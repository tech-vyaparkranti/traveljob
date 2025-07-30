@extends('layouts.webSite')
@section('title', 'About Us')
@section('content')
    <div class="information-page-slider">
        <div class="information-content">
            <h1><a href="{{ url('/') }}">Home</a><span>About Us</span></h1>
        </div>
    </div>
    <div id="about">
        <div class="default-content pt-5 pb-3">
            <div class="custom-container">
                <div class="site-title pb-3">
                    <h2 class="text-center">About Us</h2>
                </div>
                <div class="midd-content">
                    {!! isset($aboutText['0']->about_desc) ? $aboutText['0']->about_desc : '' !!}</p>
                    
                </div>
                <div class="site-title pt-2" id="teams-sec">
                    <h2 class="text-left">Our Team</h2>
                </div>
                <div class="our-teams">
                    <div class="about-our-team">
                        @foreach ($getChairManData as $RowData)
                            <div class="about-our-item about-our-item-left">
                                <img src="<?php echo url($RowData->image); ?>" alt="team-01" height="200" width="200">
                            </div>
                            <div class="about-our-item about-our-item-right">
                                <h5><?php echo $RowData->post; ?></h5>
                                <h6><?php echo $RowData->name; ?></h6>
                                <?php if(!empty($RowData->education)) { ?>
                                <i><b>Education:</b> <?php echo $RowData->education; ?> </i>
                                <?php } ;?>
                                <?php if(!empty($RowData->occupation)) { ?>
                                <i><b>Occupation:</b> <?php echo $RowData->occupation; ?> </i>
                                <?php } ;?>
                                <?php if(!empty($RowData->expertise)) { ?>
                                <p class="text-justify"><b>Area of Expertise:</b> <?php echo $RowData->expertise; ?> </p>
                                <?php } ;?>
                                <?php if(!empty($RowData->focus)) { ?>
                                <p class="text-justify"><b>Focus:</b> <?php echo $RowData->focus; ?> </p>
                                <?php } ;?>
                            </div>
                        @endforeach
                    </div>
                    <?php if(!empty($getCEOData)) { ?>
                    <div class="about-our-team">
                        @foreach ($getCEOData as $CeoRow)
                            <div class="about-our-item about-our-item-left">
                                <img src="<?php echo url($CeoRow->image); ?>" alt="team-02" height="200" width="200">
                            </div>
                            <div class="about-our-item about-our-item-right">
                                <h5><?php echo $CeoRow->post; ?></h5>
                                <h6><?php echo $CeoRow->name; ?></h6>
                                <i><?php echo $CeoRow->address; ?></i>
                                <?php if(!empty($CeoRow->education)) { ?>
                                <i><b>Education:</b> <?php echo $CeoRow->education; ?> </i>
                                <?php } ;?>

                                <?php if(!empty($CeoRow->occupation)) { ?>
                                <i><b>Occupation:</b> <?php echo $CeoRow->occupation; ?> </i>
                                <?php } ;?>
                                <?php if(!empty($CeoRow->expertise)) { ?>
                                <p class="text-justify"><b>Area of Expertise:</b> <?php echo $CeoRow->expertise; ?> </p>
                                <?php } ;?>
                                <?php if(!empty($CeoRow->focus)) { ?>
                                <p class="text-justify"><b>Focus:</b> <?php echo $CeoRow->focus; ?> </p>
                                <?php } ;?>
                            </div>
                        @endforeach
                    </div>
                    <?php  } ;?>
                </div>
                <?php if(!empty($getDirectoreData)) { ?>
                <div class="site-title pt-2 pb-4">
                    <h2 class="text-center">Directors</h2>
                </div>
                <?php } ;?>
                <div class="row director-container">
                    @foreach ($getDirectoreData as $directorRow)
                        <div class="col-md-4">
                            <div class="director-item">
                                <div class="director-figure">
                                    <img src="<?php echo url($directorRow->image); ?>" alt="" class="img-fluid">
                                </div>
                                <div class="director-content">
                                    <h3><?php echo $directorRow->name; ?></h3>
                                    <i><?php echo $directorRow->address; ?></i>
                                    <?php if(!empty($directorRow->education)) { ?>
                                    <i><b>Education:</b> <?php echo $directorRow->education; ?> </i>
                                    <?php } ;?>

                                    <?php if(!empty($directorRow->occupation)) { ?>
                                    <i><b>Occupation:</b> <?php echo $directorRow->occupation; ?> </i>
                                    <?php } ;?>
                                    <?php if(!empty($directorRow->expertise)) { ?>
                                    <p class="text-justify"><b>Area of Expertise:</b> <?php echo $directorRow->expertise; ?> </p>
                                    <?php } ;?>
                                    <?php if(!empty($directorRow->focus)) { ?>
                                    <p class="text-justify"><b>Focus:</b> <?php echo $directorRow->focus; ?> </p>
                                    <?php } ;?>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <hr>
                <p class="text-justify"><b>At TravelJob  Farmer Producer Company Limited , we invite you to embark on a journey of discovery, where every experience is crafted with care and passion. Let us be your guide to the wonders of India.</b></p>

                <img src="assets/img/logo4.png" width="100" height="" class="img-fluid mb-2" style="width: 100px;" />
                <span> - Symbolize our spirit to <i>Either Find Ways Or Make One.</i></span><br><br>
            </div>
        </div>
    </div>
    </div>
@endsection
