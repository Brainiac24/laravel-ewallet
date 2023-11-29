<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\AccountCategoryType\AccountCategoryType;

class DatabaseSeeder extends Seeder
{
    /**
     * DatabaseSeeder constructor.
     */
    /*public function __construct()
    {
        Log::useDailyFiles(storage_path().'/logs/database/seeding.log');
    }*/

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoordinatePointWorkdaysTableSeeder::class);
        $this->call(CoordinatePointTypesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ScheduleTypeTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AttestationsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CurrencyRatesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(GatewaysTableSeeder::class);
        $this->call(AccountTypesTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(CommissionTableSeeder::class);
        $this->call(ServiceLimitsTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(CategoryTypeTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(WorkdaysTableSeeder::class);
        $this->call(TransactionStatusGroupsTableSeeder::class);
        $this->call(TransactionStatusTableSeeder::class);
        $this->call(TransactionStatusDetailsTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(LicenseAgreementSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(DocApiCategoriesTableSeeder::class);
        $this->call(DocApisTableSeeder::class);
        $this->call(AccountCategoryTypesTableSeeder::class);
        $this->call(AccountStatusTableSeeder::class);
        $this->call(TransactionSyncStatusTableSeeder::class);
        $this->call(UserSessionCodeTypeTableSeeder::class);
        $this->call(UserSessionCodeChannelTableSeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(TransferListTableSeeder::class);
        $this->call(OrderTypesTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(TransactionSyncRulesTableSeeder::class);
        $this->call(PurposeTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(OrderCardContractTypesTableSeeder::class);
        $this->call(OrderCardTypesTableSeeder::class);
        $this->call(OrderProcessStatusTableSeeder::class);
        $this->call(MerchantCategoryTableSeeder::class);
        $this->call(PurposeTypesTableSeeder::class);
        $this->call(OrderCommentTableSeeder::class);
        $this->call(ReportTypesTableSeeder::class);
        $this->call(CashbacksTableSeeder::class);
        $this->call(CashbackItemsTableSeeder::class);
        $this->call(OrderDepositTypesTableSeeder::class);
        $this->call(OrderDepositTypeItemsTableSeeder::class);
        $this->call(OrderAccountTypesTableSeeder::class);
        $this->call(OrderAccountTypeItemsTableSeeder::class);
        //$this->call(DwhRulesTableSeeder::class);
//        $this->call(MerchantTableSeeder::class);
        // больше не нужно, заливка идет через excel файл
        //$this->call(AreasTableSeeder::class);
        //$this->call(CitiesTableSeeder::class);
        //$this->call(CountriesTableSeeder::class);
        //$this->call(RegionsTableSeeder::class);
    }
}
