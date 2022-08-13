<?php

/**
 * Created by PhpStorm.
 * User: kalya
 * Date: 1/5/2016
 * Time: 10:35 AM
 */
Route::group(['middleware' => ['auth']], function()
{
    Route::group(['prefix' => 'assignment', 'namespace' => 'Sammy\Assignment\Http\Controllers'], function(){
        /**
         * GET Routes
         */
     Route::get('add', [
            'as' => 'Assignment.add', 'uses' => 'AssignmentController@addView'
        ]);

        Route::get('edit/{id}', [
            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@editView'
        ]);
        
        Route::get('payment/{id}', [
            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@paymnetView'
        ]);
        
        Route::get('paymentWriter/{id}', [
            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@paymnetWriterView'
        ]);
        
        
        Route::post('paymentdelete', [
            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@paymentdelete'
        ]);
        
        Route::post('paymentdeleteUser', [
            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@paymentdeleteUser'
        ]);
        
         Route::post('confirmpay', [        
            'as' => 'Assignment', 'uses' => 'AssignmentController@confirm'
        ]);
        

        Route::get('list', [
            'as' => 'Assignment.list', 'uses' => 'AssignmentController@listView'
        ]);

        Route::get('json/list', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonList'
        ]);
        
        
        Route::get('json/writerpay/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListwriterpay'
        ]);
        
        Route::get('json/payment/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListpayment'
        ]);
        
        Route::get('json/writerpayview/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListwriterpayview'
        ]);
        
        
        Route::get('json/paymentview/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListpaymentview'
        ]);
        Route::get('json/writerrepayview/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListrewriterpayview'
        ]);
          
        Route::get('json/writerrepay/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListrewriterpay'
        ]);
        
        Route::get('json/writerspay/{type}/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListwriterspay'
        ]);
        Route::get('json/writersrepay/{type}/{id}', [
           'as' => 'Assignment.list', 'uses' => 'AssignmentController@jsonListwriterspay'
        ]);
        
        /**
         * POST Routes
         */
        Route::post('add', [
            'as' => 'Assignment.add', 'uses' => 'AssignmentController@add'
        ]);

        Route::post('accept', [
           'as' => 'Assignment.accept', 'uses' => 'AssignmentController@accept'
        ]);      
        Route::post('reject', [
            'as' => 'Assignment.reject', 'uses' => 'AssignmentController@reject'
        ]);
        Route::post('complete', [
            'as' => 'Assignment.complete', 'uses' => 'AssignmentController@complete'
        ]);
       Route::post('writerreject', [        
            'as' => 'Assignment.writerreject', 'uses' => 'AssignmentController@writerreject'
        ]);
       
        Route::post('reviewwriter', [        
            'as' => 'Assignment.reviewwriter', 'uses' => 'AssignmentController@reviewwriter'
        ]);
        
        Route::post('addReview', [        
            'as' => 'Assignment.addReview', 'uses' => 'AssignmentController@addReview'
        ]);

        Route::post('rejectwriter', [
            'as' => 'Assignment.rejectwriter', 'uses' => 'AssignmentController@rejectwriter'
        ]);
        Route::post('complete', [
            'as' => 'Assignment.complete', 'uses' => 'AssignmentController@complete'
        ]);
        
        Route::post('rewriterreject', [        
            'as' => 'Assignment.writerreject', 'uses' => 'AssignmentController@rewriterreject'
        ]);

        Route::post('writerPayment', [        
            'as' => 'Assignment.writerreject', 'uses' => 'AssignmentController@writerPayment'
        ]);
          
        Route::post('payment', [        
            'as' => 'Assignment.payment', 'uses' => 'AssignmentController@paymentAdd'
        ]);
     
        Route::post('smsSend', [
            'as' => 'Assignment.smsSend', 'uses' => 'AssignmentController@smsSend'
        ]);

        Route::post('edit/{id}', [
            'as' => 'Assignment.edit', 'uses' => 'AssignmentController@edit'
        ]);

        Route::post('delete', [
            'as' => 'Assignment.delete', 'uses' => 'AssignmentController@delete'
        ]);

    });
});