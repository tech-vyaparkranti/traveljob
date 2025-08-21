@extends('layouts.webSite')
@section('title', 'Travel Job ')
@section('content')
    {{-- @include('include.navigation') --}}
    @include('include.slider')

    {{-- <!-- aboutus Section -->
    <div class="destinations pt-5 pb-2" >
        <div class="custom-container">
            <div class="site-title">
                <h2 class="text-center">About Us</h2>
            </div>
            <p class="text-center">{!! isset($aboutText['0']->sort_about_us) ? $aboutText['0']->sort_about_us : 'Please fill about data from admin panel.'  !!}</p>
        </div>
    </div>
    <!-- About Section End --> --}}

 <div class="destinations py-5" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
  <div class="custom-container">
    <div class="offerings-container col-12">
      
      <!-- Section Title -->
      <div class="site-title text-center mb-4">
        <h2>About Us</h2>
      </div>

      <!-- Row -->
      <div class="row align-items-center">
        
        <!-- Image Column -->
        <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
          <img 
            src="{{ isset($aboutText['0']->about_image) ? asset($aboutText['0']->about_image) : asset('assets/img/Random Pics.jpeg') }}" 
            alt="About Us" 
            class="img-fluid w-100 shadow-sm hover-z image-height" 
            style="  border-radius: 10px;"
          >
        </div>
        <!-- Text Column -->
        <div class="col-md-6 text-justify text-md-start" data-aos="fade-left">
          <p class="about-text mb-3 ">
            {!! isset($aboutText['0']->sort_about_us) 
                ? $aboutText['0']->sort_about_us 
                : 'Please fill about data from admin panel.' !!}
          </p>
          <a 
            href="{{ route('aboutUs') }}" 
            class="btn" 
            style="background-color:#030358; color:white; padding:10px 20px; border-radius:5px;">
            Know More
          </a>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- In <head> -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<style>
     .image-height{
        height:300px;
     }
    @media (max-width: 640px) { 
        .image-height{
            height:200px;
        }
    }
 
.hover-zoom {
  transition: transform 0.3s ease;
}
.hover-zoom:hover {
  transform: scale(1.05);
}



.custom-container, .offerings-container {
    overflow-x: hidden;
}
</style>
    {{-- <section class="chairperson">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="chairperson-figure pb-5">
                        <?php if(!empty($getChairManData['0']->image)) { ?>
                        <img src="<?php echo url($getChairManData['0']->image)?>" width="" height="" class="img-fluid" alt="Chairperson's" />
                        <?php } else{ ?>
                            <img src="assets/img/Mukesh-Kumar-Pandey-ji.png" width="" height="" class="img-fluid" alt="Chairperson's" />
                            <?php } ?>
                    </div>
                </div>
                <div class="col-md-8">
            <?php if(!empty($getChairManData['0']->message)) { ?>
                <div class="chairperson-content">
                    <h3>Message from Chairperson’s Desk</h3>
                    <p><b>Welcome!</b><br>
                       {!! $getChairManData['0']->message  !!}</b><br><span>(<?php echo $getChairManData['0']->name?>)</span></p>getChairManData
                </div>
                <?php } else { ?>
                    <div class="chairperson-content">
                        <h3>Message from Chairperson’s Desk</h3>
                        <p><b>Welcome!</b><br>
                            I am immensely proud of the journey Travel Job  FPO has undertaken. We started with a vision to empower our fellow farmers and transform their livelihoods. Today, seeing hundreds of families thriving under our umbrella fills me with immense satisfaction. Our commitment is unwavering. We will continue to work relentlessly to provide our farmers with the resources, knowledge, and support they need to achieve agricultural success. Join us on this journey of growth and prosperity!<br><b>Warm regards,</b><br><span>(Mr. Mukesh Kumar Pandey)</span></p>getChairManData
                    </div>
                 <?php }?>

                </div>
            </div>
        </div>
    </section> --}}

    <!-- Destinations Section -->
    <div class="destinations pt-5 pb-2" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Overview Of Services</h2>
            <p class="text-center">Turn your love for travel into a career — the world is hiring!</p>
        </div>
        <div class="swiper we-offer">
            <div class="swiper-wrapper  ">
                @if (!empty($service))
                    @foreach ($service as $item)
                        <div class="swiper-slide mb-4">
                            {{-- Use Flexbox on the parent container --}}
                            <div class="destinations-block" style="display: flex; flex-direction: column; height: 350px;">
                                {{-- Image Wrapper (90% of parent height) --}}
                                <div style="height: 90%; overflow: hidden;">
                                    <img  src="{{ url($item->image) }}" class="img-fluid hover-zoom"
                                    alt="{!! $item->service_name !!}" style="width:100%; height:100%;border-radius:10px 10px 0px 0px">
                                </div>

                                {{-- Name Wrapper (10% of parent height) --}}
                                <div class="destinations-name-container" style="height: 10%; display: flex; align-items: center; justify-content: center; text-align: center; padding: 0 5px;margin-top:10px">
                                    <span class="destinations-title" style="margin: 0; font-size: 1.8rem; color: #333;">
                                        {!! $item->service_name !!}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
    <!-- Destinations Section End -->

     <!-- Destinations Section -->
    <!-- Destinations Section -->
    <div class="destinations pt-5 pb-2"  data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Quick Navigation</h2>
            <p class="text-center">Choose the path that's right for you to get started.</p>
        </div>
        <div class="row g-4">
           <div class="col-md-6">
    <a href="{{ route('productPage') }}" class="quick-nav-card d-block text-decoration-none shadow-sm rounded-3 overflow-hidden">
        <div class="quick-nav-image-container">
            {{-- Replace this placeholder image URL with your own image for job seekers --}}
            <img src="assets/img/jobseeker.jpeg" alt="Job Seeker" class="img-fluid w-100 hover-zoom" style="height: 200px; object-fit: cover;">
        </div>
        <div class="quick-nav-content p-4">
            <h4 class="text-dark">I'm a Job Seeker</h4>
            <p class="text-muted mb-0">Discover exciting career opportunities and find your next Travel Job adventure.</p>
        </div>
    </a>
</div>
            <div class="col-md-6">
                <a href="{{ route('EmployerPage') }}" class="quick-nav-card d-block text-decoration-none shadow-sm rounded-3 overflow-hidden">
                    <div class="quick-nav-image-container">
                        {{-- Replace this placeholder image URL with your own image for employers --}}
                        <img src="assets/img/employer.jpeg" alt="Employer" class="img-fluid w-100 hover-zoom" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="quick-nav-content p-4">
                        <h4 class="text-dark">I'm an Employer</h4>
                        <p class="text-muted mb-0">Post jobs and find the perfect talent to join your team with ease.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.quick-nav-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.quick-nav-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
</style>
    <!-- Destinations Section End -->
     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelJobs.info - Founders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <style>
        /* Scoped styles to prevent conflicts - all styles prefixed with .traveljobs-founders-slider */


        .traveljobs-founders-slider {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .traveljobs-founders-slider .slider-container {
            width: 100%;
            max-width: none;
            height: auto;
            min-height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: none;
            margin: 30px auto;
        }

        .traveljobs-founders-slider .founders-swiper {
            width: 100%;
            height: 100%;
        }

        .traveljobs-founders-slider .founders-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            position: relative;
            overflow: hidden;
        }

        .traveljobs-founders-slider .slide-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 40px;
            padding: 40px 60px;
            width: 100%;
            max-width: none;
            align-items: center;
            margin: 0;
        }

        .traveljobs-founders-slider .founder-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.3s ease;
        }

        .traveljobs-founders-slider .founder-image:hover {
            transform: perspective(1000px) rotateY(0deg) scale(1.05);
        }

        .traveljobs-founders-slider .founder-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
        }

        .traveljobs-founders-slider .founder-info {
            padding: 0;
            margin: 0;
        }

        .traveljobs-founders-slider .founder-title {
            font-size: 2rem;
            font-weight: 800;
            color: #030358;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: -2px;
            line-height: 1;
        }

        .traveljobs-founders-slider .founder-subtitle {
            font-size: 1.3rem;
            color: #7f8c8d;
            margin-bottom: 15px;
            font-weight: 300;
        }

        .traveljobs-founders-slider .founder-description {
            font-size: 0.9rem;
            line-height: 1.8;
            color: #34495e;
            text-align: justify;
        }

        .traveljobs-founders-slider .founder-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-top: 15px;
            text-align: right;
        }

        .traveljobs-founders-slider .founder-position {
            font-size: 1.2rem;
            color: #7f8c8d;
            font-weight: 500;
            text-align: right;
            margin-top: 2px;
        }

        /* Scoped Swiper Navigation */
        .traveljobs-founders-slider .founders-swiper .swiper-button-next,
        .traveljobs-founders-slider .founders-swiper .swiper-button-prev {
            color: #2c3e50;
            background: rgba(255,255,255,0.9);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .traveljobs-founders-slider .founders-swiper .swiper-button-next:hover,
        .traveljobs-founders-slider .founders-swiper .swiper-button-prev:hover {
            background: #2c3e50;
            color: white;
            transform: scale(1.1);
        }

        .traveljobs-founders-slider .founders-swiper .swiper-button-next:after,
        .traveljobs-founders-slider .founders-swiper .swiper-button-prev:after {
            font-size: 18px;
            font-weight: bold;
        }

        /* Scoped Pagination */
        .traveljobs-founders-slider .founders-swiper .swiper-pagination-bullet {
            width: 15px;
            height: 15px;
            background: rgba(44, 62, 80, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .traveljobs-founders-slider .founders-swiper .swiper-pagination-bullet-active {
            background: #2c3e50;
            transform: scale(1.3);
        }

        /* Co-founder slide styling */
        .traveljobs-founders-slider .slide-content.reverse {
            grid-template-columns: 2fr 1fr;
        }

        .traveljobs-founders-slider .slide-content.reverse .founder-image {
            order: 2;
            transform: perspective(1000px) rotateY(5deg);
        }

        .traveljobs-founders-slider .slide-content.reverse .founder-image:hover {
            transform: perspective(1000px) rotateY(0deg) scale(1.05);
        }

        .traveljobs-founders-slider .slide-content.reverse .founder-info {
            order: 1;
        }

        .traveljobs-founders-slider .slide-content.reverse .founder-name,
        .traveljobs-founders-slider .slide-content.reverse .founder-position {
            text-align: left;
        }

        /* Comprehensive Responsive Design */
        
        /* Extra Large Desktops (1440px+) */
        @media (min-width: 1440px) {
            .traveljobs-founders-slider .slider-container {
                max-width: none;
            }
            
            .traveljobs-founders-slider .slide-content {
                gap: 80px;
                padding: 80px 100px;
                grid-template-columns: 1fr 2fr;
            }
            
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 2fr 1fr;
            }
            
            .traveljobs-founders-slider .founder-title {
                font-size: 2rem;
            }
            
            .traveljobs-founders-slider .founder-description {
                font-size: 0.9rem;
            }
        }

        /* Large Desktops (1200px - 1439px) */
        @media (min-width: 1200px) and (max-width: 1439px) {
            .traveljobs-founders-slider .slider-container {
                max-width: none;
                height: 700px;
            }
            
            .traveljobs-founders-slider .slide-content {
                gap: 60px;
                padding: 60px 80px;
                grid-template-columns: 1fr 2fr;
            }
            
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 2fr 1fr;
            }
        }

        /* Medium Desktops (992px - 1199px) */
        @media (min-width: 992px) and (max-width: 1199px) {
            .traveljobs-founders-slider .slider-container {
                height: 650px;
            }
            
            .traveljobs-founders-slider .slide-content {
                gap: 50px;
                padding: 50px 70px;
                grid-template-columns: 1fr 2fr;
            }
            
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 2fr 1fr;
            }
            
            .traveljobs-founders-slider .founder-title {
                font-size: 2rem;
            }
            
            .traveljobs-founders-slider .founder-description {
                font-size: 0.9rem;
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 350px;
            }
        }

        /* Small Desktops/Large Tablets (768px - 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .traveljobs-founders-slider .slider-container {
                height: 600px;
            }
            
            .traveljobs-founders-slider .slide-content {
                gap: 40px;
                padding: 40px 60px;
                grid-template-columns: 1fr 2fr;
            }
            
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 2fr 1fr;
            }
            
            .traveljobs-founders-slider .founder-title {
                font-size: 2rem;
            }
            
            .traveljobs-founders-slider .founder-subtitle {
                font-size: 1.2rem;
            }
            
            .traveljobs-founders-slider .founder-description {
                font-size: 0.95rem;
                line-height: 1.7;
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 320px;
            }
            
            .traveljobs-founders-slider .founder-name {
                font-size: 1.6rem;
            }
            
            .traveljobs-founders-slider .founder-position {
                font-size: 1.1rem;
            }
        }

        /* Tablets Portrait (481px - 767px) */
        @media (min-width: 481px) and (max-width: 767px) {
            .traveljobs-founders-slider {
                padding: 0;
            }
            
            .traveljobs-founders-slider .slider-container {
                height: auto;
                min-height: 700px;
            }
            
            .traveljobs-founders-slider .slide-content,
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 30px 40px;
            }

            .traveljobs-founders-slider .slide-content.reverse .founder-image {
                order: 1;
                transform: none;
            }

            .traveljobs-founders-slider .slide-content.reverse .founder-info {
                order: 2;
            }

            .traveljobs-founders-slider .founder-title {
                font-size: 2rem;
                text-align: center;
                margin-bottom: 15px;
            }
            
            .traveljobs-founders-slider .founder-subtitle {
                font-size: 1.1rem;
                text-align: center;
                margin-bottom: 25px;
            }

            .traveljobs-founders-slider .founder-image {
                transform: none;
                max-width: 400px;
                margin: 0 auto;
            }

            .traveljobs-founders-slider .founder-image:hover {
                transform: scale(1.02);
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 300px;
            }

            .traveljobs-founders-slider .founder-description {
                font-size: 0.9rem;
                line-height: 1.6;
                text-align: left;
            }

            .traveljobs-founders-slider .founder-name,
            .traveljobs-founders-slider .founder-position {
                text-align: center !important;
            }
            
            .traveljobs-founders-slider .founder-name {
                font-size: 1.5rem;
                margin-top: 25px;
            }
            
            .traveljobs-founders-slider .founder-position {
                font-size: 1rem;
            }
        }

        /* Mobile Landscape (376px - 480px) */
        @media (min-width: 376px) and (max-width: 480px) {
            .traveljobs-founders-slider {
                padding: 0;
            }
            
            .traveljobs-founders-slider .slider-container {
                height: auto;
                min-height: 650px;
                border-radius: 0;
            }
            
            .traveljobs-founders-slider .slide-content,
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 1fr;
                gap: 25px;
                padding: 25px 30px;
            }

            .traveljobs-founders-slider .founder-title {
                font-size: 2rem;
                text-align: center;
            }
            
            .traveljobs-founders-slider .founder-subtitle {
                font-size: 1rem;
                text-align: center;
                margin-bottom: 20px;
            }

            .traveljobs-founders-slider .founder-image {
                max-width: 320px;
                margin: 0 auto;
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 250px;
            }

            .traveljobs-founders-slider .founder-description {
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .traveljobs-founders-slider .founder-name {
                font-size: 1.3rem;
                margin-top: 20px;
            }
            
            .traveljobs-founders-slider .founder-position {
                font-size: 0.95rem;
            }
            
            .traveljobs-founders-slider .founders-swiper .swiper-button-next,
            .traveljobs-founders-slider .founders-swiper .swiper-button-prev {
                width: 40px;
                height: 40px;
            }
            
            .traveljobs-founders-slider .founders-swiper .swiper-button-next:after,
            .traveljobs-founders-slider .founders-swiper .swiper-button-prev:after {
                font-size: 16px;
            }
        }

        /* Mobile Portrait (320px - 375px) */
        @media (max-width: 375px) {
            .traveljobs-founders-slider {
                padding: 0;
            }
            
            .traveljobs-founders-slider .slider-container {
                height: auto;
                min-height: 600px;
                border-radius: 0;
            }
            
            .traveljobs-founders-slider .slide-content,
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px 25px;
            }

            .traveljobs-founders-slider .founder-title {
                font-size: 1.8rem;
                text-align: center;
                line-height: 0.9;
            }
            
            .traveljobs-founders-slider .founder-subtitle {
                font-size: 0.9rem;
                text-align: center;
                margin-bottom: 15px;
            }

            .traveljobs-founders-slider .founder-image {
                max-width: 280px;
                margin: 0 auto;
                border-radius: 15px;
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 220px;
            }

            .traveljobs-founders-slider .founder-description {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            .traveljobs-founders-slider .founder-name {
                font-size: 1.2rem;
                margin-top: 15px;
            }
            
            .traveljobs-founders-slider .founder-position {
                font-size: 0.9rem;
            }
            
            .traveljobs-founders-slider .founders-swiper .swiper-button-next,
            .traveljobs-founders-slider .founders-swiper .swiper-button-prev {
                width: 35px;
                height: 35px;
            }
            
            .traveljobs-founders-slider .founders-swiper .swiper-button-next:after,
            .traveljobs-founders-slider .founders-swiper .swiper-button-prev:after {
                font-size: 14px;
            }
            
            .traveljobs-founders-slider .founders-swiper .swiper-pagination-bullet {
                width: 12px;
                height: 12px;
            }
        }

        /* Very Small Mobile (under 320px) */
        @media (max-width: 319px) {
            .traveljobs-founders-slider .founder-title {
                font-size: 1.5rem;
            }
            
            .traveljobs-founders-slider .founder-image {
                max-width: 250px;
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 200px;
            }
            
            .traveljobs-founders-slider .founder-description {
                font-size: 0.75rem;
            }
            
            .traveljobs-founders-slider .slide-content,
            .traveljobs-founders-slider .slide-content.reverse {
                padding: 15px 20px;
            }
        }

        /* Landscape Orientation Adjustments for Mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .traveljobs-founders-slider {
                min-height: auto;
                padding: 0;
            }
            
            .traveljobs-founders-slider .slider-container {
                height: 90vh;
                min-height: 500px;
            }
            
            .traveljobs-founders-slider .slide-content {
                grid-template-columns: 1fr 1.2fr;
                gap: 20px;
                padding: 20px 30px;
            }
            
            .traveljobs-founders-slider .slide-content.reverse {
                grid-template-columns: 1.2fr 1fr;
            }
            
            .traveljobs-founders-slider .founder-image {
                max-width: none;
            }
            
            .traveljobs-founders-slider .founder-image img {
                height: 250px;
            }
            
            .traveljobs-founders-slider .founder-title {
                font-size: 2rem;
                text-align: left;
            }
            
            .traveljobs-founders-slider .slide-content.reverse .founder-title {
                text-align: right;
            }
            
            .traveljobs-founders-slider .founder-description {
                font-size: 0.8rem;
                line-height: 1.4;
            }
        }

        /* Background patterns */
        .traveljobs-founders-slider .slide-content::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: foundersFloat 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes foundersFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
    </style>
</head>
<body>
    <div class="traveljobs-founders-slider" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
        <div class="slider-container">
            <div class="swiper founders-swiper">
                <div class="swiper-wrapper">
                    <!-- Founder Slide -->
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="founder-image">
                                <img src="./assets/img/founder.jpeg" width='400' height='400' viewBox='0 0 400 400'%3E%3Crect width='400' height='400' fill='%23f8f9fa'/%3E%3Ctext x='200' y='180' text-anchor='middle' fill='%236c757d' font-size='16' font-family='Arial'%3EFounder Image%3C/text%3E%3Ctext x='200' y='220' text-anchor='middle' fill='%236c757d' font-size='14' font-family='Arial'%3EAshok Harkara%3C/text%3E%3C/svg%3E" alt="Ashok Harkara - Founder">
                            </div>
                            <div class="founder-info">
                                <h2 class="founder-title">Founder</h2>
                                <p class="founder-subtitle">Message</p>
                                <p class="founder-description">
                    With over 50 years in the global travel industry—starting in 1972 as an Agency Executive in Hyderabad and spanning roles across Mumbai, Saudi Arabia, East Africa, and the U.S.—I’ve worked across all major segments of travel. Having visited 48+ countries, I bring first-hand insight into how travel works worldwide. I also served as President of Skal International Hyderabad (606) and as a member of the Skal India National Committee, championing ethics, partnerships, and professional camaraderie. Now, through TravelJobs.info, I continue contributing by connecting talent with opportunity, fostering mentorship, mobility, and meaningful careers in travel.            </p>
                                <div class="founder-name">Ashok Harkara</div>
                                <div class="founder-position">Founder, TravelJobs.info</div>
                            </div>
                        </div>
                    </div>

                    <!-- Co-Founder Slide -->
                    <div class="swiper-slide">
                        <div class="slide-content reverse">
                            <div class="founder-image">
                                <img src="http://127.0.0.1:8000/assets/img/team1.jpeg" width='400' height='400' viewBox='0 0 400 400'%3E%3Crect width='400' height='400' fill='%23f8f9fa'/%3E%3Ctext x='200' y='180' text-anchor='middle' fill='%236c757d' font-size='16' font-family='Arial'%3ECo-Founder Image%3C/text%3E%3Ctext x='200' y='220' text-anchor='middle' fill='%236c757d' font-size='14' font-family='Arial'%3EVani Harkara%3C/text%3E%3C/svg%3E" alt="Vani Harkara - Co-Founder">
                            </div>
                            <div class="founder-info">
                                <h2 class="founder-title">Co-Founder</h2>
                                <p class="founder-subtitle">Message</p>
                                <p class="founder-description">
                                    With a strong background in travel operations and business strategy, I have spent decades creating innovative solutions for the global travel industry. My journey has taken me through diverse markets, collaborating with professionals from across continents to shape better travel experiences. I believe in empowering both companies and individuals by providing access to the right resources, opportunities, and networks. At TravelJobs.com, my goal is to help bridge gaps in the industry, encourage professional growth, and inspire the next generation of travel leaders.
                                </p>
                                <div class="founder-name">Vani Harkara</div>
                                <div class="founder-position">Co-Founder, TravelJobs.info</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation buttons -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <script>
        // Use a unique variable name and specific class selector to avoid conflicts
        const foundersSwiper = new Swiper('.founders-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'slide',
            speed: 800,
            navigation: {
                nextEl: '.founders-swiper .swiper-button-next',
                prevEl: '.founders-swiper .swiper-button-prev',
            },
            pagination: {
                el: '.founders-swiper .swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            mousewheel: {
                enabled: false, // Disabled to allow normal page scrolling
            },
            // Allow touch swipe on mobile but not interfere with page scroll
            touchRatio: 1,
            touchAngle: 45,
            simulateTouch: true,
            allowTouchMove: true,
            touchStartPreventDefault: false,
        });

        // Add smooth entrance animation with unique selector
        document.addEventListener('DOMContentLoaded', function() {
            const foundersSliderContainer = document.querySelector('.traveljobs-founders-slider .slider-container');
            if (foundersSliderContainer) {
                foundersSliderContainer.style.opacity = '0';
                foundersSliderContainer.style.transform = 'translateY(50px)';
                
                setTimeout(() => {
                    foundersSliderContainer.style.transition = 'all 0.8s ease';
                    foundersSliderContainer.style.opacity = '1';
                    foundersSliderContainer.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>

    <!-- Destinations Section End -->

    {{-- Testimonial Section  --}}
    <section class="testimonial pt-5 pb-4">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Testimonial</h2>
                <p class="text-center text-white">Include quotes or stories from Jobseekers who have benefited from <b>Travel Job  FPO's</b> services.</p>
            </div>
            <div class="swiper testimonials mb-5">
                <div class="swiper-wrapper" id="testimonialsData">
                    @if(isset($testimonial) && $testimonial->count() > 0)
                        @foreach ($testimonial as $testimonialValue)
                                <div class="swiper-slide">
                                    <div class="testimonials-block text-center">
                                        <div class="testimonials-title"><?=$testimonialValue->client_name?>
                                            {{-- <span>Farmer</span> --}}
                                        </div>
                                        <p class="text-justify"><?=$testimonialValue->review_text?></p>
                                    </div>
                                </div>
                        @endforeach
                        @else
                        <p>Testimonial not found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
  
<section class="our_partner pt-5 pb-2" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
    <div class="custom-container">
        <div class="site-title pb-3">
            <h2 class="text-center">Industry Certifications</h2>
        </div>
        <div class="row justify-content-center">
            @if(!empty($partnersImages))
                @foreach ($partnersImages as $PartnerRow)
                    <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex justify-content-center">
                        <div style="width:100%; max-width:400px; height:250px; overflow:hidden; border-radius:15px;">
                            <img src="{{ url($PartnerRow->image) }}" alt="deHaat" class="img-fluid hover-zoom element" style="border-radius:20px; width:100%; height:100%; " />
                        </div>
                    </div>
                @endforeach
            @else
                @php
                    $fallbackImages = [
                        'assets/img/deHaat-logo.png',
                        'assets/img/amrit.jpg',
                        'assets/img/guiding.jpg'
                    ];
                @endphp
                @foreach ($fallbackImages as $image)
                    <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex justify-content-center">
                        <div style="width:100%; max-width:300px; height:250px; overflow:hidden; border-radius:15px;">
                            <img src="{{ asset($image) }}" alt="Industry Logo" class="img-fluid" style="border-radius:20px; width:100%; height:100%; object-fit:cover;" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<style>
    </style>
    {{-- Testimonial Section End  --}}
@endsection
@section('script')
    <script>
        let site_url = '{{ url('/') }}';
    </script>
    {{-- <script src="js/homePage.js?v=2"></script> --}}
@endsection
