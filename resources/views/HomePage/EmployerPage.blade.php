
@extends('layouts.webSite')
@section('title', 'Job Seeker Form')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Employer Form</span></h1>
    </div>
</div>
<div id="about" style="overflow-x:hidden">
    <div class="default-content products-page pt-5 ">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">EMPLOYER'S NEEDS OF QUALIFICATIONS</h2>
            </div>
            <div class="midd-content">
                <div class="container modern-form-container">
                    <form action="{{ route('employer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
                     <h3 class="form-section-title mb-3 fw-bold" style="color: #030358;">
  <i class="fa fa-user-circle me-2 logo"></i> Employer INFORMATION
</h3>
   <div class="row mb-3">
  <div class="col-md-6">
    <label for="given_name" class="form-label">Agency/Company Name:</label>
    <div class="input-group">
      <span class="input-group-text "><i class="fa fa-user logo"></i></span>
      <input type="text" class="form-control" id="given_name" name="given_name" placeholder="Enter given name" required>
    </div>
  </div>

  <div class="col-md-6">
    <label for="family_name" class="form-label">Contact Person Name:</label>
    <div class="input-group">
      <span class="input-group-text "><i class="fa fa-users logo"></i></span>
      <input type="text" class="form-control" id="family_name" name="family_name" placeholder="Enter family name" required>
    </div>
  </div>
</div>

<div class="mb-3">
  <label for="address" class="form-label">Address:</label>
  <div class="input-group">
    <span class="input-group-text"><i class="fa fa-map-marker-alt logo"></i></span>
    <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="mobile_no" class="form-label">Mobile No:</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-phone logo"></i></span>
      <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter mobile number" required>
    </div>
  </div>

  <div class="col-md-6">
    <label for="personal_email" class="form-label">Email Id:</label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-envelope logo"></i></span>
      <input type="email" class="form-control" id="personal_email" name="personal_email" placeholder="Enter email address" required>
    </div>
  </div>
</div>
<div class="row mb-3 "  >
  <div class="col-md-6">
    <label for="total_experience" class="form-label">
      Minimum DESIRED Travel Trade Experience (Years):
    </label>
    <div class="input-group">
      <span class="input-group-text"><i class="fa fa-briefcase logo"></i></span>
      <input type="number" class="form-control" id="total_experience" name="total_experience" min="0" placeholder="e.g., 5" required>
    </div>
  </div>

 <div class="row mb-3" style="margin-top: 20px">
  <div class="col-12">
    <label class="form-label">
      Specific Areas of Expertise in Travel Agency Operations:
      <small class="text-muted d-block">
        (Select below. In case of Managers, select all areas of work and select desired skills)
      </small>
    </label>
    <div class="row row-cols-1 row-cols-md-2 g-2">
      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="areas_of_expertise[]" value="Domestic Travel" id="domestic_travel">
          <label class="form-check-label" for="domestic_travel">
            <i class="fa fa-plane-departure me-1 logo"></i> Domestic Travel
          </label>
        </div>
      </div>

      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="areas_of_expertise[]" value="Hotel Bookings & Car Hire" id="hotel_car">
          <label class="form-check-label" for="hotel_car">
            <i class="fa fa-hotel me-1 logo"></i> Hotel Bookings & Car Hire
          </label>
        </div>
      </div>

      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="areas_of_expertise[]" value="International Travel" id="intl_travel">
          <label class="form-check-label" for="intl_travel">
            <i class="fa fa-globe me-1 logo"></i> International Travel
          </label>
        </div>
      </div>

      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="areas_of_expertise[]" value="VISA Handling" id="visa_handling">
          <label class="form-check-label" for="visa_handling">
            <i class="fa fa-passport me-1 logo"></i> VISA Handling
          </label>
        </div>
      </div>

      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="areas_of_expertise[]" value="Tours and Holiday Packages" id="tours">
          <label class="form-check-label" for="tours">
            <i class="fa fa-suitcase-rolling me-1 logo"></i> Tours and Holiday Packages
          </label>
        </div>
      </div>

      <div class="col">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="areas_of_expertise[]" value="Accounting" id="accounting">
          <label class="form-check-label" for="accounting">
            <i class="fa fa-calculator me-1 logo"></i> Accounting
          </label>
        </div>
      </div>
    </div>
  </div>
</div>

                  
                       <h3 class="form-section-title mb-3 fw-bold" style="color: #030358;">
  <i class="fa fa-tools me-2 logo"></i> Required SKILL SET
</h3>

                        <h4>Domestic Travel</h4>
      <div class="container mt-4">
  
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Plan/Build an Itinerary on GDS?</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_gds_itinerary" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_gds_itinerary" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">PNR Creation for Adult Pax:</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_pnr_adult" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_pnr_adult" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">PNR Creation for Children and Infants?</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_pnr_child_infant" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_pnr_child_infant" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Senior Citizen?</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_senior_citizen_fares" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_senior_citizen_fares" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Students?</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_student_fares" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_student_fares" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Youth & Other Special Fares?</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_youth_special_fares" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_youth_special_fares" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Creation of fare Mask for Ticketing:</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_fare_mask" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_fare_mask" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Ticketing on GDS:</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_ticketing_gds" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_ticketing_gds" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <label class="form-label">GDS:</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_gds_type" value="Amadeus" onclick="toggleDomesticGdsOther(false)">
            <label class="form-check-label">Amadeus</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_gds_type" value="Galileo" onclick="toggleDomesticGdsOther(false)">
            <label class="form-check-label">Galileo</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_gds_type" value="Sabre" onclick="toggleDomesticGdsOther(false)">
            <label class="form-check-label">Sabre</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_gds_type" value="Other" onclick="toggleDomesticGdsOther(true)">
            <label class="form-check-label">Other</label>
          </div>
        </div>

        <div class="mt-2" id="domestic_gds_other_name_group" style="display: none;">
          <label class="form-label" for="domestic_gds_other_name">Specify Other GDS:</label>
          <input type="text" class="form-control" id="domestic_gds_other_name" name="domestic_gds_other_name">
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Ticketing experience through direct log-in to LCC Websites:</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_lcc_websites" value="Yes">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_lcc_websites" value="No">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Through Suppliers Portal (Make My Trip, TBO, Akbar, Ria, etc.):</label>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_supplier_portal" value="Yes" onclick="toggleDomesticSupplierPortalName(true)">
            <label class="form-check-label">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="domestic_supplier_portal" value="No" onclick="toggleDomesticSupplierPortalName(false)">
            <label class="form-check-label">No</label>
          </div>
        </div>
      </div>

      <div class="col-md-12" id="domestic_supplier_portal_name_group" style="display: none;">
        <label class="form-label" for="domestic_supplier_portal_name">Name the portal:</label>
        <input type="text" class="form-control" id="domestic_supplier_portal_name" name="domestic_supplier_portal_name">
      </div>

      </div>
</div>


                        <h4>Hotel Bookings & Car Hire</h4>
                        <!-- Add Bootstrap CSS -->

<div class="container">
    <div class="row">
        <div class="col-md-6 mb-3 form-group radio-group-wrapper">
            <label class="form-label">Handle Hotel Bookings within India?</label>
            <div class="d-flex gap-3 flex-wrap">
                <label><input type="radio" name="hotel_bookings_india" value="Yes"> Yes</label>
                <label><input type="radio" name="hotel_bookings_india" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group radio-group-wrapper">
            <label class="form-label">Contact the Hotel directly?</label>
            <div class="d-flex gap-3 flex-wrap">
                <label><input type="radio" name="hotel_contact_direct" value="Yes"> Yes</label>
                <label><input type="radio" name="hotel_contact_direct" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group radio-group-wrapper">
            <label class="form-label">Book through Hotel Consolidator Websites like Hotels.com, Etc.:</label>
            <div class="d-flex gap-3 flex-wrap">
                <label><input type="radio" name="hotel_consolidator_websites" value="Yes"> Yes</label>
                <label><input type="radio" name="hotel_consolidator_websites" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group radio-group-wrapper">
            <label class="form-label">or through the Local DMC?</label>
            <div class="d-flex gap-3 flex-wrap">
                <label><input type="radio" name="hotel_local_dmc" value="Yes"> Yes</label>
                <label><input type="radio" name="hotel_local_dmc" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group radio-group-wrapper">
            <label class="form-label">Handle Car Hire within your city?</label>
            <div class="d-flex gap-3 flex-wrap">
                <label><input type="radio" name="car_hire_city" value="Yes"> Yes</label>
                <label><input type="radio" name="car_hire_city" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group radio-group-wrapper">
            <label class="form-label">Handle Car Hire in other Indian Cities?</label>
            <div class="d-flex gap-3 flex-wrap">
                <label><input type="radio" name="car_hire_other_cities" value="Yes"> Yes</label>
                <label><input type="radio" name="car_hire_other_cities" value="No"> No</label>
            </div>
        </div>
    </div>
</div>


                        <h4>International Travel</h4>
                        <div class="container">
    <div class="row g-3">
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Plan/build an Itinerary on GDS for Intl Travel?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_gds_itinerary" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_gds_itinerary" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Inputs for PNR Creation for Children and Infants?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_pnr_child_infant" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_pnr_child_infant" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Senior Citizen?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_senior_citizen_fares" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_senior_citizen_fares" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Students?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_student_fares" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_student_fares" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Youth & Other Special Fares?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_youth_special_fares" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_youth_special_fares" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Create a Fare Mask for Ticketing?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_fare_mask" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_fare_mask" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-12 form-group">
            <label class="form-label">Have you worked on GDS?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_gds_type" value="Amadeus" onclick="toggleIntlGdsOther(false)"> Amadeus</label>
                <label><input type="radio" name="intl_gds_type" value="Galileo" onclick="toggleIntlGdsOther(false)"> Galileo</label>
                <label><input type="radio" name="intl_gds_type" value="Sabre" onclick="toggleIntlGdsOther(false)"> Sabre</label>
                <label><input type="radio" name="intl_gds_type" value="Other" onclick="toggleIntlGdsOther(true)"> Other</label>
            </div>
            <div class="mt-2" id="intl_gds_other_name_group" style="display: none;">
                <label for="intl_gds_other_name">Specify Other GDS:</label>
                <input type="text" class="form-control" id="intl_gds_other_name" name="intl_gds_other_name">
            </div>
        </div>

        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Queue PNRs to Consolidators?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_queue_pnrs" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_queue_pnrs" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">The formats and procedures for First reissuing a ticket?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_first_reissue" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_first_reissue" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">The formats and procedures for reissuing a ticket after the First Reissue?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_subsequent_reissue" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_subsequent_reissue" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">The formats and Procedures for Refunds of a ticket?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_ticket_refunds" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_ticket_refunds" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Can you use the HOTAC option to book Rooms?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_hotac_rooms" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_hotac_rooms" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Create a PNR for Group Booking?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_group_pnr" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_group_pnr" value="No"> No</label>
            </div>
        </div>

        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">How to issue EMD?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_issue_emd" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_issue_emd" value="No"> No</label>
            </div>
        </div>
        <div class="col-md-6 form-group radio-group-wrapper">
            <label class="form-label">Do you know Stand Alone EMD?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_standalone_emd" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_standalone_emd" value="No"> No</label>
            </div>
        </div>

        <div class="col-12 form-group radio-group-wrapper">
            <label class="form-label">Know the Associated EMD Issuance for EB, Seat, & Seat election?</label>
            <div class="d-flex flex-wrap gap-3">
                <label><input type="radio" name="intl_associated_emd" value="Yes"> Yes</label>
                <label><input type="radio" name="intl_associated_emd" value="No"> No</label>
            </div>
        </div>
    </div>
</div>


                        <h4>VISA Handling:</h4>
                        <div class="form-group radio-group-wrapper">
                            <label>Are you aware of Visa Handling Procedures?:</label>
                            <div class="radio-group">
                                <label><input type="radio" name="visa_aware_procedures" value="Yes" onclick="toggleVisaQuestions(true)"> Yes</label>
                                <label><input type="radio" name="visa_aware_procedures" value="No" onclick="toggleVisaQuestions(false)"> No</label>
                            </div>
                        </div>
                        <div id="visa_handling_questions" style="overflow-y: auto;" class="conditional-field">
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Did you personally handle Visas for your Pax?:</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="visa_handled_personally" value="Yes"> Yes</label>
                                        <label><input type="radio" name="visa_handled_personally" value="No"> No</label>
                                    </div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Are you working in your Agency's Visa Handling Department/Activity?:</label>
                                    <div class="radio-group">
                                        <label><input type="radio" name="visa_in_department" value="Yes"> Yes</label>
                                        <label><input type="radio" name="visa_in_department" value="No"> No</label>
                                    </div>
                                </div>
                            </div>
                            <h5>Did you previously handle Visa Applications for:</h5>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>USA:</label> <div class="radio-group"><label><input type="radio" name="visa_usa" value="Yes"> Yes</label> <label><input type="radio" name="visa_usa" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Canada:</label> <div class="radio-group"><label><input type="radio" name="visa_canada" value="Yes"> Yes</label> <label><input type="radio" name="visa_canada" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Mexico:</label> <div class="radio-group"><label><input type="radio" name="visa_mexico" value="Yes"> Yes</label> <label><input type="radio" name="visa_mexico" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Brazil:</label> <div class="radio-group"><label><input type="radio" name="visa_brazil" value="Yes"> Yes</label> <label><input type="radio" name="visa_brazil" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-group radio-group-wrapper">
                                <label>Any other South American Countries:</label> <div class="radio-group"><label><input type="radio" name="visa_other_south_america" value="Yes"> Yes</label> <label><input type="radio" name="visa_other_south_america" value="No"> No</label></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>UK:</label> <div class="radio-group"><label><input type="radio" name="visa_uk" value="Yes"> Yes</label> <label><input type="radio" name="visa_uk" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Ireland:</label> <div class="radio-group"><label><input type="radio" name="visa_ireland" value="Yes"> Yes</label> <label><input type="radio" name="visa_ireland" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>HAJ/Umrah:</label> <div class="radio-group"><label><input type="radio" name="visa_haj_umrah" value="Yes"> Yes</label> <label><input type="radio" name="visa_haj_umrah" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>UAE:</label> <div class="radio-group"><label><input type="radio" name="visa_uae" value="Yes"> Yes</label> <label><input type="radio" name="visa_uae" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="visa_schengen_countries">(If Yes, Which Schengen Country or Countries in Schengen………..?):</label>
                                <input type="text" id="visa_schengen_countries" name="visa_schengen_countries">
                            </div>
                            <h5>Have you handled visas for:</h5>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Russia:</label> <div class="radio-group"><label><input type="radio" name="visa_russia" value="Yes"> Yes</label> <label><input type="radio" name="visa_russia" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>China:</label> <div class="radio-group"><label><input type="radio" name="visa_china" value="Yes"> Yes</label> <label><input type="radio" name="visa_china" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Vietnam:</label> <div class="radio-group"><label><input type="radio" name="visa_vietnam" value="Yes"> Yes</label> <label><input type="radio" name="visa_vietnam" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Cambodia:</label> <div class="radio-group"><label><input type="radio" name="visa_cambodia" value="Yes"> Yes</label> <label><input type="radio" name="visa_cambodia" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Hong Kong:</label> <div class="radio-group"><label><input type="radio" name="visa_hongkong" value="Yes"> Yes</label> <label><input type="radio" name="visa_hongkong" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Philippines:</label> <div class="radio-group"><label><input type="radio" name="visa_philippines" value="Yes"> Yes</label> <label><input type="radio" name="visa_philippines" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Singapore:</label> <div class="radio-group"><label><input type="radio" name="visa_singapore" value="Yes"> Yes</label> <label><input type="radio" name="visa_singapore" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>Malaysia:</label> <div class="radio-group"><label><input type="radio" name="visa_malaysia" value="Yes"> Yes</label> <label><input type="radio" name="visa_malaysia" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group radio-group-wrapper">
                                    <label>Australia:</label> <div class="radio-group"><label><input type="radio" name="visa_australia" value="Yes"> Yes</label> <label><input type="radio" name="visa_australia" value="No"> No</label></div>
                                </div>
                                <div class="form-group radio-group-wrapper">
                                    <label>New Zealand:</label> <div class="radio-group"><label><input type="radio" name="visa_newzealand" value="Yes"> Yes</label> <label><input type="radio" name="visa_newzealand" value="No"> No</label></div>
                                </div>
                            </div>
                            <div class="form-group radio-group-wrapper">
                                <label>Can you assist PAX to draft a cover note for all types of Visa applications?:</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="visa_draft_cover_note" value="Yes"> Yes</label>
                                    <label><input type="radio" name="visa_draft_cover_note" value="No"> No</label>
                                </div>
                            </div>
                        </div>

                        <h4>TOURS AND HOLIDAY PACKAGES</h4>
                        <div class="row mb-3">
    <div class="col-md-6 mb-3 form-group radio-group-wrapper">
      <label class="form-label">Have you handled Tour Packages?</label>
      <div class="radio-group d-flex gap-3">
        <label><input type="radio" name="tours_handled_packages" value="Yes" onclick="toggleTourCountries(true)"> Yes</label>
        <label><input type="radio" name="tours_handled_packages" value="No" onclick="toggleTourCountries(false)"> No</label>
      </div>
    </div>

    <div class="col-md-6 mb-3 form-group conditional-field" id="tours_countries_group" style="display: none;">
      <label for="tours_countries" class="form-label">To which countries did you handle Tour Packages?</label>
      <input type="text" class="form-control" id="tours_countries" name="tours_countries">
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6 mb-3 form-group radio-group-wrapper">
      <label class="form-label">Have you worked out the total cost of the Tours?</label>
      <div class="radio-group d-flex gap-3">
        <label><input type="radio" name="tours_worked_cost" value="Yes"> Yes</label>
        <label><input type="radio" name="tours_worked_cost" value="No"> No</label>
      </div>
    </div>

    <div class="col-md-6 mb-3 form-group radio-group-wrapper">
      <label class="form-label">Have you handled Incentive Groups?</label>
      <div class="radio-group d-flex gap-3">
        <label><input type="radio" name="tours_incentive_groups" value="Yes"> Yes</label>
        <label><input type="radio" name="tours_incentive_groups" value="No"> No</label>
      </div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6 mb-3 form-group radio-group-wrapper">
      <label class="form-label">Have you handled MICE Groups?</label>
      <div class="radio-group d-flex gap-3">
        <label><input type="radio" name="tours_mice_groups" value="Yes"> Yes</label>
        <label><input type="radio" name="tours_mice_groups" value="No"> No</label>
      </div>
    </div>

    <div class="col-md-6 mb-3 form-group radio-group-wrapper">
      <label class="form-label">Have you handled Cruise Pax?</label>
      <div class="radio-group d-flex gap-3">
        <label><input type="radio" name="tours_cruise_pax" value="Yes"> Yes</label>
        <label><input type="radio" name="tours_cruise_pax" value="No"> No</label>
      </div>
    </div>
  </div>


                      <h3 class="form-section-title mb-3 fw-bold" style="color: #030358;">
  <i class="fa fa-calculator me-2 logo"></i> ACCOUNTING
</h3>
  <div class="form-row">
                            <div class="container">

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>I CAN… Record the transactions daily, both for revenue and expenses:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_record_transactions" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_record_transactions" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Periodical Bank Reconciliations and Credit card transactions:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_bank_cc_reconciliation" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_bank_cc_reconciliation" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Reconciliations of corporate travel card activity:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_corporate_card_reconciliation" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_corporate_card_reconciliation" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Tracking of Commissions receivable from Airlines, Insurance companies:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_track_commissions" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_track_commissions" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Timely submission of Invoices to corporate clients:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_submit_invoices" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_submit_invoices" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Maintaining and managing financial records for the travel agency:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_manage_financial_records" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_manage_financial_records" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Proficient in accounting software and Microsoft Excel:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_software_excel_proficient" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_software_excel_proficient" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Prepare and analyze financial reports, statements, and budgets:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_prepare_analyze_reports" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_prepare_analyze_reports" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Ensure compliance with financial regulations and standards:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_ensure_compliance" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_ensure_compliance" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Manage accounts payable and receivable:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_manage_ap_ar" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_manage_ap_ar" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Process payroll and manage expense reports:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_process_payroll_expenses" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_process_payroll_expenses" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Timely Calculate & Pay: TDS, GST, Advance Tax within the due dates:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_calculate_pay_taxes" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_calculate_pay_taxes" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Coordinating with auditors to ensure compliance with all regulations:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_coordinate_auditors" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_coordinate_auditors" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>

    <div class="form-group col-md-6">
      <label>Monitor and manage cash flow and forecast future financial trends:</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_monitor_cashflow_forecast" value="Yes">
          <label class="form-check-label">Yes</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="acc_monitor_cashflow_forecast" value="No">
          <label class="form-check-label">No</label>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label>Reconcile BSP Invoices Statement with Ledger entries:</label>
    <div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="acc_reconcile_bsp" value="Yes">
        <label class="form-check-label">Yes</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="acc_reconcile_bsp" value="No">
        <label class="form-check-label">No</label>
      </div>
    </div>
  </div>

</div>


                        <button type="submit">Submit Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
      </div>
 <style>
    
    /* General body and font styling */
    body {
        font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
        background-color: #f0f2f5;
        color: #333;
    }

    /* Container for the form */
    .modern-form-container {
        max-width: 900px;
        margin: 40px auto;
        background: #ffffff;
        padding: 40px 50px; /* Increased padding */
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* More prominent shadow */
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Headings */
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
        font-size: 2.4em; /* Slightly larger */
        font-weight: 700; /* Bolder */
    }

    h3.form-section-title {
        color: #030358;
        padding-bottom: 15px; /* More padding */
        margin-top: 45px; /* More space above */
        margin-bottom: 30px; /* More space below */
        font-size: 2em; /* Larger */
        font-weight: 600;
        text-transform: uppercase; /* Uppercase for sections */
        letter-spacing: 0.5px;
    }
    .logo{
        color:#030358;
    }
    h4 {
        color: black; /* Darker grey */
        margin-top: 35px;
        margin-bottom: 25px;
        font-size: 1.6em; /* Larger */
        font-weight: 600;
        border-bottom: 1px dashed #e0e0e0; /* Subtle separator */
        padding-bottom: 10px;
    }

    h5 {
        color: #666;
        margin-top: 25px;
        margin-bottom: 15px;
        font-size: 1.2em; /* Slightly larger */
        font-weight: 500;
    }

    /* Form groups and labels */
    .form-group {
        margin-bottom: 25px; /* Standardized margin for single input fields and for spacing between form rows/groups */
    }

     label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #34495e; /* Darker blue-grey for labels */
        font-size: 1.05em; /* Slightly larger font */
    }

    /* Input fields and textareas */
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group input[type="date"],
    .form-group textarea,
    .form-group select,
    .form-group input[type="file"] {
        width: 100%;
        padding: 14px 18px; /* More padding */
        border: 1px solid #dcdcdc; /* Lighter border */
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 1em;
        color: #495057;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #fdfdfd; /* Slightly off-white background */
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus,
    .form-group input[type="number"]:focus,
    .form-group input[type="date"]:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.3rem rgba(0, 123, 255, 0.35); /* More pronounced shadow on focus */
        outline: none;
    }

    /* Radio button group styling */
    .radio-group-wrapper { /* New wrapper to ensure consistent margin-bottom for radio groups */
        margin-bottom: 25px; /* Standardized margin */
    }

    .radio-group { /* Inner flex container for radio options */
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Space between radio options */
        margin-top: 10px; /* Space between label and radio options */
    }
    .radio-group label {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        font-weight: normal;
        color: #333;
        font-size: 1em;
        margin-bottom: 0; /* Override default form-group label margin */
    }

    .radio-group input[type="radio"] {
        margin-right: 10px;
        appearance: none;
        -webkit-appearance: none;
        width: 20px; /* Slightly larger */
        height: 20px; /* Slightly larger */
        border: 2px solid #a0a0a0; /* Darker grey border */
        border-radius: 50%;
        position: relative;
        outline: none;
        cursor: pointer;
        transition: border-color 0.3s ease, background-color 0.3s ease;
    }

    .radio-group input[type="radio"]:hover {
        border-color: #007bff;
    }

    .radio-group input[type="radio"]:checked {
        border-color: #007bff;
        background-color: #e6f2ff; /* Light blue background when checked */
    }

    .radio-group input[type="radio"]:checked::before {
        content: '';
        width: 10px;
        height: 10px;
        background-color: #007bff;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: radioCheck 0.2s ease-out;
    }

    @keyframes radioCheck {
        from { transform: translate(-50%, -50%) scale(0); opacity: 0; }
        to { transform: translate(-50%, -50%) scale(1); opacity: 1; }
    }

    /* Conditional fields with smooth transition */
    .conditional-field {
        margin-top: 25px; /* More space above */
        padding-left: 25px; /* More padding */
        border-left: 5px solid #007bff; /* Thicker border */
        background-color: #eef7ff; /* Lighter blue background */
        padding: 20px 25px; /* More padding */
        border-radius: 10px; /* Slightly more rounded corners */
        box-shadow: inset 0 0 8px rgba(0, 123, 255, 0.1); /* Inner shadow for depth */
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: max-height 0.7s ease-in-out, opacity 0.5s ease-in-out;
    }

    .conditional-field.show {
        max-height: 500px; /* Sufficiently large height for content */
        opacity: 1;
    }

    /* Styles for two input fields on one line */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 30px; /* Increased gap between columns */
        margin-bottom: 25px; /* Standardized margin between rows of input fields */
    }

    .form-row .form-group {
        flex: 1 1 calc(50% - 15px); /* Distribute space for two columns, accounting for gap */
        margin-bottom: 0; /* Remove bottom margin from inner form-groups as their parent form-row handles the spacing */
    }

    /* Submit Button */
    button[type="submit"] {
        /* background-color: #28a745; */
    background-color:#030358;
        color: white;
        padding: 15px 35px; /* Larger padding */
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1.2em; /* Larger font */
        font-weight: 600;
        margin-top: 40px; /* More space above */
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3); /* More pronounced initial shadow */
    }

    button[type="submit"]:hover {
        background-color: #218838;
        transform: translateY(-3px); /* More lift on hover */
        box-shadow: 0 9px 20px rgba(40, 167, 69, 0.4); /* Stronger shadow on hover */
    }

    button[type="submit"]:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(40, 167, 69, 0.2); /* Reduced shadow on click */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modern-form-container {
            padding: 30px; /* Reduce padding on smaller screens */
            margin: 20px auto;
        }

        h2 {
            font-size: 2em;
        }

        h3.form-section-title {
            font-size: 1.6em;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        h4 {
            font-size: 1.3em;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .form-row {
            flex-direction: column; /* Stack fields vertically on small screens */
            gap: 0; /* Remove gap when stacked */
            margin-bottom: 0; /* Handled by individual form-group margin */
        }
        .form-row .form-group {
            flex: 1 1 100%; /* Make each form-group take full width */
            margin-bottom: 25px; /* Restore standardized bottom margin for stacking */
        }
        .radio-group-wrapper {
            margin-bottom: 25px; /* Ensure radio group wrappers maintain consistent spacing */
        }
    }
</style>

<script>
    function toggleField(elementId, show) {
        const group = document.getElementById(elementId);
        const inputs = group.querySelectorAll('input, select, textarea');

        if (show) {
            group.classList.add('show');
            inputs.forEach(input => {
                // Do not set required for radio inputs, handle that separately if needed
                if (input.type !== 'radio' && input.type !== 'checkbox') {
                    input.setAttribute('required', 'required');
                }
            });
        } else {
            group.classList.remove('show');
            inputs.forEach(input => {
                input.removeAttribute('required');
                if (input.type === 'text' || input.type === 'textarea' || input.type === 'number' || input.type === 'email' || input.type === 'date') {
                    input.value = ''; // Clear text, number, email, date inputs
                } else if (input.type === 'radio') {
                    input.checked = false; // Uncheck radio buttons
                } else if (input.type === 'file') {
                    input.value = ''; // Clear file input
                }
            });
        }
    }

    // Individual toggle functions for clarity, calling the generic toggleField
    function toggleRelocateCities(show) {
        toggleField('preferred_cities_group', show);
    }

    function toggleDomesticGdsOther(show) {
        toggleField('domestic_gds_other_name_group', show);
    }

    function toggleDomesticSupplierPortalName(show) {
        toggleField('domestic_supplier_portal_name_group', show);
    }

    function toggleIntlGdsOther(show) {
        toggleField('intl_gds_other_name_group', show);
    }

    function toggleVisaQuestions(show) {
        toggleField('visa_handling_questions', show);
    }

    function toggleTourCountries(show) {
        toggleField('tours_countries_group', show);
    }

    // Initialize conditional fields on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check current state of radio buttons to set initial visibility
        document.querySelectorAll('input[name="willing_to_relocate"]').forEach(radio => {
            if (radio.checked) toggleRelocateCities(radio.value === 'Yes');
        });
        document.querySelectorAll('input[name="domestic_gds_type"]').forEach(radio => {
            if (radio.checked) toggleDomesticGdsOther(radio.value === 'Other');
        });
        document.querySelectorAll('input[name="domestic_supplier_portal"]').forEach(radio => {
            if (radio.checked) toggleDomesticSupplierPortalName(radio.value === 'Yes');
        });
        document.querySelectorAll('input[name="intl_gds_type"]').forEach(radio => {
            if (radio.checked) toggleIntlGdsOther(radio.value === 'Other');
        });
        document.querySelectorAll('input[name="visa_aware_procedures"]').forEach(radio => {
            if (radio.checked) toggleVisaQuestions(radio.value === 'Yes');
        });
        document.querySelectorAll('input[name="tours_handled_packages"]').forEach(radio => {
            if (radio.checked) toggleTourCountries(radio.value === 'Yes');
        });
    });
</script>
@endsection