<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MyDashboardController;
use App\Http\Controllers\backend\configuration\UserController;
use App\Http\Controllers\backend\configuration\RoleController;
use App\Http\Controllers\backend\configuration\UsertypeController;
use App\Http\Controllers\backend\configuration\ExpenseTypeController;
use App\Http\Controllers\backend\configuration\IncomeTypeController;
use App\Http\Controllers\backend\configuration\SavingTypeController;
use App\Http\Controllers\backend\configuration\TutorialController;
use App\Http\Controllers\backend\configuration\LiabilityTypeController;
use App\Http\Controllers\backend\configuration\ReceivableTypeController;
use App\Http\Controllers\backend\incomeExpense\MyIncomeController;
use App\Http\Controllers\backend\incomeExpense\MyExpenseController;
use App\Http\Controllers\backend\saving\MySavingController;
use App\Http\Controllers\backend\liability\MyLiabilityController;
use App\Http\Controllers\backend\liability\MyLiabilityPaymentController;
use App\Http\Controllers\backend\receivable\MyReceivableController;
use App\Http\Controllers\backend\receivable\MyReceivablePaymentController;
use App\Http\Controllers\backend\saving\MySavingDepositController;
use App\Http\Controllers\backend\saving\MySavingWithdrawalController;
use App\Http\Controllers\backend\report\ReportController;
use App\Http\Controllers\backend\contact\ContactController;
/*
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('dashboard');
})->name('dashboard');

// Route to logout
Route::get('logout', [AdminController::class, 'Logout'])->name('logout');

// route for my dashboard
Route::get('myDashboard', [MyDashboardController::class, 'MyDashboard'])->name('dashboard');
// Route to go to admin dashboard
Route::get('adminDashboard', [AdminController::class, 'AdminDashboardView'])->name('adminDashboard');

// Configuration all routes
Route::prefix('configuration')->group(function(){

    // All user routes
    Route::get('user/view', [UserController::class, 'UserView'])->name('user.view');
    Route::POST('user/add', [UserController::class, 'UserAdd'])->name('user.add');
    Route::POST('user/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
    Route::POST('user/register', [UserController::class, 'UserRegister'])->name('user.register');
    Route::get('user/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');

    // All Role routes
    Route::get('role/view', [RoleController::class, 'RoleView'])->name('role.view');
    Route::POST('role/add', [RoleController::class, 'RoleAdd'])->name('role.add');
    Route::POST('role/edit/{id}', [RoleController::class, 'RoleEdit'])->name('role.edit');
    Route::get('role/delete/{id}', [RoleController::class, 'RoleDelete'])->name('role.delete');

    // All usertype routes
    Route::get('usertype/view', [UsertypeController::class, 'UsertypeView'])->name('usertype.view');
    Route::POST('usertype/add', [UsertypeController::class, 'UsertypeAdd'])->name('usertype.add');
    Route::POST('usertype/edit/{id}', [UsertypeController::class, 'UsertypeEdit'])->name('usertype.edit');
    Route::get('usertype/delete/{id}', [UsertypeController::class, 'UsertypeDelete'])->name('usertype.delete');

    // All expensetype routes
    Route::get('expenseType/view', [ExpenseTypeController::class, 'ExpenseTypeView'])->name('expenseType.view');
    Route::POST('expenseType/add', [ExpenseTypeController::class, 'ExpenseTypeAdd'])->name('expenseType.add');
    Route::POST('expenseType/edit/{id}', [ExpenseTypeController::class, 'ExpenseTypeEdit'])->name('expenseType.edit');
    Route::get('expenseType/delete/{id}', [ExpenseTypeController::class, 'ExpenseTypeDelete'])->name('expenseType.delete');

    // All incomeType routes
    Route::get('incomeType/view', [IncomeTypeController::class, 'IncomeTypeView'])->name('incomeType.view');
    Route::POST('incomeType/add', [IncomeTypeController::class, 'IncomeTypeAdd'])->name('incomeType.add');
    Route::POST('incomeType/edit/{id}', [IncomeTypeController::class, 'IncomeTypeEdit'])->name('incomeType.edit');
    Route::get('incomeType/delete/{id}', [IncomeTypeController::class, 'IncomeTypeDelete'])->name('incomeType.delete');

    // All savingType routes
    Route::get('savingType/view', [SavingTypeController::class, 'SavingTypeView'])->name('savingType.view');
    Route::POST('savingType/add', [SavingTypeController::class, 'SavingTypeAdd'])->name('savingType.add');
    Route::POST('savingType/edit/{id}', [SavingTypeController::class, 'SavingTypeEdit'])->name('savingType.edit');
    Route::get('savingType/delete/{id}', [SavingTypeController::class, 'SavingTypeDelete'])->name('savingType.delete');

    // All tutorial routes
    Route::get('tutorial/view', [TutorialController::class, 'TutorialView'])->name('tutorial.view');
    Route::POST('tutorial/add', [TutorialController::class, 'TutorialAdd'])->name('tutorial.add');
    Route::POST('tutorial/edit/{id}', [TutorialController::class, 'TutorialEdit'])->name('tutorial.edit');
    Route::get('tutorial/delete/{id}', [TutorialController::class, 'TutorialDelete'])->name('tutorial.delete');

    // All liability routes
    Route::get('liabilityType/view', [LiabilityTypeController::class, 'LiabilityTypeView'])->name('liabilityType.view');
    Route::POST('liabilityType/add', [LiabilityTypeController::class, 'LiabilityTypeAdd'])->name('liabilityType.add');
    Route::POST('liabilityType/edit/{id}', [LiabilityTypeController::class, 'LiabilityTypeEdit'])->name('liabilityType.edit');
    Route::get('liabilityType/delete/{id}', [LiabilityTypeController::class, 'LiabilityTypeDelete'])->name('liabilityType.delete');

    // All receivable routes
    Route::get('receivableType/view', [ReceivableTypeController::class, 'ReceivableTypeView'])->name('receivableType.view');
    Route::POST('receivableType/add', [ReceivableTypeController::class, 'ReceivableTypeAdd'])->name('receivableType.add');
    Route::POST('receivableType/edit/{id}', [ReceivableTypeController::class, 'ReceivableTypeEdit'])->name('receivableType.edit');
    Route::get('receivableType/delete/{id}', [ReceivableTypeController::class, 'ReceivableTypeDelete'])->name('receivableType.delete');

});
Route::prefix('incomeExpense')->group(function(){
    // All myIncome routes
    Route::get('myIncome/view', [MyIncomeController::class, 'MyIncomeView'])->name('myIncome.view');
    Route::POST('myIncome/add', [MyIncomeController::class, 'MyIncomeAdd'])->name('myIncome.add');
    Route::POST('myIncome/edit/{id}', [MyIncomeController::class, 'MyIncomeEdit'])->name('myIncome.edit');
    Route::get('myIncome/delete/{id}', [MyIncomeController::class, 'MyIncomeDelete'])->name('myIncome.delete');

    // All myExpense routes
    Route::get('myExpense/view', [MyExpenseController::class, 'MyExpenseView'])->name('myExpense.view');
    Route::POST('myExpense/add', [MyExpenseController::class, 'MyExpenseAdd'])->name('myExpense.add');
    Route::POST('myExpense/edit/{id}', [MyExpenseController::class, 'MyExpenseEdit'])->name('myExpense.edit');
    Route::get('myExpense/delete/{id}', [MyExpenseController::class, 'MyExpenseDelete'])->name('myExpense.delete');

});
Route::prefix('saving')->group(function(){
    // All mySaving routes
    Route::get('mySaving/view', [MySavingController::class, 'MySavingView'])->name('mySaving.view');
    Route::POST('mySaving/add', [MySavingController::class, 'MySavingAdd'])->name('mySaving.add');
    Route::POST('mySaving/edit/{id}', [MySavingController::class, 'MySavingEdit'])->name('mySaving.edit');
    Route::get('mySaving/delete/{id}', [MySavingController::class, 'MySavingDelete'])->name('mySaving.delete');
    Route::get('mySaving/complete/{id}', [MySavingController::class, 'MySavingComplete'])->name('mySaving.complete');
    Route::get('mySaving/terminate/{id}', [MySavingController::class, 'MySavingTerminate'])->name('mySaving.terminate');

    // All mySavingDeposit routes
    Route::POST('mySavingDeposit/add/{id}', [MySavingDepositController::class, 'MySavingDepositAdd'])->name('mySavingDeposit.add');
    Route::get('mySavingDeposit/delete/{depId}', [MySavingDepositController::class, 'MySavingDepositDelete'])->name('mySavingDeposit.delete');

    // All mySavingWithdrawal routes
    Route::POST('mySavingWithdrawal/add/{id}', [MySavingWithdrawalController::class, 'MySavingWithdrawalAdd'])->name('mySavingWithdrawal.add');
    Route::get('mySavingWithdrawal/delete/{withId}', [MySavingWithdrawalController::class, 'MySavingWithdrawalDelete'])->name('mySavingWithdrawal.delete');
});
Route::prefix('liability')->group(function(){
    // All mySaving routes
    Route::get('myLiability/view', [MyLiabilityController::class, 'MyLiabilityView'])->name('myLiability.view');
    Route::POST('myLiability/add', [MyLiabilityController::class, 'MyLiabilityAdd'])->name('myLiability.add');
    Route::POST('myLiability/edit/{id}', [MyLiabilityController::class, 'MyLiabilityEdit'])->name('myLiability.edit');
    Route::get('myLiability/delete/{id}', [MyLiabilityController::class, 'MyLiabilityDelete'])->name('myLiability.delete');

    // All mySavingDeposit routes
    Route::POST('myLiabilityPayment/add/{id}', [MyLiabilityPaymentController::class, 'MyLiabilityPaymentAdd'])->name('myLiabilityPayment.add');
    Route::get('myLiabilityPayment/delete/{payid}', [MyLiabilityPaymentController::class, 'MyLiabilityPaymentDelete'])->name('myLiabilityPayment.delete');

});
Route::prefix('receivable')->group(function(){
    // All my recievable routes
    Route::get('myReceivable/view', [MyReceivableController::class, 'MyReceivableView'])->name('myReceivable.view');
    Route::POST('myReceivable/add', [MyReceivableController::class, 'MyReceivableAdd'])->name('myReceivable.add');
    Route::POST('myReceivable/edit/{id}', [MyReceivableController::class, 'MyReceivableEdit'])->name('myReceivable.edit');
    Route::get('myReceivable/delete/{id}', [MyReceivableController::class, 'MyReceivableDelete'])->name('myReceivable.delete');

    // All my recievable payment routes
    Route::POST('myReceivablePayment/add/{id}', [MyReceivablePaymentController::class, 'MyReceivablePaymentAdd'])->name('myReceivablePayment.add');
    Route::get('myReceivablePayment/delete/{payid}', [MyReceivablePaymentController::class, 'MyReceivablePaymentDelete'])->name('myReceivablePayment.delete');

});

Route::get('report/view', [ReportController::class, 'ReportView'])->name('report.view');
Route::get('report/generate', [ReportController::class, 'ReportGenerate'])->name('report.generate');

Route::prefix('contact')->group(function(){
    Route::get('feedback/view', [ContactController::class, 'FeedbackView'])->name('feedback.view');
    Route::get('contactAdmin', [ContactController::class, 'ContactAdmin'])->name('contact.contactadmin');
    Route::get('contactAdmin/send', [ContactController::class, 'ContactAdminSend'])->name('contact.contactadmin.send');
    Route::get('contactUser', [ContactController::class, 'ContactUser'])->name('contact.contactuser');
    Route::get('contactUser/send/{recId}', [ContactController::class, 'ContactUserSend'])->name('contact.contactuser.send');
    Route::get('contactUser/{id}', [ContactController::class, 'ShowMessages'])->name('contact.contactuser.showmessage');
    Route::get('compose', [ContactController::class, 'ComposeMessageView'])->name('contact.compose.view');
});

Route::prefix('help')->group(function(){
    Route::get('help/tutorial', [TutorialController::class, 'TutorialHelp'])->name('help.tutorial');
});
