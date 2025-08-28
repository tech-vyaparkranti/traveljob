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

            <div class="site-title pb-3" style="padding-top:30px">
                <h2 class="text-center" stylr="margin-bottom:0px">Objectives</h2>
            </div>
            <div class="midd-content text-justify" style="" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
           <b> At TravelJobs, we’re committed to transforming how hiring happens in the travel industry. Our key objectives include: </b>
            <ul style="margin-top:5px;">
  <li>Delivering a seamless and efficient job search experience for individuals pursuing a career in the travel and tourism industry.</li>
  <li>Becoming a trusted hiring partner for travel agencies, tour operators, hospitality companies, airlines, cruise lines, and corporate travel departments.</li>
  <li>Creating more meaningful matches between employers and job seekers by focusing on skills, cultural fit, career goals, and long-term aspirations.</li>
  <li> Raising the standard of professionalism within the industry by promoting ethical hiring practices and supporting career development at every stage.</li>
  <li> Helping fresh graduates and career switchers find their path in the travel industry with mentorship, resources, and entry-level opportunities.</li>
</ul>
  </div>

            @if(!empty($getDirectoreData))
            <div class="site-title pt-2 pb-2" style="margin-top:30px">
                <h2 class="text-center">Founder Message</h2>
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
{{-- Team Messages Section --}}

    <div class="site-title pt-2 pb-2" style="margin-top:30px">
        <h2 class="text-center">Founder Message</h2>
    </div>
@foreach($teamData as $key => $team)
    <div class="about-our-team row align-items-center my-4" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
        {{-- Alternate image placement left/right --}}
        @if($key % 2 == 0)
            {{-- Image Left --}}
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <img src="{{ asset($team->image) }}" 
                     style="height:300px;width:300px" 
                     alt="{{ $team->name }}" 
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-md-8">
                <p class="text-justify">{!! $team->message !!}</p>
                <p class="text-end"><i><b>{{ $team->name }}</b></i></p>
                <p class="text-end"><i><b>{{ $team->post }}, TravelJobs.info</b></i></p>
            </div>
        @else
            {{-- Image Right --}}
            <div class="col-md-8">
                <p class="text-justify">{!! $team->message !!}</p>
                <p class="text-end"><i><b>{{ $team->name }}</b></i></p>
                <p class="text-end"><i><b>{{ $team->post }}, TravelJobs.info</b></i></p>
            </div>
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <img src="{{ asset($team->image) }}" 
                     style="height:300px;width:300px" 
                     alt="{{ $team->name }}" 
                     class="img-fluid rounded shadow">
            </div>
        @endif
    </div>
@endforeach

            <!-- <div class="site-title pt-4" id="teams-sec">
                <h2 class="text-left" style="margin-bottom:60px;text-align:center;">Our Team</h2>
            </div>
            <div class="row g-4" data-aos="fade-up" data-aos-duration="1500" data-aos-easing="ease-in-out-sine">
                {{-- Dynamic Team Data --}}
                @forelse ($teamData as $member)
                <div class="col-md-4 col-sm-6">
                    <div class="team-card h-100 shadow-sm p-3 rounded text-center">
                        <img src="{{ url($member->image) }}" alt="{{ $member->name }}" class="img-fluid rounded-circle mb-3" style="width: 180px; height: 180px; object-fit: cover;">
                        <h5>{{ $member->post }}</h5>
                        <h6>{{ $member->name }}</h6>
                    </div>
                </div>
                @empty
                {{-- Static Fallback Data if $teamData is empty --}}
                <div class="col-md-4 col-sm-6 ">
                    <div class="team-card h-100 shadow-sm p-3 rounded text-center">
                        <img src="{{ asset('assets/img/team1.jpeg') }}" alt="Team Member" class="img-fluid rounded-circle mb-3" style="width: 180px; height: 180px; object-fit: cover;">
                        <h6>Vani Harkara</h6>
                        <p><b>Co - Founder</b></p>
                    </div>
                </div>
                @endforelse
            </div> -->
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
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
  AOS.init();
</script>
@endsection