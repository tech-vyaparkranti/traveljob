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
            'given_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'address' => 'required|string',
            'mobile_no' => 'required|string|max:255',
            'personal_email' => 'required|string|email|max:255|unique:employers,contact_email',
            'total_experience' => 'nullable|integer',
            'areas_of_expertise' => 'nullable|array',

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
            'domestic_gds_other_name' => 'nullable|string',
            'domestic_lcc_websites' => 'nullable|in:Yes,No',
            'domestic_supplier_portal' => 'nullable|in:Yes,No',
            'domestic_supplier_portal_name' => 'nullable|string',

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
            'intl_gds_other_name' => 'nullable|string',
            'intl_queue_pnrs' => 'nullable|in:Yes,No',
            'intl_first_reissue' => 'nullable|in:Yes,No',
            'intl_subsequent_reissue' => 'nullable|in:Yes,No',
            'intl_ticket_refunds' => 'nullable|in:Yes,No',
            'intl_hotac_rooms' => 'nullable|in:Yes,No',
            'intl_group_pnr' => 'nullable|in:Yes,No',
            'intl_issue_emd' => 'nullable|in:Yes,No',
            'intl_standalone_emd' => 'nullable|in:Yes,No',
            'intl_associated_emd' => 'nullable|in:Yes,No',
            'intl_mng_queues_upd_pnrs'=>'nullable|in:Yes,No',

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
            'visa_schengen_countries' => 'nullable|string',
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
            'tours_countries' => 'nullable|string',
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
        
        $areasOfExpertise = $request->input('areas_of_expertise') ?? [];

        Employer::create([
            'company_name' => $validatedData['given_name'],
            'contact_person' => $validatedData['family_name'],
            'address' => $validatedData['address'],
            'contact_mobile' => $validatedData['mobile_no'],
            'contact_email' => $validatedData['personal_email'],
            'min_travel_trade_experience_years' => $validatedData['total_experience'],
            
            // Expertise Checkboxes
            'desired_domestic_travel_expertise' => in_array('Domestic Travel', $areasOfExpertise),
            'desired_hotel_car_hire_expertise' => in_array('Hotel Bookings & Car Hire', $areasOfExpertise),
            'desired_international_travel_expertise' => in_array('International Travel', $areasOfExpertise),
            'desired_visa_handling_expertise' => in_array('VISA Handling', $areasOfExpertise),
            'desired_tours_holiday_packages_expertise' => in_array('Tours and Holiday Packages', $areasOfExpertise),
            'desired_accounting_expertise' => in_array('Accounting', $areasOfExpertise),

            // Domestic Travel Fields
            'domestic_gds_itinerary' => $request->input('domestic_gds_itinerary') === 'Yes',
            'domestic_pnr_adult' => $request->input('domestic_pnr_adult') === 'Yes',
            'domestic_pnr_child_infant' => $request->input('domestic_pnr_child_infant') === 'Yes',
            'domestic_senior_citizen_fares' => $request->input('domestic_senior_citizen_fares') === 'Yes',
            'domestic_student_fares' => $request->input('domestic_student_fares') === 'Yes',
            'domestic_youth_special_fares' => $request->input('domestic_youth_special_fares') === 'Yes',
            'domestic_fare_mask' => $request->input('domestic_fare_mask') === 'Yes',
            'domestic_ticketing_gds' => $request->input('domestic_ticketing_gds') === 'Yes',
            'domestic_gds_type' => $request->input('domestic_gds_type'),
            'domestic_gds_other_name' => $request->input('domestic_gds_other_name'),
            'domestic_lcc_websites' => $request->input('domestic_lcc_websites') === 'Yes',
            'domestic_supplier_portal' => $request->input('domestic_supplier_portal') === 'Yes',
            'domestic_supplier_portal_name' => $request->input('domestic_supplier_portal_name'),

            // Hotel Bookings & Car Hire Fields
            'hotel_bookings_india' => $request->input('hotel_bookings_india') === 'Yes',
            'hotel_contact_direct' => $request->input('hotel_contact_direct') === 'Yes',
            'hotel_consolidator_websites' => $request->input('hotel_consolidator_websites') === 'Yes',
            'hotel_local_dmc' => $request->input('hotel_local_dmc') === 'Yes',
            'car_hire_city' => $request->input('car_hire_city') === 'Yes',
            'car_hire_other_cities' => $request->input('car_hire_other_cities') === 'Yes',

            // International Travel Fields
            'intl_gds_itinerary' => $request->input('intl_gds_itinerary') === 'Yes',
            'intl_pnr_child_infant' => $request->input('intl_pnr_child_infant') === 'Yes',
            'intl_senior_citizen_fares' => $request->input('intl_senior_citizen_fares') === 'Yes',
            'intl_student_fares' => $request->input('intl_student_fares') === 'Yes',
            'intl_youth_special_fares' => $request->input('intl_youth_special_fares') === 'Yes',
            'intl_fare_mask' => $request->input('intl_fare_mask') === 'Yes',
            'intl_gds_type' => $request->input('intl_gds_type'),
            'intl_gds_other_name' => $request->input('intl_gds_other_name'),
            'intl_queue_pnrs' => $request->input('intl_queue_pnrs') === 'Yes',
            'intl_first_reissue' => $request->input('intl_first_reissue') === 'Yes',
            'intl_subsequent_reissue' => $request->input('intl_subsequent_reissue') === 'Yes',
            'intl_ticket_refunds' => $request->input('intl_ticket_refunds') === 'Yes',
            'intl_hotac_rooms' => $request->input('intl_hotac_rooms') === 'Yes',
            'intl_group_pnr' => $request->input('intl_group_pnr') === 'Yes',
            'intl_issue_emd' => $request->input('intl_issue_emd') === 'Yes',
            'intl_standalone_emd' => $request->input('intl_standalone_emd') === 'Yes',
            'intl_associated_emd' => $request->input('intl_associated_emd') === 'Yes',
             'intl_mng_queues_upd_pnrs'=>$request->input('intl_mng_queues_upd_pnrs') === 'Yes',
            // VISA Handling Fields
            'visa_aware_procedures' => $request->input('visa_aware_procedures') === 'Yes',
            'visa_handled_personally' => $request->input('visa_handled_personally') === 'Yes',
            'visa_in_department' => $request->input('visa_in_department') === 'Yes',
            'visa_usa' => $request->input('visa_usa') === 'Yes',
            'visa_canada' => $request->input('visa_canada') === 'Yes',
            'visa_mexico' => $request->input('visa_mexico') === 'Yes',
            'visa_brazil' => $request->input('visa_brazil') === 'Yes',
            'visa_other_south_america' => $request->input('visa_other_south_america') === 'Yes',
            'visa_uk' => $request->input('visa_uk') === 'Yes',
            'visa_ireland' => $request->input('visa_ireland') === 'Yes',
            'visa_haj_umrah' => $request->input('visa_haj_umrah') === 'Yes',
            'visa_uae' => $request->input('visa_uae') === 'Yes',
            'visa_schengen_countries' => $request->input('visa_schengen_countries'),
            'visa_russia' => $request->input('visa_russia') === 'Yes',
            'visa_china' => $request->input('visa_china') === 'Yes',
            'visa_vietnam' => $request->input('visa_vietnam') === 'Yes',
            'visa_cambodia' => $request->input('visa_cambodia') === 'Yes',
            'visa_hongkong' => $request->input('visa_hongkong') === 'Yes',
            'visa_philippines' => $request->input('visa_philippines') === 'Yes',
            'visa_singapore' => $request->input('visa_singapore') === 'Yes',
            'visa_malaysia' => $request->input('visa_malaysia') === 'Yes',
            'visa_australia' => $request->input('visa_australia') === 'Yes',
            'visa_newzealand' => $request->input('visa_newzealand') === 'Yes',
            'visa_draft_cover_note' => $request->input('visa_draft_cover_note') === 'Yes',

            // TOURS AND HOLIDAY PACKAGES Fields
            'tours_handled_packages' => $request->input('tours_handled_packages') === 'Yes',
            'tours_countries' => $request->input('tours_countries'),
            'tours_worked_cost' => $request->input('tours_worked_cost') === 'Yes',
            'tours_incentive_groups' => $request->input('tours_incentive_groups') === 'Yes',
            'tours_mice_groups' => $request->input('tours_mice_groups') === 'Yes',
            'tours_cruise_pax' => $request->input('tours_cruise_pax') === 'Yes',

            // ACCOUNTING Fields
            'acc_record_transactions' => $request->input('acc_record_transactions') === 'Yes',
            'acc_bank_cc_reconciliation' => $request->input('acc_bank_cc_reconciliation') === 'Yes',
            'acc_corporate_card_reconciliation' => $request->input('acc_corporate_card_reconciliation') === 'Yes',
            'acc_track_commissions' => $request->input('acc_track_commissions') === 'Yes',
            'acc_submit_invoices' => $request->input('acc_submit_invoices') === 'Yes',
            'acc_manage_financial_records' => $request->input('acc_manage_financial_records') === 'Yes',
            'acc_software_excel_proficient' => $request->input('acc_software_excel_proficient') === 'Yes',
            'acc_prepare_analyze_reports' => $request->input('acc_prepare_analyze_reports') === 'Yes',
            'acc_ensure_compliance' => $request->input('acc_ensure_compliance') === 'Yes',
            'acc_manage_ap_ar' => $request->input('acc_manage_ap_ar') === 'Yes',
            'acc_process_payroll_expenses' => $request->input('acc_process_payroll_expenses') === 'Yes',
            'acc_calculate_pay_taxes' => $request->input('acc_calculate_pay_taxes') === 'Yes',
            'acc_coordinate_auditors' => $request->input('acc_coordinate_auditors') === 'Yes',
            'acc_monitor_cashflow_forecast' => $request->input('acc_monitor_cashflow_forecast') === 'Yes',
            'acc_reconcile_bsp' => $request->input('acc_reconcile_bsp') === 'Yes',

        ]);

        return redirect()->back()->with('success', 'Your profile has been submitted successfully!');
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
        $data = Employer::select('id', 'company_name', 'contact_person', 'contact_email', 'contact_mobile', 'min_travel_trade_experience_years', 'created_at')->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function(Employer $employer) {
                $url = route('employer.generate_profile_pdf', ['id' => $employer->id]);
                return '<a href="' . $url . '" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-file-pdf"></i> Download PDF</a>';
            })
            ->addColumn('created_at_formatted', function(Employer $employer) {
                return $employer->created_at->format('d-m-Y');
            })
            ->rawColumns(['action'])
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
                'Intl Standalone EMD', 'Intl Associated EMD','intl_mng_queues_upd_pnrs',
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
                    $employer->intl_mng_queues_upd_pnrs ? 'Yes' : 'No',
                    
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
