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
 * SFacebookAuthBehavior is a behavior for the application.
 * It loads additional config parameters that cannot be statically
 * written in config/main
 */
class SFacebookAuthBehavior extends CBehavior
{

    public static function fbLoginPrompt($successJs = "window.location.reload();")
    {
        $model = Yii::app()->user->model;
        if ($model && !$model->facebookid) {
            Yii::app()->user->setFlash('notice', '<strong>You have not linked your Facebook account.</strong><br /> ' .
                'Some SplashLab features will not work unless you are logged in to Facebook: ' .
                self::getWidget('ext.facebook.plugins.LoginButton', array(
                        'on_login' => 'fbLinkAuthCallback()',
                        'size' => 'small',
                        'text' => 'Link Facebook Account')
                ) .
                '<script type="text/javascript">
                function fbLinkAuthCallback() {
                  FB.login(function(response) {
                    if (response.authResponse) {
                      ' . $successJs . '
              }
            });
          }</script>');
        } elseif (!Yii::app()->user->isGuest && Yii::app()->user->userModel->status != 'admin') {
            Yii::app()->user->setFlash('notice', '<strong>You are not currently logged in with Facebook.</strong><br /> ' .
                'Some SplashLab features will not work unless you are logged in to Facebook: ' .
                self::getWidget('ext.facebook.plugins.LoginButton', array(
                        'on_login' => 'fbReAuthCallback()',
                        'size' => 'small',
                        'text' => 'Click here to Log In to Facebook')
                ) .
                '<script type="text/javascript">
                function fbReAuthCallback() {
                  FB.login(function(response) {
                    if (response.authResponse) {
                      ' . $successJs . '
              }
            });
          }</script>');
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
