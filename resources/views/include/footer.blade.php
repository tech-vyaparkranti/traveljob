{{-- Recognitions --}}

{{-- <section class="recognitions pt-5 pb-4">
    <div class="custom-container">
        <div class="site-title pb-3">
            <h2 class="text-center">Recognitions</h2>
        </div>
        <div class="recognitions-self swiper">
            <div class="swiper-wrapper">
                @if(!empty($Recognitions))
                @foreach ($Recognitions as $RecoRow)
                <div class="swiper-slide mb-4">
                    <div class="destinations-new">
                        <div class="destinations-inner">
                            <div style="width:auto;height:150px;overflow:hidden;">
                            <img src="{{ url($RecoRow->image) }}" class="img-fluid" style="height:100%;width:100%;object-fit:cover;"  alt="Lakshadweep">
                        </div>
                            <!-- <span class="destinations-title">Certificate-1</span> -->
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="swiper-slide mb-4">
                    <div class="destinations-new">
                        <div class="destinations-inner">
                            <img src="assets/img/fssai.png" class="img-fluid" width="300" height="400" alt="India Gate">
                            <!-- <span class="destinations-title">Certificate-2</span> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide mb-4">
                    <div class="destinations-new">
                        <div class="destinations-inner">
                            <img src="assets/img/ministry.png" class="img-fluid" width="300" height="400" alt="Hawamahal">
                            <!-- <span class="destinations-title">Certificate-3</span> -->
                        </div>
                    </div>
                </div>
                @endif


            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section> --}}
{{-- Recognitions End --}}
<!-- Footer Section -->
<footer class="footer-section pt-4 pb-4">
    <div class="custom-container">
        <div class="row">
            <div class="col-md-5 mb-4">
                <div class="footer-item">
                    <div class="footer-logo">
                        <div class="footer-logo-inner">
                            <img src="{{ isset($WebSetting['0']->logo) ? url($WebSetting['0']->logo) : './assets/img/logo4.png' }}" class="img-fluid" width="130" height="86" alt="Travel Job  Farmer Producer Company Limited " >
                            {{-- <div id="TA_rated501" class="TA_rated"><ul id="JjXmgm" class="TA_links VuYcLdHeKQX"><li id="Vri6iTpTKUC" class="IZw2R90i"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g304551-d15224458-Reviews-The_Luxury_Travel-New_Delhi_National_Capital_Territory_of_Delhi.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/badges/ollie-11424-2.gif" alt="TripAdvisor"/></a></li></ul></div><script async src="https://www.jscache.com/wejs?wtype=rated&amp;uniq=501&amp;locationId=15224458&amp;lang=en_US&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script> --}}
                        </div>
                        <p><b>{{ isset($WebSetting['0']->company_name) ? $WebSetting['0']->company_name : 'Travel Job' }}</b></p>
                        <ul class="social-media mt-4">
                <li><a href="{{ isset($WebSetting['0']->facebook) ? $WebSetting['0']->facebook : '/' }}" aria-label="Read more about Travel Job  Farmer Producer Company Limited  facebook"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="{{ isset($WebSetting['0']->twitter) ? $WebSetting['0']->twitter : '/' }}" aria-label="Read more about Travel Job  Farmer Producer Company Limited  Twitter"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="{{ isset($WebSetting['0']->instagram) ? $WebSetting['0']->instagram : '/' }}" aria-label="Read more about Travel Job  Farmer Producer Company Limited  Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="{{ isset($WebSetting['0']->youtube) ? $WebSetting['0']->youtube : '/' }}" aria-label="Read more about Travel Job  Farmer Producer Company Limited  Youtube"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                        {{-- <p class="text-center mb-0"><img style="max-width: 100%" src="assets/img/msme.png" alt="Travel Job  Farmer Producer Company Limited " width="100%" height="" /></p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="footer-item">
                    <h5 class="footer-title">Quick Link</h5>
                    <ul>
                        <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                        <li><a href="{{ url('/') }}/comingsoon">Terms & Conditions</a></li>
                        {{-- <li><a href="{{ route('shippingDeliverypolicy') }}">Shipping & Delivery Policy</a></li>
                        <li><a href="{{ route('CancellationRefundPolicy') }}">Cancellation & Refund Policy</a></li> --}}
                        <li><a href="{{ url('/') }}/comingsoon">Privacy Policy</a></li>
                        <li><a href="{{ route('destinations') }}">Our Services</a></li>
                        <li><a href="{{ route('productPage') }}">Profile Submission</a></li>
                        <!-- <li><a href="{{ route('reportPage') }}">Report</a></li> -->
                        <!-- <li><a href="{{ route('galleryPages') }}">Event</a></li> -->
                        <li><a href="{{ route('blogPage') }}">Blog</a></li>
                        <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="footer-item">
                    <h5 class="footer-title">Contact Information</h5>
                    <div class="footer-contact">
                        <div class="footer-item pb-3">
                            <label>Company E-mail:</label>
                            <p><i class="fa-solid fa-envelope"></i>&nbsp;<a href="mailto:{{ isset($WebSetting['0']->email) ? $WebSetting['0']->email : 'info@TravelJob .com' }}">{{ isset($WebSetting['0']->email) ? $WebSetting['0']->email : 'info@TravelJob .com' }}</a>
                        </div>
                        <div class="footer-item pb-3">
                            <label>Contact No:</label>
                            <p><i class="fa-solid fa-phone"></i>&nbsp;<a href="tel:{{ isset($WebSetting['0']->mobile) ? $WebSetting['0']->mobile : '+91 964 866 0699' }}">{{ isset($WebSetting['0']->mobile) ? $WebSetting['0']->mobile : '+91 964 866 0699' }}</a></p>
                        </div>
                        <div class="footer-item pb-3">
                            <label>Address:</label>
                            <p>{{ isset($WebSetting['0']->address) ? $WebSetting['0']->address : 'Radhika Utasv Vatika, Vitthalpur, Sikar, Mirzapur(231306), Uttar Pradesh' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright-section text-center p-3">&copy;
    <script>
        document.write(new Date().getFullYear());
    </script>
    {{ isset($WebSetting['0']->copyright_txt) ? $WebSetting['0']->copyright_txt : ' All Rights Reserved by Travel Job ' }}
    & Developed by <a href="https://vyaparkranti.com/" class="text-white" aria-label="Digital Markating"
        alt="Vyapar Kranti">Vyapar kranti</a>
</div><!-- Footer Section End-->
