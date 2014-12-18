## IN PROGRESS: Update to Facebook PHP SDK 4.0 and and Open Graph API 2.x

The master branch is currently under development to update to the new SDK and API. The previous stable branch with support for the old API is now under the opengraph-v1.0 branch.

### This is mainly a wrapper for the Facebook PHP SDK.

#### You can also use it to include the Facebook JS SDK on your pages, and easily set Open Graph meta tags.

#### Also included are helper widgets for all of the Facebook Social Plugins.

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

Composer installation instructions coming soon.

Include the extension in your Yii config:

    'components'=>array(
      'facebook'=>array(
        'class' => '\YiiFacebook\SFacebook',
        'appId'=>'YOUR_FACEBOOK_APP_ID', // needed for JS SDK, Social Plugins and PHP SDK
        'secret'=>'YOUR_FACEBOOK_APP_SECRET', // needed for the PHP SDK
        //'fileUpload'=>false, // needed to support API POST requests which send files
        //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
        //'locale'=>'en_US', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // don't include JS SDK
        //'async'=>true, // load JS SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'status'=>true, // JS SDK - check login status
        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
        //'oauth'=>true,  // JS SDK - enable OAuth 2.0
        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
        //'ogTags'=>array(  // set default OG tags
            //'og:title'=>'MY_WEBSITE_NAME',
            //'og:description'=>'MY_WEBSITE_DESCRIPTION',
            //'og:image'=>'URL_TO_WEBSITE_LOGO',
        //),
      ),
    ),

Then, in your base Controller, add this function to override the afterRender callback:

    protected function afterRender($view, &$output) {
      parent::afterRender($view,$output);
      //Yii::app()->facebook->addJsCallback($js); // use this if you are registering any $js code you want to run asyc
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
       'send' => true
    )); ?>

You can, of course, just use the code for this as well if loading the JS SDK on all pages
using the initJs() call in afterRender():

    <div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div>

To use the PHP SDK anywhere in your application, just call it like so (there pass-through the Facebook class):

    <?php $userid = Yii::app()->facebook->getUserId() ?>
    <?php $loginUrl = Yii::app()->facebook->getLoginUrl() ?>
    <?php $results = Yii::app()->facebook->api('/me') ?>

I also created a couple of little helper functions:

    <?php $userinfo = Yii::app()->facebook->getInfo() // gets the Graph info of the current user ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePicture('large') // gets the Facebook picture URL of the current user ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePicture(array('height'=>300,'width'=>300)) // $size can also be specific ?>
    <?php $userinfo = Yii::app()->facebook->getInfoById($openGraphId) // gets the Graph info of a given OG entity ?>
    <?php $imageUrl = Yii::app()->facebook->getProfilePictureById($openGraphId, $size) // gets the Facebook picture URL of a given OG entity ?>

* * *

BREAKING CHANGES:
---------------------------------------------------------------------------
* New version 2.x breaks everything and requires PHP 5.4

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

Updated Dec 14th 2014 by Evan Johnson
http://splashlabsocial.com
