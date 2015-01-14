<?php
/**
 * ActivityFeed class file.
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
 * The Activity feed displays the most interesting, recent activity taking place on your site,
 * using actions (such as likes) by your friends and other people.
 *
 * @see https://developers.facebook.com/docs/plugins/activity
 */
class ActivityFeed extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'activity';

    /**
     * @var string A comma-separated list of Open Graph action types to show in the feed.
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
     * @var string Allows you to filter which URLs are shown in the plugin. For example,
     * if the site parameter is set to 'www.example.com' and the filter parameter was set to
     * '/section1/section2' then only pages which matched 'http://www.example.com/section1/section2/*'
     * would be included in the activity feed section of this plugin. This filter does not apply to
     * any recommendations which may appear in this plugin (see recommendations setting).
     */
    public $filter;

    /**
     * @var boolean Show the "Recent Activity" header above the feed. Can be "true" or "false"
     * Default: true
     */
    public $header;

    /**
     * @var string TDetermines what happens when people click on the links in the feed.
     * Can be any of the standard HTML target values.
     * Default: "_blank"
     */
    public $linktarget;

    /**
     * @var integer Limit the created time of articles that are shown in the feed.
     * Valid values are 1-180, which represents the age in days to limit to.
     * Default: 0 (no limit)
     */
    public $max_age;

    /**
     * @var boolean Specifies whether to always show recommendations
     * (Articles liked by a high amount of people) in the bottom half of the
     * feed. Can be "true" or "false".
     * Default: false
     */
    public $recomendations;

    /**
     * @var string A label for tracking referrals which must be less than 50
     * characters and can contain alphanumeric characters and some punctuation
     * (currently +/=-.:_). See the FAQ for more details.
     * @see https://developers.facebook.com/docs/plugins/activity#faqref
     */
    public $ref;

    /**
     * @var string The domain for which to show activity.
     * Default: current domain
     */
    public $site;

    /**
     * @var integer The width of the plugin in pixels.
     * Default: 300
     */
    public $width;

}
