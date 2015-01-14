<?php
/**
 * LikeButton class file.
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
 * The Like button is the quickest way for people to share content with their friends.
 *
 * A single click on the Like button will 'like' pieces of content on the web and share
 * them on Facebook. You can also display a Share button next to the Like button to let
 * people add a personal message and customize who they share with.
 *
 * @see https://developers.facebook.com/docs/plugins/like-button
 */

class LikeButton extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'like';

    /**
     * @var string The verb to display on the button. Can be either "like" or "recommend"
     * Default: like
     */
    public $action;

    /**
     * @var string The color scheme used by the plugin for any text outside of the button itself.
     * Can be "light" or "dark".
     * Default: light
     */
    public $colorscheme;

    /**
     * @var string The absolute URL of the page that will be liked.
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
     * Can be one of "standard", "button_count", "button" or "box_count".
     * See the FAQ for more details.
     * @see https://developers.facebook.com/docs/plugins/like-button#faqlayout
     * Default: standard
     */
    public $layout;

    /**
     * @var string A label for tracking referrals which must be less than 50 characters
     * and can contain alphanumeric characters and some punctuation (currently +/=-.:_).
     * See the FAQ for more details.
     * @see https://developers.facebook.com/docs/plugins/like-button#faqref
     */
    public $ref;

    /**
     * @var boolean Specifies whether to include a share button beside the Like button.
     * This only works with the XFBML version.
     * Default: false
     */
    public $share;

    /**
     * @var boolean Specifies whether to display profile photos below the button
     * (standard layout only). You must not enable this on child-directed sites.
     * Default: false
     */
    public $show_faces;

    /**
     * @var integer The width of the plugin (standard layout only), which is subject
     * to the minimum and default width. Please see the FAQ below for more details.
     * Default: Depends on layout
     */
    public $width;

}
