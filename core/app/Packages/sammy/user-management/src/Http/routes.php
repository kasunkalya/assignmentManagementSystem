<?php
/**
 * USER MANAGEMENT ROUTES
 *
 * @version 1.0.0
 * @author Insaf Zakariya <insaf.zak@gmail.com>
 * @copyright 2015 Yasith Samarawickrama
 */

/**
 * USER AUTHENTICATION MIDDLEWARE
 */
Route::group(['middleware' => ['auth']], function()
{
    Route::group(['prefix' => 'user', 'namespace' => 'Sammy\UserManage\Http\Controllers'], function(){
      /**
       * GET Routes
       */
      Route::get('add', [
        'as' => 'user.add', 'uses' => 'UserController@addView'
      ]);
      Route::get('addwriter', [
          'as' => 'user.addwriter', 'uses' => 'UserController@addwriterView'
      ]);

      Route::get('edit/{id}', [
        'as' => 'user.edit', 'uses' => 'UserController@editView'
      ]);

      Route::get('list', [
        'as' => 'user.list', 'uses' => 'UserController@listView'
      ]);

      Route::get('listWriter', [
          'as' => 'user.listWriter', 'uses' => 'UserController@listWriter'
      ]);

      Route::get('json/list', [
        'as' => 'user.list', 'uses' => 'UserController@jsonList'
      ]);
      Route::get('json/listWriter', [
          'as' => 'user.listWriter', 'uses' => 'UserController@jsonListWriter'
      ]);



      Route::get('editmin/{id}', [
          'as' => 'user.edit', 'uses' => 'UserController@editminView'
      ]);

      /**
       * POST Routes
       */
      Route::post('add', [
        'as' => 'user.add', 'uses' => 'UserController@add'
      ]);
      Route::post('addwriter', [
          'as' => 'user.add', 'uses' => 'UserController@addwriter'
      ]);

      Route::post('edit/{id}', [
        'as' => 'user.edit', 'uses' => 'UserController@edit'
      ]);

      Route::post('editmin/{id}', [
          'as' => 'user.edit', 'uses' => 'UserController@editmin'
      ]);

      Route::post('status', [
        'as' => 'user.status', 'uses' => 'UserController@status'
      ]);

      Route::post('delete', [
        'as' => 'user.delete', 'uses' => 'UserController@delete'
      ]);
    });
});