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
 * SFacebookAuthBehavior is a behavior for the application.
 * It loads additional config parameters that cannot be statically
 * written in config/main
 */
class SFacebookAuthBehavior extends \CBehavior
{

    public static function fbLoginPrompt($scope = null) {
        $fbLoginCallback = "
            function fbLoginCallback(response) {
                location.reload();
            }
        ";
        Yii::app()->getClientScript()->registerScript('fb-login-callback', $fbLoginCallback, \CClientScript::POS_END);
        $model = Yii::app()->user->model;

        // if user, but no linked Facebook ID, prompt to link
        if ($model && !$model->{Yii::app()->facebook->userFbidAttribute }) {
            Yii::app()->user->setFlash('notice', '<strong>You have not linked your Facebook account.</strong><br /> ' .
                'Some SplashLab features will not work unless you are logged in to Facebook. '.
                \CHtml::link('Link Facebook Account', Yii::app()->facebook->accountLinkUrl)
                );

        // user is logged in and does have a linked facebook account
        } elseif (!Yii::app()->user->isGuest) {
            //Yii::app()->facebook->addJsCallback($script);
            Yii::app()->user->setFlash('notice', '<strong>You are not currently logged in with Facebook.</strong><br /> ' .
                'Some SplashLab features will not work unless you are logged in to Facebook: ' .
                self::getWidget('\YiiFacebook\Plugins\LoginButton', array(
                        'size' => 'small',
                        'text' => 'Click here to Log In to Facebook',
                        'onlogin' => 'fbLoginCallback()',
                        'scope' => $scope)
                ));
        }
    }

    protected static function getWidget($className, $properties)
    {
        ob_start();
        ob_implicit_flush(false);
        $widget = Yii::app()->getWidgetFactory()->createWidget(Yii::app()->controller, $className, $properties);
        $widget->init();
        $widget->run();
        return ob_get_clean();
    }
}
