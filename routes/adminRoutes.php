<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OurOffersController;
use App\Http\Controllers\OurServicesModelController;
use App\Http\Controllers\TestimonialsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminAboutUSController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\EmployerController;





Route::get("login",[AdminController::class,"Login"])->name("login");
Route::get("logout",[AdminCOntroller::class,"logout"])->name("logout");
Route::post("AdminUserLogin",[AdminController::class,"AdminLoginUser"])->name("AdminLogin");
Route::get("getmenu-items",[HomePageController::class,"getMenu"]);
//pages

Route::middleware(['auth'])->group(function () {

    Route::get("/new-dashboard",[AdminController::class,"dashboard"])->name("new-dashboard");

    // Route::get("site-navigation",[AdminController::class,"siteNav"])->name("siteNav");
    // Route::post("addEditNavigation",[AdminController::class,"addEditNavigation"])->name("addNaviagtion");
    // Route::post("deleteNavigation",[AdminController::class,"deleteNavigation"])->name("deleteNavigation");
    // Route::post("navDataTable",[AdminController::class,"navDataTable"])->name("navDataTable");

    Route::get("manage-gallery",[AdminController::class,"manageGallery"])->name("manageGallery");
    Route::post("addGalleryItems",[AdminController::class,"addGalleryItems"])->name("addGalleryItems");
    Route::post("addGalleryDataTable",[AdminController::class,"addGalleryDataTable"])->name("addGalleryDataTable");

    Route::get("add-destinations", [DestinationController::class, "destinationMaster"])->name("DestinationsMaster");
    Route::post("save-destinations", [DestinationController::class, "saveDestinations"])->name("saveDestinations");
    Route::post("destinations-data", [DestinationController::class, "destinationsData"])->name("DestinationsData");

    Route::get("our-services-master", [OurServicesModelController::class, "viewOurServicesMaster"])->name("viewOurServicesMaster");
    Route::post("save-our-services", [OurServicesModelController::class, "saveOurServicesMaster"])->name("saveOurServicesMaster");
    Route::post("our-services-data", [OurServicesModelController::class, "ourServicesData"])->name("ourServicesData");

    Route::get("testimonials-master", [TestimonialsController::class, "viewTestimonialsMaster"])->name("viewTestimonials");
    Route::post("save-testimonials", [TestimonialsController::class, "saveTestimonialsMaster"])->name("saveTestimonialsMaster");
    Route::post("testimonials-data", [TestimonialsController::class, "testimonialsData"])->name("testimonialsData");
    Route::get("get-testimonial-row-data", [TestimonialsController::class, "getTestimonialRowData"])->name("getTestimonialRowData");

    Route::get("mange-contact-us",[ContactUsController::class,"manageContactUs"])->name("manageContactUs");
    Route::post("contact-us-data",[ContactUsController::class,"contactUsData"])->name("ContactUsData");

    Route::get("manage-offers",[OurOffersController::class,"index"])->name("manage-offers.index");
    Route::post("save-offers",[OurOffersController::class,"store"])->name("manage-offers.store");
    Route::post("manage-offers-data",[OurOffersController::class,"manageOffersData"])->name("manageOffersData");
    // New Routes
    // For Slide
    Route::get('slider',[SliderController::class,'index'])->name('slider');
    Route::post('SliderData',[SliderController::class,'GetAllSliderData'])->name('slider.data');
    Route::post('slidersavemaster',[SliderController::class,'SaveSliderMaster'])->name('slider.save.master');
    Route::get('getSliderDataById',[SliderController::class,'GetSliderDataById'])->name('SliderDataBy.id');
    Route::get('deleteSlider',[SliderController::class,'deleteSlider'])->name('slider.delete');

    // For About Us
    Route::get('manageaboutus',[AdminAboutUSController::class,'index'])->name('manageAboutUs');
    Route::post('AboutUsData',[AdminAboutUSController::class,'GetAllData'])->name('aboutUs.data');
    Route::post('aboutUssavemaster',[AdminAboutUSController::class,'SaveMaster'])->name('aboutUs.save.master');
    Route::get('getaboutUsDataById',[AdminAboutUSController::class,'dataById'])->name('aboutUsDataBy.id');
    Route::get('deleteaboutUs',[AdminAboutUSController::class,'delete'])->name('aboutUs.delete');



    // For Teams
    Route::get('manageTeam',[TeamController::class,'index'])->name('manageTeam');
    Route::post('TeamData',[TeamController::class,'GetAllData'])->name('team.data');
    Route::post('Teamsmaster',[TeamController::class,'SaveMaster'])->name('team.save.master');
    Route::get('getTeamDataById',[TeamController::class,'dataById'])->name('TeamDataBy.id');
    Route::get('deleteTeam',[TeamController::class,'delete'])->name('team.delete');


    // For PROUDCT
    Route::get('manageproduct',[productController::class,'index'])->name('manageproduct');
    Route::post('productData',[productController::class,'GetAllData'])->name('product.data');
    Route::post('productsmaster',[productController::class,'SaveMaster'])->name('product.save.master');
    Route::get('getproductDataById',[productController::class,'dataById'])->name('productDataBy.id');
    Route::get('deleteproduct',[productController::class,'delete'])->name('product.delete');



    // For REPORTS
    Route::get('managereport',[ReportController::class,'index'])->name('managereport');
    Route::post('reportData',[ReportController::class,'GetAllData'])->name('report.data');
    Route::post('reportsmaster',[ReportController::class,'SaveMaster'])->name('report.save.master');
    Route::get('getreportDataById',[ReportController::class,'dataById'])->name('reportDataBy.id');
    Route::get('deletereport',[ReportController::class,'delete'])->name('report.delete');


    // For PARTNER
    Route::get('managepartner',[PartnersController::class,'index'])->name('managepartner');
    Route::post('partnerData',[PartnersController::class,'GetAllData'])->name('partner.data');
    Route::post('partnersmaster',[PartnersController::class,'SaveMaster'])->name('partner.save.master');
    Route::get('getpartnerDataById',[PartnersController::class,'dataById'])->name('partnerDataBy.id');
    Route::get('deletepartner',[PartnersController::class,'delete'])->name('partner.delete');




    // For BLOG
    Route::get('manageblog',[BlogController::class,'index'])->name('manageblog');
    Route::post('blogData',[BlogController::class,'GetAllData'])->name('blog.data');
    Route::post('blogsmaster',[BlogController::class,'SaveMaster'])->name('blog.save.master');
    Route::get('getblogDataById',[BlogController::class,'dataById'])->name('blogDataBy.id');
    Route::get('deleteblog',[BlogController::class,'delete'])->name('blog.delete');


    // For FAQ
    Route::get('managefaq',[FaqController::class,'index'])->name('managefaq');
    Route::post('faqData',[FaqController::class,'GetAllData'])->name('faq.data');
    Route::post('faqsmaster',[FaqController::class,'SaveMaster'])->name('faq.save.master');
    Route::get('getfaqDataById',[FaqController::class,'dataById'])->name('faqDataBy.id');
    Route::get('deletefaq',[FaqController::class,'delete'])->name('faq.delete');




    // For Settings
    Route::get('managesetting',[SettingController::class,'index'])->name('managesetting');
    Route::get('GetAlldata',[SettingController::class,'GetAllData'])->name('setting.data');
    Route::post('settingsmaster',[SettingController::class,'UpdateSetting'])->name('setting.update.master');

    Route::get("jobseekersdatapage",[JobSeekerController::class,"jobseekersdatapage"])->name("jobseekersdatapage");

    Route::post("jobseekersdata", [JobSeekerController::class, "jobseekersdata"])->name("jobseekersdata");
    Route::get('/jobseeker/download-cv/{id}', [JobSeekerController::class, 'downloadCv'])->name('jobseeker.download_cv');
Route::get('/jobseekers/{id}/pdf', [JobSeekerController::class, 'generateProfilePdf'])
     ->name('jobseeker.generate_profile_pdf');

Route::get('/jobseekers/export', [JobSeekerController::class, 'export'])->name('jobseeker.export_data');

Route::get("employersdatapage",[EmployerController::class,"employersdatapage"])->name("employersdatapage");

    Route::post("employersdata", [EmployerController::class, "employersdata"])->name("employersdata");
    // Route::get('/jobseeker/download-cv/{id}', [JobSeekerController::class, 'downloadCv'])->name('jobseeker.download_cv');
Route::get('/employers/{id}/pdf', [EmployerController::class, 'generateProfilePdf'])
     ->name('employers.generate_profile_pdf');

Route::get('/employers/export', [EmployerController::class, 'export'])->name('employers.export_data');

});
