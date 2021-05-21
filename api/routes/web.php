<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$route = env('PACKAGE_ROUTE', '');
// Links
// $controller = 'ShortUrlController@';
// Route::get('/l/{code}', $controller."checkUrl");

Route::get('/{code}', function ($code) {
    return app('App\Http\Controllers\ShortUrlController')->checkUrl($code);
});

/*
  Accessing uploaded files
*/
Route::get($route.'/storage/profiles/{filename}', function ($filename) {
    $path = storage_path('/app/profiles/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
Route::get($route.'/storage/logo/{filename}', function ($filename)
{
    $path = storage_path('/app/logos/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'hey'.$exitCode;

    //
});
Route::get('/clear', function () {
    $exitCode = Artisan::call('config:cache');
    return 'hey'.$exitCode;

    //
});
Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return 'hey'.$exitCode;

    //
});

/* Authentication Router */
$route = env('PACKAGE_ROUTE', '').'/authenticate';
Route::resource($route, 'AuthenticateController', ['only' => ['index']]);
Route::post($route, 'AuthenticateController@authenticate');
Route::post($route.'/user', 'AuthenticateController@getAuthenticatedUser');
Route::post($route.'/refresh', 'AuthenticateController@refreshToken');
Route::post($route.'/invalidate', 'AuthenticateController@deauthenticate');
Route::post($route.'/auth', function () {
    return true;
});

// Google Place
$route = env('PACKAGE_ROUTE', '').'/google_places/';
$controller = 'GooglePlaceController@';
Route::post($route.'search', $controller."search");

//Emails Controller
$route = env('PACKAGE_ROUTE', '').'/emails';
Route::post($route.'/create', "EmailController@create");
Route::post($route.'/retrieve', "EmailController@retrieve");
Route::post($route.'/update', "EmailController@update");
Route::post($route.'/delete', "EmailController@delete");
Route::post($route.'/reset_password', 'EmailController@resetPassword');
Route::post($route.'/verification', 'EmailController@verification');
Route::post($route.'/changed_password', 'EmailController@changedPassword');
Route::post($route.'/referral', 'EmailController@referral');
Route::post($route.'/trial', 'EmailController@trial');
Route::post($route.'/test_sms', 'EmailController@testSMS');

// Shopify
$route = env('PACKAGE_ROUTE', '').'/shopify_requests/';
$controller = 'ShopifyRequestController@';
Route::post($route.'graphql', $controller."testing");
Route::post($route.'customers', $controller."customers");
Route::post($route.'products', $controller."products");
Route::post($route.'collections', $controller."collections");
Route::get($route.'test', $controller."test");

// Shopify Customer Routes
$route = env('PACKAGE_ROUTE', '').'/shopify_customer/';
$controller = 'CustomerController@';
Route::post($route.'retrieve_customers', $controller."retrieveCustomers");

// Shopify Authenticate
$route = env('PACKAGE_ROUTE', '').'/shopify_authenticate/';
$controller = 'ShopifyAuthenticateController@';
Route::post($route.'authenticate', $controller.'authenticate');
Route::post($route.'reauthenticate', $controller.'reauth');
Route::post($route.'register', $controller.'register');

// Twilio
$route = env('PACKAGE_ROUTE', '').'/twilio/';
$controller = 'TwilioController@';
Route::post($route.'send', $controller."send");
Route::post($route.'callback/{code}', $controller."callback");

// pivot_sms controller
$route = env('PACKAGE_ROUTE', '').'/pivot_sms/';
$controller = 'SMSHandlerController@';
Route::post($route.'create', $controller."create");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'update', $controller."update");
Route::post($route.'delete', $controller."delete");
Route::post($route.'response_handler', $controller."responseHandler");

// sms group controller
$route = env('PACKAGE_ROUTE', '').'/sms_groups/';
$controller = 'SMSGroupController@';
Route::post($route.'retrieve', $controller."retrieve");

// sms controller
$route = env('PACKAGE_ROUTE', '').'/sms/';
$controller = 'SMSController@';
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'create', $controller."create");
Route::post($route.'merchant_info', $controller.'retrieveMerchantInfo');

// pivot_sms controller
$route = env('PACKAGE_ROUTE', '').'/custom_messenger_groups';
$controller = 'MessengerGroupController@';
Route::post($route.'/retrieve', $controller."retrieve");

// Merchant Setting Controller
$route = env('PACKAGE_ROUTE', '').'/merchant_settings/';
$controller = 'MerchantSettingController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");


// UpsellController
$route = env('PACKAGE_ROUTE', '').'/upsells/';
$controller = 'UpsellController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

// ClickEventController
$route = env('PACKAGE_ROUTE', '').'/click_events/';
$controller = 'ClickEventController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");
// CustomerListController
$route = env('PACKAGE_ROUTE', '').'/customer_lists/';
$controller = 'CustomerListController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

// CampaignController
$route = env('PACKAGE_ROUTE', '').'/campaigns/';
$controller = 'CampaignController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

// CampaignController
$route = env('PACKAGE_ROUTE', '').'/plans/';
$controller = 'PlanController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");


// DashboardController
$route = env('PACKAGE_ROUTE', '').'/dashboards/';
$controller = 'DashboardController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'retrieve_global', $controller."retrieveGlobal");
Route::post($route.'retrieve_cart_recovery', $controller.'getCartRecovery');
Route::post($route.'retrieve_campaigns', $controller.'getCampaigns');
Route::post($route.'retrieve_upsells', $controller."retrieveUpsells");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

