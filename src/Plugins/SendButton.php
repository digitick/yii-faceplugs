<?php
/**
 * SendButton class file.
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
 * The Send button lets people privately send content on your site to one or
 * more friends in a Facebook message, to an email address, or share it with a
 * Facebook group.
 *
 * @see https://developers.facebook.com/docs/plugins/send-button
 */
class SendButton extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'send';

    /**
     * @var string The absolute URL of the page that will be sent.
     * Default: current url
     */
    public $href;

    /**
     * @var integer Width of the Send button, defaults to 51px
     */
    public $width;
    /**
     * @var integer Height of the Send button, defaults to 450px
     */
    public $height;

    /**
     * @var string The color scheme used by the plugin. Can be "light" or "dark".
     * Default: light
     */
    public $colorscheme;

    /**
     * @var string If your web site or online service, or a portion of your service,
     * is directed to children under 13 you must enable this
     * Default: false
     */
    public $kid_directed_site;

    /**
     * @var string A label for tracking referrals which must be less than 50 characters,
     * and can contain alphanumeric characters and some punctuation (currently +/=-.:_).
     * See the FAQ for more details.
     * @see https://developers.facebook.com/docs/plugins/send-button#faqref
     */
    public $ref;

}
