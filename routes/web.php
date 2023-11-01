<?php

use Illuminate\Support\Facades\Route;

Route::get('/check', 'Controller@check');

Route::middleware(['setUpConf'])->group(function () {
    
});

// CORE
Route::post('/checkSubscription', 'IntegrationController@checkSubscription');           //Listo
Route::post('/V2/checkSubscription', 'IntegrationController@checkSubscriptionV2');      //Listo
Route::post('/Auth/Generate', 'IntegrationController@Create');                          //Listo
Route::post('/Auth/Custom/Generate', 'IntegrationController@customCreate');             //Listo
Route::post('/Auth/Validate', 'IntegrationController@refresh');                         //Listo
Route::post('/auth/custom/validate', 'IntegrationController@customRefresh');            //Listo
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


// $router->group(['middleware' => ['setUpConfNotification','replaceGetProperty']], function () use ($router) {

//     $router->post('/notification/{event}/notify', "NotificationController@notificationProviderEvent");

// });


// $router->group(['middleware' => ['setUpConf']], function () use ($router) {

//     //Global endpoints

//     $router->post("/Auth/Generate","SecureKeyController@Create"); //Listo

//     $router->post("/auth/custom/generate","SecureKeyController@CustomCreate");

//     $router->post("/notifyEvent","IntegrationController@Notify"); //Listo

//     //Subscriptions endpoints

//     $router->post("/subscription/request","IntegrationController@subscriptionRequest"); //Listo

//     $router->post("/subscription/confirm","IntegrationController@subscriptionConfirm"); //Listo

//     $router->post("/V2/subscription/request","IntegrationController@subscriptionRequestV2"); //Listo

//     $router->post("/V2/subscription/confirm","IntegrationController@subscriptionConfirmV2"); //Listo

//     $router->post("/notification/sendmt","IntegrationController@SendMt"); //Listo

//     //Unsubscription Endpoint

//     $router->post("/subscription/unsubscribe","IntegrationController@Unsubscribe"); //Listo

//     //Info check

//     $router->post("/subscription/info","IntegrationController@subscriptioninfo"); // Listo

//     $router->post("/user/unlock","IntegrationController@userUnlock");

//     //Pto Tokens

//     $router->post("/pto/request", "IntegrationController@ptoToken"); //testing

//     $router->post("/pto/validate", "IntegrationController@ptoValidate"); //testing
// });

// $router->post("/Auth/Validate","SecureKeyController@Refresh"); // Listo

// $router->post("/metadata/generate","IntegrationController@CreateMetadata"); //listo

// $router->post("/metadata/retrieve","IntegrationController@RetrieveMetadata"); // listo

// $router->post("/subscription/unsubscribe/token","IntegrationController@UnsubscribeToken");

// $router->post("/auth/custom/validate","SecureKeyController@CustomRefresh");

