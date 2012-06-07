<?php
/**
 * Wrappers for facebook plugins.
 * @copyright © Digitick <www.digitick.net> 2011
 * @license GNU Lesser General Public License v3.0
 * @author Ianaré Sévi
 */

require_once 'EFaceplugsBase.php';

/**
 * The Recommendations plugin shows personalized recommendations to your users.
 *
 * @see http://developers.facebook.com/docs/reference/plugins/recommendations
 */
class Recommendations extends EFaceplugsBase
{
	/**
	 * @var string The domain to show activity for. Defaults to the current domain.
	 */
	public $site;
	/** 
	 * @var string a comma separated list of actions to show recommendations for. 
	 */
	public $action;
	/**
	 * @var integer The width of the plugin in pixels. Default width: 300px.
	 */
	public $width;
	/**
	 * @var integer The height of the plugin in pixels. Default height: 300px.
	 */
	public $height;
	/**
	 * @var boolean Specifies whether to show the Facebook header.
	 */
	public $header;
	/**
	 * @var string The color scheme for the plugin. Options: 'light', 'dark'
	 */
	public $colorscheme;
	/**
	 * @var string The font to display in the plugin. Options: 'arial', 'lucida grande',
	 * 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
	 */
	public $font;
	/**
	 * @var string The border color of the plugin.
	 */
	public $border_color;
	/**
	 * @var boolean This specifies the context in which content links are opened.
	 * 
	 * By default all links within the plugin will open a new window.If you want
	 * the content links to open in the same window, youcan set this parameter
	 * to _top or _parent. Link to Facebook URLs will always open in a new window.
	 */
	public $linktarget;	
	/**
	 * @var string A label for tracking referrals; must be less than 50
	 * characters and can contain alphanumeric characters and some punctuation
	 * (currently +/=-.:_).
	 */
	public $ref;
	/**
	 * @var interger a limit on recommendation and creation time of articles that
	 * surfaced in the plugins, the default is 0. otherwise the valid values are
	 * 1-180, which specifies the number of days. 
	 */
	public $max_age;

	public function run()
	{
		parent::run();
		$this->renderTag('recommendations');
	}

}
