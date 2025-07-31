@extends('layouts.webSite')
@section('title', 'Travel Job ')
@section('content')
    {{-- @include('include.navigation') --}}
    @include('include.slider')

    {{-- <!-- aboutus Section -->
    <div class="destinations pt-5 pb-2">
        <div class="custom-container">
            <div class="site-title">
                <h2 class="text-center">About Us</h2>
            </div>
            <p class="text-center">{!! isset($aboutText['0']->sort_about_us) ? $aboutText['0']->sort_about_us : 'Please fill about data from admin panel.'  !!}</p>
        </div>
    </div>
    <!-- About Section End --> --}}

    <div class="destinations pt-5 pb-2">
    <div class="custom-container">
        <div class="col-12 offerings-container">
            <div class="site-title">
                <h2 class="text-center">About Us</h2>
            </div>

            <div class="row align-items-center">
                <!-- Image Column (50%) -->
                <div class="col-md-6 mb-3" data-aos="fade-right">
                    <img src="{{ isset($aboutText['0']->about_image) ? asset($aboutText['0']->about_image) : asset('assets/img/Random Pics.jpeg') }}"
                         alt="About Us"
                         class="img-fluid rounded w-100"
                         style="height:300px;">
                </div>

                <!-- Content Column (50%) -->
                <div class="col-md-6" data-aos="fade-left">
                    <p class="text-center">{!! isset($aboutText['0']->sort_about_us) ? $aboutText['0']->sort_about_us : 'Please fill about data from admin panel.'  !!}</p>


          <a href="{{ route('aboutUs') }}" 
   class="btn" 
   style="background-color:#030358; color:white; padding:10px 20px; border:none;">
   Know More
</a>
      </div>
            </div>

        </div>
    </div>
</div>
<style>
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
    <div class="destinations pt-5 pb-2">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Overview Of Services</h2>
            <p class="text-center">Turn your love for travel into a career — the world is hiring!</p>
        </div>
        <div class="swiper we-offer">
            <div class="swiper-wrapper">
                @if (!empty($service))
                    @foreach ($service as $item)
                        <div class="swiper-slide mb-4">
                            {{-- Use Flexbox on the parent container --}}
                            <div class="destinations-block" style="display: flex; flex-direction: column; height: 350px;">
                                {{-- Image Wrapper (90% of parent height) --}}
                                <div style="height: 90%; overflow: hidden;">
                                    <img src="{{ url($item->image) }}" class="img-fluid"
                                    alt="{!! $item->service_name !!}" style="width:100%; height:100%;">
                                </div>

                                {{-- Name Wrapper (10% of parent height) --}}
                                <div class="destinations-name-container" style="height: 10%; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa; text-align: center; padding: 0 5px;margin-top:10px">
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
    <div class="destinations pt-5 pb-2">
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
            <img src="assets/img/jobseeker.jpeg" alt="Job Seeker" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
        </div>
        <div class="quick-nav-content p-4">
            <h4 class="text-dark">I'm a Job Seeker</h4>
            <p class="text-muted mb-0">Discover exciting career opportunities and find your next Travel Job adventure.</p>
        </div>
    </a>
</div>
            <div class="col-md-6">
                <a href="" class="quick-nav-card d-block text-decoration-none shadow-sm rounded-3 overflow-hidden">
                    <div class="quick-nav-image-container">
                        {{-- Replace this placeholder image URL with your own image for employers --}}
                        <img src="assets/img/employer.jpeg" alt="Employer" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
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

    {{-- Testimonial Section  --}}
    <section class="testimonial pt-5 pb-4">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Testimonial</h2>
                <p class="text-center text-white">Include quotes or stories from farmers who have benefited from <b>Travel Job  FPO's</b> services.</p>
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
  
<section class="our_partner pt-5 pb-2">
    <div class="custom-container">
        <div class="site-title pb-3">
            <h2 class="text-center">Industry Certifications</h2>
        </div>
        <div class="row">
            @if(!empty($partnersImages))
            @foreach ($partnersImages as $PartnerRow)
            <div class="col-4">
                {{-- Increased size and added border-radius for a curvy look --}}
                <div style="width:auto;height:250px;overflow:hidden;border-radius: 15px;">
                    <img src="{{ url($PartnerRow->image) }}" alt="deHaat" width="300" class="img-fluid" />
                </div>
            </div>
            @endforeach
            @else
            {{-- Update the fallback images as well --}}
            <div class="col-4">
                <img src="assets/img/deHaat-logo.png" alt="deHaat" width="300" height="250" class="img-fluid" style="border-radius: 15px;" />
            </div>
            <div class="col-4">
                <img src="assets/img/amrit.jpg" alt="deHaat" width="300" height="250" class="img-fluid" style="border-radius: 15px;" />
            </div>
            <div class="col-4">
                <img src="assets/img/guiding.jpg" alt="deHaat" width="300" height="250" class="img-fluid" style="border-radius: 15px;" />
            </div>
            @endif
        </div>
    </div>
</section>

    {{-- Testimonial Section End  --}}
@endsection
@section('script')
    <script>
        let site_url = '{{ url('/') }}';
    </script>
    {{-- <script src="js/homePage.js?v=2"></script> --}}
@endsection
