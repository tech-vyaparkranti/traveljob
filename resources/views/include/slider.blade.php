<!-- main Video Section -->
<div class="video-banner" >
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
              <span   class="cursor typewriter-animation">{!! $sliderData->slider_title; !!}</span>
              <p class="cursor typewriter-animation" style="font-size:40px;font-weight:bold"><?php echo $sliderData->sort_about;?></p>
              <a href="<?php echo $sliderData->button_link;?>" aria-label="Explore The World">Get in touch</a>
            </div>
          </div>
        @endforeach
        <?php } else { ?>
        <div class="swiper-slide">
            <img class="img-fluid" width="" height="" alt="Image" src="assets/img/banner-3.png" />
            <div class="video-content">
              <span>Travel Job </span>
              <h1 >Serving Since 2023</h1>
              <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
            </div>
          </div>
         <?php } ;?>


<div class="swiper-button-prev" ></div>
<div class="swiper-button-next" ></div>

        {{-- <div class="swiper-slide">
          <img class="img-fluid" width="" height="" alt="Image" src="assets/img/banner-2.png" />
          <div class="video-content">
            <span>Travel Job </span>
            <h1>Grow with Innovation: Solutions for Sustainable Farming</h1>
            <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
</div>

<style>



.cursor {
  overflow: hidden;
  white-space: nowrap;
}
.typewriter-animation {
  animation: 
    typewriter 5s steps(50) 1s 1 normal both, 
    blinkingCursor 500ms steps(50) infinite normal;
}
@keyframes typewriter {
  from { width: 0; }
  to { width: 100%; }
}
@keyframes blinkingCursor{
  from { border-right-color: rgba(255,255,255,.75); }
  to { border-right-color: transparent; }
}

.swiper-button-prev, .swiper-button-next {
  position: absolute;
  top: 200px;
  background:white;
  padding:10px;
  border-radius:50%;
  font-size:20px !important;
  
}
@media (max-width: 640px) { 
  .swiper-button-prev, .swiper-button-next {
    top: 120px;
  }
}


</style>


