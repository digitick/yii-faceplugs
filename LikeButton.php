<?php
/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsBase.php';

/**
 * The Like button lets a user share your content with friends on Facebook.
 *
 * When the user clicks the Like button on your site, a story appears in the
 * user's friends' News Feed with a link back to your website.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/like
 */
class LikeButton extends EFaceplugsBase
{
	/**
	 * @var string The URL of the Facebook page for this Like button.
	 */
	public $href;
	/**
	 * @var boolean Specifies whether to include a Send button with the Like
	 * button.
	 */
	public $send;
	/**
	 * @var string Three options : 'standard', 'button_count', 'box_count'
	 */
	public $layout;
	/**
	 * @var boolean Display profile photos below the button (standard layout only).
	 */
	public $show_faces;
	/**
	 * @var integer Width of the Like button, defults to 450px
	 */
	public $width;
	/**
	 * @var string The verb to display on the button. Options: 'like', 'recommend'
	 */
	public $action;
	/**
	 * @var string The font to display in the button. Options: 'arial',
	 * 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
	 */
	public $font;
	/**
	 * @var string The color scheme for the plugin. Options: 'light', 'dark'
	 */
	public $colorscheme;
	/**
	 * @var string A label for tracking referrals; must be less than 50
	 * characters and can contain alphanumeric characters and some punctuation
	 * (currently +/=-.:_).
	 */
	public $ref;

	public function run()
	{
		parent::run();
		$this->renderTag('like');
	}
}
