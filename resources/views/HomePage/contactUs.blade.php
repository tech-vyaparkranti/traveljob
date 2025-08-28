@extends('layouts.webSite')
@section('title', 'Contact Us')
@section('content')
    <div class="information-page-slider">
        <div class="information-content">
            <h1><a href="{{ url('/') }}">Home</a><span>Contact Us</span></h1>
        </div>
    </div>
    <div id="about">
        <div class="default-content pt-4 pb-5">
            <div class="custom-container">
                <div class="site-title pb-4">
                    <h2 class="text-center">Contact Us</h2>
                </div>
                <!-- Contact Area Strat -->
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="contact-form-area mb-2">
                            <div class="midd-content section-title mb-3">
                                <h3>Get in touch</h3>
                            </div>
                            <form enctype="multipart/form-data" method="POST" id="contactUsForm" action="javascript:">
                                @csrf
                                <input type="hidden" name="country_code" value="" id="country_code_id">
                                <!-- Ensure Bootstrap 5 and Font Awesome are loaded -->

<div class="row">

  <!-- First Name -->
  <div class="col-md-6 mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-user logo"></i></span>
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
    </div>
    <div class="valid-feedback">Looks good!</div>
  </div>

  <!-- Last Name -->
  <div class="col-md-6 mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-user logo"></i></span>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
    </div>
    <div class="valid-feedback">Looks good!</div>
  </div>

  <!-- Email -->
  <div class="col-md-6 mb-3">
    <label for="email" class="form-label">Email</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-envelope logo"></i></span>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email ID" required>
    </div>
    <div class="invalid-feedback">Please provide a valid email.</div>
  </div>

  <!-- Phone -->
  <div class="col-md-6 mb-3">
    <label for="phone_number" class="form-label">Phone</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-phone logo"></i></span>
      <input type="tel" pattern="^[1-9][0-9]*$" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
    </div>
    <div class="invalid-feedback">Please provide a valid phone number.</div>
  </div>

  <!-- Message -->
  <div class="col-md-12 mb-3">
    <label for="message" class="form-label">Message</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-comment-dots logo"></i></span>
      <textarea class="form-control" id="message" name="message" maxlength="1000" minlength="30" rows="3" required></textarea>
    </div>
    <div class="invalid-feedback">Please provide a message.</div>
  </div>

  <!-- Captcha Input -->
  <div class="col-md-12 mb-3">
    <label for="captcha" class="form-label">Captcha</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-shield-alt logo"></i></span>
      <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha" required>
    </div>
  </div>

  <!-- Captcha Image + Refresh -->
  <div class="col-md-8 col-sm-12 mb-3">
    <div class="row">
      <div class="col-md-6 pt-4">
        <img src="{{ captcha_src() }}" class="img-thumbnail h-100" id="captcha_img_id" alt="Captcha Image">
      </div>
      <div class="col-md-6 pt-4">
        <button type="button" class="btn default-btn btn-block fw-bold"
          onclick="refreshCapthca('captcha_img_id','captcha')">
          <i class="fa fa-sync-alt me-2 logo"></i> Refresh
        </button>
      </div>
    </div>
  </div>

  <!-- Terms and Conditions -->
  <div class="col-md-12 mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="tnc" required>
      <label class="form-check-label" for="tnc">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">You must agree before submitting.</div>
    </div>
  </div>

</div>

                                <div class="view-button">
                                    <button class="default-btn" id="submitButton" type="submit">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="map-area">
        <div class="google-map-area mb-20">
            <div class="responsive-map">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.977637466187!2d78.45519097526402!3d17.412860802070668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb974676d0dae7%3A0x62f09ceccf9310b6!2sManoj%20Apartments!5e0!3m2!1sen!2sin!4v1755773403037!5m2!1sen!2sin" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
</div>
                <!-- Contact Area End -->
            </div>
        </div>
    </div>
    <style>
      .responsive-map {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 ratio, adjust if needed */
    height: 450px;
}

.responsive-map iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

    </style>
@endsection
@section('script')
    <script>
        $("#contactUsForm").on("submit", function() {
            var form = new FormData(this);

            $("#submitButton").attr("disable", true);
            $.ajax({
                type: 'post',
                url: '{{ route('saveContactUsDetails') }}',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        successMessage(response.message, true);
                    } else {
                        errorMessage(response.message ?? "Something went wrong.");
                        $("#submitButton").attr("disable", false);
                        refreshCapthca('captcha_img_id', 'captcha');
                    }
                },
                failure: function(response) {
                    errorMessage(response.message ?? "Something went wrong.");
                    $("#submitButton").attr("disable", false);
                    refreshCapthca('captcha_img_id', 'captcha');
                },
                error: function(response) {
                    errorMessage(response.message ?? "Something went wrong.");
                    $("#submitButton").attr("disable", false);
                    refreshCapthca('captcha_img_id', 'captcha');
                }
            });
        });
        // var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
        //     separateDialCode: true,
        //     preferredCountries: ["in"],
        //     hiddenInput: "full",
        //     utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        // });
    </script>
    <style>
       .logo{
        color:#030358;
    }
</style> 
@endsection

