<?php
/**
 * YiiFacebookSessionPersistentDataHandler class file.
 *
 * @author Evan Johnson <thaddeusmt - A T - gmail.com>
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright Copyright &copy; 2016 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */

namespace YiiFacebook;
use Yii;
use Facebook;
use Facebook\PersistentData\PersistentDataInterface;
use Facebook\Exceptions\FacebookSDKException;

class YiiFacebookSessionPersistentDataHandler implements PersistentDataInterface
{
    /**
     * @var string Prefix to use for session variables.
     */
    protected $sessionPrefix = 'FBRLH_';

    /**
     * Init the Yii session handler.
     *
     * @param boolean $enableSessionCheck
     *
     * @throws FacebookSDKException
     */
    public function __construct($enableSessionCheck = true)
    {
        if ($enableSessionCheck && !Yii::app()->session) {
            throw new FacebookSDKException(
                'Yii Sessions are not active.',
                720
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        if (isset(Yii::app()->session[$this->sessionPrefix . $key])) {
            return Yii::app()->session[$this->sessionPrefix . $key];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        Yii::app()->session[$this->sessionPrefix . $key] = $value;
    }
}