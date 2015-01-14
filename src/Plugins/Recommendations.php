<?php
/**
 * Recommendations class file.
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
 * The Recommendations plugin shows personalized recommendations to your users.
 *
 * @see https://developers.facebook.com/docs/plugins/recommendations
 */
class Recommendations extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'recommendations';

    /**
     * @var string a comma separated list of actions to show recommendations for
     * @see https://developers.facebook.com/docs/opengraph/creating-action-types/
     */
    public $action;

    /**
     * @var integer Display all actions associated with this app ID. This is usually
     * inferred from the app ID you use to initiate the [JavaScript SDK].
     */
    public $app_id;

    /**
     * @var string The color scheme for the plugin. Options: 'light', 'dark'
     * Default: light
     */
    public $colorscheme;

    /**
     * @var boolean Specifies whether to show the Facebook header.
     * Default: true
     */
    public $header;

    /**
     * @var integer The width of the plugin in pixels.
     * Default: 300
     */
    public $width;

    /**
     * @var integer The height of the plugin in pixels.
     * Default: 300
     */
    public $height;

    /**
     * @var string TDetermines what happens when people click on the links in the feed.
     * Can be any of the standard HTML target values.
     * Default: "_blank"
     */
    public $linktarget;

    /**
     * @var integer a limit on recommendation and creation time of articles that are
     * surfaced in the plugins, the default is 0 (we don’t take age into account).
     * Otherwise the valid values are 1-180, which specifies the number of days.
     */
    public $max_age;

    /**
     * @var string A label for tracking referrals which must be less than 50 characters
     * and can contain alphanumeric characters and some punctuation (currently +/=-.:_).
     * See the FAQ for more details.
     * @see https://developers.facebook.com/docs/plugins/share-button#faqref
     */
    public $ref;

    /**
     * @var string The domain for which to show activity.
     * Default: current domain
     */
    public $site;

}
