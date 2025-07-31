@extends('layouts.webSite')
@section('title', 'Blog')
@section('content')
    <div class="information-page-slider">
        <div class="information-content">
            <h1><a href="{{ url('/') }}">Home</a><span>Blog</span></h1>
        </div>
    </div>
    <div id="about">
        <div class="default-content blog-page pt-5 pb-3">
            <div class="custom-container">
                <div class="site-title pb-3">
                    <h2 class="text-center">Travel Job  Blog</h2>
                    {{-- <p class="text-center pb-3">From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels.</p> --}}
                </div>
                <div class="blog-container midd-content">
                    <div class="row">
                        @if ($getAllBlogs->isNotEmpty())
                            @foreach ($getAllBlogs as $BlogRow)
                                <div class="col-md-12 mb-4 offering s-container">
                                    <div class="offerings-block">
                                        <div class="offerings-content">
                                            <div class="offerings-content-inner">
                                                <h3>{{ $BlogRow['blog_title'] }}</h3>
                                                <p>{!! $BlogRow['blog_desc'] !!}</p>
                                            </div>
                                        </div>
                                        <div class="offerings-figure">
                                            <img src="{{ url($BlogRow['image']) }}" class="img-fluid rounded" width=""
                                                height="" alt="Bikaner" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 mb-4 offerings-container">
                                <div class="offerings-block">
                                    <div class="offerings-content">
                                        <div class="offerings-content-inner">
                                            <h3>Paddy</h3>
                                            <p>Paddy, the unhusked rice grain, is the cornerstone of global food security
                                                and cultural heritage. Growing in lush paddies across Asia and beyond, paddy
                                                fields sustain millions of livelihoods and feed billions of people
                                                worldwide. The transformation of paddy into rice involves a meticulous
                                                process, from planting and nurturing to harvesting and milling. This staple
                                                crop serves as the foundation of countless dishes, from steaming bowls of
                                                fragrant jasmine rice to crispy treats like rice crackers. Beyond its
                                                culinary significance, paddy cultivation is deeply ingrained in the cultural
                                                fabric of many societies, symbolizing traditions, rituals, and community
                                                bonds. As we savor the grains of rice on our plates, let us also honor the
                                                toil of farmers who cultivate paddy fields, ensuring a steady supply of this
                                                essential food source for generations to come.</p>
                                        </div>
                                    </div>
                                    <div class="offerings-figure">
                                        <img src="assets/img/Paddy.jpg" class="img-fluid rounded" width=""
                                            height="" alt="Bikaner" />
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div><br><br>
                    <h3>FAQs:</h3>
                    <div id="main-faqs" class="mt-2">
                        @if ($getAllFaq->isNotEmpty())
                            @foreach ($getAllFaq as $index => $FaqRow)
                                <div class="accordion-list">
                                    <button class="collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $index }}">
                                        Q: {!! $FaqRow['faq_question'] !!}
                                    </button>
                                    <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse">
                                        <div class="accordion-content">
                                            {!! $FaqRow['faq_answer'] !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="accordion-list">
                                <button class="collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Q: What does the name "Travel Job " mean?
                                </button>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-content">
                                        <ul>
                                            <li>A: Travel Job  is derived from the Vedic saying "Krishi hi Dhan h," which
                                                translates to "Agriculture is wealth."</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="accordion-list">
                                <button class="collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    Q: What services does Travel Job  FPO offer to farmers?
                                </button>
                                <div id="flush-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-content">
                                        <ul>
                                            <li>A: Travel Job  FPO provides a combination of services to support farmers,
                                                including:</li>
                                            <li>Supplying world-class agricultural inputs (seeds, fertilizers, crop
                                                protection products).</li>
                                            <li>Conducting capacity building programs on sustainable farming practices,
                                                improved agricultural techniques, and financial literacy.</li>
                                            <li>Facilitating market access by connecting farmers with reliable buyers and
                                                negotiating fair prices for their produce.</li>
                                            <li>Offering specific support programs to empower women farmers.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="accordion-list">
                                <button class="collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour" aria-expanded="false"
                                    aria-controls="flush-collapseFour">
                                    Q: How does Travel Job  FPO help farmers increase their income?
                                </button>
                                <div id="flush-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-content">
                                        <ul>
                                            <li>A: By providing access to high-quality inputs, training on improved
                                                practices, and fair market access, Travel Job  FPO equips farmers to:</li>
                                            <li>Increase their crop yields.</li>
                                            <li>Reduce production costs through sustainable practices.</li>
                                            <li>Secure better prices for their produce.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Continue with the rest of the FAQ items with unique IDs for each one -->
                        @endif
                    </div>
                    
                    <p><b>Case studies:</b> Showcase the positive impact Travel Job  FPO has had on specific communities or
                        farmers.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
