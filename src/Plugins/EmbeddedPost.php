<?php
/**
 * EmbeddedPost class file.
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
 * Embedded Posts are a simple way to put public posts - by a Page or a person on Facebook -
 * into the content of your web site or web page. Only public posts from Facebook Pages and
 * profiles can be embedded.
 *
 * @see https://developers.facebook.com/docs/plugins/embedded-posts
 */
class EmbeddedPost extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'post';

    /**
     * @var string URL of the Facebook post to embed
     */
    public $href;

    /**
     * @var integer The pixel width of the post (between 350 and 750)
     */
    public $width;

}
