@extends('layouts.webSite')
@section('title', 'Events')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Events</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-5">
        <div class="custom-container">
            <div class="site-title mb-4">
                <h2 class="text-center">Glimpse of Happiness</h2>
            </div>
            {{-- <div class="shuffle_wrapper text-center pt-2 pb-4">
                <button class="default-btn" id='all'><span>All</span></button>
                @if (isset($filter_category)) --}}
                    {{-- @foreach ($filter_category as $item)
                    <button class="default-btn filter" data-filter_category="{{ $item->filter_category }}" ><span>{{ $item->filter_category }}</span></button>
                    @endforeach
                    @else
                    <button class="default-btn" id='btn-travel'><span>Event</span></button>
                    <button class="default-btn" id='btn-travel_one'><span>Event One</span></button>
                @endif
            </div> --}}
            <div class="row my-shuffle-container">
                {{-- @if (empty($galleryImages))
                @foreach ($galleryImages as $item)
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["{!!  $item->filter_category !!}"]'><img src="{{ $item->local_image?url($item->local_image):$item->image_link}}" class="img-fluid" width="" height="" alt="Destinations"></div>
                @endforeach --}}

            {{-- @else --}}
    @if($galleryImages->isNotEmpty())
    @foreach ($galleryImages as $GalleryImage)
    <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
        <a data-fancybox="gallery" href="<?=$GalleryImage['local_image'];?>" >
            <div style="width: auto;height: 350px;overflow: hidden;">
                <img src="<?=$GalleryImage['local_image'];?>" class="img-fluid" width="" height="" alt="<?=$GalleryImage['title']?>" style="width: 100%;height: 100%;object-fit: cover;">
             </div>
            <div class="gallery-caption">
                <h3><?php echo  $GalleryImage['title'] !== '' ? $GalleryImage['title'] : $GalleryImage['alternate_text']  ?></h3>
                <p><?=$GalleryImage['description']?></p>
            </div>
        </a>
    </div>
    @endforeach
    @else
<div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Community-Engagement.jpg" >
                        <img src="assets/img/Community-Engagement.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Community Engagement</h3>
                            <p>Fostering collaboration and understanding within the community.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Wheat.jpg" >
                        <img src="assets/img/Wheat.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Wheat</h3>
                            <p>Wheat, the golden grain that has sustained civilizations for millennia, holds a central place in our diets and cultures worldwide.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Vermicompost.jpg" >
                        <img src="assets/img/Vermicompost.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Vermicompost</h3>
                            <p>Vermicompost, also known as worm compost or worm castings, is a nutrient-rich organic fertilizer produced through the natural decomposition of organic matter by earthworms.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/entrepreneurship-development.jpg" >
                        <img src="assets/img/entrepreneurship-development.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Entrepreneurship Development</h3>
                            <p>Training and guidance to help farmers become successful entrepreneurs.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/main-peas.jpg" >
                        <img src="assets/img/main-peas.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Peas</h3>
                            <p>Peas, those delightful green orbs, are a beloved vegetable cherished for their sweet taste and versatility.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/Market-Access.jpg" >
                        <img src="assets/img/Market-Access.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Market Access</h3>
                            <p>Connecting farmers with buyers and ensuring fair prices.</p>
                        </div>
                    </a>
                </div>

                @endif

                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Community-Engagement.jpg" >
                        <img src="assets/img/Community-Engagement.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Community Engagement</h3>
                            <p>Fostering collaboration and understanding within the community.</p>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Wheat.jpg" >
                        <img src="assets/img/Wheat.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Wheat</h3>
                            <p>Wheat, the golden grain that has sustained civilizations for millennia, holds a central place in our diets and cultures worldwide.</p>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Vermicompost.jpg" >
                        <img src="assets/img/Vermicompost.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Vermicompost</h3>
                            <p>Vermicompost, also known as worm compost or worm castings, is a nutrient-rich organic fertilizer produced through the natural decomposition of organic matter by earthworms.</p>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/entrepreneurship-development.jpg" >
                        <img src="assets/img/entrepreneurship-development.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Entrepreneurship Development</h3>
                            <p>Training and guidance to help farmers become successful entrepreneurs.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/main-peas.jpg" >
                        <img src="assets/img/main-peas.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Peas</h3>
                            <p>Peas, those delightful green orbs, are a beloved vegetable cherished for their sweet taste and versatility.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/Market-Access.jpg" >
                        <img src="assets/img/Market-Access.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Market Access</h3>
                            <p>Connecting farmers with buyers and ensuring fair prices.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/Quality-Assurance.jpg" >
                        <img src="assets/img/Quality-Assurance.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Quality Assurance</h3>
                            <p>Maintaining high production standards for premium products.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/tomato.jpg" >
                        <img src="assets/img/tomato.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Tomato</h3>
                            <p>The tomato, often referred to as the "love apple," is a culinary gem cherished for its vibrant color, juicy texture, and versatile flavor.</p>
                        </div>
                    </a>
                </div> --}}

                <div class="col-1@sm my-sizer-element"></div>
            {{-- @endif --}}

            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/6.1.0/shuffle.min.js"></script>
<script>
var gallary_page = window.location.pathname;
var split_name = gallary_page.split("/").pop();
const getpage = () => {
    var Shuffle = window.Shuffle;
    var element = document.querySelector('.my-shuffle-container');
    var sizer = element.querySelector('.my-sizer-element');
    var shuffleInstance = new Shuffle(element, {
        itemSelector: '.picture-item'
    });
    // shuffleInstance.filter('animal');
    $("#all").on("click", function () {
        shuffleInstance.filter();
    });
    $("#btn-travel").on("click", function () {
        shuffleInstance.filter('travel');
    });
    $("#btn-travel_one").on("click", function () {
        shuffleInstance.filter('travel_one');
    });
    $(".filter").on("click", function () {
        let filterData = $(this).data("filter_category");
        shuffleInstance.filter(filterData);
    });
}
if(split_name == 'event'){
    getpage();
}
</script>
@endsection
