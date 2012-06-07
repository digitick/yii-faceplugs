<?php
/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsBase.php';

/**
 * The Send Button allows users to easily send content to their friends.
 *
 * People will have the option to send your URL in a message to their Facebook friends,
 * to the group wall of one of their Facebook groups, and as an email to any email address.
 * While the Like Button allows users to share content with all of their friends, the
 * Send Button allows them to send a private message to just a few friends.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/send
 */
class SendButton extends EFaceplugsBase
{
	/**
	 * @var string The URL to send.
	 */
	public $href;
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
		$this->renderTag('send');
	}
}
