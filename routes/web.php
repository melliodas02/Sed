<?php


use Illuminate\Support\Facades\Route;

/**
 * Домашний контроллер
 */
use App\Http\Controllers\HomeController;

/**
 * Организации контроллер
 */
use App\Http\Controllers\Sed\OrganizationController;

/**
 * Входящие документы
 */
use App\Http\Controllers\Sed\InputControllers\InputDocsController;

/**
 * Исходящие документы
 */
use \App\Http\Controllers\Sed\OutputController\OutputDocsController;

/**
 * Приказы
 */
use App\Http\Controllers\Sed\Orders\OrderController;

/**
 * Служебные записки
 */
use App\Http\Controllers\Sed\Memos\MemosController;

/**
 * Договоры
 */
use App\Http\Controllers\Sed\Contracts\ContractsController;

/**
 * Почта
 */
use App\Http\Controllers\Sed\Mails\MailController;

/**
 * Пользователь
 */
use App\Http\Controllers\Users\UserController;

/**
 * Поиск
 */
use App\Http\Controllers\Sed\Search\SearchController;

/**
 * Роли
 */
use App\Http\Controllers\RolePermissions\RoleController;

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /**
     * Роуты для организаций
     */
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('organization.index');
    Route::get('/organizations/add', [OrganizationController::class, 'add'])->name('organization.add');
    Route::post('/organizations/create', [OrganizationController::class, 'create'])->name('organization.create');
    Route::get('/organizations/{id}', [OrganizationController::class, 'show'])->name('organization.show');
    Route::get('/organizations/{id}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
    Route::post('/organizations/{id}/save_changes', [OrganizationController::class, 'saveChanges'])->name('organization.saveChanges');
    Route::get('/organizations/{id}/remove', [OrganizationController::class, 'remove'])->name('organization.remove');

    /**
     * Роуты для входящих документов
     */
    Route::get('/inputDocs/add', [InputDocsController::class, 'add'])->name('inputDocs.add');
    Route::post('/inputDocs/save', [InputDocsController::class, 'save'])->name('inputDocs.save');
    Route::get('/inputDocs/{id}/edit', [InputDocsController::class, 'edit'])->name('inputDocs.edit');
    Route::post('/inputDocs/{id}/put', [InputDocsController::class, 'put'])->name('inputDocs.put');
    Route::get('/inputDocs/{id}/remove', [InputDocsController::class, 'delete'])->name('inputDocs.delete');
    Route::get('/inputDocs/{id}/download', [InputDocsController::class, 'download'])->name('inputDocs.download');

    Route::get('/inputDocs/DocumentsFromAHigherLevelOrganization', [InputDocsController::class, 'DocumentsFromAHigherLevelOrganization'])->name('docFromHiherLevel.index');
    Route::get('/inputDocs/DocumentsFromAHigherLevelOrganization/{id}', [InputDocsController::class, 'info'])->name('docFromHiherLevel.info');

    Route::get('/inputDocs/CorrespondeceWithStateAuthorities', [InputDocsController::class, 'CorrespondeceWithStateAuthorities'])->name('CorrespondeceWithStateAuthorities.index');
    Route::get('/inputDocs/CorrespondeceWithStateAuthorities/{id}', [InputDocsController::class, 'info'])->name('CorrespondeceWithStateAuthorities.info');

    Route::get('/inputDocs/CorrespondenceWithOrganizationsAndEnterprises', [InputDocsController::class, 'CorrespondenceWithOrganizationsAndEnterprises'])->name('CorrespondenceWithOrganizationsAndEnterprises.index');
    Route::get('/inputDocs/CorrespondenceWithOrganizationsAndEnterprises/{id}', [InputDocsController::class, 'info'])->name('CorrespondenceWithOrganizationsAndEnterprises.info');

    /**
     * Роуты для исходящих документов
     */
    Route::get('/outputDocs/add', [OutputDocsController::class, 'add'])->name('OutputDocs.add');
    Route::post('/outputDocs/save', [OutputDocsController::class, 'save'])->name('OutputDocs.save');
    Route::get('/outputDocs/{id}/edit', [OutputDocsController::class, 'edit'])->name('OutputDocs.edit');
    Route::post('/outputDocs/{id}/put', [OutputDocsController::class, 'put'])->name('OutputDocs.put');
    Route::get('/outputDocs/{id}/remove', [OutputDocsController::class, 'delete'])->name('OutputDocs.delete');
    Route::get('/outputDocs/{id}/download', [OutputDocsController::class, 'download'])->name('OutputDocs.download');

    Route::get('/outputDocs/CorrespondenceWithOrganizationsAndEnterprisesOutput', [OutputDocsController::class, 'CorrespondenceWithOrganizationsAndEnterprisesOutput'])->name('correspondence_with_organizations_and_enterprises.index');
    Route::get('/outputDocs/CorrespondenceWithOrganizationsAndEnterprisesOutput/{id}', [OutputDocsController::class, 'info'])->name('correspondence_with_organizations_and_enterprises.info');

    Route::get('/outputDocs/CorrespondenceWithStateAuthoritiesOutput', [OutputDocsController::class, 'CorrespondenceWithStateAuthoritiesOutput'])->name('correspondence_with_state_authorities.index');
    Route::get('/outputDocs/CorrespondenceWithStateAuthoritiesOutput/{id}', [OutputDocsController::class, 'info'])->name('correspondence_with_state_authorities.info');

    Route::get('/outputDocs/DocumentsFromAHigherLevelOrganizationsOutput', [OutputDocsController::class, 'DocumentsFromAHigherLevelOrganizationsOutput'])->name('documents_from_a_higher_level_organizations.index');
    Route::get('/outputDocs/DocumentsFromAHigherLevelOrganizationsOutput/{id}', [OutputDocsController::class, 'info'])->name('documents_from_a_higher_level_organizations.info');

    /**
     * Роуты для приказов
     */
    Route::get('/orders/add', [OrderController::class, 'add'])->name('orders.add');
    Route::post('/orders/save', [OrderController::class, 'save'])->name('orders.save');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::post('/order/{id}/put', [OrderController::class, 'put'])->name('orders.put');
    Route::get('/orders/{id}/remove', [OrderController::class, 'delete'])->name('orders.delete');
    Route::get('/orders/{id}/download', [OrderController::class, 'download'])->name('orders.download');

    Route::get('/orders/OrdersOnTheBasicsOfActivity', [OrderController::class, 'OrdersOnTheBasicsOfActivity'])->name('orders.OrdersOnTheBasicsOfActivity');
    Route::get('/orders/OrdersOnTheBasicsOfActivity/{id}', [OrderController::class, 'info'])->name('orders.OrdersOnTheBasicsOfActivity.info');

    Route::get('/orders/OrdersOnAdministrativeAndEconomicIssues', [OrderController::class, 'OrdersOnAdministrativeAndEconomicIssues'])->name('orders.OrdersOnAdministrativeAndEconomicIssues');
    Route::get('/orders/OrdersOnAdministrativeAndEconomicIssues/{id}', [OrderController::class, 'info'])->name('orders.OrdersOnAdministrativeAndEconomicIssues.info');

    Route::get('/orders/TravelOrders', [OrderController::class, 'TravelOrders'])->name('orders.TravelOrders');
    Route::get('/orders/TravelOrders/{id}', [OrderController::class, 'info'])->name('orders.TravelOrders.info');

    /**
     * Роуты для служебных записок
     */

    Route::get('/memos/add', [MemosController::class, 'add'])->name('memos.add');
    Route::post('/memos/save', [MemosController::class, 'save'])->name('memos.save');
    Route::get('/memos/{id}/edit', [MemosController::class, 'edit'])->name('memos.edit');
    Route::post('/memos/{id}/put', [MemosController::class, 'put'])->name('memos.put');
    Route::get('/memos/{id}/remove', [MemosController::class, 'delete'])->name('memos.delete');
    Route::get('/memos/{id}/download', [MemosController::class, 'download'])->name('memos.download');

    Route::get('/memos/AboutEmployeeBusinessTrips', [MemosController::class, 'AboutEmployeeBusinessTrips'])->name('memos.AboutEmployeeBusinessTrips');
    Route::get('/memos/AboutEmployeeBusinessTrips/{id}', [MemosController::class, 'info'])->name('memos.AboutEmployeeBusinessTrips.info');

    Route::get('/memos/AboutTheDevelopmentAndChangeOfStaffSchedules', [MemosController::class, 'AboutTheDevelopmentAndChangeOfStaffSchedules'])->name('memos.AboutTheDevelopmentAndChangeOfStaffSchedules');
    Route::get('/memos/AboutTheDevelopmentAndChangeOfStaffSchedules/{id}', [MemosController::class, 'info'])->name('memos.AboutTheDevelopmentAndChangeOfStaffSchedules.info');

    Route::get('/memos/ForPurchase', [MemosController::class, 'ForPurchase'])->name('memos.ForPurchase');
    Route::get('/memos/ForPurchase/{id}', [MemosController::class, 'info'])->name('memos.ForPurchase.info');

    Route::get('/memos/AboutReimbursementOfExpenses', [MemosController::class, 'AboutReimbursementOfExpenses'])->name('memos.AboutReimbursementOfExpenses');
    Route::get('/memos/AboutReimbursementOfExpenses/{id}', [MemosController::class, 'info'])->name('memos.AboutReimbursementOfExpenses.info');

    /**
     * Роуты для договоров
     */
    Route::get('/contracts/add', [ContractsController::class, 'add'])->name('contracts.add');
    Route::post('/contracts/save', [ContractsController::class, 'save'])->name('contracts.save');
    Route::get('/contracts/{id}/edit', [ContractsController::class, 'edit'])->name('contracts.edit');
    Route::post('/contracts/{id}/put}', [ContractsController::class, 'put'])->name('contracts.puy');
    Route::get('/contracts/{id}/remove', [ContractsController::class, 'delete'])->name('contracts.delete');
    Route::get('/contracts/{id}/download', [ContractsController::class, 'download'])->name('contracts.download');

    Route::get('/contracts/PurchaseAndSaleAgreement', [ContractsController::class, 'PurchaseAndSaleAgreement'])->name('contracts.PurchaseAndSaleAgreement');
    Route::get('/contracts/PurchaseAndSaleAgreement/{id}', [ContractsController::class, 'info'])->name('contracts.PurchaseAndSaleAgreement.info');

    Route::get('/contracts/LeaseAgreement', [ContractsController::class, 'LeaseAgreement'])->name('contracts.LeaseAgreement');
    Route::get('/contracts/LeaseAgreement/{id}', [ContractsController::class, 'info'])->name('contracts.LeaseAgreement.info');

    Route::get('/contracts/DeliveryContract', [ContractsController::class, 'DeliveryContract'])->name('contracts.DeliveryContract');
    Route::get('/contracts/DeliveryContract/{id}', [ContractsController::class, 'info'])->name('contracts.DeliveryContract.info');

    Route::get('/contracts/ContractAgreement', [ContractsController::class, 'ContractAgreement'])->name('contracts.ContractAgreement');
    Route::get('/contracts/ContractAgreement/{id}', [ContractsController::class, 'info'])->name('contracts.ContractAgreement.info');

    /**
     *  Роуты для работы с почтой
     */
    Route::get('/mails', [MailController::class, 'index'])->name('mails.index');
    Route::get('/mails/update', [MailController::class, 'update'])->name('mails.update');
    Route::get('/mails/{id}', [MailController::class, 'info'])->name('mails.info');
    Route::get('/mails/{id}/download', [MailController::class, 'download'])->name('mails.download');
    Route::get('/mails/pushInDocs/{id}', [MailController::class, 'pushInDocs'])->name('mails.pushInDocs');
    Route::post('/mails/save_documents', [MailController::class, 'save_documents'])->name('mails.save_documents');

    /**
     * Роуты для настроек пользователя
     */
    Route::resource('users', UserController::class);

    /**
     * Роуты для управления ролями
     */
    Route::resource('roles', RoleController::class);

    /**
     * Роуты для поиска
     */
    Route::get('/search/{search}', [SearchController::class, 'search'])->name('search.index');
});
