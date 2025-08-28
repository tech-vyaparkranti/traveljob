<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables; 
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon; // Make sure to use Carbon for date formatting



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
            'not_want_company' => 'required|string|max:255',

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
            'intl_mng_queues_upd_pnrs'=>'required|in:Yes,No',

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
            'intl_issue_emd', 'intl_standalone_emd', 'intl_associated_emd','intl_mng_queues_upd_pnrs',
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

    public function generateProfilePdf($id)
    {
        $jobSeeker = JobSeeker::find($id);

        if (!$jobSeeker) {
            return redirect()->back()->with('error', 'Job Seeker not found.');
        }

        // Load the view with the job seeker data
        $pdf = Pdf::loadView('pdfs.jobseeker_profile', compact('jobSeeker'));

        // Define a friendly filename for the PDF
        $givenName = Str::slug($jobSeeker->given_name);
        $familyName = Str::slug($jobSeeker->family_name);
        $pdfFileName = $givenName . '_' . $familyName . '_Profile.pdf';

        // Return the PDF for download
        return $pdf->download($pdfFileName);
    }

    public function jobseekersdatapage(){
        return view("Dashboard.Pages.jobseekers");
    }

    public function export(): StreamedResponse
    {
        $jobSeekers = JobSeeker::all(); // Fetch all job seeker records

        $csvFileName = 'job_seeker_full_data_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $callback = function() use ($jobSeekers) {
            $file = fopen('php://output', 'w');

            // Define CSV Headers (ensure these match your database columns and desired display names)
            fputcsv($file, [
                'ID',
                'Given Name',
                'Family Name',
                'Date of Birth',
                'Address',
                'Mobile No',
                'Personal Email',
                'Total Experience (Years)',
                'Current City',
                'Willing to Relocate',
                'Preferred Cities',
                'Current Salary',
                'not_want_company',

                // Domestic Travel Skills
                'Domestic GDS Itinerary',
                'Domestic PNR Adult',
                'Domestic PNR Child/Infant',
                'Domestic Senior Citizen Fares',
                'Domestic Student Fares',
                'Domestic Youth Special Fares',
                'Domestic Fare Mask',
                'Domestic Ticketing GDS',
                'Domestic GDS Type',
                'Domestic GDS Other Name',
                'Domestic LCC Websites',
                'Domestic Supplier Portal',
                'Domestic Supplier Portal Name',

                // Hotel & Car Hire Skills
                'Hotel Bookings India',
                'Hotel Contact Direct',
                'Hotel Consolidator Websites',
                'Hotel Local DMC',
                'Car Hire Current City',
                'Car Hire Other Cities',

                // International Travel Skills
                'Intl GDS Itinerary',
                'Intl PNR Child/Infant',
                'Intl Senior Citizen Fares',
                'Intl Student Fares',
                'Intl Youth Special Fares',
                'Intl Fare Mask',
                'Intl GDS Ticketing',
                'Intl GDS Type (Intl)',
                'Intl GDS Other Name (Intl)',
                'Intl Queue PNRs',
                'Intl First Reissue',
                'Intl Subsequent Reissue',
                'Intl Ticket Refunds',
                'Intl HOTAC Rooms',
                'Intl Group PNR',
                'Intl Issue EMD',
                'Intl Standalone EMD',
                'Intl Associated EMD',
                'intl_mng_queues_upd_pnrs',

                // Visa Processing Skills
                'Visa Aware Procedures',
                'Visa Handled Personally',
                'Visa In Department',
                'Visa USA',
                'Visa Canada',
                'Visa Mexico',
                'Visa Brazil',
                'Visa Other South America',
                'Visa UK',
                'Visa Ireland',
                'Visa Haj/Umrah',
                'Visa UAE',
                'Visa Schengen Countries',
                'Visa Russia',
                'Visa China',
                'Visa Vietnam',
                'Visa Cambodia',
                'Visa Hongkong',
                'Visa Philippines',
                'Visa Singapore',
                'Visa Malaysia',
                'Visa Australia',
                'Visa New Zealand',
                'Visa Draft Cover Note',

                // Tours & Packages Skills
                'Tours Handled Packages',
                'Tours Countries',
                'Tours Worked on Costing',
                'Tours Incentive Groups',
                'Tours MICE Groups',
                'Tours Cruise Passengers',

                // Accounting Skills
                'Acc Record Transactions',
                'Acc Bank/CC Reconciliation',
                'Acc Corporate Card Reconciliation',
                'Acc Track Commissions',
                'Acc Submit Invoices',
                'Acc Manage Financial Records',
                'Acc Software/Excel Proficient',
                'Acc Prepare/Analyze Reports',
                'Acc Ensure Compliance',
                'Acc Manage AP/AR',
                'Acc Process Payroll/Expenses',
                'Acc Calculate/Pay Taxes',
                'Acc Coordinate Auditors',
                'Acc Monitor Cashflow/Forecast',
                'Acc Reconcile BSP',

                'CV Path', // Path to CV file
                'Created At',
                'Updated At',
            ]);

            // Add data rows
            foreach ($jobSeekers as $jobSeeker) {
                fputcsv($file, [
                    $jobSeeker->id,
                    $jobSeeker->given_name,
                    $jobSeeker->family_name,
                    $jobSeeker->dob ? Carbon::parse($jobSeeker->dob)->format('d M, Y') : null,
                    $jobSeeker->address,
                    $jobSeeker->mobile_no,
                    $jobSeeker->personal_email,
                    $jobSeeker->total_experience,
                    $jobSeeker->current_city,
                    $jobSeeker->willing_to_relocate ? 'Yes' : 'No',
                    $jobSeeker->preferred_cities,
                    $jobSeeker->current_salary ? number_format($jobSeeker->current_salary, 2) : null,

                    // Domestic Travel Skills
                    $jobSeeker->domestic_gds_itinerary ? 'Yes' : 'No',
                    $jobSeeker->domestic_pnr_adult ? 'Yes' : 'No',
                    $jobSeeker->domestic_pnr_child_infant ? 'Yes' : 'No',
                    $jobSeeker->domestic_senior_citizen_fares ? 'Yes' : 'No',
                    $jobSeeker->domestic_student_fares ? 'Yes' : 'No',
                    $jobSeeker->domestic_youth_special_fares ? 'Yes' : 'No',
                    $jobSeeker->domestic_fare_mask ? 'Yes' : 'No',
                    $jobSeeker->domestic_ticketing_gds ? 'Yes' : 'No',
                    $jobSeeker->domestic_gds_type,
                    $jobSeeker->domestic_gds_other_name,
                    $jobSeeker->domestic_lcc_websites ? 'Yes' : 'No',
                    $jobSeeker->domestic_supplier_portal ? 'Yes' : 'No',
                    $jobSeeker->domestic_supplier_portal_name,

                    // Hotel & Car Hire Skills
                    $jobSeeker->hotel_bookings_india ? 'Yes' : 'No',
                    $jobSeeker->hotel_contact_direct ? 'Yes' : 'No',
                    $jobSeeker->hotel_consolidator_websites ? 'Yes' : 'No',
                    $jobSeeker->hotel_local_dmc ? 'Yes' : 'No',
                    $jobSeeker->car_hire_city ? 'Yes' : 'No',
                    $jobSeeker->car_hire_other_cities ? 'Yes' : 'No',

                    // International Travel Skills
                    $jobSeeker->intl_gds_itinerary ? 'Yes' : 'No',
                    $jobSeeker->intl_pnr_child_infant ? 'Yes' : 'No',
                    $jobSeeker->intl_senior_citizen_fares ? 'Yes' : 'No',
                    $jobSeeker->intl_student_fares ? 'Yes' : 'No',
                    $jobSeeker->intl_youth_special_fares ? 'Yes' : 'No',
                    $jobSeeker->intl_fare_mask ? 'Yes' : 'No',
                    $jobSeeker->intl_gds_type ? 'Yes' : 'No', // This was a boolean check in HTML, but here it's the GDS Type. Revisit if this should be $jobSeeker->intl_gds_ticketing
                    $jobSeeker->intl_gds_type,
                    $jobSeeker->intl_gds_other_name,
                    $jobSeeker->intl_queue_pnrs ? 'Yes' : 'No',
                    $jobSeeker->intl_first_reissue ? 'Yes' : 'No',
                    $jobSeeker->intl_subsequent_reissue ? 'Yes' : 'No',
                    $jobSeeker->intl_ticket_refunds ? 'Yes' : 'No',
                    $jobSeeker->intl_hotac_rooms ? 'Yes' : 'No',
                    $jobSeeker->intl_group_pnr ? 'Yes' : 'No',
                    $jobSeeker->intl_issue_emd ? 'Yes' : 'No',
                    $jobSeeker->intl_standalone_emd ? 'Yes' : 'No',
                    $jobSeeker->intl_associated_emd ? 'Yes' : 'No',
                    $jobSeeker->intl_mng_queues_upd_pnrs ? 'Yes' : 'No',
       
                    // Visa Processing Skills
                    $jobSeeker->visa_aware_procedures ? 'Yes' : 'No',
                    $jobSeeker->visa_handled_personally ? 'Yes' : 'No',
                    $jobSeeker->visa_in_department ? 'Yes' : 'No',
                    $jobSeeker->visa_usa ? 'Yes' : 'No',
                    $jobSeeker->visa_canada ? 'Yes' : 'No',
                    $jobSeeker->visa_mexico ? 'Yes' : 'No',
                    $jobSeeker->visa_brazil ? 'Yes' : 'No',
                    $jobSeeker->visa_other_south_america ? 'Yes' : 'No',
                    $jobSeeker->visa_uk ? 'Yes' : 'No',
                    $jobSeeker->visa_ireland ? 'Yes' : 'No',
                    $jobSeeker->visa_haj_umrah ? 'Yes' : 'No',
                    $jobSeeker->visa_uae ? 'Yes' : 'No',
                    $jobSeeker->visa_schengen_countries,
                    $jobSeeker->visa_russia ? 'Yes' : 'No',
                    $jobSeeker->visa_china ? 'Yes' : 'No',
                    $jobSeeker->visa_vietnam ? 'Yes' : 'No',
                    $jobSeeker->visa_cambodia ? 'Yes' : 'No',
                    $jobSeeker->visa_hongkong ? 'Yes' : 'No',
                    $jobSeeker->visa_philippines ? 'Yes' : 'No',
                    $jobSeeker->visa_singapore ? 'Yes' : 'No',
                    $jobSeeker->visa_malaysia ? 'Yes' : 'No',
                    $jobSeeker->visa_australia ? 'Yes' : 'No',
                    $jobSeeker->visa_newzealand ? 'Yes' : 'No',
                    $jobSeeker->visa_draft_cover_note ? 'Yes' : 'No',

                    // Tours & Packages Skills
                    $jobSeeker->tours_handled_packages ? 'Yes' : 'No',
                    $jobSeeker->tours_countries,
                    $jobSeeker->tours_worked_cost ? 'Yes' : 'No',
                    $jobSeeker->tours_incentive_groups ? 'Yes' : 'No',
                    $jobSeeker->tours_mice_groups ? 'Yes' : 'No',
                    $jobSeeker->tours_cruise_pax ? 'Yes' : 'No',

                    // Accounting Skills
                    $jobSeeker->acc_record_transactions ? 'Yes' : 'No',
                    $jobSeeker->acc_bank_cc_reconciliation ? 'Yes' : 'No',
                    $jobSeeker->acc_corporate_card_reconciliation ? 'Yes' : 'No',
                    $jobSeeker->acc_track_commissions ? 'Yes' : 'No',
                    $jobSeeker->acc_submit_invoices ? 'Yes' : 'No',
                    $jobSeeker->acc_manage_financial_records ? 'Yes' : 'No',
                    $jobSeeker->acc_software_excel_proficient ? 'Yes' : 'No',
                    $jobSeeker->acc_prepare_analyze_reports ? 'Yes' : 'No',
                    $jobSeeker->acc_ensure_compliance ? 'Yes' : 'No',
                    $jobSeeker->acc_manage_ap_ar ? 'Yes' : 'No',
                    $jobSeeker->acc_process_payroll_expenses ? 'Yes' : 'No',
                    $jobSeeker->acc_calculate_pay_taxes ? 'Yes' : 'No',
                    $jobSeeker->acc_coordinate_auditors ? 'Yes' : 'No',
                    $jobSeeker->acc_monitor_cashflow_forecast ? 'Yes' : 'No',
                    $jobSeeker->acc_reconcile_bsp ? 'Yes' : 'No',

                    $jobSeeker->cv_path,
                    $jobSeeker->created_at ? Carbon::parse($jobSeeker->created_at)->format('d M, Y H:i:s') : null,
                    $jobSeeker->updated_at ? Carbon::parse($jobSeeker->updated_at)->format('d M, Y H:i:s') : null,
                ]);
            }
            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
    public function jobseekersdata(Request $request)
{
    if ($request->ajax()) {
        $data = JobSeeker::select('id', 'given_name', 'family_name', 'personal_email', 'mobile_no', 'total_experience', 'cv_path', 'created_at');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('cv_download', function(JobSeeker $jobSeeker) {
                if ($jobSeeker->cv_path) {
                    $url = route('jobseeker.download_cv', ['id' => $jobSeeker->id]);
                    return '<a href="' . $url . '" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Download CV</a>';
                }
                return 'N/A';
            })
            ->addColumn('profile_pdf', function(JobSeeker $jobSeeker) { // <-- NEW COLUMN
                $url = route('jobseeker.generate_profile_pdf', ['id' => $jobSeeker->id]);
                return '<a href="' . $url . '" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Download Profile PDF</a>';
            })
            ->addColumn('created_at_formatted', function(JobSeeker $jobSeeker) {
                return $jobSeeker->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['cv_download', 'profile_pdf']) // <-- Add 'profile_pdf' here
            ->make(true);
    }
    abort(403, 'Unauthorized access.');
}

    /**
     * Handles the CV file download.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
   public function downloadCv($id)
    {
        $jobSeeker = JobSeeker::find($id);

        if (!$jobSeeker || !$jobSeeker->cv_path) {
            return redirect()->back()->with('error', 'CV file not found or path is missing.');
        }

        // The path stored in cv_path is relative to the 'public' disk root (storage/app/public)
        if (!Storage::disk('public')->exists($jobSeeker->cv_path)) {
            // It's a good idea to log this for actual debugging on a server
            \Log::error('CV file not found on public disk: ' . $jobSeeker->cv_path);
            return redirect()->back()->with('error', 'CV file does not exist on the server.');
        }

        // --- CHANGES START HERE ---

        // 1. Get the original file extension
        $extension = pathinfo($jobSeeker->cv_path, PATHINFO_EXTENSION);

        // 2. Construct the desired filename using given_name and family_name
        // Sanitize the names to be safe for filenames (e.g., replace spaces with hyphens)
        $givenName = Str::slug($jobSeeker->given_name);
        $familyName = Str::slug($jobSeeker->family_name);

        // Combine them, add "CV", and append the original extension
        $newFileName = $givenName . '_' . $familyName . '_CV.' . $extension;

        // Ensure the path is correct for the Storage::download method
        // You had changed this line in your last snippet. We need to revert to using
        // Storage::disk('public')->download() because it correctly handles the symlink.
        // response()->download() expects a full, absolute server path.
        // Storage::disk('public')->download() expects the path relative to the disk's root.
        return Storage::disk('public')->download($jobSeeker->cv_path, $newFileName);

        // --- CHANGES END HERE ---
    }
}
