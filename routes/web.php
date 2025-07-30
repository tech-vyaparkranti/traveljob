<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OurServicesModelController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\JobSeekerController;

//use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get("comingsoon",[HomePageController::class,function(){
    //     return view("HomePage.ComingSoon");
    // }]);
    
Route::controller(HomePageController::class)->group(function(){
    Route::get("/","homePage");
    Route::get("comingsoon","ComingSoon")->name("ComingSoon");
    Route::get("about-us","aboutUs")->name("aboutUs");
    Route::get("terms-conditions","termsConditions")->name("termsConditions");
    Route::get("shipping-delivery-policy","shippingDeliverypolicy")->name("shippingDeliverypolicy");
    Route::get("cancellation-refund-policy","CancellationRefundPolicy")->name("CancellationRefundPolicy");
    Route::get("privacy-policy","privacyPolicy")->name("privacyPolicy");
    Route::get("services","destinations")->name("destinations");
    Route::get("profilesubmission","productPage")->name("productPage");
    Route::get("report","reportPage")->name("reportPage");
    Route::get("event","galleryPages")->name("galleryPages");
    Route::get("contact-us","contactUs")->name("contactUs");
    Route::get("blog","blogPage")->name("blogPage");
    Route::get('refresh-captcha',"refreshCapthca")->name("refreshCaptcha");
});

Route::post('/jobseeker/store', [JobSeekerController::class, 'store'])->name('jobseeker.store');


Route::get("get-home-page-dd",[DestinationController::class,"getHomePageDestinations"])->name("getHomePageDestinations");
Route::get("get-home-page-services",[OurServicesModelController::class,"getHomePageServices"])->name("getHomePageServices");
Route::post("contact-us-form",[ContactUsController::class,"saveContactUsDetails"])->name("saveContactUsDetails");
Route::get("get-testimonials-home-page", [TestimonialsController::class, "getHomePageTestimonials"])->name("getHomePageTestimonials");

// require __DIR__.'/auth.php';

include_once "adminRoutes.php";
