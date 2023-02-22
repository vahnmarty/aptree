<?php

declare(strict_types=1);

use Wave\Facades\Wave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Tenant\TemplateLibrary;
use App\Http\Livewire\Tenant\Courses\EditCourse;
use App\Http\Livewire\Tenant\Courses\ShowCourse;
use App\Http\Livewire\Tenant\Courses\CoursePlayer;
use App\Http\Livewire\Tenant\Courses\CreateCourse;
use App\Http\Livewire\Tenant\Courses\ManageCourses;
use App\Http\Livewire\Tenant\Courses\CourseContents;
use App\Http\Livewire\Tenant\Courses\ModuleItemPreview;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes();

    Route::group(['prefix' => 'courses', 'middleware' => ['auth']], function(){
        Route::get('/', ManageCourses::class)->name('courses.index');
        Route::get('/create', CreateCourse::class)->name('courses.create');
        Route::get('/{id}', ShowCourse::class)->name('courses.show');
        Route::get('/{id}/edit', EditCourse::class)->name('courses.edit');
        Route::get('/{id}/contents', CourseContents::class)->name('courses.contents');
        Route::get('/{id}/play', CoursePlayer::class)->name('courses.play');
        Route::get('/module-preview/{id}', ModuleItemPreview::class)->name('courses.module-preview');
    });

    Route::group(['middleware' => ['auth']], function(){

        Route::get('template-library', TemplateLibrary::class)->name('template.library');
    });


    /*
    |--------------------------------------------------------------------------
    | WAVE Routes
    |--------------------------------------------------------------------------
    */
    Route::impersonate();

    Route::get('/', '\Wave\Http\Controllers\HomeController@index')->name('wave.home');
    Route::get('@{username}', '\Wave\Http\Controllers\ProfileController@index')->name('wave.profile');

    // Documentation routes
    Route::view('docs/{page?}', 'docs::index')->where('page', '(.*)');

    // Additional Auth Routes
    Route::get('logout', '\Wave\Http\Controllers\Auth\LoginController@logout')->name('wave.logout');
    Route::get('user/verify/{verification_code}', '\Wave\Http\Controllers\Auth\RegisterController@verify')->name('verify');
    Route::post('register/complete', '\Wave\Http\Controllers\Auth\RegisterController@complete')->name('wave.register-complete');

    Route::get('blog', '\Wave\Http\Controllers\BlogController@index')->name('wave.blog');
    Route::get('blog/{category}', '\Wave\Http\Controllers\BlogController@category')->name('wave.blog.category');
    Route::get('blog/{category}/{post}', '\Wave\Http\Controllers\BlogController@post')->name('wave.blog.post');

    Route::view('install', 'wave::install')->name('wave.install');

    /***** Pages *****/
    Route::get('p/{page}', '\Wave\Http\Controllers\PageController@page');

    /***** Pricing Page *****/
    Route::view('pricing', 'theme::pricing')->name('wave.pricing');

    /***** Billing Routes *****/
    Route::post('paddle/webhook', '\Wave\Http\Controllers\SubscriptionController@webhook');
    Route::post('checkout', '\Wave\Http\Controllers\SubscriptionController@checkout')->name('checkout');

    Route::get('test', '\Wave\Http\Controllers\SubscriptionController@test');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', '\Wave\Http\Controllers\DashboardController@index')->name('wave.dashboard');
    });

    Route::group(['middleware' => 'auth'], function(){
        Route::get('settings/{section?}', '\Wave\Http\Controllers\SettingsController@index')->name('wave.settings');

        Route::post('settings/profile', '\Wave\Http\Controllers\SettingsController@profilePut')->name('wave.settings.profile.put');
        Route::put('settings/security', '\Wave\Http\Controllers\SettingsController@securityPut')->name('wave.settings.security.put');

        Route::post('settings/api', '\Wave\Http\Controllers\SettingsController@apiPost')->name('wave.settings.api.post');
        Route::put('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiPut')->name('wave.settings.api.put');
        Route::delete('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiDelete')->name('wave.settings.api.delete');

        Route::get('settings/invoices/{invoice}', '\Wave\Http\Controllers\SettingsController@invoice')->name('wave.invoice');

        Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
        Route::get('announcements', '\Wave\Http\Controllers\AnnouncementController@index')->name('wave.announcements');
        Route::get('announcement/{id}', '\Wave\Http\Controllers\AnnouncementController@announcement')->name('wave.announcement');
        Route::post('announcements/read', '\Wave\Http\Controllers\AnnouncementController@read')->name('wave.announcements.read');
        Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
        Route::post('notification/read/{id}', '\Wave\Http\Controllers\NotificationController@delete')->name('wave.notification.read');

        /********** Checkout/Billing Routes ***********/
        Route::post('cancel', '\Wave\Http\Controllers\SubscriptionController@cancel')->name('wave.cancel');
        Route::view('checkout/welcome', 'theme::welcome');

        Route::post('subscribe', '\Wave\Http\Controllers\SubscriptionController@subscribe')->name('wave.subscribe');
        Route::view('trial_over', 'theme::trial_over')->name('wave.trial_over');
        Route::view('cancelled', 'theme::cancelled')->name('wave.cancelled');
        Route::post('switch-plans', '\Wave\Http\Controllers\SubscriptionController@switchPlans')->name('wave.switch-plans');
    });

    /*
    |--------------------------------------------------------------------------
    | WAVE Routes
    |--------------------------------------------------------------------------
    */
    
});



