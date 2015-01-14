<?php
/**
 * SFacebook class file.
 *
 * @author Evan Johnson <thaddeusmt - A T - gmail.com>
 * @author Ianaré Sévi (original author) www.digitick.net
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright &copy; Digitick <www.digitick.net> 2011
 * @copyright Copyright &copy; 2015 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */
namespace YiiFacebook;
use Yii;

class SFacebook extends \CApplicationComponent
{
    /**
     * @var \Facebook\FacebookSession instance of the Facebook Session class
     */
    private $_session;

    /**
     * @var string cached Facebook access token
     */
    private $_token;

    /**
     * @var string cached Facebook user id
     */
    private $_userId;

    /**
     * @var string cached FacebookRedirectLoginHelper
     */
    private $_sessionExpired = false;

    /**
     * @var string Facebook Application ID
     */
    public $appId;

    /**
     * @var string Facebook Application secret
     */
    public $secret;

    /**
     * @var string Facebook OpenGraph version to request i.e. v2.0, v2.1, v2.2
     */
    public $version = 'v2.2';

    /**
     * @var callable Callback method to run when Facebook session needs to be renewed
     */
    public $expiredSessionCallback;

    /**
     * @var string default login redirect url
     */
    public $redirectUrl;

    /**
     * @var bool whether or not to check login status
     */
    public $status = true;

    /**
     * @var bool whether or not use a cookie
     */
    public $cookie = true;

    /**
     * @var bool With xfbml set to true, the SDK will parse your page's DOM to find and initialize any
     * social plugins that have been added using XFBML. If you're not using social plugins on the page,
     * setting xfbml to false will improve page load times. You can find out more about this by looking
     * at Social Plugins.
     * @see https://developers.facebook.com/docs/javascript/quickstart#plugins
     */
    public $xfbml = false;

    /**
     * @var bool whether or not to look for an run JS callbacks in the async JS loader
     */
    public $jsCallback = false;

    /**
     * @var string JavaScript to run after the Facebook JS library loads asynchronously
     */
    private $callbackScripts = '';

    /**
     * @var array the default permissions to ask for on facebook login
     */
    public $defaultScope = array();

    /**
     * @var bool whether or not to use frictionlessRequests on request dialogs
     */
    public $frictionlessRequests = false;

    /**
     * This specifies a function that is called whenever it is necessary to hide Adobe Flash objects on a page.
     * This is used when FB.api() JS requests are made, as Flash objects will always have a higher z-index than
     * any other DOM element. See our Custom Flash Hide Callback for more details on what to put in this function:
     * https://developers.facebook.com/docs/games/canvas/handling-popups#flash_hide_callback
     * Defaults to null.
     * @var bool whether or not to use frictionlessRequests on request dialogs
     */
    public $hideFlashCallback = null;

    /**
     * @var bool turn on or off the Facebook JS
     */
    public $jsSdk = true;

    /**
     * @var bool Use new html5 Social Plugins markup instead of old xfbml
     */
    public $html5 = true;

    /**
     * @var bool Load the Facebook init script asynchronously.
     *
     * This speeds up page loads because loading the plugin does not block
     * loading other elements of the page.
     */
    public $async = true;

    /**
     * @var int user attribute where Facebook Id is stored
     */
    public $userFbidAttribute;

    /**
     * @var string url of page to link Facebook account to user account
     */
    public $accountLinkUrl;

    /**
     * @var string Override default locale for the widget.
     *
     * Normally locale is set automatically based on the Yii language settings,
     * setting it here allows a specific locale to be used.
     */
    public $locale;
    private $_locale;

    /**
     * @var array Open Graph Meta Tags
     */
    public $ogTags = array();

    /**
     * @var array Valid Facebook locales.
     */
    protected $locales = array(
        'az_AZ',
        'be_BY',
        'bg_BG',
        'bn_IN',
        'bs_BA',
        'ca_ES',
        'ck_US',
        'cs_CZ',
        'cy_GB',
        'da_DK',
        'de_DE',
        'eu_ES',
        'en_GB',
        'en_PI',
        'en_UD',
        'en_US',
        'es_LA',
        'es_CL',
        'es_CO',
        'es_ES',
        'es_MX',
        'es_VE',
        'fb_FI',
        'fi_FI',
        'fr_FR',
        'gl_ES',
        'hu_HU',
        'it_IT',
        'ja_JP',
        'ko_KR',
        'nb_NO',
        'nn_NO',
        'nl_NL',
        'pl_PL',
        'pt_BR',
        'pt_PT',
        'ro_RO',
        'ru_RU',
        'sk_SK',
        'sl_SI',
        'sv_SE',
        'th_TH',
        'tr_TR',
        'ku_TR',
        'zh_CN',
        'zh_HK',
        'zh_TW',
        'fb_LT',
        'af_ZA',
        'sq_AL',
        'hy_AM',
        'hr_HR',
        'nl_BE',
        'eo_EO',
        'et_EE',
        'fo_FO',
        'fr_CA',
        'ka_GE',
        'el_GR',
        'gu_IN',
        'hi_IN',
        'is_IS',
        'id_ID',
        'ga_IE',
        'jv_ID',
        'kn_IN',
        'kk_KZ',
        'la_VA',
        'lv_LV',
        'li_NL',
        'lt_LT',
        'mk_MK',
        'mg_MG',
        'ms_MY',
        'mt_MT',
        'mr_IN',
        'mn_MN',
        'ne_NP',
        'pa_IN',
        'rm_CH',
        'sa_IN',
        'sr_RS',
        'so_SO',
        'sw_KE',
        'tl_PH',
        'ta_IN',
        'tt_RU',
        'te_IN',
        'ml_IN',
        'uk_UA',
        'uz_UZ',
        'vi_VN',
        'xh_ZA',
        'zu_ZA',
        'km_KH',
        'tg_TJ',
        'ar_AR',
        'he_IL',
        'ur_PK',
        'fa_IR',
        'sy_SY',
        'yi_DE',
        'gn_PY',
        'qu_PE',
        'ay_BO',
        'se_NO',
        'ps_AF',
        'tl_ST',
    );

    public function init()
    {
        if ($this->appId && $this->secret) {
            parent::init();
            \Facebook\FacebookSession::setDefaultApplication($this->appId, $this->secret);
        } else {
            if (!$this->appId)
                throw new \CException('Facebook application ID not specified.');
            elseif (!$this->secret)
                throw new \CException('Facebook application secret not specified.');
        }
    }


    /**
     * Get the proper http URL prefix depending on if this was a secure page request or not
     *
     * @param string $override optional
     * @return string http or https
     */
    public function getProtocol($override = '')
    {
        if ($override) return $override;
        if (Yii::app()->request->isSecureConnection)
            return 'https';
        return 'http';
    }

    /**
     * Load Facebook JS and Open Graph meta tags
     * @see https://developers.facebook.com/docs/javascript
     * @see https://developers.facebook.com/docs/graph-api
     * @param string $output (passed by reference) The rendered HTML page output for this request
     * @throws \CException If no Facebook Application ID is specified for this component
     */
    public function initJs(&$output)
    {
        if (!$this->appId) {
            throw new \CException('Facebook Application ID not specified.');
        }
        // initialize the Facebook JS
        if ($this->jsSdk) {
            $script = '//connect.facebook.net/' . $this->getLocale() . '/sdk.js';
            $init = $this->registerSDKScript('init', array(
                    // https://developers.facebook.com/docs/javascript/reference/FB.init/v2.2
                    'appId' => $this->appId, // application ID
                    'version' => $this->version, // OpenGraph API version to request
                    'cookie' => $this->cookie, // enable cookies to allow the server to access the session
                    'status' => $this->status, // check login status
                    'xfbml' => $this->xfbml, // parse XFBML
                    'frictionlessRequests' => $this->frictionlessRequests, // Enable frictionless requests on requests dialog
                    'hideFlashCallback' => $this->hideFlashCallback, // This specifies a function that is called whenever it is necessary to hide Adobe Flash objects on a page.
                )
            );
            if ($this->async) {
                $init = "window.fbAsyncInit = function(){{$init}};
                (function(d, s, id){
                     var js, fjs = d.getElementsByTagName(s)[0];
                     if (d.getElementById(id)) {return;}
                     js = d.createElement(s); js.id = id;
                     js.src = '{$script}';
                     fjs.parentNode.insertBefore(js, fjs);
                 }(document, 'script', 'facebook-jssdk'));";
            } else {
                Yii::app()->clientScript->registerScriptFile($script, \CClientScript::POS_END);
            }
            Yii::app()->getClientScript()->registerScript('fb-script', $init, \CClientScript::POS_END);
            $this->insertFbRoot($output);
            $this->registerAsyncCallback();
        }
    }

    /**
     * This function adds the fb-root div tag to the bottom of the <body> tag
     * THe code is borrowed from Yii's own CClientScript::renderBodyEnd() function
     * @param string $output (passed by reference) The rendered HTML page output for this request
     */
    protected function insertFbRoot(&$output)
    {
        $fbRoot = '<div id="fb-root"></div>';
        $fullPage = 0;
        $output = preg_replace('/(<\\/body\s*>)/is', '<###end###>$1', $output, 1, $fullPage);
        if ($fullPage)
            $output = str_replace('<###end###>', $fbRoot, $output);
        else
            $output = $output . $fbRoot;
    }

    /**
     * Registers all of the Open Graph meta tags declared
     * @return void
     */
    public function renderOGMetaTags()
    {
        $this->ogTags['fb:app_id'] = $this->appId; // set this app ID og tag, for Facebook insights and administration
        if (!isset($this->ogTags['og:type']))
            $this->ogTags['og:type'] = 'website'; // set website as the default type
        if (!isset($this->ogTags['og:title']))
            $this->ogTags['og:title'] = Yii::app()->name; // default to App name
        if (!isset($this->ogTags['og:url']))
            $this->ogTags['og:url'] = $this->getProtocol() . "://" . Yii::app()->request->serverName . Yii::app()->request->requestUri; // defaults to current URL
        foreach ($this->ogTags as $type => $value) { // loop through any other OG tags declared
            $this->registerOpenGraph($type, $value);
        }
    }

    /**
     * Add JS to run in callback after Facebook initializes
     * @param string JavaScript that needs to run right after the Facebook Asynchronous loader finishes
     * @return void
     */
    public function addJsCallback($script)
    {
        $this->callbackScripts .= $script;
    }

    /**
     * Creates the Facebook JS init call
     * @param string $method
     * @param array $args args to use in the method
     * @return string the js created
     */
    protected function registerSDKScript($method, $args = array())
    {
        $args = \CJavaScript::encode($args); // Initalize Facebook JS
        if ($this->jsCallback)
            return "FB.{$method}({$args});asyncCallback();";
        else
            return "FB.{$method}({$args});";
    }

    /**
     * This method adds your scripts to the callback method
     * Call this function in afterRender after you have added scripts with the addScript method
     * @return void
     */
    protected function registerAsyncCallback()
    {
        if ($this->jsCallback) {
            $script = "function asyncCallback() {
        {$this->callbackScripts}
      }";
            Yii::app()->getClientScript()->registerScript('fb-async-callback', $script, \CClientScript::POS_END);
        }
    }

    /**
     * Register an Open Graph object property meta tag.
     * @param string $property
     * @param string $data
     */
    public function registerOpenGraph($property, $data)
    {
        Yii::app()->clientScript->registerMetaTag($data, null, null, array('property' => $property));
    }

    /**
     * Determine the script locale to load
     * Looks at $locale variable declared in this file first
     * Then looks at the Yii application language
     * @return string locale code
     * @throws \CException on invalid local code
     * Default value: en_US
     */
    protected function getLocale()
    {
        if ($this->_locale === null) {
            if (isset($this->locale)) {
                $locale = strtolower($this->locale);
            } elseif (Yii::app()->language) {
                $locale = Yii::app()->language;
            } else {
                $locale = 'en_US'; // default
            }
            // Adjustments, mainly because facebook doesn't have all countries
            // of the same language translated.
            $lang = substr($locale, 0, 2);
            $adjust = array(
                'de' => 'de_de',
                'nl' => 'nl_nl',
                'ru' => 'ru_ru',
                'ar' => 'ar_ar', // non standard
                'ku' => 'ku_tr',
            );
            // single check languages, array above ...
            if (isset($adjust[$lang])) {
                $locale = $adjust[$lang];
            } // english
            else if ($lang === 'en' && !in_array($locale, array('en_us', 'en_pi', 'en_ud'))) {
                // closer to US english
                if ($locale === 'en_ca') {
                    $locale = 'en_us';
                } // closer to UK english
                else {
                    $locale = 'en_gb';
                }
            } // french
            else if ($lang === 'fr' && $locale !== 'fr_ca') {
                $locale = 'fr_fr';
            } // spanish
            else if ($lang === 'es' && !in_array($locale, array('es_es', 'es_cl', 'es_co', 'es_mx', 'es_ve'))) {
                $locale = 'es_la'; // non standard
            } // portuguese
            else if ($lang === 'pt' && $locale !== 'pt_br') {
                $locale = 'pt_pt';
            }
            $c = explode('_', $locale);
            if (!isset($c[1])) {
                throw new \CException('Locale for Facebook plugins must be in the following format : ll_CC');
            }
            $locale = $c[0] . '_' . strtoupper($c[1]);
            if (!in_array($locale, $this->locales)) {
                throw new \CException('Invalid Facebook locale');
            }
            $this->_locale = $locale;
        }
        return $this->_locale;
    }

    /*** PHP SDK functions **/

    /**
     * Finds and loads active Facebook session
     * @throws \Facebook\FacebookRequestException if exception fails
     * @return \Facebook\FacebookSession instance of Facebook PHP SDK FacebookSession class
     */
    protected function getSession()
    {
        if (is_null($this->_session) && !$this->_sessionExpired) {

            // check for cached accessToken, and try to get session from it
            if ($this->getToken()) {
                if ($accessToken = new \Facebook\Entities\AccessToken($this->getToken())) {
                    $this->_session = new \Facebook\FacebookSession($accessToken);
                }
            }

            // if no session
            if (!$this->_session) {
                // try to get session from redirect login
                $helper = new \Facebook\FacebookRedirectLoginHelper($this->redirectUrl);
                $this->_session = $helper->getSessionFromRedirect();
            }

            // if no session
            if (!$this->_session) {
                // try to get session for JavaScript SDK cookie
                $helper = new \Facebook\FacebookJavaScriptLoginHelper();
                try {
                    $this->_session = $helper->getSession();
                } catch (\Facebook\FacebookAuthorizationException $e) {
                    $this->_sessionExpired = true;
                    $this->destroySession();
                    // if there is an re-authorize callback for expired sessions, run it if that's the problem
                    if (!$this->expiredSessionCallback($e)) {
                        throw $e; // throw exception if unable to renew facebook session
                    }
                }
            }
            // cache token and userId
            if ($this->_session) {
                $this->setToken($this->_session->getToken());
                $this->setUserId($this->_session->getUserId());
            }
        }
        return $this->_session;
    }

    /**
     * If the Facebook session has expired, possibly run code here to renew it
     * @param \Exception $e The exception we are handling
     * @return bool true if exception is handled, false to continue throwing exception
     */
    protected function expiredSessionCallback(\Exception $e)
    {
        // if there is an re-authorize callback for expired sessions, run it if that's the problem
        if (is_callable($this->expiredSessionCallback)) {
            return call_user_func($this->expiredSessionCallback);
        }
        return false;
    }

    /**
     * Get the cached access token string
     * @return string cached access token
     */
    public function getToken()
    {
        if (!$this->_token) {
            if (Yii::app()->session && isset(Yii::app()->session['fb_token'])) {
                $this->_token = Yii::app()->session['fb_token'];
            }
        }
        return $this->_token;
    }

    /**
     * Cache the Facebook access token string
     * @param string $token
     */
    protected function setToken($token)
    {
        if (Yii::app()->session) {
            Yii::app()->session['fb_token'] = $token;
        }
        $this->_token = $token;
    }

    /**
     * Get the user's Facebook ID.
     *
     * @return string the user id
     */
    public function getUserId()
    {
        if (!$this->_userId) {
            if ($this->getSession() && Yii::app()->session && isset(Yii::app()->session['fb_userId'])) {
                $this->_userId = Yii::app()->session['fb_userId'];
            }
        }
        return $this->_userId;
    }

    /**
     * Cache the Facebook user id
     * @param string $userId
     */
    protected function setUserId($userId)
    {
        if ($userId && Yii::app()->session) {
            Yii::app()->session['fb_userId'] = $userId;
        }
        $this->_userId = $userId;
    }


    /**
     * Destroy the current session
     */
    public function destroySession()
    {
        $this->_session = null;
        $this->_token = null;
        $this->_userId = null;
        // unset the cached session variables
        if (Yii::app()->session && isset(Yii::app()->session['fb_token'])) {
            unset(Yii::app()->session['fb_token']);
            unset(Yii::app()->session['fb_userId']);
        }
        // remove the JavaScript cookie as well
        if (isset($_COOKIE['fbsr_' . $this->appId])) {
            unset($_COOKIE['fbsr_' . $this->appId]);
        }
    }

    /**
     * Returns the access token entity.
     *
     * @return \Facebook\Entities\AccessToken
     */
    public function getAccessToken()
    {
        if ($this->getSession()) {
            return $this->getSession()->getAccessToken();
        }
    }

    /**
     * Get the Facebook session info
     * @return \Facebook\GraphSessionInfo
     */
    public function getSessionInfo()
    {
        if ($this->getSession()) {
            return $this->getSession()->getSessionInfo();
        }
    }

    /**
     * Returns the SignedRequest entity.
     *
     * @return \Facebook\Entities\SignedRequest
     */
    public function getSignedRequest()
    {
        if ($this->getSession()) {
            return $this->getSession()->getSignedRequest();
        }
    }

    /**
     * Returns the signed request payload.
     *
     * @return null|array
     */
    public function getSignedRequestData()
    {
        if ($this->getSession()) {
            return $this->getSession()->getSignedRequestData();
        }
    }

    /**
     * Returns a property from the signed request data if available.
     *
     * @param string $key
     *
     * @return null|mixed
     */
    public function getSignedRequestProperty($key)
    {
        if ($this->getSession()) {
            return $this->getSession()->getSignedRequestProperty($key);
        }
    }

    /**
     * Returns the signed request payload.
     *
     * @return null|array
     */
    public function getLongLivedSession()
    {
        if ($this->getSession()) {
            $this->_session = $this->getSession()->getLongLivedSession();
            return $this->_session;
        }
    }

    /**
     * Returns the signed request payload.
     *
     * @return null|array
     */
    public function getExchangeToken()
    {
        if ($this->getSession()) {
            return $this->getSession()->getExchangeToken();
        }
    }

    /**
     * Redirect urls helper function
     * @param string $redirectUrl
     * @return \Facebook\FacebookRedirectLoginHelper | cached
     */
    protected function getRedirectLoginHelper($redirectUrl = null)
    {
        if (!$redirectUrl) $redirectUrl = $this->redirectUrl;
        return new \Facebook\FacebookRedirectLoginHelper($redirectUrl);
    }

    /**
     * @param string $redirectUrl (optional)
     * @param array $scope (optional) List of permissions to request during login
     * @param bool $displayAsPopup (optional) Indicate if the page will be displayed as a popup
     * @return string
     */
    public function getLoginUrl($redirectUrl = null, $scope = array(), $displayAsPopup = false)
    {
        if ($loginHelper = $this->getRedirectLoginHelper($redirectUrl)) {
            return $loginHelper->getLoginUrl($scope, $this->version, $displayAsPopup);
        }
    }

    /**
     * @param string $redirectUrl (optional)
     * @param array $scope (optional) List of permissions to request during re-login
     * @return string
     */
    public function getReRequestUrl($redirectUrl = null, $scope = array())
    {
        if ($loginHelper = $this->getRedirectLoginHelper($redirectUrl)) {
            return $loginHelper->getReRequestUrl($scope, $this->version);
        }
    }

    /**
     * @param string $next url to redirect to after logout
     * @return string
     */
    public function getLogoutUrl($next)
    {
        if ($this->getSession() && ($loginHelper = $this->getRedirectLoginHelper())) {
            return $loginHelper->getLogoutUrl($this->getSession(), $next);
        }
    }

    /**
     * Make a Facebook Open Graph API request
     *
     * @param string $path request URL
     * @param string $method HTTP request method
     * @param array $parameters additional request parameters
     * @param bool $etag
     * @throws \Facebook\FacebookRequestException if request fails
     * @return \Facebook\FacebookResponse
     */
    public function makeRequest($path, $method = 'GET', $parameters = null, $etag = null)
    {
        if ($this->getSession()) {
            if ($request = new \Facebook\FacebookRequest(
                $this->getSession(), $method, $path, $parameters, $this->version, $etag
            )) {
                return $request->execute();
            }
        }
        return null;
    }

    /**
     * Get current logged in user
     *
     * @return \Facebook\GraphUser
     */
    public function getMe()
    {
        return $this->getGraphUser('me');
    }

    /**
     * Get Facebook user by id
     *
     * @param $id Facebook ID of user
     * @return \Facebook\GraphUser
     */
    public function getGraphUser($id)
    {
        return $this->makeRequest('/' . $id, 'GET')->getGraphObject(\Facebook\GraphUser::className());
    }

    /**
     * Get the Facebook profile picture for the currently logged in user
     *
     * @param mixed size facebook image size (square, small, normal, large)
     * @return url of Facebook profile picture
     */
    public function getProfilePicture($size = null)
    {
        if ($id = $this->getUserId()) {
            return $this->getProfilePictureById($id, $size);
        }
        return null;
    }

    /**
     * Get the Facebook user profile picture for a given Open Graph object
     *
     * @param mixed id Facebook user id
     * @param mixed size (optional) size of the facebook image to return (square, small, normal, large),
     * or an array specifying width and height
     * @param string $protocol (optional)
     * @return url of Facebook profile picture
     */
    public function getProfilePictureById($id, $size = null, $protocol = '')
    {
        $params = null;
        if ($size && is_array($size) && isset($size['height']) && isset($size['width'])) {
            $params = '?width=' . $size['width'] . '&height=' . $size['height'];
        } elseif ($size) {
            $params = '?type=' . $size;
        }
        return $this->getProtocol($protocol) . '://graph.facebook.com/' . $id . '/picture' . $params;
    }

}
