<?php
/**
 * FBUserIdentity class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright Copyright &copy; 2014 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */
namespace YiiFacebook;

/**
 * FBUserIdentity represents the data needed to identity a user to log in with Facebook.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FBUserIdentity extends CBaseUserIdentity
{
    const ERROR_UNKNOWN_FACEBOOK_ID = 10;

    /**
     * @var string username
     */
    public $username;

    private $_fbid;
    private $_id;
    private $_record;

    /**
     * Constructor.
     * @param string $fbid facebook user ID
     */
    public function __construct($fbid)
    {
        $this->_fbid = $fbid;
    }

    // accessor method
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Returns the display name for the identity.
     * The default implementation simply returns {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return string the display name for the identity.
     */
    public function getName()
    {
        return $this->username;
    }

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        // now find the user using the Facebook ID
        $record = $this->mapUser();
        if ($record === null) { // if no user is found
            $this->errorCode = self::ERROR_UNKNOWN_FACEBOOK_ID; // error
        } else {
            $this->username = $record->username;
            $this->_id = $record->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * Find user based on the Facebook Id (fbid) field set on this Identity
     * Ensure the user does not have a blocked status.
     * @return CActiveRecord|the
     */
    public function findUser()
    {
        if (!$this->_record) {
            if ($this->_fbid) {
                $userCriteria = new CDbCriteria;
                $userCriteria->addNotInCondition('status', array(User::STATUS_BLOCKED, User::STATUS_PENDING));
                $this->_record = User::model()->findByAttributes(array('facebookid' => $this->_fbid), $userCriteria);
            }
        }
        return $this->_record;
    }

    public function mapUser()
    {
        // attempt to map user and update id
        if (Yii::app()->facebook->getUser() && $this->findUser() === null && isset(Yii::app()->params['update_fb_id']) && Yii::app()->params['update_fb_id'] == true) {

            try {
                $info = Yii::app()->facebook->api('/me');

                if ($info && isset($info['email'])){
                    $userCriteria = new CDbCriteria;
                    $userCriteria->addNotInCondition('status', array(User::STATUS_BLOCKED, User::STATUS_PENDING));
                    $this->_record = User::model()->findByAttributes(array('username' => $info['email']), $userCriteria);
                    // update facebook id
                    if ($this->_record) {
                        $this->_record->facebookid = $info['id'];
                        $this->_fbid = $info['id'];
                        $this->_record->save(true,array('facebookid'));
                    }
                }
            } catch (FacebookApiException $e) {
                Yii::app()->user->setFlash('error',"There was a problem connecting Facebook. Please try again later.");
            }
        }
        return $this->_record;
    }

}
