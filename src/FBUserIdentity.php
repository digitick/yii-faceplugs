<?php
/**
 * FBUserIdentity class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright Copyright &copy; 2015 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */
namespace YiiFacebook;

use Yii;

/**
 * FBUserIdentity represents the data needed to identity a user to log in with Facebook via Facebook ID.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FBUserIdentity extends \CBaseUserIdentity
{
    const ERROR_UNKNOWN_FACEBOOK_ID = 10;

    private $_fbid;
    protected $_id;
    protected $_record;

    /**
     * Constructor.
     * @param integer $fbid Facebook user ID
     * @throws \CException If userFbidAttribute is not set
     */
    public function __construct($fbid)
    {
        if (!Yii::app()->facebook->userFbidAttribute) {
            throw new \CException('YiiFacebook userFbidAttribute property must be declared.');
        }
        $this->_fbid = $fbid;
    }

    /**
     * Get user Facebook ID
     * @return integer
     */
    public function getFbid()
    {
        return $this->_fbid;
    }

    /**
     * Authenticates a user by Facebook ID
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $record = $this->findUser();
        if ($record === null) { // if no user is found
            $this->errorCode = self::ERROR_UNKNOWN_FACEBOOK_ID; // error
            $this->errorMessage = "Unknown Facebook ID";
        } else {
            $this->_id = $record->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * Find user based on the Facebook ID (fbid) field set on this Identity
     * @return CActiveRecord|the user linked to this facebook account
     */
    public function findUser()
    {
        if (!$this->_record && $this->_fbid) {
            $this->_record = \User::model()->findByAttributes(
                array(Yii::app()->facebook->userFbidAttribute => $this->_fbid)
            );
        }
        return $this->_record;
    }

}
