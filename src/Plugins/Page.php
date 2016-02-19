<?php
/**
 * LikeButton class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @author Ianaré Sévi (original author) www.digitick.net
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright &copy; Digitick <www.digitick.net> 2011
 * @copyright Copyright &copy; 2016 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */
namespace YiiFacebook\Plugins;

/**
 * The Page plugin lets you easily embed and promote any Facebook Page on your website. Just like on Facebook, your
 * visitors can like and share the Page without leaving your site.
 *
 * @see https://developers.facebook.com/docs/plugins/page-plugin
 */

class Page extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'page';

    /**
     * @var string The URL of the Facebook Page
     */
    public $href;

    /**
     * @var integer The pixel width of the plugin. Min. is 180 & Max. is 500
     * Default: 340
     */
    public $width;

    /**
     * @var integer The pixel height of the plugin. Min. is 70
     * Default: 500
     */
    public $height;

    /**
     * @var string Tabs to render i.e. timeline, events, messages. Use a
     * comma-separated list to add multiple tabs, i.e. timeline, events.
     * Default: timeline
     */
    public $tabs;

    /**
     * @var boolean Hide cover photo in the header
     * Default: false
     */
    public $hide_cover;

    /**
     * @var boolean Show profile photos when friends like this
     * Default: true
     */
    public $show_facepile;

    /**
     * @var boolean Hide the custom call to action button (if available)
     * Default: false
     */
    public $hide_cta;

    /**
     * @var boolean Use the small header instead
     * Default: false
     */
    public $small_header;

    /**
     * @var boolean Try to fit inside the container width
     * Default: false
     */
    public $adapt_container_width;



}
