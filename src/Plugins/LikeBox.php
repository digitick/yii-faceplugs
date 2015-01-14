<?php
/**
 * LikeBox class file.
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
 * The Like Box is a special version of the Like Button designed only for Facebook Pages.
 * It allows admins to promote their Pages and embed a simple feed of content from a Page
 * into other sites.
 *
 * @see https://developers.facebook.com/docs/plugins/like-box-for-pages
 */
class LikeBox extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'like-box';

    /**
     * @var string The color scheme used by the plugin for any text outside of the button itself.
     * Can be "light" or "dark".
     * Default: light
     */
    public $colorscheme;

    /**
     * @var boolean For "place" Pages (Pages that have a physical location that can be used with check-ins),
     * this specifies whether the stream contains posts by the Page or just check-ins from friends.
     * Default: false
     */
    public $force_wall;

    /**
     * @var boolean Specifies whether to display the Facebook header at the top of the plugin.
     * Default: true
     */
    public $header;

    /**
     * @var integer The height of the plugin in pixels. The default height varies based on number
     * of faces to display, and whether the stream is displayed. With stream set to true and 10 photos
     * displayed (via show_faces) the default height is 556px. With stream and show_faces both false, the
     * default height is 63px. The stream is always 300px so if you have it enabled, you need to make sure
     * there is enough height for any other elements, e.g. footer, header
     */
    public $height;

    /**
     * @var string The absolute URL of the Facebook Page that will be liked. This is a required setting.
     */
    public $href;

    /**
     * @var boolean Specifies whether or not to show a border around the plugin.
     * Default: true
     */
    public $show_border;

    /**
     * @var boolean Specifies whether to display profile photos of people who like the page.
     * Default: true
     */
    public $show_faces;

    /**
     * @var boolean Specifies whether to display a stream of the latest posts by the Page.
     * Default: false
     */
    public $stream;

    /**
     * @var integer The width of the plugin in pixels. Minimum is 292.
     * Default: 300
     */
    public $width;

}
