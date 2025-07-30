<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('given_name');
            $table->string('family_name');
            $table->date('dob');
            $table->text('address');
            $table->string('mobile_no');
            $table->string('personal_email')->unique();
            $table->integer('total_experience')->nullable();
            $table->string('current_city', 3);
            $table->string('willing_to_relocate', 3); // Yes/No
            $table->string('preferred_cities')->nullable();
            $table->decimal('current_salary', 10, 2)->nullable();
            $table->string('cv_path')->nullable(); // Path to the uploaded CV

            // Domestic Travel Fields (example)
            $table->boolean('domestic_gds_itinerary')->nullable(); // true/false for Yes/No
            $table->boolean('domestic_pnr_adult')->nullable();
            $table->boolean('domestic_pnr_child_infant')->nullable();
            $table->boolean('domestic_senior_citizen_fares')->nullable();
            $table->boolean('domestic_student_fares')->nullable();
            $table->boolean('domestic_youth_special_fares')->nullable();
            $table->boolean('domestic_fare_mask')->nullable();
            $table->boolean('domestic_ticketing_gds')->nullable();
            $table->string('domestic_gds_type')->nullable(); // Amadeus, Galileo, Sabre, Other
            $table->string('domestic_gds_other_name')->nullable();
            $table->boolean('domestic_lcc_websites')->nullable();
            $table->boolean('domestic_supplier_portal')->nullable();
            $table->string('domestic_supplier_portal_name')->nullable();

            // Hotel Bookings & Car Hire Fields
            $table->boolean('hotel_bookings_india')->nullable();
            $table->boolean('hotel_contact_direct')->nullable();
            $table->boolean('hotel_consolidator_websites')->nullable();
            $table->boolean('hotel_local_dmc')->nullable();
            $table->boolean('car_hire_city')->nullable();
            $table->boolean('car_hire_other_cities')->nullable();

            // International Travel Fields
            $table->boolean('intl_gds_itinerary')->nullable();
            $table->boolean('intl_pnr_child_infant')->nullable();
            $table->boolean('intl_senior_citizen_fares')->nullable();
            $table->boolean('intl_student_fares')->nullable();
            $table->boolean('intl_youth_special_fares')->nullable();
            $table->boolean('intl_fare_mask')->nullable();
            $table->string('intl_gds_type')->nullable();
            $table->string('intl_gds_other_name')->nullable();
            $table->boolean('intl_queue_pnrs')->nullable();
            $table->boolean('intl_first_reissue')->nullable();
            $table->boolean('intl_subsequent_reissue')->nullable();
            $table->boolean('intl_ticket_refunds')->nullable();
            $table->boolean('intl_hotac_rooms')->nullable();
            $table->boolean('intl_group_pnr')->nullable();
            $table->boolean('intl_issue_emd')->nullable();
            $table->boolean('intl_standalone_emd')->nullable();
            $table->boolean('intl_associated_emd')->nullable();

            // VISA Handling Fields
            $table->boolean('visa_aware_procedures')->nullable();
            $table->boolean('visa_handled_personally')->nullable();
            $table->boolean('visa_in_department')->nullable();
            $table->boolean('visa_usa')->nullable();
            $table->boolean('visa_canada')->nullable();
            $table->boolean('visa_mexico')->nullable();
            $table->boolean('visa_brazil')->nullable();
            $table->boolean('visa_other_south_america')->nullable();
            $table->boolean('visa_uk')->nullable();
            $table->boolean('visa_ireland')->nullable();
            $table->boolean('visa_haj_umrah')->nullable();
            $table->boolean('visa_uae')->nullable();
            $table->string('visa_schengen_countries')->nullable();
            $table->boolean('visa_russia')->nullable();
            $table->boolean('visa_china')->nullable();
            $table->boolean('visa_vietnam')->nullable();
            $table->boolean('visa_cambodia')->nullable();
            $table->boolean('visa_hongkong')->nullable();
            $table->boolean('visa_philippines')->nullable();
            $table->boolean('visa_singapore')->nullable();
            $table->boolean('visa_malaysia')->nullable();
            $table->boolean('visa_australia')->nullable();
            $table->boolean('visa_newzealand')->nullable();
            $table->boolean('visa_draft_cover_note')->nullable();


            // TOURS AND HOLIDAY PACKAGES Fields
            $table->boolean('tours_handled_packages')->nullable();
            $table->string('tours_countries')->nullable();
            $table->boolean('tours_worked_cost')->nullable();
            $table->boolean('tours_incentive_groups')->nullable();
            $table->boolean('tours_mice_groups')->nullable();
            $table->boolean('tours_cruise_pax')->nullable();

            // ACCOUNTING Fields
            $table->boolean('acc_record_transactions')->nullable();
            $table->boolean('acc_bank_cc_reconciliation')->nullable();
            $table->boolean('acc_corporate_card_reconciliation')->nullable();
            $table->boolean('acc_track_commissions')->nullable();
            $table->boolean('acc_submit_invoices')->nullable();
            $table->boolean('acc_manage_financial_records')->nullable();
            $table->boolean('acc_software_excel_proficient')->nullable();
            $table->boolean('acc_prepare_analyze_reports')->nullable();
            $table->boolean('acc_ensure_compliance')->nullable();
            $table->boolean('acc_manage_ap_ar')->nullable();
            $table->boolean('acc_process_payroll_expenses')->nullable();
            $table->boolean('acc_calculate_pay_taxes')->nullable();
            $table->boolean('acc_coordinate_auditors')->nullable();
            $table->boolean('acc_monitor_cashflow_forecast')->nullable();
            $table->boolean('acc_reconcile_bsp')->nullable();

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seekers');
    }
}