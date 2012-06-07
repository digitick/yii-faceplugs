<?php
/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsBase.php';

/**
 * The Subscribe button lets a user subscribe to your public updates on Facebook.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/subscribe
 */
class SubscribeButton extends EFaceplugsBase
{
	/**
	 * @var string The profile URL of the user to subscribe to. This must be a facebook.com profile URL.
	 */
	public $href;
	/**
	 * @var string There are three options:
	 *
	 * 'standard' - displays social text to the right of the button and friends' profile photos below.
	 * Minimum width: 225 pixels. Default width: 450 pixels. Height: 35 pixels (without photos) or 80 pixels (with photos).
	 *
	 * 'button_count' - displays the total number of subscribers to the right of the button.
	 * Minimum width: 90 pixels. Default width: 90 pixels. Height: 20 pixels.
	 *
	 * box_count - displays the total number of subscribers above the button.
	 * Minimum width: 55 pixels. Default width: 55 pixels. Height: 65 pixels.
	 */
	public $layout;
	/**
	 * @var boolean Display profile photos in the plugin (standard layout only).
	 */
	public $show_faces;
	/**
	 * @var string The color scheme for the plugin. Options: 'light', 'dark'
	 */
	public $colorscheme;
	/**
	 * @var string The font to display in the button. Options: 'arial',
	 * 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
	 */
	public $font;
	/**
	 * @var integer The width of the plugin in pixels.
	 */
	public $width;
	
	public function run()
	{
		parent::run();
		$this->renderTag('subscribe');
	}
}
