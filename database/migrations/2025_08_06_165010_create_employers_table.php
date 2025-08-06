<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();

            // Employer's general information
            $table->string('company_name');
            $table->string('contact_person');
            $table->string('contact_email')->unique();
            $table->string('contact_mobile');
            
            // Experience and Expertise
            $table->integer('min_travel_trade_experience_years')->nullable();
            $table->boolean('desired_domestic_travel_expertise')->nullable();
            $table->boolean('desired_hotel_car_hire_expertise')->nullable();
            $table->boolean('desired_international_travel_expertise')->nullable();
            $table->boolean('desired_visa_handling_expertise')->nullable();
            $table->boolean('desired_tours_holiday_packages_expertise')->nullable();
            $table->boolean('desired_accounting_expertise')->nullable();

            // Domestic Travel Fields
            $table->boolean('domestic_gds_itinerary')->nullable();
            $table->boolean('domestic_pnr_adult')->nullable();
            $table->boolean('domestic_pnr_child_infant')->nullable();
            $table->boolean('domestic_senior_citizen_fares')->nullable();
            $table->boolean('domestic_student_fares')->nullable();
            $table->boolean('domestic_youth_special_fares')->nullable();
            $table->boolean('domestic_fare_mask')->nullable();
            $table->boolean('domestic_ticketing_gds')->nullable();
            $table->string('domestic_gds_type')->nullable(); // Amadeus, Galileo, Sabre, Other
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
            $table->boolean('visa_handled_usa')->nullable();
            $table->boolean('visa_handled_canada')->nullable();
            $table->boolean('visa_handled_mexico')->nullable();
            $table->boolean('visa_handled_brazil')->nullable();
            $table->boolean('visa_handled_other_south_america')->nullable();
            $table->boolean('visa_handled_uk')->nullable();
            $table->boolean('visa_handled_ireland')->nullable();
            $table->boolean('visa_handled_haj_umrah')->nullable();
            $table->boolean('visa_handled_uae')->nullable();
            $table->string('visa_handled_schengen_countries')->nullable();
            $table->boolean('visa_handled_russia')->nullable();
            $table->boolean('visa_handled_china')->nullable();
            $table->boolean('visa_handled_vietnam')->nullable();
            $table->boolean('visa_handled_cambodia')->nullable();
            $table->boolean('visa_handled_hong_kong')->nullable();
            $table->boolean('visa_handled_philippines')->nullable();
            $table->boolean('visa_handled_singapore')->nullable();
            $table->boolean('visa_handled_malaysia')->nullable();
            $table->boolean('visa_handled_australia')->nullable();
            $table->boolean('visa_handled_new_zealand')->nullable();
            $table->boolean('visa_draft_cover_note')->nullable();

            // TOURS AND HOLIDAY PACKAGES Fields
            $table->boolean('tours_handle_packages')->nullable();
            $table->string('tours_countries')->nullable();
            $table->boolean('tours_worked_cost')->nullable();
            $table->boolean('tours_handle_incentive_groups')->nullable();
            $table->boolean('tours_handle_mice_groups')->nullable();
            $table->boolean('tours_handle_cruise_pax')->nullable();

            // ACCOUNTING Fields
            $table->boolean('acc_record_transactions')->nullable();
            $table->boolean('acc_bank_cc_reconciliations')->nullable();
            $table->boolean('acc_corporate_card_reconciliations')->nullable();
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

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
