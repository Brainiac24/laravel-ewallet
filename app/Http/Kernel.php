<?php

namespace App\Http;


use App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType\CanCreateOrderCardContractType;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType\CanDeleteOrderCardContractType;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType\CanEditOrderCardContractType;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType\CanListOrderCardContractType;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardContractType\CanShowOrderCardContractType;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

use App\Http\Middleware\Backend\Permissions\SplashScreen\CanCreateSplashScreen;
use App\Http\Middleware\Backend\Permissions\SplashScreen\CanShowSplashScreen;
use App\Http\Middleware\Backend\Permissions\Job\JobHistory\CanListJobHistoryCommand;
use App\Http\Middleware\Backend\Permissions\Schedule\CanCreateSchedule;
use App\Http\Middleware\Backend\Permissions\Schedule\CanDeleteSchedule;
use App\Http\Middleware\Backend\Permissions\Schedule\CanEditSchedule;
use App\Http\Middleware\Backend\Permissions\Schedule\CanListSchedule;
use App\Http\Middleware\Backend\Permissions\Schedule\CanShowSchedule;
use App\Http\Middleware\Backend\Permissions\Schedule\ScheduleJob\CanCreateScheduleJob;
use App\Http\Middleware\Backend\Permissions\Schedule\ScheduleJob\CanListScheduleJob;
use App\Http\Middleware\Backend\Permissions\Schedule\ScheduleJob\CanShowScheduleJob;
use App\Http\Middleware\Backend\Permissions\Schedule\ScheduleType\CanListScheduleType;
use App\Http\Middleware\Backend\Permissions\Schedule\ScheduleType\CanShowScheduleType;
use App\Http\Middleware\Backend\Permissions\Merchant\CanDeleteContractMerchant;
use App\Http\Middleware\Backend\Permissions\FileManager\CanDeleteFileManager;
use App\Http\Middleware\Backend\Permissions\FileManager\CanDownloadFileManager;
use App\Http\Middleware\Backend\Permissions\FileManager\CanEditFileManager;
use App\Http\Middleware\Backend\Permissions\FileManager\CanListFileManager;
use App\Http\Middleware\Backend\Permissions\FileManager\CanStoreFileManager;
use App\Http\Middleware\Backend\Permissions\Reports\ReportAnalysis\CanCreateReportAnalysis;
use App\Http\Middleware\Backend\Permissions\Reports\ReportAnalysis\CanDeleteReportAnalysis;
use App\Http\Middleware\Backend\Permissions\Reports\ReportAnalysis\CanEditReportAnalysis;
use App\Http\Middleware\Backend\Permissions\Reports\ReportAnalysis\CanListReportAnalysis;
use App\Http\Middleware\Backend\Permissions\Branch\CanCreateBranch;
use App\Http\Middleware\Backend\Permissions\Branch\CanDeleteBranch;
use App\Http\Middleware\Backend\Permissions\Branch\CanEditBranch;
use App\Http\Middleware\Backend\Permissions\Branch\CanListBranch;
use App\Http\Middleware\Backend\Permissions\Branch\CanShowBranch;
use App\Http\Middleware\Backend\Filter\RememberSearchFields;
use App\Http\Middleware\TrimStrings;




use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRule\CanCreateTransactionContinueRule;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRule\CanDeleteTransactionContinueRule;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRule\CanEditTransactionContinueRule;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRule\CanListTransactionContinueRule;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRule\CanShowTransactionContinueRule;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRuleAccordance\CanCreateTransactionContinueRuleAccordance;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRuleAccordance\CanDeleteTransactionContinueRuleAccordance;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRuleAccordance\CanEditTransactionContinueRuleAccordance;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRuleAccordance\CanListTransactionContinueRuleAccordance;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionContinueRuleAccordance\CanShowTransactionContinueRuleAccordance;



use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointCity\CanCreateCoordinatePointCity;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointCity\CanDeleteCoordinatePointCity;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointCity\CanEditCoordinatePointCity;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointCity\CanListCoordinatePointCity;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointCity\CanShowCoordinatePointCity;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointService\CanCreateCoordinatePointService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointService\CanDeleteCoordinatePointService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointService\CanEditCoordinatePointService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointService\CanListCoordinatePointService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointService\CanShowCoordinatePointService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointType\CanCreateCoordinatePointType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointType\CanDeleteCoordinatePointType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointType\CanEditCoordinatePointType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointType\CanListCoordinatePointType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointType\CanShowCoordinatePointType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointTypeService\CanCreateCoordinatePointTypeService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointTypeService\CanDeleteCoordinatePointTypeService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointTypeService\CanEditCoordinatePointTypeService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointTypeService\CanListCoordinatePointTypeService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointTypeService\CanShowCoordinatePointTypeService;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointWorkday\CanCreateCoordinatePointWorkday;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointWorkday\CanDeleteCoordinatePointWorkday;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointWorkday\CanEditCoordinatePointWorkday;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointWorkday\CanListCoordinatePointWorkday;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CoordinatePointWorkday\CanShowCoordinatePointWorkday;
use App\Http\Middleware\Backend\Permissions\DwhRule\CanCreateDwhRule;
use App\Http\Middleware\Backend\Permissions\DwhRule\CanDeleteDwhRule;
use App\Http\Middleware\Backend\Permissions\DwhRule\CanEditDwhRule;
use App\Http\Middleware\Backend\Permissions\DwhRule\CanListDwhRule;
use App\Http\Middleware\Backend\Permissions\DwhRule\CanShowDwhRule;

use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use App\Http\Middleware\Backend\Permissions\Area\CanEditArea;
use App\Http\Middleware\Backend\Permissions\Area\CanListArea;
use App\Http\Middleware\Backend\Permissions\Area\CanShowArea;
use App\Http\Middleware\Backend\Permissions\Bank\CanEditBank;
use App\Http\Middleware\Backend\Permissions\Bank\CanListBank;
use App\Http\Middleware\Backend\Permissions\Bank\CanShowBank;
use App\Http\Middleware\Backend\Permissions\City\CanEditCity;
use App\Http\Middleware\Backend\Permissions\City\CanListCity;
use App\Http\Middleware\Backend\Permissions\City\CanShowCity;
use App\Http\Middleware\Backend\Permissions\News\CanEditNews;
use App\Http\Middleware\Backend\Permissions\News\CanListNews;
use App\Http\Middleware\Backend\Permissions\News\CanShowNews;
use App\Http\Middleware\Backend\Permissions\User\CanEditUser;
use App\Http\Middleware\Backend\Permissions\User\CanLockUser;
use App\Http\Middleware\Frontend\Api\Settings\CheckAppVersion;
use App\Http\Middleware\Backend\Permissions\Area\CanCreateArea;
use App\Http\Middleware\Backend\Permissions\Area\CanDeleteArea;
use App\Http\Middleware\Backend\Permissions\Bank\CanCreateBank;
use App\Http\Middleware\Backend\Permissions\Bank\CanDeleteBank;
use App\Http\Middleware\Backend\Permissions\City\CanCreateCity;
use App\Http\Middleware\Backend\Permissions\City\CanDeleteCity;
use App\Http\Middleware\Backend\Permissions\News\CanCreateNews;
use App\Http\Middleware\Backend\Permissions\News\CanDeleteNews;
use App\Http\Middleware\Backend\Permissions\Order\CanEditOrder;
use App\Http\Middleware\Backend\Permissions\Order\CanListOrder;
use App\Http\Middleware\Backend\Permissions\Order\CanShowOrder;
use App\Http\Middleware\Backend\Permissions\User\CanCreateUser;
use App\Http\Middleware\Backend\Permissions\User\CanUnLockUser;
use App\Http\Middleware\Frontend\Api\User\Auth\CheckExistToken;
use App\Http\Middleware\Backend\Permissions\Color\CanManageColor;
use App\Http\Middleware\Backend\Permissions\DocApi\CanListDocApi;
use App\Http\Middleware\Backend\Permissions\JobLog\CanListJobLog;
use App\Http\Middleware\Backend\Permissions\JobLog\CanShowJobLog;
use App\Http\Middleware\Backend\Permissions\Region\CanEditRegion;
use App\Http\Middleware\Backend\Permissions\Region\CanListRegion;
use App\Http\Middleware\Backend\Permissions\Region\CanShowRegion;
use App\Http\Middleware\Backend\Permissions\User\CanShowListUser;
use App\Http\Middleware\Backend\Permissions\User\CanEditUserAdmin;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use App\Http\Middleware\Backend\Permissions\Account\CanEditAccount;
use App\Http\Middleware\Backend\Permissions\Account\CanListAccount;
use App\Http\Middleware\Backend\Permissions\Account\CanShowAccount;
use App\Http\Middleware\Backend\Permissions\Country\CanEditCountry;
use App\Http\Middleware\Backend\Permissions\Country\CanListCountry;
use App\Http\Middleware\Backend\Permissions\Country\CanShowCountry;
use App\Http\Middleware\Backend\Permissions\Purpose\CanListPurpose;
use App\Http\Middleware\Backend\Permissions\Purpose\CanShowPurpose;
use App\Http\Middleware\Backend\Permissions\Region\CanCreateRegion;
use App\Http\Middleware\Backend\Permissions\Region\CanDeleteRegion;
use App\Http\Middleware\Backend\Permissions\Service\CanEditService;
use App\Http\Middleware\Backend\Permissions\Service\CanListService;
use App\Http\Middleware\Backend\Permissions\Service\CanShowService;
use App\Http\Middleware\Backend\Permissions\User\CanShowDetailUser;
use App\Http\Middleware\Frontend\Api\User\Auth\ValidateAccessToken;
use App\Http\Middleware\Backend\Permissions\User\CanDeleteEmailUser;
use App\Http\Middleware\Backend\Permissions\User\IsActiveMiddleware;
use App\Http\Middleware\Frontend\Api\User\Auth\ValidateRefreshToken;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use App\Http\Middleware\Backend\Permissions\Account\CanCreateAccount;
use App\Http\Middleware\Backend\Permissions\Account\CanDeleteAccount;
use App\Http\Middleware\Backend\Permissions\Cashback\CanEditCashback;
use App\Http\Middleware\Backend\Permissions\Cashback\CanListCashback;
use App\Http\Middleware\Backend\Permissions\Cashback\CanShowCashback;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus\CanCreateBonusAccrualStatus;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus\CanDeleteBonusAccrualStatus;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus\CanEditBonusAccrualStatus;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus\CanListBonusAccrualStatus;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\BonusAccrualStatus\CanShowBonusAccrualStatus;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\CanListBonusAccrual;
use App\Http\Middleware\Backend\Permissions\Cashback\BonusAccrual\CanShowBonusAccrual;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackType\CanCreateCashbackType;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackType\CanDeleteCashbackType;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackType\CanEditCashbackType;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackType\CanListCashbackType;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackType\CanShowCashbackType;
use App\Http\Middleware\Backend\Permissions\Country\CanCreateCountry;
use App\Http\Middleware\Backend\Permissions\Country\CanDeleteCountry;
use App\Http\Middleware\Backend\Permissions\Currency\CanEditCurrency;
use App\Http\Middleware\Backend\Permissions\Currency\CanListCurrency;
use App\Http\Middleware\Backend\Permissions\Currency\CanShowCurrency;
use App\Http\Middleware\Backend\Permissions\Gateway\CanManageGateway;
use App\Http\Middleware\Backend\Permissions\Job\JobHistory\CanListJobHistory;
use App\Http\Middleware\Backend\Permissions\Job\JobHistory\CanShowJobHistory;
use App\Http\Middleware\Backend\Permissions\Order\OrderComment\CanCreateOrderComment;
use App\Http\Middleware\Backend\Permissions\Order\OrderComment\CanEditOrderComment;
use App\Http\Middleware\Backend\Permissions\Order\OrderComment\CanListOrderComment;
use App\Http\Middleware\Backend\Permissions\Order\OrderComment\CanShowOrderComment;
use App\Http\Middleware\Backend\Permissions\Order\RemoteIdentification\CanEditRemoteIdentification;
use App\Http\Middleware\Backend\Permissions\Order\RemoteIdentification\CanListRemoteIdentification;
use App\Http\Middleware\Backend\Permissions\Order\RemoteIdentification\CanShowRemoteIdentification;
use App\Http\Middleware\Backend\Permissions\Order\RemoteIdentification\CanUpdateStatusRemoteIdentification;
use App\Http\Middleware\Backend\Permissions\ReportMerchant\CanListReportMerchant;
use App\Http\Middleware\Backend\Permissions\Reports\CanListReports;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser\CanDeleteMerchantUser;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser\CanEditMerchantUser;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser\CanListMerchantUser;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantUser\CanShowMerchantUser;
use App\Http\Middleware\Backend\Permissions\Merchant\CanEditMerchant;
use App\Http\Middleware\Backend\Permissions\Merchant\CanListMerchant;
use App\Http\Middleware\Backend\Permissions\Merchant\CanShowMerchant;
use App\Http\Middleware\Backend\Permissions\Service\CanCreateService;
use App\Http\Middleware\Backend\Permissions\Service\CanDeleteService;
use App\Http\Middleware\Backend\Permissions\Service\Menu\CanEditMenu;
use App\Http\Middleware\Backend\Permissions\Service\Menu\CanListMenu;
use App\Http\Middleware\Backend\Permissions\Service\Menu\CanShowMenu;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardType\CanEditOrderCardType;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardType\CanListOrderCardType;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardType\CanShowOrderCardType;
use App\Http\Middleware\Backend\Permissions\User\Client\CanEditClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanListClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanShowClient;
use App\Http\Middleware\Backend\Permissions\User\Event\CanManageEvent;
use App\Http\Middleware\Backend\Permissions\Cashback\CanCreateCashback;
use App\Http\Middleware\Backend\Permissions\Cashback\CanDeleteCashback;
use App\Http\Middleware\Backend\Permissions\Currency\CanCreateCurrency;
use App\Http\Middleware\Backend\Permissions\Currency\CanDeleteCurrency;
use App\Http\Middleware\Backend\Permissions\Dashboard\CanShowDashboard;
use App\Http\Middleware\Backend\Permissions\Merchant\CanCreateMerchant;
use App\Http\Middleware\Backend\Permissions\Merchant\CanDeleteMerchant;
use App\Http\Middleware\Backend\Permissions\Register\CanManageRegistry;
use App\Http\Middleware\Backend\Permissions\Service\Menu\CanCreateMenu;
use App\Http\Middleware\Backend\Permissions\Service\Menu\CanDeleteMenu;
use App\Http\Middleware\Backend\Permissions\Settings\CanManageSettings;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardType\CanDeleteOrderCardType;
use App\Http\Middleware\Backend\Permissions\User\Client\CanCreateClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanDeleteClient;
use App\Http\Middleware\Backend\Permissions\User\Limit\CanEditUserLimit;
use App\Http\Middleware\Backend\Permissions\User\Limit\CanListUserLimit;
use App\Http\Middleware\Backend\Permissions\User\Limit\CanShowUserLimit;
use App\Http\Middleware\Backend\Permissions\User\Role\CanShowSectionRole;
use App\Http\Middleware\Backend\Permissions\User\ChangePasswordMiddleware;
use App\Http\Middleware\Backend\Permissions\User\Limit\CanCreateUserLimit;
use App\Http\Middleware\Backend\Permissions\User\Limit\CanDeleteUserLimit;
use App\Http\Middleware\Backend\Permissions\User\TempUser\CanListTempUser;
use App\Http\Middleware\Backend\Permissions\User\TempUser\CanShowTempUser;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer\CanCreateFAQAnswer;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer\CanDeleteFAQAnswer;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer\CanEditFAQAnswer;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer\CanListFAQAnswer;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQAnswer\CanShowFAQAnswer;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion\CanCreateFAQQuestion;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion\CanDeleteFAQQuestion;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion\CanEditFAQQuestion;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion\CanListFAQQuestion;
use App\Http\Middleware\Backend\Permissions\FAQ\FAQQuestion\CanShowFAQQuestion;
use App\Http\Middleware\Backend\Permissions\Service\Workday\CanEditWorkday;
use App\Http\Middleware\Backend\Permissions\Service\Workday\CanListWorkday;
use App\Http\Middleware\Backend\Permissions\Service\Workday\CanShowWorkday;
use App\Http\Middleware\Backend\Permissions\Transaction\CanEditTransaction;
use App\Http\Middleware\Backend\Permissions\Transaction\CanListTransaction;
use App\Http\Middleware\Backend\Permissions\Transaction\CanShowTransaction;
use App\Http\Middleware\Backend\Permissions\LicenseAgreement\CanEditLicense;
use App\Http\Middleware\Backend\Permissions\LicenseAgreement\CanShowLicense;
use App\Http\Middleware\Backend\Permissions\User\Client\CanAddCodeMapClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanLockManageClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanUpdateLiteClient;
use App\Http\Middleware\Backend\Permissions\User\History\CanListUserHistory;
use App\Http\Middleware\Backend\Permissions\User\History\CanShowUserHistory;
use App\Http\Middleware\Backend\Permissions\Attestation\CanManageAttestation;
use App\Http\Middleware\Backend\Permissions\DocumentType\CanEditDocumentType;
use App\Http\Middleware\Backend\Permissions\DocumentType\CanListDocumentType;
use App\Http\Middleware\Backend\Permissions\DocumentType\CanShowDocumentType;
use App\Http\Middleware\Backend\Permissions\Order\OrderType\CanListOrderType;
use App\Http\Middleware\Backend\Permissions\Order\OrderType\CanShowOrderType;
use App\Http\Middleware\Backend\Permissions\Service\Category\CanEditCategory;
use App\Http\Middleware\Backend\Permissions\Service\Category\CanListCategory;
use App\Http\Middleware\Backend\Permissions\Service\Category\CanShowCategory;
use App\Http\Middleware\Backend\Permissions\Service\Workday\CanCreateWorkday;
use App\Http\Middleware\Backend\Permissions\Service\Workday\CanDeleteWorkday;
use App\Http\Middleware\Backend\Permissions\Transaction\CanCreateTransaction;
use App\Http\Middleware\Backend\Permissions\Transaction\CanDeleteTransaction;
use App\Http\Middleware\Backend\Permissions\Transaction\CanResendTransaction;
use App\Http\Middleware\Backend\Permissions\TransferList\CanEditTransferList;
use App\Http\Middleware\Backend\Permissions\TransferList\CanListTransferList;
use App\Http\Middleware\Backend\Permissions\TransferList\CanShowTransferList;
use App\Http\Middleware\Backend\Permissions\User\Client\CanDeleteEmailClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanIdentificateClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanUnLockManageClient;
use App\Http\Middleware\Backend\Permissions\User\Favorite\CanEditUserFavorite;
use App\Http\Middleware\Backend\Permissions\User\Favorite\CanListUserFavorite;
use App\Http\Middleware\Backend\Permissions\User\Favorite\CanShowUserFavorite;
use App\Http\Middleware\Backend\Permissions\CategoryType\CanManageCategoryType;
use App\Http\Middleware\Backend\Permissions\DocumentType\CanCreateDocumentType;
use App\Http\Middleware\Backend\Permissions\DocumentType\CanDeleteDocumentType;
use App\Http\Middleware\Backend\Permissions\Service\Category\CanCreateCategory;
use App\Http\Middleware\Backend\Permissions\Service\Category\CanDeleteCategory;
use App\Http\Middleware\Backend\Permissions\TransferList\CanCreateTransferList;
use App\Http\Middleware\Backend\Permissions\TransferList\CanDeleteTransferList;
use App\Http\Middleware\Backend\Permissions\User\Client\CanDeleteCodeMapClient;
use App\Http\Middleware\Backend\Permissions\User\Client\CanResetPasswordClient;
use App\Http\Middleware\Backend\Permissions\User\Favorite\CanCreateUserFavorite;
use App\Http\Middleware\Backend\Permissions\User\Favorite\CanDeleteUserFavorite;
use App\Http\Middleware\Backend\Permissions\Order\OrderStatus\CanListOrderStatus;
use App\Http\Middleware\Backend\Permissions\Order\OrderStatus\CanShowOrderStatus;
use App\Http\Middleware\Backend\Permissions\Service\Commission\CanEditCommission;
use App\Http\Middleware\Backend\Permissions\Service\Commission\CanListCommission;
use App\Http\Middleware\Backend\Permissions\Service\Commission\CanShowCommission;
use App\Http\Middleware\Backend\Permissions\Account\AccountType\CanEditAccountType;
use App\Http\Middleware\Backend\Permissions\Account\AccountType\CanListAccountType;
use App\Http\Middleware\Backend\Permissions\Account\AccountType\CanShowAccountType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CanEditCoordinatePoint;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CanListCoordinatePoint;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CanShowCoordinatePoint;
use App\Http\Middleware\Backend\Permissions\Service\Commission\CanCreateCommission;
use App\Http\Middleware\Backend\Permissions\Service\Commission\CanDeleteCommission;
use App\Http\Middleware\Backend\Permissions\Account\AccountType\CanCreateAccountType;
use App\Http\Middleware\Backend\Permissions\Account\AccountType\CanDeleteAccountType;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CanCreateCoordinatePoint;
use App\Http\Middleware\Backend\Permissions\CoordinatePoint\CanDeleteCoordinatePoint;
use App\Http\Middleware\Backend\Permissions\Service\ServiceLimit\CanEditServiceLimit;
use App\Http\Middleware\Backend\Permissions\Service\ServiceLimit\CanListServiceLimit;
use App\Http\Middleware\Backend\Permissions\Service\ServiceLimit\CanShowServiceLimit;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackItem\CanEditCashbackItem;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackItem\CanListCashbackItem;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackItem\CanShowCashbackItem;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRate\CanEditCurrencyRate;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRate\CanListCurrencyRate;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRate\CanShowCurrencyRate;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem\CanEditMerchantItem;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem\CanListMerchantItem;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem\CanShowMerchantItem;
use App\Http\Middleware\Backend\Permissions\User\Client\CanIdentificateClientForAdmin;
use App\Http\Middleware\Backend\Permissions\User\UnverifiedUser\CanListUnverifiedUser;
use App\Http\Middleware\Backend\Permissions\User\UnverifiedUser\CanShowUnverifiedUser;
use App\Http\Middleware\Backend\Permissions\Account\AccountStatus\CanEditAccountStatus;
use App\Http\Middleware\Backend\Permissions\Account\AccountStatus\CanListAccountStatus;
use App\Http\Middleware\Backend\Permissions\Account\AccountStatus\CanShowAccountStatus;
use App\Http\Middleware\Backend\Permissions\Order\OrderCardType\CanCreateOrderCardType;
use App\Http\Middleware\Backend\Permissions\Service\ServiceLimit\CanCreateServiceLimit;
use App\Http\Middleware\Backend\Permissions\Service\ServiceLimit\CanDeleteServiceLimit;
use App\Http\Middleware\Backend\Permissions\User\UseSessionCode\CanListUserSessionCode;
use App\Http\Middleware\Backend\Permissions\User\UseSessionCode\CanShowUserSessionCode;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackItem\CanCreateCashbackItem;
use App\Http\Middleware\Backend\Permissions\Cashback\CashbackItem\CanDeleteCashbackItem;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRate\CanCreateCurrencyRate;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRate\CanDeleteCurrencyRate;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem\CanCreateMerchantItem;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem\CanDeleteMerchantItem;
use App\Http\Middleware\Backend\Permissions\Account\AccountHistory\CanEditAccountHistory;
use App\Http\Middleware\Backend\Permissions\Account\AccountHistory\CanListAccountHistory;
use App\Http\Middleware\Backend\Permissions\Account\AccountHistory\CanShowAccountHistory;
use App\Http\Middleware\Backend\Permissions\Account\AccountStatus\CanCreateAccountStatus;
use App\Http\Middleware\Backend\Permissions\Account\AccountStatus\CanDeleteAccountStatus;
use App\Http\Middleware\Backend\Permissions\Account\AccountHistory\CanCreateAccountHistory;
use App\Http\Middleware\Backend\Permissions\Account\AccountHistory\CanDeleteAccountHistory;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountType\CanEditOrderAccountType;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountType\CanListOrderAccountType;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountType\CanShowOrderAccountType;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositType\CanEditOrderDepositType;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositType\CanListOrderDepositType;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositType\CanShowOrderDepositType;
use App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit\CanEditServiceOtpLimit;
use App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit\CanListServiceOtpLimit;
use App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit\CanShowServiceOtpLimit;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountType\CanCreateOrderAccountType;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountType\CanDeleteOrderAccountType;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositType\CanCreateOrderDepositType;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositType\CanDeleteOrderDepositType;
use App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit\CanCreateServiceOtpLimit;
use App\Http\Middleware\Backend\Permissions\Service\ServiceOtpLimit\CanDeleteServiceOtpLimit;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCategory\CanEditMerchantCategory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCategory\CanListMerchantCategory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCategory\CanShowMerchantCategory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays\CanEditMerchantWorkdays;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays\CanListMerchantWorkdays;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays\CanShowMerchantWorkdays;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionType\CanListTransactionType;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCategory\CanCreateMerchantCategory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCategory\CanDeleteMerchantCategory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays\CanCreateMerchantWorkdays;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantWorkdays\CanDeleteMerchantWorkdays;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission\CanEditMerchantCommission;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission\CanListMerchantCommission;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission\CanShowMerchantCommission;
use App\Http\Middleware\Backend\Permissions\Transaction\CanChangeTransactionSyncStatusTransaction;
use App\Http\Middleware\Backend\Permissions\Account\AccountCategoryType\CanEditAccountCategoryType;
use App\Http\Middleware\Backend\Permissions\Account\AccountCategoryType\CanListAccountCategoryType;
use App\Http\Middleware\Backend\Permissions\Account\AccountCategoryType\CanShowAccountCategoryType;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountTypeItem\CanEditOrderAccountTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountTypeItem\CanListOrderAccountTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountTypeItem\CanShowOrderAccountTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositTypeItem\CanEditOrderDepositTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositTypeItem\CanListOrderDepositTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositTypeItem\CanShowOrderDepositTypeItem;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatus\CanListTransactionStatus;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRateHistory\CanEditCurrencyRateHistory;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRateHistory\CanListCurrencyRateHistory;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRateHistory\CanShowCurrencyRateHistory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission\CanCreateMerchantCommission;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommission\CanDeleteMerchantCommission;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantItem\CanChangeAccountNumberMerchantItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountTypeItem\CanCreateOrderAccountTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderAccountTypeItem\CanDeleteOrderAccountTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositTypeItem\CanCreateOrderDepositTypeItem;
use App\Http\Middleware\Backend\Permissions\Order\OrderDepositTypeItem\CanDeleteOrderDepositTypeItem;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionHistory\CanEditTransactionHistory;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionHistory\CanListTransactionHistory;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionHistory\CanShowTransactionHistory;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRateHistory\CanCreateCurrencyRateHistory;
use App\Http\Middleware\Backend\Permissions\Currency\CurrencyRateHistory\CanDeleteCurrencyRateHistory;
use App\Http\Middleware\Backend\Permissions\RegisterWithdrawMerchant\CanManageRegistryWithdrawMerhcant;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionHistory\CanCreateTransactionHistory;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionHistory\CanDeleteTransactionHistory;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem\CanEditMerchantCommissionItem;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem\CanListMerchantCommissionItem;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem\CanShowMerchantCommissionItem;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionSyncStatus\CanListTransactionSyncStatus;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionSyncStatus\CanShowTransactionSyncStatus;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem\CanCreateMerchantCommissionItem;
use App\Http\Middleware\Backend\Permissions\Merchant\MerchantCommissionItem\CanDeleteMerchantCommissionItem;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatusGroup\CanListTransactionStatusGroup;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatusGroup\CanShowTransactionStatusGroup;
use App\Http\Middleware\Backend\Permissions\Transaction\TransactionStatusDetail\CanListTransactionStatusDetail;
use App\Http\Middleware\Backend\Permissions\User\Client\CanDeletePinClient;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:120,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = array(
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'checkExistToken' => CheckExistToken::class,
        'validateAccessToken' => ValidateAccessToken::class,
        'validateRefreshToken' => ValidateRefreshToken::class,
        'isActive' => IsActiveMiddleware::class,
        'changePassword' => ChangePasswordMiddleware::class,
        //Dashboard
        'dashboard.can-show-list' => CanShowDashboard::class,
        //Settings
        'settings.can-manage' => CanManageSettings::class,
        //UserHistory
        'user.history.can-list' => CanListUserHistory::class,
        'user.history.can-show' => CanShowUserHistory::class,
        //UserFavorite
        'user.favorite.can-list' => CanListUserFavorite::class,
        'user.favorite.can-show' => CanShowUserFavorite::class,
        'user.favorite.can-create' => CanCreateUserFavorite::class,
        'user.favorite.can-edit' => CanEditUserFavorite::class,
        'user.favorite.can-delete' => CanDeleteUserFavorite::class,
        //UserLimit
        'user.limit.can-list' => CanListUserLimit::class,
        'user.limit.can-show' => CanShowUserLimit::class,
        'user.limit.can-create' => CanCreateUserLimit::class,
        'user.limit.can-edit' => CanEditUserLimit::class,
        'user.limit.can-delete' => CanDeleteUserLimit::class,
        //Transaction
        'transaction.can-list' => CanListTransaction::class,
        'transaction.can-show' => CanShowTransaction::class,
        'transaction.can-create' => CanCreateTransaction::class,
        'transaction.can-edit' => CanEditTransaction::class,
        'transaction.can-delete' => CanDeleteTransaction::class,
        'transaction.can-resend' => CanResendTransaction::class,
        'transaction.can-changeTransactionSyncStatus' => CanChangeTransactionSyncStatusTransaction::class,
        //Transaction_history
        'transaction.history.can-list' => CanListTransactionHistory::class,
        'transaction.history.can-show' => CanShowTransactionHistory::class,
        'transaction.history.can-create' => CanCreateTransactionHistory::class,
        'transaction.history.can-edit' => CanEditTransactionHistory::class,
        'transaction.history.can-delete' => CanDeleteTransactionHistory::class,
        //Transaction_continueRule
        'transaction.continueRule.can-list' => CanListTransactionContinueRule::class,
        'transaction.continueRule.can-show' => CanShowTransactionContinueRule::class,
        'transaction.continueRule.can-create' => CanCreateTransactionContinueRule::class,
        'transaction.continueRule.can-edit' => CanEditTransactionContinueRule::class,
        'transaction.continueRule.can-delete' => CanDeleteTransactionContinueRule::class,
        //Transaction_continueRule
        'transaction.continueRuleAccordance.can-list' => CanListTransactionContinueRuleAccordance::class,
        'transaction.continueRuleAccordance.can-show' => CanShowTransactionContinueRuleAccordance::class,
        'transaction.continueRuleAccordance.can-create' => CanCreateTransactionContinueRuleAccordance::class,
        'transaction.continueRuleAccordance.can-edit' => CanEditTransactionContinueRuleAccordance::class,
        'transaction.continueRuleAccordance.can-delete' => CanDeleteTransactionContinueRuleAccordance::class,
        //transaction_type
        'transaction.type.can-list' => CanListTransactionType::class,
        //transaction_status
        'transaction.status.can-list' => CanListTransactionStatus::class,
        //transaction_status_detail
        'transaction.status.detail.can-list' => CanListTransactionStatusDetail::class,
        //transaction_status_group
        'transaction.status.group.can-list' => CanListTransactionStatusGroup::class,
        'transaction.status.group.can-show' => CanShowTransactionStatusGroup::class,

        //transaction_sync_status
        'transaction.sync.status.can-list' => CanListTransactionSyncStatus::class,
        'transaction.sync.status.can-show' => CanShowTransactionSyncStatus::class,

        //gateway
        'gateway.can-manage' => CanManageGateway::class,
        //Service
        'service.can-list' => CanListService::class,
        'service.can-show' => CanShowService::class,
        'service.can-create' => CanCreateService::class,
        'service.can-edit' => CanEditService::class,
        'service.can-delete' => CanDeleteService::class,
        //Service_menu
        'service.menu.can-list' => CanListMenu::class,
        'service.menu.can-show' => CanShowMenu::class,
        'service.menu.can-create' => CanCreateMenu::class,
        'service.menu.can-edit' => CanEditMenu::class,
        'service.menu.can-delete' => CanDeleteMenu::class,
        //Service_Limit
        'service.limit.can-list' => CanListServiceLimit::class,
        'service.limit.can-show' => CanShowServiceLimit::class,
        'service.limit.can-create' => CanCreateServiceLimit::class,
        'service.limit.can-edit' => CanEditServiceLimit::class,
        'service.limit.can-delete' => CanDeleteServiceLimit::class,
        //Service_Commission
        'service.commission.can-list' => CanListCommission::class,
        'service.commission.can-show' => CanShowCommission::class,
        'service.commission.can-create' => CanCreateCommission::class,
        'service.commission.can-edit' => CanEditCommission::class,
        'service.commission.can-delete' => CanDeleteCommission::class,
        //Service_Workdays
        'service.workday.can-list' => CanListWorkday::class,
        'service.workday.can-show' => CanShowWorkday::class,
        'service.workday.can-create' => CanCreateWorkday::class,
        'service.workday.can-edit' => CanEditWorkday::class,
        'service.workday.can-delete' => CanDeleteWorkday::class,
        //Service_Category
        'service.category.can-list' => CanListCategory::class,
        'service.category.can-show' => CanShowCategory::class,
        'service.category.can-create' => CanCreateCategory::class,
        'service.category.can-edit' => CanEditCategory::class,
        'service.category.can-delete' => CanDeleteCategory::class,
        //Account
        'account.can-list' => CanListAccount::class,
        'account.can-show' => CanShowAccount::class,
        'account.can-create' => CanCreateAccount::class,
        'account.can-edit' => CanEditAccount::class,
        'account.can-delete' => CanDeleteAccount::class,
        //Account_history
        'account.history.can-list' => CanListAccountHistory::class,
        'account.history.can-show' => CanShowAccountHistory::class,
        'account.history.can-create' => CanCreateAccountHistory::class,
        'account.history.can-edit' => CanEditAccountHistory::class,
        'account.history.can-delete' => CanDeleteAccountHistory::class,
        //Account_type
        'account.type.can-list' => CanListAccountType::class,
        'account.type.can-show' => CanShowAccountType::class,
        'account.type.can-create' => CanCreateAccountType::class,
        'account.type.can-edit' => CanEditAccountType::class,
        'account.type.can-delete' => CanDeleteAccountType::class,
        //Currency
        'currency.can-list' => CanListCurrency::class,
        'currency.can-show' => CanShowCurrency::class,
        'currency.can-create' => CanCreateCurrency::class,
        'currency.can-edit' => CanEditCurrency::class,
        'currency.can-delete' => CanDeleteCurrency::class,
        //Currency_rate
        'currency.rate.can-list' => CanListCurrencyRate::class,
        'currency.rate.can-show' => CanShowCurrencyRate::class,
        'currency.rate.can-create' => CanCreateCurrencyRate::class,
        'currency.rate.can-edit' => CanEditCurrencyRate::class,
        'currency.rate.can-delete' => CanDeleteCurrencyRate::class,
        //Currency_rate_history
        'currency.rate.history.can-list' => CanListCurrencyRateHistory::class,
        'currency.rate.history.can-show' => CanShowCurrencyRateHistory::class,
        'currency.rate.history.can-create' => CanCreateCurrencyRateHistory::class,
        'currency.rate.history.can-edit' => CanEditCurrencyRateHistory::class,
        'currency.rate.history.can-delete' => CanDeleteCurrencyRateHistory::class,

        //CoordinatePoint
        'coordinatePoint.can-list' => CanListCoordinatePoint::class,
        'coordinatePoint.can-show' => CanShowCoordinatePoint::class,
        'coordinatePoint.can-create' => CanCreateCoordinatePoint::class,
        'coordinatePoint.can-edit' => CanEditCoordinatePoint::class,
        'coordinatePoint.can-delete' => CanDeleteCoordinatePoint::class,
        //CoordinatePointType
        'coordinatePointType.can-list' => CanListCoordinatePointType::class,
        'coordinatePointType.can-show' => CanShowCoordinatePointType::class,
        'coordinatePointType.can-create' => CanCreateCoordinatePointType::class,
        'coordinatePointType.can-edit' => CanEditCoordinatePointType::class,
        'coordinatePointType.can-delete' => CanDeleteCoordinatePointType::class,
        //CoordinatePointTypeService
        'coordinatePointTypeService.can-list' => CanListCoordinatePointTypeService::class,
        'coordinatePointTypeService.can-show' => CanShowCoordinatePointTypeService::class,
        'coordinatePointTypeService.can-create' => CanCreateCoordinatePointTypeService::class,
        'coordinatePointTypeService.can-edit' => CanEditCoordinatePointTypeService::class,
        'coordinatePointTypeService.can-delete' => CanDeleteCoordinatePointTypeService::class,
        //CoordinatePointService
        'coordinatePointService.can-list' => CanListCoordinatePointService::class,
        'coordinatePointService.can-show' => CanShowCoordinatePointService::class,
        'coordinatePointService.can-create' => CanCreateCoordinatePointService::class,
        'coordinatePointService.can-edit' => CanEditCoordinatePointService::class,
        'coordinatePointService.can-delete' => CanDeleteCoordinatePointService::class,
        //CoordinatePointWorkday
        'coordinatePointWorkday.can-list' => CanListCoordinatePointWorkday::class,
        'coordinatePointWorkday.can-show' => CanShowCoordinatePointWorkday::class,
        'coordinatePointWorkday.can-create' => CanCreateCoordinatePointWorkday::class,
        'coordinatePointWorkday.can-edit' => CanEditCoordinatePointWorkday::class,
        'coordinatePointWorkday.can-delete' => CanDeleteCoordinatePointWorkday::class,
        //CoordinatePointCity
        'coordinatePointCity.can-list' => CanListCoordinatePointCity::class,
        'coordinatePointCity.can-show' => CanShowCoordinatePointCity::class,
        'coordinatePointCity.can-create' => CanCreateCoordinatePointCity::class,
        'coordinatePointCity.can-edit' => CanEditCoordinatePointCity::class,
        'coordinatePointCity.can-delete' => CanDeleteCoordinatePointCity::class,

        //Client
        'client.can-show-list' => CanListClient::class,
        'client.can-show' => CanShowClient::class,
        'client.can-create' => CanCreateClient::class,
        'client.can-edit' => CanEditClient::class,
        'client.can-delete' => CanDeleteClient::class,
        'client.can-delete-pin' => CanDeletePinClient::class,
        'client.can-lockManage' => CanLockManageClient::class,
        'client.can-unlockManage' => CanUnLockManageClient::class,
        'client.can-delete-email' => CanDeleteEmailClient::class,
        'client.can-identificate' => CanIdentificateClient::class,
        'client.can-identificate-for-admin' => CanIdentificateClientForAdmin::class,
        'client.can-addCodeMap' => CanAddCodeMapClient::class,
        'client.can-deleteCodeMap' => CanDeleteCodeMapClient::class,
        'client.can-resetPassword' => CanResetPasswordClient::class,
        'client.can-updateLite' => CanUpdateLiteClient::class,

        //Attestation
        'attestation.can-list' => CanManageAttestation::class,
        //END USERS ROLES HERE
        // NEXT IS NOT FK SETTINGS   21.09.2018 17:14
        'user.can-show-list' => CanShowListUser::class,
        'user.can-show-detail' => CanShowDetailUser::class,
        'user.can-create' => CanCreateUser::class,
        'user.can-edit' => CanEditUser::class,
        'user.can-edit-admin' => CanEditUserAdmin::class,
        'user.can-lock' => CanLockUser::class,
        'user.can-unlock' => CanUnLockUser::class,
        'user.can-deleteEmail' => CanDeleteEmailUser::class,

        //Country
        'country.can-list' => CanListCountry::class,
        'country.can-show' => CanShowCountry::class,
        'country.can-create' => CanCreateCountry::class,
        'country.can-edit' => CanEditCountry::class,
        'country.can-delete' => CanDeleteCountry::class,

        //Region
        'region.can-list' => CanListRegion::class,
        'region.can-show' => CanShowRegion::class,
        'region.can-create' => CanCreateRegion::class,
        'region.can-edit' => CanEditRegion::class,
        'region.can-delete' => CanDeleteRegion::class,

        //Area
        'area.can-list' => CanListArea::class,
        'area.can-show' => CanShowArea::class,
        'area.can-create' => CanCreateArea::class,
        'area.can-edit' => CanEditArea::class,
        'area.can-delete' => CanDeleteArea::class,

        //City
        'city.can-list' => CanListCity::class,
        'city.can-show' => CanShowCity::class,
        'city.can-create' => CanCreateCity::class,
        'city.can-edit' => CanEditCity::class,
        'city.can-delete' => CanDeleteCity::class,

        //LicenseAgreement
        'license.can-show' => CanShowLicense::class,
        'license.can-edit' => CanEditLicense::class,

        //Registry
        'registry.can-manage' => CanManageRegistry::class,

        'registry-withdraw-merchant.can-manage' => CanManageRegistryWithdrawMerhcant::class,

        //DocApi
        'docapi.can-list' => CanListDocApi::class,

        //AccountStatus
        'account.status.can-list' => CanListAccountStatus::class,
        'account.status.can-show' => CanShowAccountStatus::class,
        'account.status.can-create' => CanCreateAccountStatus::class,
        'account.status.can-edit' => CanEditAccountStatus::class,
        'account.status.can-delete' => CanDeleteAccountStatus::class,

        'role.can-manage' => CanShowSectionRole::class,
        'checkAppVersion' => CheckAppVersion::class,

        //JobLog
        'jobLog.can-list' => CanListJobLog::class,
        'jobLog.can-show' => CanShowJobLog::class,

        //AccountCategoryType
        'account.categoryType.can-list' => CanListAccountCategoryType::class,
        'account.categoryType.can-show' => CanShowAccountCategoryType::class,
        'account.categoryType.can-edit' => CanEditAccountCategoryType::class,


        //bank
        'bank.can-list' => CanListBank::class,
        'bank.can-show' => CanShowBank::class,
        'bank.can-create' => CanCreateBank::class,
        'bank.can-edit' => CanEditBank::class,
        'bank.can-delete' => CanDeleteBank::class,

        //Branch
        'branch.can-list' => CanListBranch::class,
        'branch.can-show' => CanShowBranch::class,
        'branch.can-create' => CanCreateBranch::class,
        'branch.can-edit' => CanEditBranch::class,
        'branch.can-delete' => CanDeleteBranch::class,

        //categoryType
        'categoryType.can-manage' => CanManageCategoryType::class,

        //color
        'colors.can-manage' => CanManageColor::class,

        //documentType
        'documentType.can-list' => CanListDocumentType::class,
        'documentType.can-show' => CanShowDocumentType::class,
        'documentType.can-create' => CanCreateDocumentType::class,
        'documentType.can-edit' => CanEditDocumentType::class,
        'documentType.can-delete' => CanDeleteDocumentType::class,

        //event
        'events.can-manage' => CanManageEvent::class,

        //order
        'order.can-list' => CanListOrder::class,
        'order.can-show' => CanShowOrder::class,
        'order.can-edit' => CanEditOrder::class,

        //remoteIdentification
        'remoteIdentification.can-list' => CanListRemoteIdentification::class,
        'remoteIdentification.can-edit' => CanEditRemoteIdentification::class,
        'remoteIdentification.can-show' => CanShowRemoteIdentification::class,
        'remoteIdentification.can-update-status' => CanUpdateStatusRemoteIdentification::class,

        //orderType
        'order.orderType.can-list' => CanListOrderType::class,
        'order.orderType.can-show' => CanShowOrderType::class,

        //orderStatus
        'order.orderStatus.can-list' => CanListOrderStatus::class,
        'order.orderStatus.can-show' => CanShowOrderStatus::class,

        //orderCardType
        'orderCardType.can-list' => CanListOrderCardType::class,
        'orderCardType.can-show' => CanShowOrderCardType::class,
        'orderCardType.can-create' => CanCreateOrderCardType::class,
        'orderCardType.can-edit' => CanEditOrderCardType::class,
        'orderCardType.can-delete' => CanDeleteOrderCardType::class,

        //orderCardType
        'orderCardContractType.can-list' => CanListOrderCardContractType::class,
        'orderCardContractType.can-show' => CanShowOrderCardContractType::class,
        'orderCardContractType.can-create' => CanCreateOrderCardContractType::class,
        'orderCardContractType.can-edit' => CanEditOrderCardContractType::class,
        'orderCardContractType.can-delete' => CanDeleteOrderCardContractType::class,

        //orderAccountType
        'orderAccountType.can-list' => CanListOrderAccountType::class,
        'orderAccountType.can-show' => CanShowOrderAccountType::class,
        'orderAccountType.can-create' => CanCreateOrderAccountType::class,
        'orderAccountType.can-edit' => CanEditOrderAccountType::class,
        'orderAccountType.can-delete' => CanDeleteOrderAccountType::class,

        //orderAccountTypeItem
        'orderAccountTypeItem.can-list' => CanListOrderAccountTypeItem::class,
        'orderAccountTypeItem.can-show' => CanShowOrderAccountTypeItem::class,
        'orderAccountTypeItem.can-create' => CanCreateOrderAccountTypeItem::class,
        'orderAccountTypeItem.can-edit' => CanEditOrderAccountTypeItem::class,
        'orderAccountTypeItem.can-delete' => CanDeleteOrderAccountTypeItem::class,

        //orderDepositType
        'orderDepositType.can-list' => CanListOrderDepositType::class,
        'orderDepositType.can-show' => CanShowOrderDepositType::class,
        'orderDepositType.can-create' => CanCreateOrderDepositType::class,
        'orderDepositType.can-edit' => CanEditOrderDepositType::class,
        'orderDepositType.can-delete' => CanDeleteOrderDepositType::class,

        //orderDepositTypeItem
        'orderDepositTypeItem.can-list' => CanListOrderDepositTypeItem::class,
        'orderDepositTypeItem.can-show' => CanShowOrderDepositTypeItem::class,
        'orderDepositTypeItem.can-create' => CanCreateOrderDepositTypeItem::class,
        'orderDepositTypeItem.can-edit' => CanEditOrderDepositTypeItem::class,
        'orderDepositTypeItem.can-delete' => CanDeleteOrderDepositTypeItem::class,

        //tempUser
        'user.tempUser.can-list' => CanListTempUser::class,
        'user.tempUser.can-show' => CanShowTempUser::class,

        //purpose
        'purpose.can-list' => CanListPurpose::class,
        'purpose.can-show' => CanShowPurpose::class,

        //transferList
        'transferList.can-list' => CanListTransferList::class,
        'transferList.can-show' => CanShowTransferList::class,
        'transferList.can-create' => CanCreateTransferList::class,
        'transferList.can-edit' => CanEditTransferList::class,
        'transferList.can-delete' => CanDeleteTransferList::class,

        //unverifiedUser
        'user.unverifiedUser.can-list' => CanListUnverifiedUser::class,
        'user.unverifiedUser.can-show' => CanShowUnverifiedUser::class,

        //userSessionCode
        'user.userSessionCode.can-list' => CanListUserSessionCode::class,
        'user.userSessionCode.can-show' => CanShowUserSessionCode::class,

        //transferList
        'news.can-list' => CanListNews::class,
        'news.can-show' => CanShowNews::class,
        'news.can-create' => CanCreateNews::class,
        'news.can-edit' => CanEditNews::class,
        'news.can-delete' => CanDeleteNews::class,

        //Service_OTP_Limit
        'service.otp.limit.can-list' => CanListServiceOtpLimit::class,
        'service.otp.limit.can-show' => CanShowServiceOtpLimit::class,
        'service.otp.limit.can-create' => CanCreateServiceOtpLimit::class,
        'service.otp.limit.can-edit' => CanEditServiceOtpLimit::class,
        'service.otp.limit.can-delete' => CanDeleteServiceOtpLimit::class,

        //merchant
        'merchant.can-list' => CanListMerchant::class,
        'merchant.can-show' => CanShowMerchant::class,
        'merchant.can-create' => CanCreateMerchant::class,
        'merchant.can-edit' => CanEditMerchant::class,
        'merchant.can-delete' => CanDeleteMerchant::class,
        'merchant.can-delete-contract' => CanDeleteContractMerchant::class,

        //merchant-item
        'merchant.item.can-list' => CanListMerchantItem::class,
        'merchant.item.can-show' => CanShowMerchantItem::class,
        'merchant.item.can-create' => CanCreateMerchantItem::class,
        'merchant.item.can-edit' => CanEditMerchantItem::class,
        'merchant.item.can-delete' => CanDeleteMerchantItem::class,
        'merchant.item.can-changeAccountNumber' => CanChangeAccountNumberMerchantItem::class,

        //merchant-category
        'merchant.category.can-list' => CanListMerchantCategory::class,
        'merchant.category.can-show' => CanShowMerchantCategory::class,
        'merchant.category.can-create' => CanCreateMerchantCategory::class,
        'merchant.category.can-edit' => CanEditMerchantCategory::class,
        'merchant.category.can-delete' => CanDeleteMerchantCategory::class,

        //merchant-workdays
        'merchant.workdays.can-list' => CanListMerchantWorkdays::class,
        'merchant.workdays.can-show' => CanShowMerchantWorkdays::class,
        'merchant.workdays.can-create' => CanCreateMerchantWorkdays::class,
        'merchant.workdays.can-edit' => CanEditMerchantWorkdays::class,
        'merchant.workdays.can-delete' => CanDeleteMerchantWorkdays::class,

        //merchant-commission
        'merchant.commission.can-list' => CanListMerchantCommission::class,
        'merchant.commission.can-show' => CanShowMerchantCommission::class,
        'merchant.commission.can-create' => CanCreateMerchantCommission::class,
        'merchant.commission.can-edit' => CanEditMerchantCommission::class,
        'merchant.commission.can-delete' => CanDeleteMerchantCommission::class,

        //merchant-user
        'merchant.user.can-list' => CanListMerchantUser::class,
        'merchant.user.can-show' => CanShowMerchantUser::class,
        'merchant.user.can-edit' => CanEditMerchantUser::class,
        'merchant.user.can-delete' => CanDeleteMerchantUser::class,

        //merchant-commission-item
        'merchant.commission.item.can-list' => CanListMerchantCommissionItem::class,
        'merchant.commission.item.can-show' => CanShowMerchantCommissionItem::class,
        'merchant.commission.item.can-create' => CanCreateMerchantCommissionItem::class,
        'merchant.commission.item.can-edit' => CanEditMerchantCommissionItem::class,
        'merchant.commission.item.can-delete' => CanDeleteMerchantCommissionItem::class,

        //cashback-workdays
        'cashback.can-list' => CanListCashback::class,
        'cashback.can-show' => CanShowCashback::class,
        'cashback.can-create' => CanCreateCashback::class,
        'cashback.can-edit' => CanEditCashback::class,
        'cashback.can-delete' => CanDeleteCashback::class,

        //cashback-item
        'cashback.item.can-list' => CanListCashbackItem::class,
        'cashback.item.can-show' => CanShowCashbackItem::class,
        'cashback.item.can-create' => CanCreateCashbackItem::class,
        'cashback.item.can-edit' => CanEditCashbackItem::class,
        'cashback.item.can-delete' => CanDeleteCashbackItem::class,

        //JobHistory
        'jobHistory.can-list' => CanListJobHistory::class,
        'jobHistory.can-show' => CanShowJobHistory::class,
        'jobHistoryCommand.can-list' => CanListJobHistoryCommand::class,

        //cashback-type
        'cashback.type.can-list'=>CanListCashbackType::class,
        'cashback.type.can-show'=>CanShowCashbackType::class,
        'cashback.type.can-edit'=>CanEditCashbackType::class,
        'cashback.type.can-create'=>CanCreateCashbackType::class,
        'cashback.type.can-delete'=>CanDeleteCashbackType::class,

        //bonus-accrual
        'bonus.accrual.can-list'=>CanListBonusAccrual::class,
        'bonus.accrual.can-show'=>CanShowBonusAccrual::class,

        //bonus-accrual-status
        'bonus.accrual.status.can-list'=>CanListBonusAccrualStatus::class,
        'bonus.accrual.status.can-show'=>CanShowBonusAccrualStatus::class,
        'bonus.accrual.status.can-edit'=>CanEditBonusAccrualStatus::class,
        'bonus.accrual.status.can-create'=>CanCreateBonusAccrualStatus::class,
        'bonus.accrual.status.can-delete'=>CanDeleteBonusAccrualStatus::class,

        //FAQQuestion
        'FAQQuestion.can-list'=>CanListFAQQuestion::class,
        'FAQQuestion.can-show'=>CanShowFAQQuestion::class,
        'FAQQuestion.can-edit'=>CanEditFAQQuestion::class,
        'FAQQuestion.can-create'=>CanCreateFAQQuestion::class,
        'FAQQuestion.can-delete'=>CanDeleteFAQQuestion::class,

        //FAQAnswer
        'FAQAnswer.can-list'=>CanListFAQAnswer::class,
        'FAQAnswer.can-show'=>CanShowFAQAnswer::class,
        'FAQAnswer.can-edit'=>CanEditFAQAnswer::class,
        'FAQAnswer.can-create'=>CanCreateFAQAnswer::class,
        'FAQAnswer.can-delete'=>CanDeleteFAQAnswer::class,

        //FileManager
        'FileManager.can-list'=>CanListFileManager::class,
        'FileManager.can-delete'=>CanDeleteFileManager::class,
        'FileManager.can-store'=>CanStoreFileManager::class,
        'FileManager.can-download'=>CanDownloadFileManager::class,
        'FileManager.can-edit'=>CanEditFileManager::class,

        'reportMerchant.can-list' => CanListReportMerchant::class,


        'orderComment.can-list' => CanListOrderComment::class,
        'orderComment.can-show' => CanShowOrderComment::class,
        'orderComment.can-create' => CanCreateOrderComment::class,
        'orderComment.can-edit' => CanEditOrderComment::class,

        //SplashScreen
        'splashScreen.can-show' => CanShowSplashScreen::class,
        'splashScreen.can-create' => CanCreateSplashScreen::class,

        'reports.can-list' => CanListReports::class,

        //ScheduleType
        'ScheduleType.can-list' => CanListScheduleType::class,
        'ScheduleType.can-show' => CanShowScheduleType::class,

        //Schedule
        'Schedule.can-list' => CanListSchedule::class,
        'Schedule.can-show' => CanShowSchedule::class,
        'Schedule.can-edit' => CanEditSchedule::class,
        'Schedule.can-create' => CanCreateSchedule::class,
        'Schedule.can-delete' => CanDeleteSchedule::class,
        //Dwh rules
        'dwhRule.can-list' => CanListDwhRule::class,
        'dwhRule.can-show' => CanShowDwhRule::class,
        'dwhRule.can-edit' => CanEditDwhRule::class,
        'dwhRule.can-create' => CanCreateDwhRule::class,
        'dwhRule.can-delete' => CanDeleteDwhRule::class,

        //ScheduleJob
        'ScheduleJob.can-list' => CanListScheduleJob::class,
        'ScheduleJob.can-show' => CanShowScheduleJob::class,
        'ScheduleJob.can-create' => CanCreateScheduleJob::class,

        'reportAnalysis.can-list' => CanListReportAnalysis::class,
        'reportAnalysis.can-delete' => CanDeleteReportAnalysis::class,
        'reportAnalysis.can-create' => CanCreateReportAnalysis::class,
        'reportAnalysis.can-edit' => CanEditReportAnalysis::class,
        'rememberSearchFields' => RememberSearchFields::class,

    );
}
