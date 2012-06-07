<?php
/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsAppLink.php';

/**
 * The registration plugin allows users to easily sign up for your website with
 * their Facebook account.
 *
 * @see http://developers.facebook.com/docs/plugins/registration
 */
class Registration extends EFaceplugsAppLink
{
	/**
	 * @var integer your app ID.
	 */
	public $client_id;
	/**
	 * @var string The URI that will process the signed_request. It must be
	 * prefixed by your Site URL.
	 */
	public $redirect_uri;	
	/**
	 * @var string Comma separated list of Named Fields, or JSON of Custom
	 * Fields.
	 */
	public $fields;
	/**
	 * @var boolean Only allow users to register by linking their Facebook profile.
	 *
	 * Use this if you do not have your own registration system. Default: false.
	 */
	public $fb_only;
	/**
	 * @var boolean Allow users to register for Facebook during the registration
	 * process. Use this if you do not have your own registration system. Default:false. 
	 */
	public $fb_register;
	/**
	 * @var integer The width in pixels. If the width is < 520 the plugin will
	 * render in a small layout.
	 */
	public $width;
	/**
	 * @var integer the border color of the plugin. 
	 */
	public $border_color;
	/**
	 * @var string The target of the form submission: _top(default),_parent of self.
	 */
	public $target;
	
	public function run()
	{
		parent::run();
		$this->client_id = $this->app_id;
		$this->renderTag('registration');
	}

}
