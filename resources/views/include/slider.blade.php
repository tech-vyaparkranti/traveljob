<!-- main Video Section -->
<div class="video-banner">
  <div class="video-block">
    <div class="swiper main-slider">
      <div class="swiper-wrapper">
        <?php
         if(!empty($slider[0]->slider_title) || !empty($slider[0]->slider_image)) {
            ?>
        @foreach ($slider as $sliderData)
        <div class="swiper-slide">
            <img class="img-fluid" width="" height="" alt="Image" src="<?php echo $sliderData->slider_image;?>" />
            <div class="video-content">
              <span>{!! $sliderData->slider_title; !!}</span>
              <h1><?php echo $sliderData->sort_about;?></h1>
              <a href="<?php echo $sliderData->button_link;?>" aria-label="Explore The World">Get in touch</a>
            </div>
          </div>
        @endforeach
        <?php } else { ?>
        <div class="swiper-slide">
            <img class="img-fluid" width="" height="" alt="Image" src="assets/img/banner-3.png" />
            <div class="video-content">
              <span>Krishidha</span>
              <h1>Serving Since 2023</h1>
              <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
            </div>
          </div>
         <?php } ;?>


<div class="swiper-button-prev" ></div>
<div class="swiper-button-next" ></div>

        {{-- <div class="swiper-slide">
          <img class="img-fluid" width="" height="" alt="Image" src="assets/img/banner-2.png" />
          <div class="video-content">
            <span>Krishidha</span>
            <h1>Grow with Innovation: Solutions for Sustainable Farming</h1>
            <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
</div>

<style>


.swiper-button-prev, .swiper-button-next {
  position: absolute;
  top: 200px;
  
}
@media (max-width: 640px) { 
  .swiper-button-prev, .swiper-button-next {
    top: 120px;
  }
}

</style>

