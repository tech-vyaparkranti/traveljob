<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables; // Make sure to import DataTables facade


class JobSeekerController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'given_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'mobile_no' => 'required|string|max:20',
            'personal_email' => 'required|email|max:255',
            'total_experience' => 'nullable|integer|min:0',
            'current_city' => 'required|string|max:3',
            'willing_to_relocate' => 'required|in:Yes,No',
            'preferred_cities' => 'nullable|string|max:255',
            'current_salary' => 'nullable|numeric|min:0',
            'cv_upload' => 'required|file|mimes:pdf,doc,docx|max:2048', // Max 2MB

            // Validation rules for all your other fields (domestic, international, visa, tours, accounting)
            // For radio buttons (Yes/No), they should be 'in:Yes,No' and then converted
            'domestic_gds_itinerary' => 'required|in:Yes,No',
            'domestic_pnr_adult' => 'required|in:Yes,No',
            'domestic_pnr_child_infant' => 'required|in:Yes,No',
            'domestic_senior_citizen_fares' => 'required|in:Yes,No',
            'domestic_student_fares' => 'required|in:Yes,No',
            'domestic_youth_special_fares' => 'required|in:Yes,No',
            'domestic_fare_mask' => 'required|in:Yes,No',
            'domestic_ticketing_gds' => 'required|in:Yes,No',
            'domestic_gds_type' => 'nullable|string', // Amadeus, Galileo, Sabre, Other
            'domestic_gds_other_name' => 'nullable|string|max:255',
            'domestic_lcc_websites' => 'required|in:Yes,No',
            'domestic_supplier_portal' => 'required|in:Yes,No',
            'domestic_supplier_portal_name' => 'nullable|string|max:255',

            'hotel_bookings_india' => 'required|in:Yes,No',
            'hotel_contact_direct' => 'required|in:Yes,No',
            'hotel_consolidator_websites' => 'required|in:Yes,No',
            'hotel_local_dmc' => 'required|in:Yes,No',
            'car_hire_city' => 'required|in:Yes,No',
            'car_hire_other_cities' => 'required|in:Yes,No',

            'intl_gds_itinerary' => 'required|in:Yes,No',
            'intl_pnr_child_infant' => 'required|in:Yes,No',
            'intl_senior_citizen_fares' => 'required|in:Yes,No',
            'intl_student_fares' => 'required|in:Yes,No',
            'intl_youth_special_fares' => 'required|in:Yes,No',
            'intl_fare_mask' => 'required|in:Yes,No',
            'intl_gds_type' => 'nullable|string',
            'intl_gds_other_name' => 'nullable|string|max:255',
            'intl_queue_pnrs' => 'required|in:Yes,No',
            'intl_first_reissue' => 'required|in:Yes,No',
            'intl_subsequent_reissue' => 'required|in:Yes,No',
            'intl_ticket_refunds' => 'required|in:Yes,No',
            'intl_hotac_rooms' => 'required|in:Yes,No',
            'intl_group_pnr' => 'required|in:Yes,No',
            'intl_issue_emd' => 'required|in:Yes,No',
            'intl_standalone_emd' => 'required|in:Yes,No',
            'intl_associated_emd' => 'required|in:Yes,No',

            'visa_aware_procedures' => 'required|in:Yes,No',
            'visa_handled_personally' => 'nullable|in:Yes,No', // Nullable if conditional
            'visa_in_department' => 'nullable|in:Yes,No',       // Nullable if conditional
            'visa_usa' => 'nullable|in:Yes,No',
            'visa_canada' => 'nullable|in:Yes,No',
            'visa_mexico' => 'nullable|in:Yes,No',
            'visa_brazil' => 'nullable|in:Yes,No',
            'visa_other_south_america' => 'nullable|in:Yes,No',
            'visa_uk' => 'nullable|in:Yes,No',
            'visa_ireland' => 'nullable|in:Yes,No',
            'visa_haj_umrah' => 'nullable|in:Yes,No',
            'visa_uae' => 'nullable|in:Yes,No',
            'visa_schengen_countries' => 'nullable|string|max:255',
            'visa_russia' => 'nullable|in:Yes,No',
            'visa_china' => 'nullable|in:Yes,No',
            'visa_vietnam' => 'nullable|in:Yes,No',
            'visa_cambodia' => 'nullable|in:Yes,No',
            'visa_hongkong' => 'nullable|in:Yes,No',
            'visa_philippines' => 'nullable|in:Yes,No',
            'visa_singapore' => 'nullable|in:Yes,No',
            'visa_malaysia' => 'nullable|in:Yes,No',
            'visa_australia' => 'nullable|in:Yes,No',
            'visa_newzealand' => 'nullable|in:Yes,No',
            'visa_draft_cover_note' => 'nullable|in:Yes,No',

            'tours_handled_packages' => 'required|in:Yes,No',
            'tours_countries' => 'nullable|string|max:255',
            'tours_worked_cost' => 'required|in:Yes,No',
            'tours_incentive_groups' => 'required|in:Yes,No',
            'tours_mice_groups' => 'required|in:Yes,No',
            'tours_cruise_pax' => 'required|in:Yes,No',

            'acc_record_transactions' => 'required|in:Yes,No',
            'acc_bank_cc_reconciliation' => 'required|in:Yes,No',
            'acc_corporate_card_reconciliation' => 'required|in:Yes,No',
            'acc_track_commissions' => 'required|in:Yes,No',
            'acc_submit_invoices' => 'required|in:Yes,No',
            'acc_manage_financial_records' => 'required|in:Yes,No',
            'acc_software_excel_proficient' => 'required|in:Yes,No',
            'acc_prepare_analyze_reports' => 'required|in:Yes,No',
            'acc_ensure_compliance' => 'required|in:Yes,No',
            'acc_manage_ap_ar' => 'required|in:Yes,No',
            'acc_process_payroll_expenses' => 'required|in:Yes,No',
            'acc_calculate_pay_taxes' => 'required|in:Yes,No',
            'acc_coordinate_auditors' => 'required|in:Yes,No',
            'acc_monitor_cashflow_forecast' => 'required|in:Yes,No',
            'acc_reconcile_bsp' => 'required|in:Yes,No',
        ]);

        // 2. Handle CV file upload
        $cvPath = null;
        if ($request->hasFile('cv_upload')) {
            $cvPath = $request->file('cv_upload')->store('cvs', 'public');
        }

        // 3. Prepare data for insertion, converting 'Yes'/'No' strings to booleans
        $dataToStore = [
            'given_name' => $validatedData['given_name'],
            'family_name' => $validatedData['family_name'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'mobile_no' => $validatedData['mobile_no'],
            'personal_email' => $validatedData['personal_email'],
            'total_experience' => $validatedData['total_experience'],
            'current_city' => $validatedData['current_city'],
            'willing_to_relocate' => ($validatedData['willing_to_relocate'] === 'Yes'), // Convert here
            'preferred_cities' => $validatedData['preferred_cities'],
            'current_salary' => $validatedData['current_salary'],
            'cv_path' => $cvPath,
        ];

        // List all fields that require 'Yes'/'No' to boolean conversion
        $booleanFields = [
            'domestic_gds_itinerary', 'domestic_pnr_adult', 'domestic_pnr_child_infant',
            'domestic_senior_citizen_fares', 'domestic_student_fares', 'domestic_youth_special_fares',
            'domestic_fare_mask', 'domestic_ticketing_gds', 'domestic_lcc_websites',
            'domestic_supplier_portal',
            'hotel_bookings_india', 'hotel_contact_direct', 'hotel_consolidator_websites',
            'hotel_local_dmc', 'car_hire_city', 'car_hire_other_cities',
            'intl_gds_itinerary', 'intl_pnr_child_infant', 'intl_senior_citizen_fares',
            'intl_student_fares', 'intl_youth_special_fares', 'intl_fare_mask',
            'intl_queue_pnrs', 'intl_first_reissue', 'intl_subsequent_reissue',
            'intl_ticket_refunds', 'intl_hotac_rooms', 'intl_group_pnr',
            'intl_issue_emd', 'intl_standalone_emd', 'intl_associated_emd',
            'visa_aware_procedures', 'visa_handled_personally', 'visa_in_department',
            'visa_usa', 'visa_canada', 'visa_mexico', 'visa_brazil',
            'visa_other_south_america', 'visa_uk', 'visa_ireland', 'visa_haj_umrah',
            'visa_uae', 'visa_russia', 'visa_china', 'visa_vietnam', 'visa_cambodia',
            'visa_hongkong', 'visa_philippines', 'visa_singapore', 'visa_malaysia',
            'visa_australia', 'visa_newzealand', 'visa_draft_cover_note',
            'tours_handled_packages', 'tours_worked_cost', 'tours_incentive_groups',
            'tours_mice_groups', 'tours_cruise_pax',
            'acc_record_transactions', 'acc_bank_cc_reconciliation', 'acc_corporate_card_reconciliation',
            'acc_track_commissions', 'acc_submit_invoices', 'acc_manage_financial_records',
            'acc_software_excel_proficient', 'acc_prepare_analyze_reports', 'acc_ensure_compliance',
            'acc_manage_ap_ar', 'acc_process_payroll_expenses', 'acc_calculate_pay_taxes',
            'acc_coordinate_auditors', 'acc_monitor_cashflow_forecast', 'acc_reconcile_bsp',
        ];

        foreach ($booleanFields as $field) {
            // Check if the field exists in validatedData and convert if it's 'Yes' or 'No'
            if (isset($validatedData[$field])) {
                $dataToStore[$field] = ($validatedData[$field] === 'Yes');
            } else {
                // If a radio button group is not selected, its key might not be present in $validatedData.
                // In such cases, store null or false, depending on your database schema's nullability.
                // Assuming 'nullable' boolean columns, setting to null is generally safe.
                $dataToStore[$field] = null;
            }
        }

        // Add other non-boolean specific fields from validatedData that weren't directly mapped above
        // For dynamic fields like 'other GDS names' or 'Schengen countries':
        $dataToStore['domestic_gds_type'] = $validatedData['domestic_gds_type'] ?? null;
        $dataToStore['domestic_gds_other_name'] = $validatedData['domestic_gds_other_name'] ?? null;
        $dataToStore['domestic_supplier_portal_name'] = $validatedData['domestic_supplier_portal_name'] ?? null;
        $dataToStore['intl_gds_type'] = $validatedData['intl_gds_type'] ?? null;
        $dataToStore['intl_gds_other_name'] = $validatedData['intl_gds_other_name'] ?? null;
        $dataToStore['visa_schengen_countries'] = $validatedData['visa_schengen_countries'] ?? null;
        $dataToStore['tours_countries'] = $validatedData['tours_countries'] ?? null;


        // 4. Create a new JobSeeker record in the database
        $jobSeeker = JobSeeker::create($dataToStore);

        // 5. Redirect with a success message
        return redirect()->back()->with('success', 'Your profile has been submitted successfully!');
    }

     public function jobseekersdatapage(){
        return view("Dashboard.Pages.jobseekers");
    }

    public function jobseekersdata(Request $request)
    {
        if ($request->ajax()) {
            // Select all columns from the job_seekers table
            $data = JobSeeker::select('*');

            return DataTables::of($data)
                ->addIndexColumn() // Adds the DT_RowIndex column for serial numbers (Sr.No.)
                ->addColumn('cv_download', function(JobSeeker $jobSeeker) {
                    if ($jobSeeker->cv_path) {
                        // Generate a URL for the stored file.
                        // IMPORTANT: Ensure 'php artisan storage:link' has been run
                        // to symlink storage/app/public to public/storage.
                        $url = Storage::url($jobSeeker->cv_path);
                        return '<a href="' . $url . '" class="btn btn-sm btn-primary" download>Download CV</a>';
                    }
                    return 'N/A'; // If no CV is available
                })
                ->addColumn('created_at_date', function(JobSeeker $jobSeeker) {
                    // Format the created_at timestamp as desired
                    return $jobSeeker->created_at->format('Y-m-d H:i:s');
                })
                // Add more custom columns to display 'Yes'/'No' for boolean fields
                ->addColumn('willing_to_relocate', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->willing_to_relocate ? 'Yes' : 'No';
                })
                ->addColumn('domestic_gds_itinerary', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_gds_itinerary ? 'Yes' : 'No';
                })
                ->addColumn('domestic_pnr_adult', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_pnr_adult ? 'Yes' : 'No';
                })
                ->addColumn('domestic_pnr_child_infant', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_pnr_child_infant ? 'Yes' : 'No';
                })
                ->addColumn('domestic_senior_citizen_fares', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_senior_citizen_fares ? 'Yes' : 'No';
                })
                ->addColumn('domestic_student_fares', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_student_fares ? 'Yes' : 'No';
                })
                ->addColumn('domestic_youth_special_fares', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_youth_special_fares ? 'Yes' : 'No';
                })
                ->addColumn('domestic_fare_mask', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_fare_mask ? 'Yes' : 'No';
                })
                ->addColumn('domestic_ticketing_gds', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_ticketing_gds ? 'Yes' : 'No';
                })
                ->addColumn('domestic_lcc_websites', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_lcc_websites ? 'Yes' : 'No';
                })
                ->addColumn('domestic_supplier_portal', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->domestic_supplier_portal ? 'Yes' : 'No';
                })
                ->addColumn('hotel_bookings_india', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->hotel_bookings_india ? 'Yes' : 'No';
                })
                ->addColumn('hotel_contact_direct', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->hotel_contact_direct ? 'Yes' : 'No';
                })
                ->addColumn('hotel_consolidator_websites', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->hotel_consolidator_websites ? 'Yes' : 'No';
                })
                ->addColumn('hotel_local_dmc', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->hotel_local_dmc ? 'Yes' : 'No';
                })
                ->addColumn('car_hire_city', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->car_hire_city ? 'Yes' : 'No';
                })
                ->addColumn('car_hire_other_cities', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->car_hire_other_cities ? 'Yes' : 'No';
                })
                ->addColumn('intl_gds_itinerary', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_gds_itinerary ? 'Yes' : 'No';
                })
                ->addColumn('intl_pnr_child_infant', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_pnr_child_infant ? 'Yes' : 'No';
                })
                ->addColumn('intl_senior_citizen_fares', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_senior_citizen_fares ? 'Yes' : 'No';
                })
                ->addColumn('intl_student_fares', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_student_fares ? 'Yes' : 'No';
                })
                ->addColumn('intl_youth_special_fares', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_youth_special_fares ? 'Yes' : 'No';
                })
                ->addColumn('intl_fare_mask', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_fare_mask ? 'Yes' : 'No';
                })
                ->addColumn('intl_queue_pnrs', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_queue_pnrs ? 'Yes' : 'No';
                })
                ->addColumn('intl_first_reissue', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_first_reissue ? 'Yes' : 'No';
                })
                ->addColumn('intl_subsequent_reissue', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_subsequent_reissue ? 'Yes' : 'No';
                })
                ->addColumn('intl_ticket_refunds', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_ticket_refunds ? 'Yes' : 'No';
                })
                ->addColumn('intl_hotac_rooms', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_hotac_rooms ? 'Yes' : 'No';
                })
                ->addColumn('intl_group_pnr', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_group_pnr ? 'Yes' : 'No';
                })
                ->addColumn('intl_issue_emd', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_issue_emd ? 'Yes' : 'No';
                })
                ->addColumn('intl_standalone_emd', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_standalone_emd ? 'Yes' : 'No';
                })
                ->addColumn('intl_associated_emd', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->intl_associated_emd ? 'Yes' : 'No';
                })
                ->addColumn('visa_aware_procedures', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_aware_procedures ? 'Yes' : 'No';
                })
                ->addColumn('visa_handled_personally', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_handled_personally ? 'Yes' : 'No';
                })
                ->addColumn('visa_in_department', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_in_department ? 'Yes' : 'No';
                })
                ->addColumn('visa_usa', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_usa ? 'Yes' : 'No';
                })
                ->addColumn('visa_canada', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_canada ? 'Yes' : 'No';
                })
                ->addColumn('visa_mexico', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_mexico ? 'Yes' : 'No';
                })
                ->addColumn('visa_brazil', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_brazil ? 'Yes' : 'No';
                })
                ->addColumn('visa_other_south_america', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_other_south_america ? 'Yes' : 'No';
                })
                ->addColumn('visa_uk', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_uk ? 'Yes' : 'No';
                })
                ->addColumn('visa_ireland', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_ireland ? 'Yes' : 'No';
                })
                ->addColumn('visa_haj_umrah', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_haj_umrah ? 'Yes' : 'No';
                })
                ->addColumn('visa_uae', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_uae ? 'Yes' : 'No';
                })
                ->addColumn('visa_russia', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_russia ? 'Yes' : 'No';
                })
                ->addColumn('visa_china', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_china ? 'Yes' : 'No';
                })
                ->addColumn('visa_vietnam', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->vietnam ? 'Yes' : 'No';
                })
                ->addColumn('visa_cambodia', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_cambodia ? 'Yes' : 'No';
                })
                ->addColumn('visa_hongkong', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_hongkong ? 'Yes' : 'No';
                })
                ->addColumn('visa_philippines', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_philippines ? 'Yes' : 'No';
                })
                ->addColumn('visa_singapore', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_singapore ? 'Yes' : 'No';
                })
                ->addColumn('visa_malaysia', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_malaysia ? 'Yes' : 'No';
                })
                ->addColumn('visa_australia', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_australia ? 'Yes' : 'No';
                })
                ->addColumn('visa_newzealand', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_newzealand ? 'Yes' : 'No';
                })
                ->addColumn('visa_draft_cover_note', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->visa_draft_cover_note ? 'Yes' : 'No';
                })
                ->addColumn('tours_handled_packages', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->tours_handled_packages ? 'Yes' : 'No';
                })
                ->addColumn('tours_worked_cost', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->tours_worked_cost ? 'Yes' : 'No';
                })
                ->addColumn('tours_incentive_groups', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->tours_incentive_groups ? 'Yes' : 'No';
                })
                ->addColumn('tours_mice_groups', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->tours_mice_groups ? 'Yes' : 'No';
                })
                ->addColumn('tours_cruise_pax', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->tours_cruise_pax ? 'Yes' : 'No';
                })
                ->addColumn('acc_record_transactions', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_record_transactions ? 'Yes' : 'No';
                })
                ->addColumn('acc_bank_cc_reconciliation', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_bank_cc_reconciliation ? 'Yes' : 'No';
                })
                ->addColumn('acc_corporate_card_reconciliation', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_corporate_card_reconciliation ? 'Yes' : 'No';
                })
                ->addColumn('acc_track_commissions', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_track_commissions ? 'Yes' : 'No';
                })
                ->addColumn('acc_submit_invoices', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_submit_invoices ? 'Yes' : 'No';
                })
                ->addColumn('acc_manage_financial_records', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_manage_financial_records ? 'Yes' : 'No';
                })
                ->addColumn('acc_software_excel_proficient', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_software_excel_proficient ? 'Yes' : 'No';
                })
                ->addColumn('acc_prepare_analyze_reports', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_prepare_analyze_reports ? 'Yes' : 'No';
                })
                ->addColumn('acc_ensure_compliance', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_ensure_compliance ? 'Yes' : 'No';
                })
                ->addColumn('acc_manage_ap_ar', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_manage_ap_ar ? 'Yes' : 'No';
                })
                ->addColumn('acc_process_payroll_expenses', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_process_payroll_expenses ? 'Yes' : 'No';
                })
                ->addColumn('acc_calculate_pay_taxes', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_calculate_pay_taxes ? 'Yes' : 'No';
                })
                ->addColumn('acc_coordinate_auditors', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_coordinate_auditors ? 'Yes' : 'No';
                })
                ->addColumn('acc_monitor_cashflow_forecast', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_monitor_cashflow_forecast ? 'Yes' : 'No';
                })
                ->addColumn('acc_reconcile_bsp', function(JobSeeker $jobSeeker) {
                    return $jobSeeker->acc_reconcile_bsp ? 'Yes' : 'No';
                })
                // ... continue for all other boolean fields ...

                ->rawColumns(['cv_download']) // Crucial: tells DataTables that this column contains HTML
                ->make(true);
        }
        abort(403, 'Unauthorized access.'); // Protect against direct access
    }
}