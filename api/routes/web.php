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

/* Account */
$route = env('PACKAGE_ROUTE', '').'/account';
Route::post($route. '/create', 'Auth\RegisterController@create');

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
$route = env('PACKAGE_ROUTE', '').'/users';
$controller = 'AccountsController@';
Route::post($route. '/retrieve ', $controller.'retrieve');



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
Route::get($route.'/test', 'EmailController@test');


// SocialLite Controller
$route = env('PACKAGE_ROUTE', '').'/social_lite';
Route::post($route . '/authenticate/{provider}/redirect', 'SocialController@redirect');
Route::post($route . '/authenticate/{provider}/callback','SocialController@Callback');
Route::post($route . '/account/{provider}/redirect','SocialController@connectRedirect');
Route::post($route . '/account/{provider}/callback','SocialController@connectCallBack');
Route::post($route . '/account/{provider}/linkedinConnect','SocialController@linkedinConnect');
Route::post($route . '/verify_token','SocialController@checkToken');

// Post Management
$route = env('PACKAGE_ROUTE', '').'/post';
Route::post($route . '/create', 'PostController@create');
Route::post($route . '/retrieve', 'PostController@retrieve');
Route::post($route . '/retrieve_by_user', 'PostController@retrieveByUser');
Route::post($route . '/retrieve_by_id', 'PostController@retrieveById');
Route::post($route. '/delete', 'PostController@delete');

$route = env('PACKAGE_ROUTE', '').'/file';
Route::post($route . '/upload', 'FileUploadController@upload');

Route::get('/login/{provider}/redirect', 'SocialController@redirect');

$route = env('PACKAGE_ROUTE', '').'/posting';
$controller = 'SocialMediaController@';
Route::post($route.'/linkedin_post', $controller.'linkedinPost');
Route::post($route.'/register_upload', $controller.'linkedinRegisterUpload');
Route::get($route.'/test',  $controller.'post');

$route = env('PACKAGE_ROUTE', '').'/plans/';
$controller = 'PlanController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'retrieve_with_payments_and_history', $controller."retrieveWithPaymentsAndHistory");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");


$route = env('PACKAGE_ROUTE', '').'/billings/';
$controller = 'BillingController@';
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'retrieve_on_history', $controller."retrieveOnHistory");
Route::get($route.'test', $controller."test");


$route = env('PACKAGE_ROUTE', '').'/brandings/';
$controller = 'BrandingController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'retrieve_by_accountId', $controller."retrieveByAccountIdRequest");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

$route = env('PACKAGE_ROUTE', '').'/accounts_info/';
$controller = 'AccountInformationsContoller@';
Route::post($route.'create', $controller."create");
Route::post($route.'retrieve', $controller."retrieveAccountInformation");
Route::post($route.'update', $controller."update");
Route::post($route.'update_account', $controller.'updateAccountAndInformations');
Route::post($route.'check_password', $controller.'checkPassword');
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");

$route = env('PACKAGE_ROUTE', '').'/social_auths/';
$controller = 'SocialAuthController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");


$route = env('PACKAGE_ROUTE', '').'/pages/';
$controller = 'PageController@';
Route::post($route.'create', $controller."create");
Route::post($route.'update', $controller."update");
Route::post($route.'retrieve', $controller."retrieve");
Route::post($route.'delete', $controller."delete");
Route::get($route.'test', $controller."test");


$route = env('PACKAGE_ROUTE', '').'/stripe_webhooks/';
$controller = 'StripeController@';
Route::post($route.'charge_customer', $controller."chargeCustomer");
Route::get($route.'test', $controller."test");