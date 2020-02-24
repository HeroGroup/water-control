<?php

Auth::routes(['register' => false]);

Route::get('/', function () {
    if (auth()->user()) { return  auth()->user()->user_type == "client" ? redirect(route('client.home')) : redirect(route('devices.index')); }
    else return view('client.login');
});

Route::get('completeProfile', function () {return view('client.login2');})->name('client.completeProfile');

Route::post('notifications/send', 'NotificationController@sendApi')->name('notifications.sendApi');

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', function () {
        if (auth()->user()) return redirect(route('devices.index'));
        else return redirect(route('login'));
    });
    Route::group(['middleware' => ['auth', 'admin']], function() {
        Route::get('home', 'HomeController@index')->name('admin.home');
        Route::resource('devices', 'DeviceController');
        Route::post('devices/assignUser', 'DeviceController@assignUser')->name('devices.assignUser');
        Route::post('devices/revokeUser', 'DeviceController@revokeUser')->name('devices.revokeUser');
        Route::get('devices/{device}/status', 'DeviceController@currentStatus')->name('devices.status');
        Route::get('devices/{device}/getRawData', 'DeviceController@getRawData')->name('devices.getRawData');
        Route::get('devices/{device}/changelog', 'DeviceController@changelog')->name('devices.changelog');
        Route::resource('users', 'UserController');
        Route::get('users/{user}/history', 'UserController@history')->name('users.history');
        Route::get('users/{user}/sendNotification', 'UserController@sendNotification')->name('users.sendNotification');
        Route::post('users/notification/send', 'UserController@postNotification')->name('users.notifications.send');
        Route::get('profile', 'UserController@profile')->name('users.profile');
        Route::post('users/changePassword', 'UserController@changePassword')->name('users.changePassword');
        Route::post('users/updateProfile', 'UserController@updateProfile')->name('users.updateProfile');
        Route::get('users/{userId}/resetPassword', 'UserController@resetPassword')->name('users.resetPassword');
        Route::resource('alarms', 'AlarmController');
    });
});

Route::group(['prefix' => 'client'], function() {
    Route::post('login', 'UserController@clientLogin')->name('client.login');
    Route::post('updatePassword', 'UserController@clientUpdatePassword')->name('client.updatePassword');

    Route::group(['middleware' => ['auth', 'checkProfileCompletion']], function() {
        Route::get('home', 'HomeController@clientIndex')->name('client.home');
        Route::get('setting', 'DeviceController@deviceSettings')->name('client.setting');
        Route::post('setting', 'DeviceController@updateDeviceSettings')->name('client.setting.update');
        Route::get('report', 'HomeController@report')->name('client.report');
        Route::post('report', 'HomeController@generateRport')->name('client.generateReport');
        Route::get('changePassword', 'UserController@clientChangePassword')->name('client.changePassword');
        Route::post('updateProfile', 'UserController@clientUpdateProfile')->name('client.updateProfile');
        Route::post('getReport', 'ReportController@getReport')->name('client.getReport');
    });
});


/*  ==========================  API ROUTES  ====================================    */

Route::group(['prefix' => 'api'], function() {
    // Route::get('/user', function (\Illuminate\Http\Request $request) { return $request->user(); });

    Route::post('/postDeviceData', 'DeviceController@postDeviceData')->name('postDeviceData');
    Route::get('/getDeviceData/{deviceNum}', 'DeviceController@getDeviceData')->name('getDeviceData');
    Route::get('/getLevelAlarmConfig/{deviceNum}', 'DeviceController@getLevelAlarmConfig')->name('getLevelAlarmConfig');
    Route::get('/getLevelMeterConfig/{deviceNum}', 'DeviceController@getLevelMeterConfig')->name('getLevelMeterConfig');

    /* =====================    TEMP    ===================== */
    Route::post('/postBatteryAlarmData', 'TempController@postBatteryAlarmData')->name('postBatteryAlarmData');
    Route::get('/getBatteryAlarmConfig/{deviceNum}', 'TempController@getBatteryAlarmConfig')->name('getBatteryAlarmConfig');
    Route::get('/getBatteryAlarmData/{deviceNum}', 'TempController@getBatteryAlarmData')->name('getBatteryAlarmData');
    /* ====================================================== */

    Route::group(['prefix' => 'mobile'], function() {
        Route::post('/login', 'MobileController@login')->name('mobile.login');
        Route::group(['middleware' => 'Mobile'], function () {
            Route::post('/updatePassword', 'MobileController@updatePassword')->name('mobile.updatePassword');
            Route::post('/updateProfile', 'MobileController@updateProfile')->name('mobile.updateProfile');
            Route::get('/getCurrentStatus/{device}', 'MobileController@getCurrentStatus')->name('mobile.getCurrentStatus');
            Route::get('/getDeviceSettings/{device}', 'MobileController@getDeviceSettings')->name('mobile.getDeviceSettings');
            Route::get('/getDeviceAlarms/{device}', 'MobileController@getDeviceAlarms')->name('mobile.getDeviceAlarms');
            Route::post('/updateDeviceSettings', 'MobileController@updateDeviceSettings')->name('mobile.updateDeviceSettings');
        });
    });
});
