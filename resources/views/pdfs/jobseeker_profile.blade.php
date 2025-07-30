```html
<!DOCTYPE html>
<html>
<head>
    <title>Job Seeker Profile - {{ $jobSeeker->given_name }} {{ $jobSeeker->family_name }}</title>
    <style>
        @page {
            margin: 0.75in;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Good for broader character support in PDFs */
            font-size: 10pt;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa; /* Light background for a softer look */
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 30px; /* Increased padding */
            box-sizing: border-box; /* Include padding in width */
        }
        h1 {
            font-size: 24pt;
            color: #2c3e50; /* Darker blue-grey for main title */
            border-bottom: 2px solid #3498db; /* Blue border */
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
        }
        h2 {
            font-size: 16pt;
            color: #34495e; /* Slightly lighter blue-grey for section titles */
            border-bottom: 1px solid #ccc;
            padding-bottom: 8px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        h3 {
            font-size: 12pt;
            color: #555;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 25px; /* Increased space between sections */
            padding: 15px;
            background-color: #ffffff; /* White background for sections */
            border: 1px solid #e0e0e0;
            border-radius: 5px; /* Slightly rounded corners */
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Subtle shadow */
        }
        .data-row {
            display: flex; /* Flexbox for key-value pairs */
            margin-bottom: 8px;
            border-bottom: 1px dotted #f0f0f0; /* Dotted line separator */
            padding-bottom: 5px;
        }
        .data-label {
            flex: 0 0 160px; /* Wider label column */
            font-weight: bold;
            color: #4a4a4a; /* Darker grey for labels */
            padding-right: 10px;
        }
        .data-value {
            flex: 1;
            color: #666; /* Medium grey for values */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        th, td {
            border: 1px solid #e9ecef; /* Lighter border for tables */
            padding: 10px 12px; /* More padding in cells */
            text-align: left;
        }
        th {
            background-color: #e2e6ea; /* Light grey for table headers */
            color: #343a40; /* Dark text for headers */
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
        }
        tr:nth-child(even) { /* Zebra striping for tables */
            background-color: #f7f7f7;
        }
        .yes-no {
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 3px;
            display: inline-block; /* Allows padding and border */
            min-width: 40px; /* Ensures consistent button size */
            text-align: center;
        }
        .yes {
            color: #155724; /* Dark green text */
            background-color: #d4edda; /* Light green background */
            border: 1px solid #c3e6cb;
        }
        .no {
            color: #721c24; /* Dark red text */
            background-color: #f8d7da; /* Light red background */
            border: 1px solid #f5c6cb;
        }
        .cv-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Primary blue */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 11pt;
            transition: background-color 0.3s ease; /* Smooth transition for hover effect (though not visible in PDF) */
            margin-top: 10px;
        }
        /* Removed .break-after to prevent forced page breaks between sections */
    </style>
</head>
<body>
    <div class="container">
        <h1>Job Seeker Profile: {{ $jobSeeker->given_name }} {{ $jobSeeker->family_name }}</h1>

        <div class="section">
            <h2>Personal Information</h2>
            <div class="data-row"><div class="data-label">Full Name:</div><div class="data-value">{{ $jobSeeker->given_name }} {{ $jobSeeker->family_name }}</div></div>
            <div class="data-row"><div class="data-label">Date of Birth:</div><div class="data-value">{{ \Carbon\Carbon::parse($jobSeeker->dob)->format('d M, Y') }}</div></div>
            <div class="data-row"><div class="data-label">Address:</div><div class="data-value">{{ $jobSeeker->address }}</div></div>
            <div class="data-row"><div class="data-label">Mobile No:</div><div class="data-value">{{ $jobSeeker->mobile_no }}</div></div>
            <div class="data-row"><div class="data-label">Personal Email:</div><div class="data-value">{{ $jobSeeker->personal_email }}</div></div>
            <div class="data-row"><div class="data-label">Total Experience:</div><div class="data-value">{{ $jobSeeker->total_experience }} Years</div></div>
            <div class="data-row"><div class="data-label">Current City:</div><div class="data-value">{{ $jobSeeker->current_city }}</div></div>
            <div class="data-row"><div class="data-label">Willing to Relocate:</div><div class="data-value"><span class="yes-no {{ $jobSeeker->willing_to_relocate ? 'yes' : 'no' }}">{{ $jobSeeker->willing_to_relocate ? 'Yes' : 'No' }}</span></div></div>
            @if($jobSeeker->preferred_cities)
            <div class="data-row"><div class="data-label">Preferred Cities:</div><div class="data-value">{{ $jobSeeker->preferred_cities }}</div></div>
            @endif
            @if($jobSeeker->current_salary)
            <div class="data-row"><div class="data-label">Current Salary:</div><div class="data-value">{{ number_format($jobSeeker->current_salary, 2) }}</div></div>
            @endif
        </div>

        <div class="section">
            <h2>Curriculum Vitae (CV)</h2>
            @if($jobSeeker->cv_path)
                <p>
                    <a href="{{ route('jobseeker.download_cv', ['id' => $jobSeeker->id]) }}" class="cv-button">
                        Download Original CV
                    </a>
                </p>
                <p style="font-size: 9pt; color: #777; margin-top: 15px;">(This link will only be clickable if you view this PDF in a browser that supports external links within PDFs, like Google Chrome's PDF viewer. Otherwise, copy-paste the link.)</p>
            @else
                <p>No CV uploaded.</p>
            @endif
        </div>

        <div class="section">
            <h2>Domestic Travel Skills</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td>GDS Itinerary</td><td class="yes-no {{ $jobSeeker->domestic_gds_itinerary ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_gds_itinerary ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>PNR Adult</td><td class="yes-no {{ $jobSeeker->domestic_pnr_adult ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_pnr_adult ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>PNR Child/Infant</td><td class="yes-no {{ $jobSeeker->domestic_pnr_child_infant ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_pnr_child_infant ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Senior Citizen Fares</td><td class="yes-no {{ $jobSeeker->domestic_senior_citizen_fares ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_senior_citizen_fares ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Student Fares</td><td class="yes-no {{ $jobSeeker->domestic_student_fares ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_student_fares ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Youth Special Fares</td><td class="yes-no {{ $jobSeeker->domestic_youth_special_fares ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_youth_special_fares ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Fare Mask</td><td class="yes-no {{ $jobSeeker->domestic_fare_mask ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_fare_mask ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Ticketing GDS</td><td class="yes-no {{ $jobSeeker->domestic_ticketing_gds ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_ticketing_gds ? 'Yes' : 'No' }}</td><td>
                        @if($jobSeeker->domestic_ticketing_gds)
                            GDS Type: {{ $jobSeeker->domestic_gds_type ?? 'N/A' }}
                            @if($jobSeeker->domestic_gds_type == 'Other' && $jobSeeker->domestic_gds_other_name)
                                ({{ $jobSeeker->domestic_gds_other_name }})
                            @endif
                        @endif
                    </td></tr>
                    <tr><td>LCC Websites</td><td class="yes-no {{ $jobSeeker->domestic_lcc_websites ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_lcc_websites ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Supplier Portal</td><td class="yes-no {{ $jobSeeker->domestic_supplier_portal ? 'yes' : 'no' }}">{{ $jobSeeker->domestic_supplier_portal ? 'Yes' : 'No' }}</td><td>
                        @if($jobSeeker->domestic_supplier_portal && $jobSeeker->domestic_supplier_portal_name)
                            Portal: {{ $jobSeeker->domestic_supplier_portal_name }}
                        @endif
                    </td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Hotel & Car Hire Skills</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th></tr>
                </thead>
                <tbody>
                    <tr><td>Hotel Bookings (India)</td><td class="yes-no {{ $jobSeeker->hotel_bookings_india ? 'yes' : 'no' }}">{{ $jobSeeker->hotel_bookings_india ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Contact Hotels Direct</td><td class="yes-no {{ $jobSeeker->hotel_contact_direct ? 'yes' : 'no' }}">{{ $jobSeeker->hotel_contact_direct ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Consolidator Websites</td><td class="yes-no {{ $jobSeeker->hotel_consolidator_websites ? 'yes' : 'no' }}">{{ $jobSeeker->hotel_consolidator_websites ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Local DMC</td><td class="yes-no {{ $jobSeeker->hotel_local_dmc ? 'yes' : 'no' }}">{{ $jobSeeker->hotel_local_dmc ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Car Hire (Current City)</td><td class="yes-no {{ $jobSeeker->car_hire_city ? 'yes' : 'no' }}">{{ $jobSeeker->car_hire_city ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Car Hire (Other Cities)</td><td class="yes-no {{ $jobSeeker->car_hire_other_cities ? 'yes' : 'no' }}">{{ $jobSeeker->car_hire_other_cities ? 'Yes' : 'No' }}</td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>International Travel Skills</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td>GDS Itinerary</td><td class="yes-no {{ $jobSeeker->intl_gds_itinerary ? 'yes' : 'no' }}">{{ $jobSeeker->intl_gds_itinerary ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>PNR Child/Infant</td><td class="yes-no {{ $jobSeeker->intl_pnr_child_infant ? 'yes' : 'no' }}">{{ $jobSeeker->intl_pnr_child_infant ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Senior Citizen Fares</td><td class="yes-no {{ $jobSeeker->intl_senior_citizen_fares ? 'yes' : 'no' }}">{{ $jobSeeker->intl_senior_citizen_fares ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Student Fares</td><td class="yes-no {{ $jobSeeker->intl_student_fares ? 'yes' : 'no' }}">{{ $jobSeeker->intl_student_fares ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Youth Special Fares</td><td class="yes-no {{ $jobSeeker->intl_youth_special_fares ? 'yes' : 'no' }}">{{ $jobSeeker->intl_youth_special_fares ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Fare Mask</td><td class="yes-no {{ $jobSeeker->intl_fare_mask ? 'yes' : 'no' }}">{{ $jobSeeker->intl_fare_mask ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>GDS Ticketing</td><td class="yes-no {{ $jobSeeker->intl_gds_type ? 'yes' : 'no' }}">{{ $jobSeeker->intl_gds_type ? 'Yes' : 'No' }}</td><td>
                        @if($jobSeeker->intl_gds_type)
                            GDS Type: {{ $jobSeeker->intl_gds_type ?? 'N/A' }}
                            @if($jobSeeker->intl_gds_type == 'Other' && $jobSeeker->intl_gds_other_name)
                                ({{ $jobSeeker->intl_gds_other_name }})
                            @endif
                        @endif
                    </td></tr>
                    <tr><td>Queue PNRs</td><td class="yes-no {{ $jobSeeker->intl_queue_pnrs ? 'yes' : 'no' }}">{{ $jobSeeker->intl_queue_pnrs ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>First Reissue</td><td class="yes-no {{ $jobSeeker->intl_first_reissue ? 'yes' : 'no' }}">{{ $jobSeeker->intl_first_reissue ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Subsequent Reissue</td><td class="yes-no {{ $jobSeeker->intl_subsequent_reissue ? 'yes' : 'no' }}">{{ $jobSeeker->intl_subsequent_reissue ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Ticket Refunds</td><td class="yes-no {{ $jobSeeker->intl_ticket_refunds ? 'yes' : 'no' }}">{{ $jobSeeker->intl_ticket_refunds ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>HOTAC Rooms</td><td class="yes-no {{ $jobSeeker->intl_hotac_rooms ? 'yes' : 'no' }}">{{ $jobSeeker->intl_hotac_rooms ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Group PNR</td><td class="yes-no {{ $jobSeeker->intl_group_pnr ? 'yes' : 'no' }}">{{ $jobSeeker->intl_group_pnr ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Issue EMD</td><td class="yes-no {{ $jobSeeker->intl_issue_emd ? 'yes' : 'no' }}">{{ $jobSeeker->intl_issue_emd ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Standalone EMD</td><td class="yes-no {{ $jobSeeker->intl_standalone_emd ? 'yes' : 'no' }}">{{ $jobSeeker->intl_standalone_emd ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Associated EMD</td><td class="yes-no {{ $jobSeeker->intl_associated_emd ? 'yes' : 'no' }}">{{ $jobSeeker->intl_associated_emd ? 'Yes' : 'No' }}</td><td></td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Visa Processing Skills</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td>Aware of Visa Procedures</td><td class="yes-no {{ $jobSeeker->visa_aware_procedures ? 'yes' : 'no' }}">{{ $jobSeeker->visa_aware_procedures ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Handled Personally</td><td class="yes-no {{ $jobSeeker->visa_handled_personally ? 'yes' : 'no' }}">{{ $jobSeeker->visa_handled_personally ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>In Department</td><td class="yes-no {{ $jobSeeker->visa_in_department ? 'yes' : 'no' }}">{{ $jobSeeker->visa_in_department ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>USA Visa</td><td class="yes-no {{ $jobSeeker->visa_usa ? 'yes' : 'no' }}">{{ $jobSeeker->visa_usa ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Canada Visa</td><td class="yes-no {{ $jobSeeker->visa_canada ? 'yes' : 'no' }}">{{ $jobSeeker->visa_canada ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Mexico Visa</td><td class="yes-no {{ $jobSeeker->visa_mexico ? 'yes' : 'no' }}">{{ $jobSeeker->visa_mexico ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Brazil Visa</td><td class="yes-no {{ $jobSeeker->visa_brazil ? 'yes' : 'no' }}">{{ $jobSeeker->visa_brazil ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Other South America</td><td class="yes-no {{ $jobSeeker->visa_other_south_america ? 'yes' : 'no' }}">{{ $jobSeeker->visa_other_south_america ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>UK Visa</td><td class="yes-no {{ $jobSeeker->visa_uk ? 'yes' : 'no' }}">{{ $jobSeeker->visa_uk ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Ireland Visa</td><td class="yes-no {{ $jobSeeker->visa_ireland ? 'yes' : 'no' }}">{{ $jobSeeker->visa_ireland ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Haj/Umrah Visa</td><td class="yes-no {{ $jobSeeker->visa_haj_umrah ? 'yes' : 'no' }}">{{ $jobSeeker->visa_haj_umrah ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>UAE Visa</td><td class="yes-no {{ $jobSeeker->visa_uae ? 'yes' : 'no' }}">{{ $jobSeeker->visa_uae ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Schengen Countries</td><td>{{ $jobSeeker->visa_schengen_countries ?? 'N/A' }}</td><td></td></tr>
                    <tr><td>Russia Visa</td><td class="yes-no {{ $jobSeeker->visa_russia ? 'yes' : 'no' }}">{{ $jobSeeker->visa_russia ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>China Visa</td><td class="yes-no {{ $jobSeeker->visa_china ? 'yes' : 'no' }}">{{ $jobSeeker->visa_china ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Vietnam Visa</td><td class="yes-no {{ $jobSeeker->visa_vietnam ? 'yes' : 'no' }}">{{ $jobSeeker->visa_vietnam ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Cambodia Visa</td><td class="yes-no {{ $jobSeeker->visa_cambodia ? 'yes' : 'no' }}">{{ $jobSeeker->visa_cambodia ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Hongkong Visa</td><td class="yes-no {{ $jobSeeker->visa_hongkong ? 'yes' : 'no' }}">{{ $jobSeeker->visa_hongkong ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Philippines Visa</td><td class="yes-no {{ $jobSeeker->visa_philippines ? 'yes' : 'no' }}">{{ $jobSeeker->visa_philippines ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Singapore Visa</td><td class="yes-no {{ $jobSeeker->visa_singapore ? 'yes' : 'no' }}">{{ $jobSeeker->visa_singapore ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Malaysia Visa</td><td class="yes-no {{ $jobSeeker->visa_malaysia ? 'yes' : 'no' }}">{{ $jobSeeker->visa_malaysia ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Australia Visa</td><td class="yes-no {{ $jobSeeker->visa_australia ? 'yes' : 'no' }}">{{ $jobSeeker->visa_australia ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>New Zealand Visa</td><td class="yes-no {{ $jobSeeker->visa_newzealand ? 'yes' : 'no' }}">{{ $jobSeeker->visa_newzealand ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Draft Cover Note</td><td class="yes-no {{ $jobSeeker->visa_draft_cover_note ? 'yes' : 'no' }}">{{ $jobSeeker->visa_draft_cover_note ? 'Yes' : 'No' }}</td><td></td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Tours & Packages Skills</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th><th>Details</th></tr>
                </thead>
                <tbody>
                    <tr><td>Handled Packages</td><td class="yes-no {{ $jobSeeker->tours_handled_packages ? 'yes' : 'no' }}">{{ $jobSeeker->tours_handled_packages ? 'Yes' : 'No' }}</td><td>
                        @if($jobSeeker->tours_handled_packages && $jobSeeker->tours_countries)
                            Countries: {{ $jobSeeker->tours_countries }}
                        @endif
                    </td></tr>
                    <tr><td>Worked on Costing</td><td class="yes-no {{ $jobSeeker->tours_worked_cost ? 'yes' : 'no' }}">{{ $jobSeeker->tours_worked_cost ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Incentive Groups</td><td class="yes-no {{ $jobSeeker->tours_incentive_groups ? 'yes' : 'no' }}">{{ $jobSeeker->tours_incentive_groups ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>MICE Groups</td><td class="yes-no {{ $jobSeeker->tours_mice_groups ? 'yes' : 'no' }}">{{ $jobSeeker->tours_mice_groups ? 'Yes' : 'No' }}</td><td></td></tr>
                    <tr><td>Cruise Passengers</td><td class="yes-no {{ $jobSeeker->tours_cruise_pax ? 'yes' : 'no' }}">{{ $jobSeeker->tours_cruise_pax ? 'Yes' : 'No' }}</td><td></td></tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Accounting Skills</h2>
            <table>
                <thead>
                    <tr><th>Skill</th><th>Proficiency</th></tr>
                </thead>
                <tbody>
                    <tr><td>Record Transactions</td><td class="yes-no {{ $jobSeeker->acc_record_transactions ? 'yes' : 'no' }}">{{ $jobSeeker->acc_record_transactions ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Bank/CC Reconciliation</td><td class="yes-no {{ $jobSeeker->acc_bank_cc_reconciliation ? 'yes' : 'no' }}">{{ $jobSeeker->acc_bank_cc_reconciliation ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Corporate Card Reconciliation</td><td class="yes-no {{ $jobSeeker->acc_corporate_card_reconciliation ? 'yes' : 'no' }}">{{ $jobSeeker->acc_corporate_card_reconciliation ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Track Commissions</td><td class="yes-no {{ $jobSeeker->acc_track_commissions ? 'yes' : 'no' }}">{{ $jobSeeker->acc_track_commissions ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Submit Invoices</td><td class="yes-no {{ $jobSeeker->acc_submit_invoices ? 'yes' : 'no' }}">{{ $jobSeeker->acc_submit_invoices ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Manage Financial Records</td><td class="yes-no {{ $jobSeeker->acc_manage_financial_records ? 'yes' : 'no' }}">{{ $jobSeeker->acc_manage_financial_records ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Software/Excel Proficient</td><td class="yes-no {{ $jobSeeker->acc_software_excel_proficient ? 'yes' : 'no' }}">{{ $jobSeeker->acc_software_excel_proficient ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Prepare/Analyze Reports</td><td class="yes-no {{ $jobSeeker->acc_prepare_analyze_reports ? 'yes' : 'no' }}">{{ $jobSeeker->acc_prepare_analyze_reports ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Ensure Compliance</td><td class="yes-no {{ $jobSeeker->acc_ensure_compliance ? 'yes' : 'no' }}">{{ $jobSeeker->acc_ensure_compliance ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Manage AP/AR</td><td class="yes-no {{ $jobSeeker->acc_manage_ap_ar ? 'yes' : 'no' }}">{{ $jobSeeker->acc_manage_ap_ar ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Process Payroll/Expenses</td><td class="yes-no {{ $jobSeeker->acc_process_payroll_expenses ? 'yes' : 'no' }}">{{ $jobSeeker->acc_process_payroll_expenses ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Calculate/Pay Taxes</td><td class="yes-no {{ $jobSeeker->acc_calculate_pay_taxes ? 'yes' : 'no' }}">{{ $jobSeeker->acc_calculate_pay_taxes ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Coordinate Auditors</td><td class="yes-no {{ $jobSeeker->acc_coordinate_auditors ? 'yes' : 'no' }}">{{ $jobSeeker->acc_coordinate_auditors ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Monitor Cashflow/Forecast</td><td class="yes-no {{ $jobSeeker->acc_monitor_cashflow_forecast ? 'yes' : 'no' }}">{{ $jobSeeker->acc_monitor_cashflow_forecast ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Reconcile BSP</td><td class="yes-no {{ $jobSeeker->acc_reconcile_bsp ? 'yes' : 'no' }}">{{ $jobSeeker->acc_reconcile_bsp ? 'Yes' : 'No' }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
```