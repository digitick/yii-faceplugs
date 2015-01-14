<?php
/**
 * Facepile class file.
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
 * The Facepile plugin displays the Facebook profile photos of people who have
 * connected with your Facebook page or app.
 *
 * @see https://developers.facebook.com/docs/plugins/facepile
 */
class Facepile extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'facepile';

    /**
     * @var string An Open Graph action type, such as like or customapp:run
     * @see https://developers.facebook.com/docs/opengraph/creating-action-types/
     * Default: like
     */
    public $action;

    /**
     * @var integer Specify this if you want the plugin to display users who have connected to your site using Facebook Login. If you are using the JavaScript SDK, this will be automatically specified.
     */
    public $app_id;

    /**
     * @var string The color scheme for the plugin. Options: 'light', 'dark'
     * Default: light
     */
    public $colorscheme;

    /**
     * @var string Display photos of the people who have liked this absolute URL.
     */
    public $href;

    /**
     * @var integer The maximum number of rows of faces to display. Note that if
     * there are fewer faces to display than rows specified, the plugin will pick
     * the next lowest number of rows.
     * Default: 1
     */
    public $max_rows;

    /**
     * @var string Controls the size of the photos shown in the plugin.
     * Can be "small", "medium" or "large".
     * Default: small
     */
    public $size;

    /**
     * @var integer The width of the plugin in pixels, minimum of 200.
     * Default: 300
     */
    public $width;

}
