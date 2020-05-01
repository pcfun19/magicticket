<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Payments
    Route::apiResource('payments', 'PaymentsApiController');

    // Saved Customers
    Route::apiResource('saved-customers', 'SavedCustomerApiController');

    // Business Details
    Route::post('business-details/media', 'BusinessDetailsApiController@storeMedia')->name('business-details.storeMedia');
    Route::apiResource('business-details', 'BusinessDetailsApiController');

    // Events
    Route::post('events/media', 'EventsApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventsApiController');

    // Tickets
    Route::post('tickets/media', 'TicketsApiController@storeMedia')->name('tickets.storeMedia');
    Route::apiResource('tickets', 'TicketsApiController');

});
