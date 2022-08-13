<?php

/**
 * Created by PhpStorm.
 * User: kalya
 * Date: 1/5/2016
 * Time: 10:35 AM
 */
Route::group(['middleware' => ['auth']], function()
{
    Route::group(['prefix' => 'chat', 'namespace' => 'Sammy\Chat\Http\Controllers'], function(){
        /**
         * GET Routes
         */
        Route::get('add', [
            'as' => 'chat.add', 'uses' => 'ChatController@addView'
        ]);
        Route::get('add/{id}', [
            'as' => 'chat.add', 'uses' => 'ChatController@addView'
        ]);
        Route::get('list', [
            'as' => 'chat.list', 'uses' => 'ChatController@listView'
        ]);
        
        Route::get('json/list', [
        'as' => 'chat.json.list', 'uses' => 'ChatController@jsonLists'
        ]);
        
        Route::get('edit/{id}/{from}/{to}', [
            'as' => 'chat.edit', 'uses' => 'ChatController@editView'
        ]);
          
        Route::get('getlivechat', [
            'as' => 'chat.getlivechat', 'uses' => 'ChatController@getlivechat'
        ]);
        
        Route::get('history', [
            'as' => 'chat.history', 'uses' => 'ChatController@chathistory'
        ]);
        
        Route::get('ischat', [
            'as' => 'chat.ischat', 'uses' => 'ChatController@ischat'
        ]);
        
        Route::post('addchat', [
            'as' => 'chat.addchat', 'uses' => 'ChatController@addchat'
        ]);
         Route::post('endchat', [
            'as' => 'chat.endchat', 'uses' => 'ChatController@endchat'
        ]);
        Route::get('json/list/date/{from}/{to}', [
                'as' => 'Assignment.list', 'uses' => 'ChatController@jsonListsdate'
        ]);
        
        Route::get('json/historylist/date/{from}/{to}', [
                'as' => 'Assignment.list', 'uses' => 'ChatController@jsonHistoryListsdate'
        ]);
        
         Route::get('json/historylist', [
        'as' => 'chat.json.list', 'uses' => 'ChatController@jsonLists'
        ]);
        
            Route::get('historylist', [
            'as' => 'chat.historylist', 'uses' => 'ChatController@historylistView'
        ]);
//        Route::get('edit/{id}', [
//            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@editView'
//        ]);
//
//        Route::get('list', [
//            'as' => 'Assignment.list', 'uses' => 'AssignmentController@listView'
//        ]);
//
//        Route::get('json/list', [
//           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonList'
//        ]);
//
//        /**
//         * POST Routes
//         */
//        Route::post('add', [
//            'as' => 'Assignment.add', 'uses' => 'AssignmentController@add'
//        ]);
//
//        Route::post('accept', [
//           'as' => 'Assignment.accept', 'uses' => 'AssignmentController@accept'
//        ]);      
//        Route::post('reject', [
//            'as' => 'Assignment.reject', 'uses' => 'AssignmentController@reject'
//        ]);
//        Route::post('complete', [
//            'as' => 'Assignment.complete', 'uses' => 'AssignmentController@complete'
//        ]);
//       Route::post('writerreject', [        
//            'as' => 'Assignment.writerreject', 'uses' => 'AssignmentController@writerreject'
//        ]);
//       
//        Route::post('reviewwriter', [        
//            'as' => 'Assignment.reviewwriter', 'uses' => 'AssignmentController@reviewwriter'
//        ]);
//        
//        Route::post('addReview', [        
//            'as' => 'Assignment.addReview', 'uses' => 'AssignmentController@addReview'
//        ]);
//
//        Route::post('rejectwriter', [
//            'as' => 'Assignment.rejectwriter', 'uses' => 'AssignmentController@rejectwriter'
//        ]);
//        Route::post('complete', [
//            'as' => 'Assignment.complete', 'uses' => 'AssignmentController@complete'
//        ]);
//
//        Route::post('smsSend', [
//            'as' => 'Assignment.smsSend', 'uses' => 'AssignmentController@smsSend'
//        ]);
//
//        Route::post('edit/{id}', [
//            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@edit'
//        ]);
//
//        Route::post('delete', [
//            'as' => 'Assignment.delete', 'uses' => 'AssignmentController@delete'
//        ]);

    });
});