The master branch is not stable, please use tagged release branches. The previous stable branch with support for the old API is now under the opengraph-v1.0 branch.

### This is a Yii application component wrapper for the official Facebook PHP SDK 4.0

Also included are some helper functions that:

  * Include the Facebook JS SDK on your pages
  * Allow setting Open Graph meta tags
  * Easy rendering of Facebook Social Plugins.

Facebook PHP SDK:
https://developers.facebook.com/docs/reference/php/4.0.0
https://github.com/facebook/facebook-php-sdk-v4

Facebook JS SDK:
https://developers.facebook.com/docs/javascript

Facebook Social Plugins:
https://developers.facebook.com/docs/plugins/

Open Graph Protocol:
https://developers.facebook.com/docs/graph-api

* * *

INSTALLATION:
---------------------------------------------------------------------------

It is recommended that you install this via composer.

    "require": {
        "splashlab/yii-facebook-opengraph": "dev-master"
    }

Run `composer update` to get the extension. This will pull down the official Facebook SDK as a dependency.

Configure Yii application component SFacebook in your yii config file:

    'components'=>array(
      'facebook'=>array(
        'class' => '\YiiFacebook\SFacebook',
        'appId'=>'YOUR_FACEBOOK_APP_ID', // needed for JS SDK, Social Plugins and PHP SDK
        'secret'=>'YOUR_FACEBOOK_APP_SECRET', // needed for the PHP SDK
        //'version'=>'v2.2', // Facebook APi version to default to
        //'locale'=>'en_US', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // don't include JS SDK
        //'async'=>true, // load JS SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'callbackScripts'=>'', // default JS SDK init callback JavaScript
        //'status'=>true, // JS SDK - check login status
        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
        //'hideFlashCallback'=>null, // JS SDK - A function that is called whenever it is necessary to hide Adobe Flash objects on a page.
        //'html5'=>true,  // use html5 Social Plugins instead ofolder XFBML
        //'defaultScope'=>array(), // default Facebook Login permissions to request
        //'redirectUrl'=>null, // default Facebook post-Login redirect URL
        //'expiredSessionCallback'=>null, // PHP callable method to run if expired Facebook session is detected
        //'userFbidAttribute'=>null, // if using FBAuthRequest, declare Facebook ID attribute on user model here
        //'accountLinkUrl'=>null, // if using FBAuthRequest, declare link to user account page here
        //'ogTags'=>array(  // set default OG tags
            //'og:title'=>'MY_WEBSITE_NAME',
            //'og:description'=>'MY_WEBSITE_DESCRIPTION',
            //'og:image'=>'URL_TO_WEBSITE_LOGO',
        //),
      ),
    ),

Then, to enable the JS SDK and Open Graph meta tag functionality in your base Controller,
add this function to override the `afterRender()` callback:

    protected function afterRender($view, &$output) {
      parent::afterRender($view,$output);
      //Yii::app()->facebook->addJsCallback($js); // use this if you are registering any additional $js code you want to run on init()
      Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
      Yii::app()->facebook->renderOGMetaTags(); // this renders the OG tags
      return true;
    }

* * *

USAGE:
---------------------------------------------------------------------------

Setting OG tags on a page (in view or action):

    <?php Yii::app()->facebook->ogTags['og:title'] = "My Page Title"; ?>

Render Facebook Social Plugins using helper Yii widgets:

    <?php $this->widget('\YiiFacebook\Plugins\LikeButton', array(
       //'href' => 'YOUR_URL', // if omitted Facebook will use the OG meta tag
       'show_faces'=>true,
       'share' => true
    )); ?>

You can, of course, just use the code for this as well if loading the JS SDK on all pages
using the initJs() call in afterRender():

    <div class="fb-like" data-share="true" data-show-faces="true"></div>

To use the PHP SDK anywhere in your application, just call it like so (there pass-through the Facebook class):

    <?php $userid = Yii::app()->facebook->getUserId() ?>
    <?php $accessToken = Yii::app()->facebook->getToken() ?>
    <?php $longLivedSession = Yii::app()->facebook->getLongLivedSession() ?>
    <?php $exchangeToken = Yii::app()->facebook->getExchangeToken() ?>
    <?php $loginUrl = Yii::app()->facebook->getLoginUrl() ?>
    <?php $reRequestUrl = Yii::app()->facebook->getReRequestUrl() ?>
    <?php $accessToken = Yii::app()->facebook->accessToken() ?>
    <?php $sessionInfo = Yii::app()->facebook->getSessionInfo() ?>
    <?php $signedRequest = Yii::app()->facebook->getSignedRequest() ?>
    <?php $signedRequestData = Yii::app()->facebook->getSignedRequestData() ?>
    <?php $property = Yii::app()->facebook->getSignedRequestProperty('property_name) ?>
    <?php $logoutUrl = Yii::app()->facebook->getLogoutUrl('http://example.com/after-logout') ?>
    <?php $graphPageObject = Yii::app()->facebook->makeRequest('/SOME_PAGE_ID')->getGraphObject(\Facebook\GraphPage::className()) ?>
    <?php
      try {

        $response = Yii::app()->facebook->makeRequest('/me/feed', 'POST', array(
          'link' => 'www.example.com',
          'message' => 'User provided message'
        ))->getGraphObject()

        echo "Posted with id: " . $response->getProperty('id');

      } catch (\Facebook\FacebookRequestException $e) {

        echo "Exception occured, code: " . $e->getCode();
        echo " with message: " . $e->getMessage();

      }

    ?>
    <?php Yii::app()->facebook->destroySession() ?>

I also created a couple of little helper functions:

    <?php $graphUserObject = Yii::app()->facebook->getMe() // gets the Graph info of the current user ?>
    <?php $graphUserObject = Yii::app()->facebook->getGraphUser($user_id) // gets the Graph info of the current user ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePicture('large') // gets the Facebook picture URL of the current user ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePicture(array('height'=>300,'width'=>300)) // $size can also be specific ?>
    <?php $userinfo = Yii::app()->facebook->getInfoById($openGraphId) // gets the Graph info of a given OG entity ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePictureById($openGraphId, $size) // gets the Facebook picture URL of a given OG entity ?>

* * *

BREAKING CHANGES:
---------------------------------------------------------------------------
* New version 2.x breaks everything from previous version and requires PHP 5.4

* * *

CHANGE LOG:
---------------------------------------------------------------------------
* beta-1.0.1 Updating or PHP SDK 4.0

* * *

I plan on continuing to update and bugfix this extension as needed.

Please log bugs to the GitHub tracker.

Extension is posted on Yii website also:
http://www.yiiframework.com/extension/facebook-opengraph/

The original version with support for SDK 3.x and API 1x was forked from ianare's faceplugs Yii extension:
http://www.yiiframework.com/extension/faceplugs
https://github.com/digitick/yii-faceplugs

Updated Jan 14th 2015 by Evan Johnson
http://splashlabsocial.com
