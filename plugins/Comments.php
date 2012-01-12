<?php
/**
 * Comments class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @author Ianaré Sévi (original author) www.digitick.net
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright Copyright &copy; 2011 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
 *
 */

require_once 'SPluginBase.php';

/**
 * The Comments Box easily enables your users to comment on your site's content —
 * whether it's for a web page, article, photo, or other piece of content.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/comments
 */
class Comments extends SPluginBase
{
	/**
	 * @var integer Number of posts to show.
	 */
	public $numposts;
	/**
	 * @var integer The width of the widget.
	 */
	public $width;
	/**
	 * @var boolean Specify whether to publish a comment on the user's wall.
	 */
	public $publish_feed = true;

	public function run()
	{
		parent::run();
		$params = $this->getParams();
        $this->renderTag('comments',$params);
	}

}
