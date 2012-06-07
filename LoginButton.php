<?php

/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsAppLink.php';

/**
 * The Login Button shows profile pictures of the user's friends who have
 * already signed up for your site in addition to a login button.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/login
 */
class LoginButton extends EFaceplugsAppLink
{
	/**
	 * @var string The URL of the page.
	 *
	 * The plugin will display photos of users who have liked this page.
	 */
	public $show_faces;
	/**
	 * @var integer The width of the plugin in pixels. Default width: 200px.
	 */
	public $width;
	/**
	 * @var integer The maximum number of rows of profile pictures to display.
	 * Default value: 1.
	 */
	public $max_rows;
	/**
	 * @var string a comma separated list of extended permissions.By default the
	 * Login button prompts users for their public information. 
	 */
	public $scope;
	/**
	 * @var string registration page url. If the user has not registered for your
	 * site, they will be redirected to the URL you specify in the registration-url
	 * parameter. 
	 */
	public $registration_url;
	

	public function run()
	{
		parent::run();
		$this->renderTag('login-button');
	}

}
