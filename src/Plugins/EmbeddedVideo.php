<?php
/**
 * EmbeddedVideo class file.
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
 * With the embedded video player you can easily add Facebook videos to your website. You can use any public video post by a Page or a person as video source.
 *
 * @see https://developers.facebook.com/docs/plugins/embedded-video-player
 */
class EmbeddedVideo extends OpenGraphPluginBase
{

    /**
     * @var string Name of plugin to render
     */
    protected $tagName = 'video';

    /**
     * @var string URL of the Facebook post to embed
     */
    public $href;

    /**
     * @var bool Allow the video to be played in fullscreen mode. Can be false or true.
     * Default: false
     */
    public $allowfullscreen;

    /**
     * @var bool Automatically start playing the video when the page loads. The video
     * will be played without sound (muted). People can turn on sound via the video
     * player controls. This setting does not apply to mobile devices. Can be false or true.
     * Default: false
     */
    public $autoplay;

    /**
     * @var string The width of the video container. Min. 220px.
     * Default: auto
     */
    public $width;

}
