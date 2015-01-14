<?php
/**
 * ShareButton class file.
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
 * The Share button lets people add a personalized message to links before
 * sharing on their timeline, in groups, or to their friends via a Facebook Message.
 *
 * @see https://developers.facebook.com/docs/plugins/share-button
 */

class ShareButton extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'share-button';

    /**
     * @var string The URL to share
     */
    public $href;

    /**
     * @var string tSelects one of the different layouts that are available for the plugin.
     * Can be one of "box_count", "button_count", "button", "link", "icon_link", or "icon".
     * Default: icon_link
     */
    public $layout;

}
