
<!DOCTYPE html>
<html>
<head>
    <title>Employer Profile - {{ $employer->company_name }}</title>
    <style>
        @page {
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.6;
            color: #333;
            background-color: #e6e6f2;
            margin: 0;
            padding: 0;
            border-radius: 20px;
        }
        .container {
            width: 90%;
            padding: 30px;
            padding-top: 20px;
            box-sizing: border-box;
            padding-bottom: 0px;
        }
        h1 {
            font-size: 24pt;
            color: #030358;
            border-bottom: 2px solid #030358;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
        }
        h2 {
            font-size: 16pt;
            color: black;
            border-bottom: 1px solid #ccc;
            padding-bottom: 8px;
            margin-top: 20px;
            margin-bottom: 15px;
        }
        h3 {
            font-size: 12pt;
            color: #555;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 10px;
            padding: 15px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin: 10px auto;
        }
        .data-row {
            display: flex;
            margin-bottom: 8px;
            border-bottom: 1px dotted #f0f0f0;
            padding-bottom: 5px;
        }
        .data-label {
            flex: 0 0 160px;
            font-weight: bold;
            color: #4a4a4a;
            padding-right: 10px;
        }
        .data-value {
            flex: 1;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        th, td {
            border: 1px solid #e9ecef;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background-color: #e2e6ea;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #f7f7f7;
        }
        .yes-no {
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 3px;
            display: inline-block;
            min-width: 40px;
            text-align: center;
        }
        .yes {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 3px 10px;
            margin-left: 45px;
            margin-top: 5px;
        }
        .no {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 3px 10px;
            text-align: center;
            margin-left: 45px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employer Profile: {{ $employer->company_name }}</h1>

        <div class="section bg-white shadow rounded-xl p-6 border border-gray-200">
            <h2>Company & Contact Information</h2>
            <table class="w-full text-sm sm:text-base text-gray-700 table-auto">
                <tbody>
                    <tr class="border-b">
                        <td class="py-2 pr-4 font-semibold text-black w-1/2" style="color:black;font-weight:bold">Company Name:</td>
                        <td class="py-2">{{ $employer->company_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 pr-4 font-semibold text-black" style="color:black;font-weight:bold">Contact Person:</td>
                        <td class="py-2">{{ $employer->contact_person }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 pr-4 font-semibold text-black" style="color:black;font-weight:bold">Address:</td>
                        <td class="py-2">{{ $employer->address }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 pr-4 font-semibold text-black" style="color:black;font-weight:bold">Mobile No:</td>
                        <td class="py-2">{{ $employer->contact_mobile }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 pr-4 font-semibold text-black" style="color:black;font-weight:bold">Contact Email:</td>
                        <td class="py-2">{{ $employer->contact_email }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-semibold text-black" style="color:black;font-weight:bold">Min. Experience Required:</td>
                        <td class="py-2">{{ $employer->min_travel_trade_experience_years }} Years</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Domestic Travel Expertise</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td>GDS Itinerary</td><td><span class="yes-no {{ $employer->domestic_gds_itinerary ? 'yes' : 'no' }}">{{ $employer->domestic_gds_itinerary ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">PNR Adult</td><td><span class="yes-no {{ $employer->domestic_pnr_adult ? 'yes' : 'no' }}">{{ $employer->domestic_pnr_adult ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">PNR Child/Infant</td><td><span class="yes-no {{ $employer->domestic_pnr_child_infant ? 'yes' : 'no' }}">{{ $employer->domestic_pnr_child_infant ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Senior Citizen Fares</td><td><span class="yes-no {{ $employer->domestic_senior_citizen_fares ? 'yes' : 'no' }}">{{ $employer->domestic_senior_citizen_fares ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Student Fares</td><td><span class="yes-no {{ $employer->domestic_student_fares ? 'yes' : 'no' }}">{{ $employer->domestic_student_fares ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Youth Special Fares</td><td><span class="yes-no {{ $employer->domestic_youth_special_fares ? 'yes' : 'no' }}">{{ $employer->domestic_youth_special_fares ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Fare Mask</td><td><span class="yes-no {{ $employer->domestic_fare_mask ? 'yes' : 'no' }}">{{ $employer->domestic_fare_mask ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Ticketing GDS</td><td><span class="yes-no {{ $employer->domestic_ticketing_gds ? 'yes' : 'no' }}">{{ $employer->domestic_ticketing_gds ? 'Yes' : 'No' }}</span></td><td>
                        @if($employer->domestic_ticketing_gds)
                            GDS Type: {{ $employer->domestic_gds_type ?? 'N/A' }}
                            @if($employer->domestic_gds_type == 'Other' && $employer->domestic_gds_other_name)
                                ({{ $employer->domestic_gds_other_name }})
                            @endif
                        @endif
                    </td></tr>
                    <tr><td style="color:black;font-weight:bold">LCC Websites</td><td><span class="yes-no {{ $employer->domestic_lcc_websites ? 'yes' : 'no' }}">{{ $employer->domestic_lcc_websites ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Supplier Portal</td><td><span class="yes-no {{ $employer->domestic_supplier_portal ? 'yes' : 'no' }}">{{ $employer->domestic_supplier_portal ? 'Yes' : 'No' }}</span></td><td>
                        @if($employer->domestic_supplier_portal && $employer->domestic_supplier_portal_name)
                            Portal: {{ $employer->domestic_supplier_portal_name }}
                        @endif
                    </td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Hotel & Car Hire Expertise</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th></tr>
                </thead>
                <tbody>
                    <tr><td style="color:black;font-weight:bold">Hotel Bookings (India)</td><td><span class="yes-no {{ $employer->hotel_bookings_india ? 'yes' : 'no' }}">{{ $employer->hotel_bookings_india ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Contact Hotels Direct</td><td><span class="yes-no {{ $employer->hotel_contact_direct ? 'yes' : 'no' }}">{{ $employer->hotel_contact_direct ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Consolidator Websites</td><td><span class="yes-no {{ $employer->hotel_consolidator_websites ? 'yes' : 'no' }}">{{ $employer->hotel_consolidator_websites ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Local DMC</td><td><span class="yes-no {{ $employer->hotel_local_dmc ? 'yes' : 'no' }}">{{ $employer->hotel_local_dmc ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Car Hire (Current City)</td><td><span class="yes-no {{ $employer->car_hire_city ? 'yes' : 'no' }}">{{ $employer->car_hire_city ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Car Hire (Other Cities)</td><td><span class="yes-no {{ $employer->car_hire_other_cities ? 'yes' : 'no' }}">{{ $employer->car_hire_other_cities ? 'Yes' : 'No' }}</span></td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>International Travel - Basic Skills (Base Positions)</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td style="color:black;font-weight:bold">GDS Itinerary</td><td><span class="yes-no {{ $employer->intl_gds_itinerary ? 'yes' : 'no' }}">{{ $employer->intl_gds_itinerary ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">PNR Child/Infant</td><td><span class="yes-no {{ $employer->intl_pnr_child_infant ? 'yes' : 'no' }}">{{ $employer->intl_pnr_child_infant ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Senior Citizen Fares</td><td><span class="yes-no {{ $employer->intl_senior_citizen_fares ? 'yes' : 'no' }}">{{ $employer->intl_senior_citizen_fares ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Student Fares</td><td><span class="yes-no {{ $employer->intl_student_fares ? 'yes' : 'no' }}">{{ $employer->intl_student_fares ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Youth Special Fares</td><td><span class="yes-no {{ $employer->intl_youth_special_fares ? 'yes' : 'no' }}">{{ $employer->intl_youth_special_fares ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Fare Mask</td><td><span class="yes-no {{ $employer->intl_fare_mask ? 'yes' : 'no' }}">{{ $employer->intl_fare_mask ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">GDS Ticketing</td><td><span class="yes-no {{ $employer->intl_gds_type ? 'yes' : 'no' }}">{{ $employer->intl_gds_type ? 'Yes' : 'No' }}</span></td><td>
                        @if($employer->intl_gds_type)
                            GDS Type: {{ $employer->intl_gds_type ?? 'N/A' }}
                            @if($employer->intl_gds_type == 'Other' && $employer->intl_gds_other_name)
                                ({{ $employer->intl_gds_other_name }})
                            @endif
                        @endif
                    </td></tr>
                    <tr><td style="color:black;font-weight:bold">Queue PNRs</td><td><span class="yes-no {{ $employer->intl_queue_pnrs ? 'yes' : 'no' }}">{{ $employer->intl_queue_pnrs ? 'Yes' : 'No' }}</span></td><td></td></tr>
                     </tbody>
            </table>
        </div>
<div class="section">
     <h2>International Travel - Advanced Skills (Senior Positions)</h2>
           
    <table>
        <thead>
    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                
        </thead>
        <tbody>
              <tr><td style="color:black;font-weight:bold">First Reissue</td><td><span class="yes-no {{ $employer->intl_first_reissue ? 'yes' : 'no' }}">{{ $employer->intl_first_reissue ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Subsequent Reissue</td><td><span class="yes-no {{ $employer->intl_subsequent_reissue ? 'yes' : 'no' }}">{{ $employer->intl_subsequent_reissue ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Ticket Refunds</td><td><span class="yes-no {{ $employer->intl_ticket_refunds ? 'yes' : 'no' }}">{{ $employer->intl_ticket_refunds ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">HOTAC Rooms</td><td><span class="yes-no {{ $employer->intl_hotac_rooms ? 'yes' : 'no' }}">{{ $employer->intl_hotac_rooms ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Group PNR</td><td><span class="yes-no {{ $employer->intl_group_pnr ? 'yes' : 'no' }}">{{ $employer->intl_group_pnr ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Issue EMD</td><td><span class="yes-no {{ $employer->intl_issue_emd ? 'yes' : 'no' }}">{{ $employer->intl_issue_emd ? 'Yes' : 'No' }}</span></td><td></td></tr>
                  
                    <tr><td style="color:black;font-weight:bold">Standalone EMD</td><td><span class="yes-no {{ $employer->intl_standalone_emd ? 'yes' : 'no' }}">{{ $employer->intl_standalone_emd ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Associated EMD</td><td ><span class="yes-no {{ $employer->intl_associated_emd ? 'yes' : 'no' }}">{{ $employer->intl_associated_emd ? 'Yes' : 'No' }}</span></td><td></td></tr>
                  
                    <tr><td style="color:black;font-weight:bold">Manage Queues and update PNRs</td><td><span class="yes-no {{ $employer->intl_mng_queues_upd_pnrs ? 'yes' : 'no' }}">{{ $employer->intl_associated_emd ? 'Yes' : 'No' }}</span></td><td></td></tr>
             
        </tbody>
    </table>
</div>
        <div class="section">
            <h2>Visa Processing Expertise</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td style="color:black;font-weight:bold">Aware of Visa Procedures</td><td><span class="yes-no {{ $employer->visa_aware_procedures ? 'yes' : 'no' }}">{{ $employer->visa_aware_procedures ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Handled Personally</td><td><span class="yes-no {{ $employer->visa_handled_personally ? 'yes' : 'no' }}">{{ $employer->visa_handled_personally ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">In Department</td><td><span class="yes-no {{ $employer->visa_in_department ? 'yes' : 'no' }}">{{ $employer->visa_in_department ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">USA Visa</td><td><span class="yes-no {{ $employer->visa_usa ? 'yes' : 'no' }}">{{ $employer->visa_usa ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Canada Visa</td><td><span class="yes-no {{ $employer->visa_canada ? 'yes' : 'no' }}">{{ $employer->visa_canada ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Mexico Visa</td><td><span class="yes-no {{ $employer->visa_mexico ? 'yes' : 'no' }}">{{ $employer->visa_mexico ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Brazil Visa</td><td><span class="yes-no {{ $employer->visa_brazil ? 'yes' : 'no' }}">{{ $employer->visa_brazil ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Other South America</td><td><span class="yes-no {{ $employer->visa_other_south_america ? 'yes' : 'no' }}">{{ $employer->visa_other_south_america ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">UK Visa</td><td><span class="yes-no {{ $employer->visa_uk ? 'yes' : 'no' }}">{{ $employer->visa_uk ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Ireland Visa</td><td><span class="yes-no {{ $employer->visa_ireland ? 'yes' : 'no' }}">{{ $employer->visa_ireland ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Haj/Umrah Visa</td><td><span class="yes-no {{ $employer->visa_haj_umrah ? 'yes' : 'no' }}">{{ $employer->visa_haj_umrah ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">UAE Visa</td><td><span class="yes-no {{ $employer->visa_uae ? 'yes' : 'no' }}">{{ $employer->visa_uae ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Schengen Countries</td><td>{{ $employer->visa_schengen_countries ?? 'N/A' }}</td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Russia Visa</td><td><span class="yes-no {{ $employer->visa_russia ? 'yes' : 'no' }}">{{ $employer->visa_russia ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">China Visa</td><td><span class="yes-no {{ $employer->visa_china ? 'yes' : 'no' }}">{{ $employer->visa_china ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Vietnam Visa</td><td><span class="yes-no {{ $employer->visa_vietnam ? 'yes' : 'no' }}">{{ $employer->visa_vietnam ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Cambodia Visa</td><td><span class="yes-no {{ $employer->visa_cambodia ? 'yes' : 'no' }}">{{ $employer->visa_cambodia ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Hongkong Visa</td><td><span class="yes-no {{ $employer->visa_hongkong ? 'yes' : 'no' }}">{{ $employer->visa_hongkong ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Philippines Visa</td><td><span class="yes-no {{ $employer->visa_philippines ? 'yes' : 'no' }}">{{ $employer->visa_philippines ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Singapore Visa</td><td><span class="yes-no {{ $employer->visa_singapore ? 'yes' : 'no' }}">{{ $employer->visa_singapore ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Malaysia Visa</td><td><span class="yes-no {{ $employer->visa_malaysia ? 'yes' : 'no' }}">{{ $employer->visa_malaysia ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Australia Visa</td><td><span class="yes-no {{ $employer->visa_australia ? 'yes' : 'no' }}">{{ $employer->visa_australia ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">New Zealand Visa</td><td><span class="yes-no {{ $employer->visa_newzealand ? 'yes' : 'no' }}">{{ $employer->visa_newzealand ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Draft Cover Note</td><td><span class="yes-no {{ $employer->visa_draft_cover_note ? 'yes' : 'no' }}">{{ $employer->visa_draft_cover_note ? 'Yes' : 'No' }}</span></td><td></td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Tours & Packages Expertise</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td style="color:black;font-weight:bold">Handled Packages</td><td><span class="yes-no {{ $employer->tours_handled_packages ? 'yes' : 'no' }}">{{ $employer->tours_handled_packages ? 'Yes' : 'No' }}</span></td><td>
                        @if($employer->tours_handled_packages && $employer->tours_countries)
                            Countries: {{ $employer->tours_countries }}
                        @endif
                    </td></tr>
                    <tr><td style="color:black;font-weight:bold">Worked on Costing</td><td><span class="yes-no {{ $employer->tours_worked_cost ? 'yes' : 'no' }}">{{ $employer->tours_worked_cost ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Incentive Groups</td><td><span class="yes-no {{ $employer->tours_incentive_groups ? 'yes' : 'no' }}">{{ $employer->tours_incentive_groups ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">MICE Groups</td><td><span class="yes-no {{ $employer->tours_mice_groups ? 'yes' : 'no' }}">{{ $employer->tours_mice_groups ? 'Yes' : 'No' }}</span></td><td></td></tr>
                    <tr><td style="color:black;font-weight:bold">Cruise Passengers</td><td><span class="yes-no {{ $employer->tours_cruise_pax ? 'yes' : 'no' }}">{{ $employer->tours_cruise_pax ? 'Yes' : 'No' }}</span></td><td></td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Accounting Expertise</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th></tr>
                </thead>
                <tbody>
                    <tr><td style="color:black;font-weight:bold">Record Transactions</td><td><span class="yes-no {{ $employer->acc_record_transactions ? 'yes' : 'no' }}">{{ $employer->acc_record_transactions ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Bank/CC Reconciliation</td><td><span class="yes-no {{ $employer->acc_bank_cc_reconciliation ? 'yes' : 'no' }}">{{ $employer->acc_bank_cc_reconciliation ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Corporate Card Reconciliation</td><td><span class="yes-no {{ $employer->acc_corporate_card_reconciliation ? 'yes' : 'no' }}">{{ $employer->acc_corporate_card_reconciliation ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Track Commissions</td><td><span class="yes-no {{ $employer->acc_track_commissions ? 'yes' : 'no' }}">{{ $employer->acc_track_commissions ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Submit Invoices</td><td><span class="yes-no {{ $employer->acc_submit_invoices ? 'yes' : 'no' }}">{{ $employer->acc_submit_invoices ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Manage Financial Records</td><td><span class="yes-no {{ $employer->acc_manage_financial_records ? 'yes' : 'no' }}">{{ $employer->acc_manage_financial_records ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Software/Excel Proficient</td><td><span class="yes-no {{ $employer->acc_software_excel_proficient ? 'yes' : 'no' }}">{{ $employer->acc_software_excel_proficient ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Prepare/Analyze Reports</td><td><span class="yes-no {{ $employer->acc_prepare_analyze_reports ? 'yes' : 'no' }}">{{ $employer->acc_prepare_analyze_reports ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Ensure Compliance</td><td><span class="yes-no {{ $employer->acc_ensure_compliance ? 'yes' : 'no' }}">{{ $employer->acc_ensure_compliance ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Manage AP/AR</td><td><span class="yes-no {{ $employer->acc_manage_ap_ar ? 'yes' : 'no' }}">{{ $employer->acc_manage_ap_ar ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Process Payroll/Expenses</td><td><span class="yes-no {{ $employer->acc_process_payroll_expenses ? 'yes' : 'no' }}">{{ $employer->acc_process_payroll_expenses ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Calculate/Pay Taxes</td><td><span class="yes-no {{ $employer->acc_calculate_pay_taxes ? 'yes' : 'no' }}">{{ $employer->acc_calculate_pay_taxes ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Coordinate Auditors</td><td><span class="yes-no {{ $employer->acc_coordinate_auditors ? 'yes' : 'no' }}">{{ $employer->acc_coordinate_auditors ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Monitor Cashflow/Forecast</td><td><span class="yes-no {{ $employer->acc_monitor_cashflow_forecast ? 'yes' : 'no' }}">{{ $employer->acc_monitor_cashflow_forecast ? 'Yes' : 'No' }}</span></td></tr>
                    <tr><td style="color:black;font-weight:bold">Reconcile BSP</td><td><span class="yes-no {{ $employer->acc_reconcile_bsp ? 'yes' : 'no' }}">{{ $employer->acc_reconcile_bsp ? 'Yes' : 'No' }}</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
