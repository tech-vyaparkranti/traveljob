<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class EmployerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255|unique:employers,contact_email',
            'contact_mobile' => 'required|string|max:20',
            'min_travel_trade_experience_years' => 'nullable|integer|min:0',

            // Validation rules for all your other fields (domestic, international, etc.)
            // For boolean fields (Yes/No), they should be 'in:Yes,No' and then converted
            'desired_domestic_travel_expertise' => 'nullable|in:Yes,No',
            'desired_hotel_car_hire_expertise' => 'nullable|in:Yes,No',
            'desired_international_travel_expertise' => 'nullable|in:Yes,No',
            'desired_visa_handling_expertise' => 'nullable|in:Yes,No',
            'desired_tours_holiday_packages_expertise' => 'nullable|in:Yes,No',
            'desired_accounting_expertise' => 'nullable|in:Yes,No',
            
            // Domestic Travel Fields
            'domestic_gds_itinerary' => 'nullable|in:Yes,No',
            'domestic_pnr_adult' => 'nullable|in:Yes,No',
            'domestic_pnr_child_infant' => 'nullable|in:Yes,No',
            'domestic_senior_citizen_fares' => 'nullable|in:Yes,No',
            'domestic_student_fares' => 'nullable|in:Yes,No',
            'domestic_youth_special_fares' => 'nullable|in:Yes,No',
            'domestic_fare_mask' => 'nullable|in:Yes,No',
            'domestic_ticketing_gds' => 'nullable|in:Yes,No',
            'domestic_gds_type' => 'nullable|string',
            'domestic_lcc_websites' => 'nullable|in:Yes,No',
            'domestic_supplier_portal' => 'nullable|in:Yes,No',
            'domestic_supplier_portal_name' => 'nullable|string|max:255',

            // Hotel Bookings & Car Hire Fields
            'hotel_bookings_india' => 'nullable|in:Yes,No',
            'hotel_contact_direct' => 'nullable|in:Yes,No',
            'hotel_consolidator_websites' => 'nullable|in:Yes,No',
            'hotel_local_dmc' => 'nullable|in:Yes,No',
            'car_hire_city' => 'nullable|in:Yes,No',
            'car_hire_other_cities' => 'nullable|in:Yes,No',

            // International Travel Fields
            'intl_gds_itinerary' => 'nullable|in:Yes,No',
            'intl_pnr_child_infant' => 'nullable|in:Yes,No',
            'intl_senior_citizen_fares' => 'nullable|in:Yes,No',
            'intl_student_fares' => 'nullable|in:Yes,No',
            'intl_youth_special_fares' => 'nullable|in:Yes,No',
            'intl_fare_mask' => 'nullable|in:Yes,No',
            'intl_gds_type' => 'nullable|string',
            'intl_queue_pnrs' => 'nullable|in:Yes,No',
            'intl_first_reissue' => 'nullable|in:Yes,No',
            'intl_subsequent_reissue' => 'nullable|in:Yes,No',
            'intl_ticket_refunds' => 'nullable|in:Yes,No',
            'intl_hotac_rooms' => 'nullable|in:Yes,No',
            'intl_group_pnr' => 'nullable|in:Yes,No',
            'intl_issue_emd' => 'nullable|in:Yes,No',
            'intl_standalone_emd' => 'nullable|in:Yes,No',
            'intl_associated_emd' => 'nullable|in:Yes,No',

            // VISA Handling Fields
            'visa_aware_procedures' => 'nullable|in:Yes,No',
            'visa_handled_personally' => 'nullable|in:Yes,No',
            'visa_in_department' => 'nullable|in:Yes,No',
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

            // TOURS AND HOLIDAY PACKAGES Fields
            'tours_handled_packages' => 'nullable|in:Yes,No',
            'tours_countries' => 'nullable|string|max:255',
            'tours_worked_cost' => 'nullable|in:Yes,No',
            'tours_incentive_groups' => 'nullable|in:Yes,No',
            'tours_mice_groups' => 'nullable|in:Yes,No',
            'tours_cruise_pax' => 'nullable|in:Yes,No',

            // ACCOUNTING Fields
            'acc_record_transactions' => 'nullable|in:Yes,No',
            'acc_bank_cc_reconciliation' => 'nullable|in:Yes,No',
            'acc_corporate_card_reconciliation' => 'nullable|in:Yes,No',
            'acc_track_commissions' => 'nullable|in:Yes,No',
            'acc_submit_invoices' => 'nullable|in:Yes,No',
            'acc_manage_financial_records' => 'nullable|in:Yes,No',
            'acc_software_excel_proficient' => 'nullable|in:Yes,No',
            'acc_prepare_analyze_reports' => 'nullable|in:Yes,No',
            'acc_ensure_compliance' => 'nullable|in:Yes,No',
            'acc_manage_ap_ar' => 'nullable|in:Yes,No',
            'acc_process_payroll_expenses' => 'nullable|in:Yes,No',
            'acc_calculate_pay_taxes' => 'nullable|in:Yes,No',
            'acc_coordinate_auditors' => 'nullable|in:Yes,No',
            'acc_monitor_cashflow_forecast' => 'nullable|in:Yes,No',
            'acc_reconcile_bsp' => 'nullable|in:Yes,No',
        ]);

        // 2. Prepare data for insertion, converting 'Yes'/'No' strings to booleans
        $dataToStore = [
            'company_name' => $validatedData['company_name'],
            'contact_person' => $validatedData['contact_person'],
            'contact_email' => $validatedData['contact_email'],
            'contact_mobile' => $validatedData['contact_mobile'],
            'min_travel_trade_experience_years' => $validatedData['min_travel_trade_experience_years'],
        ];

        // List all fields that require 'Yes'/'No' to boolean conversion
        $booleanFields = [
            'desired_domestic_travel_expertise', 'desired_hotel_car_hire_expertise',
            'desired_international_travel_expertise', 'desired_visa_handling_expertise',
            'desired_tours_holiday_packages_expertise', 'desired_accounting_expertise',
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
                $dataToStore[$field] = null;
            }
        }

        // Add other non-boolean specific fields from validatedData
        $dataToStore['domestic_gds_type'] = $validatedData['domestic_gds_type'] ?? null;
        $dataToStore['domestic_supplier_portal_name'] = $validatedData['domestic_supplier_portal_name'] ?? null;
        $dataToStore['intl_gds_type'] = $validatedData['intl_gds_type'] ?? null;
        $dataToStore['visa_schengen_countries'] = $validatedData['visa_schengen_countries'] ?? null;
        $dataToStore['tours_countries'] = $validatedData['tours_countries'] ?? null;


        // 3. Create a new Employer record in the database
        $employer = Employer::create($dataToStore);

        // 4. Redirect with a success message
        return redirect()->back()->with('success', 'Employer profile has been submitted successfully!');
    }

    /**
     * Display the employer data page.
     *
     * @return \Illuminate\Http\Response
     */
    public function employersDataPage()
    {
        return view("Dashboard.Pages.employers");
    }

    /**
     * Returns a JSON response for DataTables.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function employersData(Request $request)
    {
        if ($request->ajax()) {
            $data = Employer::select('id', 'company_name', 'contact_person', 'contact_email', 'contact_mobile', 'created_at');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('profile_pdf', function(Employer $employer) {
                    $url = route('employer.generate_profile_pdf', ['id' => $employer->id]);
                    return '<a href="' . $url . '" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> Download Profile PDF</a>';
                })
                ->addColumn('created_at_formatted', function(Employer $employer) {
                    return $employer->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['profile_pdf'])
                ->make(true);
        }
        abort(403, 'Unauthorized access.');
    }

    /**
     * Generate and download a PDF of the employer's profile.
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function generateProfilePdf($id)
    {
        $employer = Employer::find($id);

        if (!$employer) {
            return redirect()->back()->with('error', 'Employer not found.');
        }

        // Load the view with the employer data
        // You'll need to create a view file at resources/views/pdfs/employer_profile.blade.php
        $pdf = Pdf::loadView('pdfs.employer_profile', compact('employer'));

        // Define a friendly filename for the PDF
        $companyName = Str::slug($employer->company_name);
        $pdfFileName = $companyName . '_Profile.pdf';

        // Return the PDF for download
        return $pdf->download($pdfFileName);
    }


    /**
     * Export all employer data to a CSV file.
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export(): StreamedResponse
    {
        $employers = Employer::all(); // Fetch all employer records

        $csvFileName = 'employer_full_data_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $callback = function() use ($employers) {
            $file = fopen('php://output', 'w');

            // Define CSV Headers (ensure these match your database columns)
            fputcsv($file, [
                'ID', 'Company Name', 'Contact Person', 'Contact Email', 'Contact Mobile',
                'Min. Travel Trade Experience (Years)',
                // Expertise
                'Desired Domestic Travel Expertise', 'Desired Hotel & Car Hire Expertise',
                'Desired International Travel Expertise', 'Desired Visa Handling Expertise',
                'Desired Tours & Packages Expertise', 'Desired Accounting Expertise',
                // Domestic Travel Fields
                'Domestic GDS Itinerary', 'Domestic PNR Adult', 'Domestic PNR Child/Infant',
                'Domestic Senior Citizen Fares', 'Domestic Student Fares', 'Domestic Youth Special Fares',
                'Domestic Fare Mask', 'Domestic Ticketing GDS', 'Domestic GDS Type', 'Domestic LCC Websites',
                'Domestic Supplier Portal', 'Domestic Supplier Portal Name',
                // Hotel & Car Hire Fields
                'Hotel Bookings India', 'Hotel Contact Direct', 'Hotel Consolidator Websites',
                'Hotel Local DMC', 'Car Hire City', 'Car Hire Other Cities',
                // International Travel Fields
                'Intl GDS Itinerary', 'Intl PNR Child/Infant', 'Intl Senior Citizen Fares',
                'Intl Student Fares', 'Intl Youth Special Fares', 'Intl Fare Mask',
                'Intl GDS Type', 'Intl Queue PNRs', 'Intl First Reissue', 'Intl Subsequent Reissue',
                'Intl Ticket Refunds', 'Intl HOTAC Rooms', 'Intl Group PNR', 'Intl Issue EMD',
                'Intl Standalone EMD', 'Intl Associated EMD',
                // Visa Processing Skills
                'Visa Aware Procedures', 'Visa Handled Personally', 'Visa In Department',
                'Visa USA', 'Visa Canada', 'Visa Mexico', 'Visa Brazil',
                'Visa Other South America', 'Visa UK', 'Visa Ireland', 'Visa Haj/Umrah',
                'Visa UAE', 'Visa Schengen Countries', 'Visa Russia', 'Visa China',
                'Visa Vietnam', 'Visa Cambodia', 'Visa Hongkong', 'Visa Philippines',
                'Visa Singapore', 'Visa Malaysia', 'Visa Australia', 'Visa New Zealand',
                'Visa Draft Cover Note',
                // Tours & Packages Skills
                'Tours Handled Packages', 'Tours Countries', 'Tours Worked on Costing',
                'Tours Incentive Groups', 'Tours MICE Groups', 'Tours Cruise Passengers',
                // Accounting Skills
                'Acc Record Transactions', 'Acc Bank/CC Reconciliation', 'Acc Corporate Card Reconciliation',
                'Acc Track Commissions', 'Acc Submit Invoices', 'Acc Manage Financial Records',
                'Acc Software/Excel Proficient', 'Acc Prepare/Analyze Reports', 'Acc Ensure Compliance',
                'Acc Manage AP/AR', 'Acc Process Payroll/Expenses', 'Acc Calculate/Pay Taxes',
                'Acc Coordinate Auditors', 'Acc Monitor Cashflow/Forecast', 'Acc Reconcile BSP',
                // Timestamps
                'Created At', 'Updated At',
            ]);

            // Add data rows
            foreach ($employers as $employer) {
                fputcsv($file, [
                    $employer->id,
                    $employer->company_name,
                    $employer->contact_person,
                    $employer->contact_email,
                    $employer->contact_mobile,
                    $employer->min_travel_trade_experience_years,
                    $employer->desired_domestic_travel_expertise ? 'Yes' : 'No',
                    $employer->desired_hotel_car_hire_expertise ? 'Yes' : 'No',
                    $employer->desired_international_travel_expertise ? 'Yes' : 'No',
                    $employer->desired_visa_handling_expertise ? 'Yes' : 'No',
                    $employer->desired_tours_holiday_packages_expertise ? 'Yes' : 'No',
                    $employer->desired_accounting_expertise ? 'Yes' : 'No',
                    // Domestic Travel Skills
                    $employer->domestic_gds_itinerary ? 'Yes' : 'No',
                    $employer->domestic_pnr_adult ? 'Yes' : 'No',
                    $employer->domestic_pnr_child_infant ? 'Yes' : 'No',
                    $employer->domestic_senior_citizen_fares ? 'Yes' : 'No',
                    $employer->domestic_student_fares ? 'Yes' : 'No',
                    $employer->domestic_youth_special_fares ? 'Yes' : 'No',
                    $employer->domestic_fare_mask ? 'Yes' : 'No',
                    $employer->domestic_ticketing_gds ? 'Yes' : 'No',
                    $employer->domestic_gds_type,
                    $employer->domestic_lcc_websites ? 'Yes' : 'No',
                    $employer->domestic_supplier_portal ? 'Yes' : 'No',
                    $employer->domestic_supplier_portal_name,
                    // Hotel & Car Hire Skills
                    $employer->hotel_bookings_india ? 'Yes' : 'No',
                    $employer->hotel_contact_direct ? 'Yes' : 'No',
                    $employer->hotel_consolidator_websites ? 'Yes' : 'No',
                    $employer->hotel_local_dmc ? 'Yes' : 'No',
                    $employer->car_hire_city ? 'Yes' : 'No',
                    $employer->car_hire_other_cities ? 'Yes' : 'No',
                    // International Travel Skills
                    $employer->intl_gds_itinerary ? 'Yes' : 'No',
                    $employer->intl_pnr_child_infant ? 'Yes' : 'No',
                    $employer->intl_senior_citizen_fares ? 'Yes' : 'No',
                    $employer->intl_student_fares ? 'Yes' : 'No',
                    $employer->intl_youth_special_fares ? 'Yes' : 'No',
                    $employer->intl_fare_mask ? 'Yes' : 'No',
                    $employer->intl_gds_type,
                    $employer->intl_queue_pnrs ? 'Yes' : 'No',
                    $employer->intl_first_reissue ? 'Yes' : 'No',
                    $employer->intl_subsequent_reissue ? 'Yes' : 'No',
                    $employer->intl_ticket_refunds ? 'Yes' : 'No',
                    $employer->intl_hotac_rooms ? 'Yes' : 'No',
                    $employer->intl_group_pnr ? 'Yes' : 'No',
                    $employer->intl_issue_emd ? 'Yes' : 'No',
                    $employer->intl_standalone_emd ? 'Yes' : 'No',
                    $employer->intl_associated_emd ? 'Yes' : 'No',
                    // Visa Processing Skills
                    $employer->visa_aware_procedures ? 'Yes' : 'No',
                    $employer->visa_handled_personally ? 'Yes' : 'No',
                    $employer->visa_in_department ? 'Yes' : 'No',
                    $employer->visa_usa ? 'Yes' : 'No',
                    $employer->visa_canada ? 'Yes' : 'No',
                    $employer->visa_mexico ? 'Yes' : 'No',
                    $employer->visa_brazil ? 'Yes' : 'No',
                    $employer->visa_other_south_america ? 'Yes' : 'No',
                    $employer->visa_uk ? 'Yes' : 'No',
                    $employer->visa_ireland ? 'Yes' : 'No',
                    $employer->visa_haj_umrah ? 'Yes' : 'No',
                    $employer->visa_uae ? 'Yes' : 'No',
                    $employer->visa_schengen_countries,
                    $employer->visa_russia ? 'Yes' : 'No',
                    $employer->visa_china ? 'Yes' : 'No',
                    $employer->visa_vietnam ? 'Yes' : 'No',
                    $employer->visa_cambodia ? 'Yes' : 'No',
                    $employer->visa_hongkong ? 'Yes' : 'No',
                    $employer->visa_philippines ? 'Yes' : 'No',
                    $employer->visa_singapore ? 'Yes' : 'No',
                    $employer->visa_malaysia ? 'Yes' : 'No',
                    $employer->visa_australia ? 'Yes' : 'No',
                    $employer->visa_newzealand ? 'Yes' : 'No',
                    $employer->visa_draft_cover_note ? 'Yes' : 'No',
                    // Tours & Packages Skills
                    $employer->tours_handled_packages ? 'Yes' : 'No',
                    $employer->tours_countries,
                    $employer->tours_worked_cost ? 'Yes' : 'No',
                    $employer->tours_incentive_groups ? 'Yes' : 'No',
                    $employer->tours_mice_groups ? 'Yes' : 'No',
                    $employer->tours_cruise_pax ? 'Yes' : 'No',
                    // Accounting Skills
                    $employer->acc_record_transactions ? 'Yes' : 'No',
                    $employer->acc_bank_cc_reconciliation ? 'Yes' : 'No',
                    $employer->acc_corporate_card_reconciliation ? 'Yes' : 'No',
                    $employer->acc_track_commissions ? 'Yes' : 'No',
                    $employer->acc_submit_invoices ? 'Yes' : 'No',
                    $employer->acc_manage_financial_records ? 'Yes' : 'No',
                    $employer->acc_software_excel_proficient ? 'Yes' : 'No',
                    $employer->acc_prepare_analyze_reports ? 'Yes' : 'No',
                    $employer->acc_ensure_compliance ? 'Yes' : 'No',
                    $employer->acc_manage_ap_ar ? 'Yes' : 'No',
                    $employer->acc_process_payroll_expenses ? 'Yes' : 'No',
                    $employer->acc_calculate_pay_taxes ? 'Yes' : 'No',
                    $employer->acc_coordinate_auditors ? 'Yes' : 'No',
                    $employer->acc_monitor_cashflow_forecast ? 'Yes' : 'No',
                    $employer->acc_reconcile_bsp ? 'Yes' : 'No',
                    // Timestamps
                    $employer->created_at ? Carbon::parse($employer->created_at)->format('d M, Y H:i:s') : null,
                    $employer->updated_at ? Carbon::parse($employer->updated_at)->format('d M, Y H:i:s') : null,
                ]);
            }
            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
