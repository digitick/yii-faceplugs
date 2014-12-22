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
 * The Login Button shows profile pictures of the user's friends who have
 * already signed up for your site in addition to a login button.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/login
 */
class LoginButton extends OpenGraphPluginBase
{
    /**
     * @var string The URL of the page.
     *
     * The plugin will display photos of users who have liked this page.
     */
    public $show_faces;
    /**
     * @var integer The width of the plugin in pixels. Default width: 200px.
     */
    public $width;
    /**
     * @var integer The maximum number of rows of profile photos in the Facepile when show_faces is enabled.
     * The actual number of rows shown may be shorter if there aren't enough faces to fill the number you specify.
     * Default value: 1.
     */
    public $max_rows;
    /**
     * @var string A comma separated list of extended permissions.
     *
     * By default the Login button prompts users for their public information.
     * If your application needs to access other parts of the user's profile
     * that may be private, your application can request extended permissions.
     *
     * @see http://developers.facebook.com/docs/authentication/permissions/
     */
    public $scope;
    /**
     * @var string registration page url.
     * If the user has not registered for your
     * site, they will be redirected to the URL you specify in the registration-url
     * parameter.
     */
    public $registration_url;
    /**
     * @var string Picks one of the size options for the button. Options: small, medium, large, xlarge
     * Default value: small
     */
    public $size;
    /**
     * @var string A JavaScript function to trigger when the login process is complete.
     *
     * @see http://developers.facebook.com/docs/user_registration/flows/
     */
    public $onlogin;
    /**
     * @var string text of the login button
     */
    public $text;
    /**
     * @var bool If enabled, the button will change to a logout button when the user is logged in
     */
    public $auto_logout_link;
    /**
     * Determines what audience will be selected by default, when requesting write permissions.
     * @var bool Everyone, friends, only_me (Default: friends)
     */
    public $default_audience;

    public function run()
    {
        parent::run();
        $params = $this->getParams();
        $this->renderTag('login-button', $params);
    }

}
