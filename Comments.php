<?php
/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsBase.php';

/**
 * The Comments Box easily enables your users to comment on your site's content —
 * whether it's for a web page, article, photo, or other piece of content.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/comments
 */
class Comments extends EFaceplugsBase
{
	/**
	 * @var string the URL for this Comments plugin. News feed stories on Facebook
	 * will link to this URL. 
	 */
	public $href;
	/**
	 * @var integer The width of the widget.
	 */
	public $width;
	/**
	 * @var string the colors scheme for the plugin. Options:'light','dark' 
	 */
	public $colorscheme;
	/**
	 * @var integer The number of comments to show by default. Default:'10. Minimum:1
	 */
	public $num_posts;
	
	/**
	 * @var string whether to show the mobile-optimized version.Default:auto-delect.
	 */
	public $mobile;

	public function run()
	{
		parent::run();
		$this->renderTag('comments');
	}

}
