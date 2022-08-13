<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * USER AUTHENTICATION MIDDLEWARE
 */
Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', [
      'as' => 'index', 'uses' => 'WelcomeController@index'
    ]);

    Route::get('/runingprojects', [
        'as' => 'index', 'uses' => 'WelcomeController@runing'
    ]);
    Route::get('/completeProjects', [
        'as' => 'index', 'uses' => 'WelcomeController@complete'
    ]);
    Route::get('/rejectedProjects', [
        'as' => 'index', 'uses' => 'WelcomeController@rejected'
    ]);
    Route::get('/assignedProjects', [
        'as' => 'index', 'uses' => 'WelcomeController@assigned'
    ]);
    Route::get('/writercomplete', [
        'as' => 'index', 'uses' => 'WelcomeController@writercomplete'
    ]);
    Route::get('/reportswriter', [
        'as' => 'index', 'uses' => 'WelcomeController@reports'
    ]);
    Route::get('/reportsref', [
        'as' => 'index', 'uses' => 'WelcomeController@reportsref'
    ]);
    
    Route::get('/reportspayment', [
        'as' => 'index', 'uses' => 'WelcomeController@reportspayment'
    ]);
    
    Route::get('/revierlist', [
        'as' => 'index', 'uses' => 'WelcomeController@revierlist'
    ]);
    Route::get('/reportdate', [
        'as' => 'index', 'uses' => 'WelcomeController@reportdate'
    ]);
    Route::get('/reviewingview', [
        'as' => 'index', 'uses' => 'WelcomeController@reviewingview'
    ]);
    
    Route::get('/reviewedview', [
        'as' => 'index', 'uses' => 'WelcomeController@reviewedview'
    ]);
    
    Route::get('/reviewrejectview', [
        'as' => 'index', 'uses' => 'WelcomeController@reviewrejectviewview'
    ]);
    
    Route::get('/writerrejectview', [
        'as' => 'index', 'uses' => 'WelcomeController@writerrejectview'
    ]);
    
    Route::get('/writerpayment', [
        'as' => 'index', 'uses' => 'WelcomeController@writerpaymentview'
    ]);
    
    Route::get('/studentpayment', [
        'as' => 'index', 'uses' => 'WelcomeController@studentpaymentview'
    ]);
    
      
    Route::get('/reviwerview', [
        'as' => 'index', 'uses' => 'WelcomeController@reviwerview'
    ]);
    Route::get('/rewriterpayment', [
        'as' => 'index', 'uses' => 'WelcomeController@rewriterpaymentview'
    ]);
});

Route::get('user/login', [
  'as' => 'user.login', 'uses' => 'AuthController@loginView'
]);

Route::post('user/login', [
  'as' => 'user.login', 'uses' => 'AuthController@login'
]);

Route::get('user/logout', [
  'as' => 'user.logout', 'uses' => 'AuthController@logout'
]);

Route::get('test/test', 'WelcomeController@pending'); //This is test controller to test data...

Route::get('json/list', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonList'
]);

Route::get('json/runingprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@runingprojects'
]);

Route::get('json/writerpayments/{id}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonListwriterpayview'
]);

Route::get('json/rewriterpayments/{id}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonListrewriterpayview'
]);

Route::get('json/studentpayments/{id}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonListstudentpayview'
]);

Route::get('json/writers/{id}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonListwriter'
]);

Route::get('json/writerpayment/{id}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonListwriter'
]);


Route::get('json/ref/{id}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonref'
]);
Route::get('json/allwriters', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsonListallwriter'
]);
Route::get('json/completedprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@completeprojectlist'
]);

Route::get('json/reviewingprojectlist', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@reviewingprojectlist'
]);

Route::get('json/reviewedprojectlist', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@reviewedprojectlist'
]);


Route::get('json/rejectedprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@rejectedprojectlist'
]);

Route::get('json/rerejectedprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@reviewrejectedprojectlist'
]);

Route::get('json/writerrejectedprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@writerrejectedprojectlist'
]);


Route::get('json/assignedprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@assignedprojectlist'
]);
Route::get('json/writercompleteprojects', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@writercompleteprojectlist'
]);

Route::get('json/reportDate/{id}/{from}/{to}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsondate'
]);

Route::get('json/jsondateReview/{id}/{from}/{to}', [
    'as' => 'Assignment.list', 'uses' => 'WelcomeController@jsondateReview'
]);

Route::get('pay/oder', [
  'as' => 'Assignment.oder', 'uses' => 'WelcomeController@oder'
]);

Route::get('pay/payhere', 'WelcomeController@payhere');

/////////////////////////////////////////////////////////
//$arr = [['id'=>1],['id'=>2],['id'=>5],['id'=>8]];
