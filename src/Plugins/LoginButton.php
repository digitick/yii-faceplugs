<?php
/**
 * LoginButton class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @author Ianaré Sévi (original author) www.digitick.net
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright &copy; Digitick <www.digitick.net> 2011
 * @copyright Copyright &copy; 2012 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */

namespace YiiFacebook\Plugins;

/**
 * The Login Button is a simple way to trigger the Facebook Login process on your website or web app.
 *
 * If someone hasn't logged into your app yet, they'll see this button, and clicking it will popup a
 * Login dialog, starting the login flow. People who have already logged in won't see any button, or
 * you can also choose to show a logout button to them.
 *
 * The Login Button is only designed to work in connection with the JavaScript SDK - if you're building
 * a mobile app or can't use our JavaScript SDK, you should follow the login flow guide for that type of
 * app instead.
 *
 * @see https://developers.facebook.com/docs/plugins/login-button
 * @see https://developers.facebook.com/docs/facebook-login/login-flow-for-web/
 */
class LoginButton extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'login-button';

    /**
     * @var boolean The plugin will display photos of users who have liked this page.
     */
    public $show_faces;

    /**
     * @var integer Determines whether a Facepile of logged-in friends is shown below the button.
     * When this is enabled, a logged-in user will only see the Facepile, and no login or logout button.
     * Default value: 1.
     */
    public $max_rows;

    /**
     * @var string The list of permissions to request during login.
     *
     * @see https://developers.facebook.com/docs/facebook-login/permissions/v2.2
     */
    public $scope;

    /**
     * @var string Picks one of the size options for the button. Options: small, medium, large, xlarge
     * Default: small
     */
    public $size;

    /**
     * @var string A JavaScript function to trigger when the login process is complete.
     */
    public $onlogin;

    /**
     * @var string Text of the login button
     */
    public $text;

    /**
     * @var bool If enabled, the button will change to a logout button when the user is logged in
     * Default: false
     */
    public $auto_logout_link;

    /**
     * Determines what audience will be selected by default, when requesting write permissions.
     * @var string Everyone, friends, only_me
     * Default: friends
     */
    public $default_audience;


}
