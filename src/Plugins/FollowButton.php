<?php
/**
 * FollowButton class file.
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
 * The Follow button lets people subscribe to the public updates of others on Facebook.
 *
 * @see https://developers.facebook.com/docs/plugins/follow-button
 */
class FollowButton extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'follow';

    /**
     * @var string The color scheme used by the plugin for any text outside of the button itself.
     * Can be "light" or "dark".
     * Default: light
     */
    public $colorscheme;

    /**
     * @var string The Facebook.com profile URL of the user to follow.
     */
    public $href;

    /**
     * @var string If your web site or online service, or a portion of your service,
     * is directed to children under 13 you must enable this
     * Default: false
     */
    public $kid_directed_site;

    /**
     * @var string Selects one of the different layouts that are available for the plugin.
     * Can be one of "standard", "button_count", or "box_count". See the FAQ for more details.
     * @see https://developers.facebook.com/docs/plugins/follow-button#faqlayouts
     * Default: standard
     */
    public $layout;

    /**
     * @var boolean Specifies whether to display profile photos below the button (standard layout only).
     * You must not enable this on child-directed sites.
     * Default: false
     */
    public $show_faces;

    /**
     * @var integer The width of the plugin. The layout you choose affects the minimum and default widths
     * you can use, please see the FAQ below for more details.
     * @see https://developers.facebook.com/docs/plugins/follow-button#faqlayout
     */
    public $width;


}
