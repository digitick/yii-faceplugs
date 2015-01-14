<?php
/**
 * Comments class file.
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
 * The Comments box lets people comment on content on your site using their Facebook profile
 * and shows this activity to their friends in news feed. It also contains built-in moderation
 * tools and special social relevance ranking.
 *
 * @see https://developers.facebook.com/docs/plugins/comments
 */
class Comments extends OpenGraphPluginBase
{
    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'comments';

    /**
     * @var string The color scheme for the plugin. Options: 'light', 'dark'
     * Default: light
     */
    public $colorscheme;

    /**
     * @var string The absolute URL that comments posted in the plugin will
     * be permanently associated with. Stories on Facebook about comments
     * posted in the plugin will link to this URL.
     * Default: current url
     */
    public $href;

    /**
     * @var string A boolean value that specifies whether to show the mobile-optimized version or not.
     * Default: auto-detected
     */
    public $mobile;

    /**
     * @var integer The number of comments to show by default. The minimum value is 1.
     * Default: 10
     */
    public $num_posts;

    /**
     * @var integer The order to use when displaying comments. Can be "social", "reverse_time",
     * or "time". The different order types are explained in the FAQ
     * @see https://developers.facebook.com/docs/plugins/comments#faqorder
     */
    public $order_by;

    /**
     * @var integer The width of the plugin. Either a pixel value or the literal 100%
     * for fluid width. The mobile version of the Comments plugin ignores the width
     * parameter, and instead has a fluid width of 100%.
     * Default: 550
     */
    public $width;

}
