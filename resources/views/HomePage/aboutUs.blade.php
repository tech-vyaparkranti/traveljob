@extends('layouts.webSite')
@section('title', 'About Us')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>About Us</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-3" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">About Us</h2>
            </div>
            <div class="midd-content text-justify">
                {!! isset($aboutText['0']->about_desc) ? $aboutText['0']->about_desc : '' !!}
            </div>


       <div class="site-title pb-3 " style="padding-top:30px">
                <h2 class="text-center">Objectives</h2>
            </div>
            <div class="midd-content text-justify" style="" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
                <ul >
        	<li>To provide a seamless job search experience for travel industry professionals.</li>
<li>To serve as a trusted hiring partner for travel agencies and corporate employers.</li>
<li>To elevate the overall quality of employment within the travel sector by facilitating better matches based on skills, expertise, and aspirations.</li>
</div>
         

            @if(!empty($getDirectoreData))
            
            <div  class="site-title pt-2 pb-2" style="margin-top:20px">
                <h2 class="text-center">Directors</h2>
            </div>
            <div class="row director-container" style="background:#f9f9f9" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
                @foreach ($getDirectoreData as $directorRow)
                <div class="col-md-4">
                    <div class="director-item">
                        <div class="director-figure">
                            <img src="{{ url($directorRow->image) }}" alt="" class="img-fluid">
                        </div>
                        <div class="director-content">
                            <h3>{{ $directorRow->name }}</h3>
                            <i>{{ $directorRow->address }}</i>
                            @if(!empty($directorRow->education))
                            <i><b>Education:</b> {{ $directorRow->education }} </i>
                            @endif
                            @if(!empty($directorRow->occupation))
                            <i><b>Occupation:</b> {{ $directorRow->occupation }} </i>
                            @endif
                            @if(!empty($directorRow->expertise))
                            <p class="text-justify"><b>Area of Expertise:</b> {{ $directorRow->expertise }} </p>
                            @endif
                            @if(!empty($directorRow->focus))
                            <p class="text-justify"><b>Focus:</b> {{ $directorRow->focus }} </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Static Founder -->
            <div class="about-our-team row align-items-center my-4" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
                <div class="col-md-5 text-center mb-3 mb-md-0">
                    <img src="{{ asset('assets/img/founder.jpeg') }}" alt="Dr. Anita Sharma" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-7">
                    <p class="text-justify">
                        With over 50 years in the global travel industry, I’ve worn many hats—having joined as an Agency Executive in January 1972 in Hyderabad, India, and has since taken me to Mumbai, Saudi Arabia, East Africa, and the United States, working across every significant segment of travel services.
                        Along the way, I’ve had the privilege of visiting more than 48 countries, forging connections and gaining a ground-level view of how travel works—and how it should work. I served as the President of Skal International Hyderabad (606) and as a member of the Skal India National Committee, always believing in the value of ethical business, trusted partnerships, and professional camaraderie.
                        Now, though retired from full-time roles, I’m not done contributing. With TravelJobs.com, I aim to bridge industry talent with opportunity. It’s more than a job board—it’s a platform for mentorship, mobility, and meaningful careers in travel.
                    </p>
                      <p class="text-end"> <i><b>Ashok Harkara</b></i><br>
                   </p>
                  
                    <p class="text-end"> <i><b>Founder, TravelJobs.info</b></i><br>
                   </p>
                    

                </div>
            
           
            </div>
          <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<!-- Before </body> -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<!--objectives !-->
            <!-- Our Team Section -->
            <!-- Our Team Section -->
<div class="site-title pt-4" id="teams-sec">
    <h2 class="text-left" style="margin-bottom:60px;text-align:center;">Our Team</h2>
</div>
<div class="row g-4" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
    {{-- Dynamic Chairman Data --}}
    @foreach ($getChairManData as $RowData)
    <div class="col-md-4 col-sm-6">
        <div class="team-card h-100 shadow-sm p-3 rounded text-center">
            <img src="{{ url($RowData->image) }}" alt="Chairman" class="img-fluid rounded-circle mb-3" style="width: 180px; height: 180px; object-fit: cover;">
            <h5>{{ $RowData->post }}</h5>
            <h6>{{ $RowData->name }}</h6>
            @if(!empty($RowData->education))
            <p><b>Education:</b> {{ $RowData->education }}</p>
            @endif
            @if(!empty($RowData->occupation))
            <p><b>Occupation:</b> {{ $RowData->occupation }}</p>
            @endif
            @if(!empty($RowData->expertise))
            <p><b>Area of Expertise:</b> {{ $RowData->expertise }}</p>
            @endif
            @if(!empty($RowData->focus))
            <p><b>Focus:</b> {{ $RowData->focus }}</p>
            @endif
        </div>
    </div>
    @endforeach

    {{-- Dynamic CEO Data --}}
    @foreach ($getCEOData as $CeoRow)
    <div class="col-md-4 col-sm-6">
        <div class="team-card h-100 shadow-sm p-3 rounded text-center">
            <img src="{{ url($CeoRow->image) }}" alt="CEO" class="img-fluid rounded-circle mb-3" style="width: 180px; height: 180px; object-fit: cover;">
            <h5>{{ $CeoRow->post }}</h5>
            <h6>{{ $CeoRow->name }}</h6>
            <p><b>Address:</b> {{ $CeoRow->address }}</p>
            @if(!empty($CeoRow->education))
            <p><b>Education:</b> {{ $CeoRow->education }}</p>
            @endif
            @if(!empty($CeoRow->occupation))
            <p><b>Occupation:</b> {{ $CeoRow->occupation }}</p>
            @endif
            @if(!empty($CeoRow->expertise))
            <p><b>Area of Expertise:</b> {{ $CeoRow->expertise }}</p>
            @endif
            @if(!empty($CeoRow->focus))
            <p><b>Focus:</b> {{ $CeoRow->focus }}</p>
            @endif
        </div>
    </div>
    @endforeach

    {{-- Fallback: If both are empty --}}
    @if($getChairManData->isEmpty() && $getCEOData->isEmpty())
    <div class="col-md-4 col-sm-6 ">
        <div class="team-card h-100 shadow-sm p-3 rounded text-center">
            <img src="{{ asset('assets/img/team1.jpeg') }}" alt="Team Member" class="img-fluid rounded-circle mb-3" style="width: 180px; height: 180px; object-fit: cover;">
            <h6>Vani Harkara</h6>
            <p><b>Co - Founder</b></p>
            

        </div>
    </div>
    @endif
</div>



          </div>
    </div>
</div>
<style>
    .team-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
     box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25) !important;
}

.team-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

</style>
@endsection
