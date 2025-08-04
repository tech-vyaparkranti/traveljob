<div class="sticky-navigation" style="background:#f2dcdc;">
    <div class="custom-container">
    <ul class="sticky-content p-0 m-0" >
            <li><a  style="color:black" href="mailto:{{ isset($WebSetting['0']->email) ? $WebSetting['0']->email : 'info@Traveljob.com' }}"><i class="fa fa-envelope"></i>&nbsp;<span>{{ isset($WebSetting['0']->email) ? $WebSetting['0']->email : 'info@TravelJob.com' }}</span></a></li>
            <li><a  style="color:black" href="tel:{{ isset($WebSetting['0']->mobile) ? $WebSetting['0']->mobile : '+91 9876543210' }}"><i class="fa fa-phone"  style="color:black"></i>&nbsp;<span>{{ isset($WebSetting['0']->mobile) ? $WebSetting['0']->mobile : '+91 9876543210' }}</span></a></li>
        </ul>
        <div class="gtranslate_wrapper"></div>
    </div>
</div>
<!-- Header section Start -->
<header class="main-header">
    <div class="header-contaner">
        <div class="logo-section">
            <div class="mobile-bars" hidden></div>
            <a href="{{ url('/') }}" aria-level="Main logo"><img src="{{ isset($WebSetting['0']->logo) ? url($WebSetting['0']->logo) : './assets/img/logo4.png' }}" class="img-fluid" width="120" height="86" alt="TravelJob  Farmer Producer Company Limited"></a>
        </div>
        <div class="slide-navigation">
            <div class="navbar-wrapper">
                <ul class="navbar-block">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('aboutUs') }}">About Us</a>
                        {{-- <i class="drop-plus" hidden></i>
                        <ul class="sublist">
                            <li><a href="{{ route('aboutUs') }}#mission-sec">Vision/Mission</a></li>
                            <li><a href="{{ route('aboutUs') }}#teams-sec">Our Teams</a></li>
                        </ul> --}}
                    </li>
                    {{-- <li><a href="{{ route('destinations') }}">Our Services</a></li> --}}
                    <li><a href="{{ route('productPage') }}">Profile submission</a></li>
                    {{-- <li><a href="{{ route('reportPage') }}">Report</a></li>
                    <li><a href="{{ route('galleryPages') }}">Event</a></li>
                     <li><a href="{{ route('blogPage') }}">Blog</a></li> --}}
                    <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                </ul>
            </div>
            <ul class="social-media">
                <li><a href="{{ isset($WebSetting['0']->facebook) ? $WebSetting['0']->facebook : '/' }}" aria-label="Read more about TravelJob  Farmer Producer Company Limited  facebook"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="{{ isset($WebSetting['0']->twitter) ? $WebSetting['0']->twitter : '/' }}" aria-label="Read more about TravelJob  Farmer Producer Company Limited  Twitter"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="{{ isset($WebSetting['0']->instagram) ? $WebSetting['0']->instagram : '/' }}" aria-label="Read more about TravelJob  Farmer Producer Company Limited  Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="{{ isset($WebSetting['0']->youtube) ? $WebSetting['0']->youtube : '/' }}" aria-label="Read more about TravelJob  Farmer Producer Company Limited  Youtube"><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
        </div>
    </div>
</header>
<!-- Header section end -->
<style>
    header.fixed-header .slide-navigation ul li a {
    color:white;
}

header.fixed-header .mobile-bars:before,
header.fixed-header .mobile-bars:after {
    background: white !important;
}

</style>