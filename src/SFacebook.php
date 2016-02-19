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
use \Facebook\Facebook;
use Facebook\Authentication\AccessToken;
use Facebook\SignedRequest;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookAuthenticationException;
use Facebook\Exceptions\FacebookAuthorizationException;

class SFacebook extends \CApplicationComponent
{
    /**
     * @var Facebook instance of the Facebook app class
     */
    private $_fb;

    /**
     * @var AccessToken cached Facebook access token
     */
    private $_token;

    /**
     * @var SignedRequest cached Facebook signed request
     */
    private $_signedRequest;

    /**
     * @var string cached Facebook user id
     */
    private $_userId;

    /**
     * @var string Facebook Application ID
     */
    public $appId;

    /**
     * @var string Facebook Application secret
     */
    public $secret;

    /**
     * @var string Facebook OpenGraph version to request i.e. v1.0, v2.0, v2.1, v2.2
     * @see https://developers.facebook.com/docs/apps/changelog/
     */
    public $version = 'v2.5';

    /**
     * @var callable Callback method to run when Facebook session needs to be renewed
     */
    public $authenticationErrorCallback;

    /**
     * @var callable Callback method to run when Facebook API permissions are missing
     */
    public $authorizationErrorCallback;

    /**
     * @var callable Callback method to run when Facebook SDK exception
     */
    public $sdkErrorCallback;

    /**
     * @var string Default login redirect url
     */
    public $redirectUrl;

    /**
     * @var bool Determines whether the current login status of the user is freshly retrieved on every page load.
     * If this is disabled, that status will have to be manually retrieved using .getLoginStatus().
     * Defaults to false.
     */
    public $status = false;

    /**
     * @var bool Determines whether a cookie is created for the session or not. If enabled,
     * it can be accessed by server-side code. Defaults to false.
     */
    public $cookie = false;

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
     * @var array the default permissions to ask for on facebook Login buttons
     */
    public $defaultScope = [];

    /**
     * @var bool Frictionless Requests are available to games on Facebook.com or on mobile web using the JavaScript SDK.
     * This parameter determines whether they are enabled.
     * Defaults to false.
     */
    public $frictionlessRequests = false;

    /**
     * @var bool This specifies a function that is called whenever it is necessary to hide Adobe Flash objects on a page.
     * This is used when FB.api() JS requests are made, as Flash objects will always have a higher z-index than
     * any other DOM element. See our Custom Flash Hide Callback for more details on what to put in this function:
     * https://developers.facebook.com/docs/games/canvas/handling-popups#flash_hide_callback
     * Defaults to null.
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
    public $ogTags = [];

    /**
     * @var array Valid Facebook locales.
     */
    protected $locales = [
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
    ];

    public function init()
    {
        if ($this->appId && $this->secret) {
            parent::init();
            $this->_fb = new Facebook([
                'app_id'     => $this->appId,
                'app_secret' => $this->secret,
                'default_graph_version' => $this->version,
                'persistent_data_handler' => new YiiFacebookSessionPersistentDataHandler()
            ]);
        } else {
            if (!$this->appId)
                throw new \CException('Facebook application ID not specified.');
            elseif (!$this->secret)
                throw new \CException('Facebook application secret not specified.');
        }
    }

    public function getFb()
    {
        return $this->_fb;
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
            $init = $this->registerSDKScript('init', [
                    // https://developers.facebook.com/docs/javascript/reference/FB.init/v2.2
                    'appId' => $this->appId, // application ID
                    'version' => $this->version, // OpenGraph API version to request
                    'cookie' => $this->cookie, // enable cookies to allow the server to access the session
                    'status' => $this->status, // check login status
                    'xfbml' => $this->xfbml, // parse XFBML
                    'frictionlessRequests' => $this->frictionlessRequests, // Enable frictionless requests on requests dialog
                    'hideFlashCallback' => $this->hideFlashCallback, // This specifies a function that is called whenever it is necessary to hide Adobe Flash objects on a page.
                ]
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
    protected function registerSDKScript($method, $args = [])
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
        Yii::app()->clientScript->registerMetaTag($data, null, null, ['property' => $property]);
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
            $adjust = [
                'de' => 'de_de',
                'nl' => 'nl_nl',
                'ru' => 'ru_ru',
                'ar' => 'ar_ar', // non standard
                'ku' => 'ku_tr',
            ];
            // single check languages, array above ...
            if (isset($adjust[$lang])) {
                $locale = $adjust[$lang];
            } // english
            else if ($lang === 'en' && !in_array($locale, ['en_us', 'en_pi', 'en_ud'])) {
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
            else if ($lang === 'es' && !in_array($locale, ['es_es', 'es_cl', 'es_co', 'es_mx', 'es_ve'])) {
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

    /**
     * Get AccessToken from various login methods
     * @return AccessToken|null|void
     */
    protected function getNewAccessToken()
    {
        $accessToken = null;
        try {

            // else try to get a token from the JS
            $helper = $this->_fb->getJavaScriptHelper();
            if ($accessToken = $helper->getAccessToken()) {
                $this->saveSignedRequest($helper);
                return $accessToken;
            }

            // else try to get a token from the redirect login
            $helper = $this->_fb->getRedirectLoginHelper();
            if ($accessToken = $helper->getAccessToken()) {
                $this->saveSignedRequest($helper);
                return $accessToken;
            } elseif ($helper->getError()) {
                Yii::log("FacebookRedirectLoginHelper: " . $helper->getErrorDescription(), 'error', 'SFacebook');
                Yii::app()->user->setFlash('error', "FacebookRedirectLoginHelper: " . $helper->getErrorDescription());
            }

            // else try to get a token from the PageTab
            $helper = $this->_fb->getPageTabHelper();
            if ($accessToken = $helper->getAccessToken()) {
                $this->saveSignedRequest($helper);
                return $accessToken;
            }

            // this means the token may have expired, so we may want to run to code to prompt to renew
        } catch (FacebookAuthenticationException $e) {
            $this->authenticationError($e);

            // this means the token may have expired, so we may want to run to code to prompt to renew
        } catch (FacebookAuthorizationException $e) {
            $this->authorizationError($e);

            // general Facebook SDK exceptions
        } catch(FacebookSDKException $e) {
            if ($previous = $e->getPrevious()) {
                if ($previous instanceof FacebookAuthenticationException) {
                    return $this->authenticationError($previous);
                }
                if ($previous instanceof FacebookAuthorizationException) {
                    return $this->authorizationError($previous);
                }
            }
            $this->sdkError($e);
        }
        return $accessToken;
    }

    /**
     * Store the signed request and cache the Facebook User ID
     * @param $helper
     */
    protected function saveSignedRequest($helper)
    {
        if ($signedRequest = $helper->getSignedRequest()) {
            $this->_signedRequest = $signedRequest;
            if ($user_id = $signedRequest->getUserId()) {
                $this->setUserId($user_id);
            }
        }
    }

    /**
     * Handler SDK errors
     * @param FacebookSDKException $e
     * @throws FacebookSDKException
     */
    protected function sdkError(FacebookSDKException $e)
    {
        // There was an error communicating with Graph
        // Or there was a problem validating the signed request
        if ($e && !$this->sdkErrorCallback($e)) {
            Yii::log("FacebookSDKException: " . $e, 'error', 'SFacebook');
            Yii::app()->user->setFlash('error', "FacebookSDKException: " . $e->getMessage());
            //throw $e; // throw exception if unable to renew facebook session
        }
    }

    /**
     * If the Facebook session has expired, possibly run code here to renew it
     * @param FacebookSDKException $e The exception we are handling
     * @return bool true if exception is handled, false to continue throwing exception
     */
    protected function sdkErrorCallback(FacebookSDKException $e)
    {
        // if there is an exception callback for eSDK errors, run it if that's the problem
        if (is_callable($this->sdkErrorCallback)) {
            return call_user_func($this->sdkErrorCallback, $e);
        }
        return false;
    }

    /**
     * Handle missing permissions errors
     * @param FacebookAuthorizationException $e
     * @throws FacebookAuthorizationException
     */
    protected function authorizationError(FacebookAuthorizationException $e = null)
    {
        $this->destroySession();
        // if there is an re-authorize callback for expired sessions, run it if that's the problem
        if ($e && !$this->authorizationErrorCallback($e)) {
            throw $e; // throw exception if unable to renew facebook session
        }
    }

    /**
     * If the Facebook API permissions are missing
     * @param FacebookAuthorizationException $e The exception we are handling
     * @return bool true if exception is handled, false to continue throwing exception
     */
    protected function authorizationErrorCallback(FacebookAuthorizationException $e)
    {
        // if there is an re-authorize callback for expired sessions, run it if that's the problem
        if (is_callable($this->authorizationErrorCallback)) {
            return call_user_func($this->authorizationErrorCallback, $e);
        }
        return false;
    }

    /**
     * Handle expired auth
     * @param FacebookAuthenticationException $e
     * @throws FacebookAuthenticationException
     */
    protected function authenticationError(FacebookAuthenticationException $e = null)
    {
        $this->destroySession();
        // if there is an re-authorize callback for expired sessions, run it if that's the problem
        if ($e && !$this->authenticationErrorCallback($e)) {
            throw $e; // throw exception if unable to renew facebook session
        }
    }

    /**
     * If the Facebook session has expired, possibly run code here to renew it
     * @param FacebookAuthenticationException $e The exception we are handling
     * @return bool true if exception is handled, false to continue throwing exception
     */
    protected function authenticationErrorCallback(FacebookAuthenticationException $e)
    {
        // if there is an re-authorize callback for expired sessions, run it if that's the problem
        if (is_callable($this->authenticationErrorCallback)) {
            return call_user_func($this->authenticationErrorCallback, $e);
        }
        return false;
    }

    /**
     * Get the cached access token string
     *
     * @return AccessToken cached access token
     */
    public function getAccessToken()
    {
        if (!$this->_token) {
            if (Yii::app()->session && isset(Yii::app()->session['fb_token']) && Yii::app()->session['fb_token']) {
                $this->setAccessToken(Yii::app()->session['fb_token']);
            } else {
                if ($accessToken = $this->getNewAccessToken()) {
                    $this->getLongLivedAccessToken($accessToken);
                }
            }
        }
        return $this->_token;
    }

    /**
     * Cache the Facebook access token string
     * @param AccessToken|string $accessToken
     * @throws FacebookAuthenticationException
     */
    protected function setAccessToken($accessToken)
    {
        if ($accessToken && Yii::app()->session) {
            Yii::app()->session['fb_token'] = (string) $accessToken;
        }
        if (is_string($accessToken)) {
            $accessToken = new AccessToken($accessToken);
        }
        if ($accessToken instanceof AccessToken) {
            if ($this->isExpired($accessToken)) {
                throw new FacebookAuthenticationException;
            } else {
                $this->_token = $accessToken;
                // this way it will automatically be used by all API requests
                $this->_fb->setDefaultAccessToken($accessToken);
            }
        }
    }

    /**
     * Get the cached session expiration
     * @param AccessToken $accessToken
     * @return string cached access token
     */
    public function isExpired($accessToken)
    {
        $expiresAt = null;
        if ($accessToken && ($expiresAt = $accessToken->getExpiresAt())) {
            Yii::app()->session['fb_token_expires'] = $expiresAt;

        } elseif (Yii::app()->session['fb_token_expires']) {
            $expiresAt = Yii::app()->session['fb_token_expires'];
        }
        if ($expiresAt && $expiresAt->getTimestamp() > time()) {
            return false;
        }
        return true;
    }

    /**
     * Returns the SignedRequest entity.
     * @return SignedRequest
     */
    public function getSignedRequest()
    {
        if ($this->getAccessToken()) {
            return $this->_signedRequest;
        }
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
        $this->_token = null;
        $this->_userId = null;
        $this->_signedRequest = null;
        // unset the cached session variables
        if (Yii::app()->session && isset(Yii::app()->session['fb_token'])) {
            unset(Yii::app()->session['fb_token']);
            unset(Yii::app()->session['fb_token_expires']);
            unset(Yii::app()->session['fb_userId']);
        }
        // remove the JavaScript cookie as well
        if (isset($_COOKIE['fbsr_' . $this->appId])) {
            unset($_COOKIE['fbsr_' . $this->appId]);
        }
    }

    /**
     * Get an extended access token
     * @param $accessToken
     * @return AccessToken
     */
    public function getLongLivedAccessToken($accessToken = null)
    {
        if (!$accessToken) $accessToken = $this->getAccessToken();
        if ($accessToken && ($client = $this->_fb->getOAuth2Client())) {
            try {
                // Returns a long-lived access token
                if ($accessToken = $client->getLongLivedAccessToken($accessToken)) {
                    $this->setAccessToken($accessToken);
                }
            } catch(FacebookSDKException $e) {
                $this->sdkError($e);
            }
        }
        return $this->_token;
    }

    /*** RedirectLogin methods ***/

    /**
     * @param string $redirectUrl The URL Facebook should redirect users to after login.
     * @param array  $scope       List of permissions to request during login.
     * @param string $separator   The separator to use in http_build_query().
     * @return string
     */
    public function getLoginUrl($redirectUrl = null, $scope = [], $separator = '&')
    {
        if (!$redirectUrl) $redirectUrl = $this->redirectUrl;
        if ($loginHelper = $this->_fb->getRedirectLoginHelper()) {
            return $loginHelper->getLoginUrl($redirectUrl, $scope, $separator);
        }
    }

    /**
     * @param string $redirectUrl The URL Facebook should redirect users to after login.
     * @param array  $scope       List of permissions to request during login.
     * @param string $separator   The separator to use in http_build_query().
     * @return string
     */
    public function getReRequestUrl($redirectUrl, array $scope = [], $separator = '&')
    {
        if (!$redirectUrl) $redirectUrl = $this->redirectUrl;
        if ($loginHelper = $this->_fb->getRedirectLoginHelper()) {
            return $loginHelper->getReRequestUrl($redirectUrl, $scope, $separator);
        }
    }

    /**
     * @param string $redirectUrl The URL Facebook should redirect users to after login.
     * @param array  $scope       List of permissions to request during login.
     * @param string $separator   The separator to use in http_build_query().
     * @return string
     */
    public function getReAuthenticationUrl($redirectUrl, array $scope = [], $separator = '&')
    {
        if (!$redirectUrl) $redirectUrl = $this->redirectUrl;
        if ($loginHelper = $this->_fb->getRedirectLoginHelper()) {
            return $loginHelper->getReAuthenticationUrl($redirectUrl, $scope, $separator);
        }
    }

    /**
     * @param string $next The url Facebook should redirect the user to after a successful logout.
     * @param string $separator The separator to use in http_build_query().
     * @param AccessToken|string $accessToken The access token that will be logged out.
     * @return string
     */
    public function getLogoutUrl($next, $separator = '&', $accessToken = null)
    {
        if (!$accessToken) $accessToken = $this->getAccessToken();
        if ($loginHelper = $this->_fb->getRedirectLoginHelper()) {
            return $loginHelper->getLogoutUrl($accessToken, $next, $separator);
        }
    }

    // FacebookAuthenticationException = Login status or token expired, revoked, or invalid, or OAuth authentication error
    // FacebookAuthorizationException = missing permissions

    /*** SDK calls ***/

    /**
     * If the method doesn't exist on this class, call it on the Facebook class
     * This allows calling request(), get(),
     * Do not call this method. This is a PHP magic method that we override
     * to implement the behavior feature.
     * @param string $name the method name
     * @param array $parameters method parameters
     * @throws \CException if current class and its behaviors do not have a method or closure with the given name
     * @return mixed the method return value
     */
    public function __call($name,$parameters)
    {
        try {
            $this->getAccessToken(); // set the default access token if there is one
            if($this->_fb && method_exists($this->_fb,$name))
                return call_user_func_array([$this->_fb,$name],$parameters);

            // Login status or token expired, revoked, or invalid, or OAuth authentication error, so we may want to run to code to prompt to renew
        } catch (FacebookAuthenticationException $e) {
            return $this->authenticationError($e);

            // missing permissions, so we may want to run to code to prompt to renew and get more permissions
        } catch (FacebookAuthorizationException $e) {
            return $this->authorizationError($e);

            // general Facebook SDK exceptions
        } catch(FacebookSDKException $e) {
            if ($previous = $e->getPrevious()) {
                if ($previous instanceof FacebookAuthenticationException) {
                    return $this->authenticationError($previous);
                }
                if ($previous instanceof FacebookAuthorizationException) {
                    return $this->authorizationError($previous);
                }
            }
            return $this->sdkError($e);
        }

        throw new \CException(Yii::t('yii','{class} and Facebook do not have a method or closure named "{name}".',
            ['{class}'=>get_class($this), '{name}'=>$name]));
    }

    /*** Convenience methods ***/

    /**
     * Get the user's Facebook ID.
     * @return string the user id
     */
    public function getUserId()
    {
        if (!$this->_userId) {
            if (Yii::app()->session && isset(Yii::app()->session['fb_userId'])) {
                $this->_userId = Yii::app()->session['fb_userId'];
            }
            // if no cached user id, try to refresh the session
            if (!$this->_userId) {
                $this->getAccessToken();
            }
        }
        return $this->_userId;
    }

    /**
     * Get current logged in user
     * @return Facebook\GraphNodes\GraphUser
     */
    public function getMe()
    {
        return $this->getGraphUser('me');
    }

    /**
     * Get Facebook user by id
     * @param $id Facebook ID of user
     * @return \Facebook\GraphNodes\GraphUser
     */
    public function getGraphUser($id)
    {
        if ($response = $this->get('/' . $id)) {
            return $response->getGraphUser();
        }
        return null;
    }

    /**
     * Get the Facebook profile picture for the currently logged in user
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
