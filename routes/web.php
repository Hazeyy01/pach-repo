<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ChildGrowthController;
use App\Http\Controllers\ChildDevelopmentController;
use App\Http\Controllers\ChildImmunizationController;
use App\Http\Controllers\MilestoneQuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/officer', function () {
    return view('officer_signup');
});
Route::get('/officer/dashboard/profile', function () {
    return view('officer_profile');
});
Route::get('/officer/{id}', [ UserController::class, 'showOfficer' ]);
Route::post('/officer', [ UserController::class, 'storeOfficer' ]);
Route::put('/officer', [ UserController::class, 'updateOfficer' ]);
Route::post('/officer/signin', [ UserController::class, 'signinOfficer' ]);
Route::delete('/officer/{id}', [ UserController::class, 'destroyOfficer' ]);

Route::get('/parent', function () {
    return view('parent_signup');
});
Route::get('/parent/dashboard/profile', function () {
    return view('parent_profile');
});
Route::get('/parent/{id}', [ UserController::class, 'showParent' ]);
Route::post('/parent', [ UserController::class, 'storeParent' ]);
Route::put('/parent', [ UserController::class, 'updateParent' ]);
Route::post('/parent/signin', [ UserController::class, 'signinParent' ]);
Route::delete('/parent/{id}', [ UserController::class, 'destroyParent' ]);

// parent children routing
Route::get('/parent/dashboard/childrens/page', function () {
    return view('childrens_page');
});
Route::get('/parent/dashboard/children/page/{id}', function () {
    return view('children_page');
});
Route::get('/childrens', [ ChildrenController::class, 'index' ]);
Route::get('/childrens/{parent_id}', [ ChildrenController::class, 'index_parent_id' ]);
Route::get('/children/{id}', [ ChildrenController::class, 'show' ]);
Route::post('/children', [ ChildrenController::class, 'store' ]);
Route::put('/children', [ ChildrenController::class, 'update' ]);
Route::delete('/children/{id}', [ ChildrenController::class, 'destroy' ]);

// officer vaccine routing
Route::get('/officer/dashboard/vaccines/page', function () {
    return view('vaccines_page');
});
Route::get('/officer/dashboard/vaccine/page', function () {
    return view('vaccine_page');
});
Route::get('/vaccines', [ VaccineController::class, 'index' ]);
Route::get('/vaccine/{id}', [ VaccineController::class, 'show' ]);
Route::post('/vaccine', [ VaccineController::class, 'store' ]);
Route::put('/vaccine', [ VaccineController::class, 'update' ]);
Route::delete('/vaccine/{id}', [ VaccineController::class, 'destroy' ]);

// officer immunization routing
Route::get('/child_immunizations', [ ChildImmunizationController::class, 'index' ]);
Route::get('/child_immunization_vaccine/{children_id}', [ ChildImmunizationController::class, 'index_immunization_vaccine' ]);
Route::get('/child_immunizations/{children_id}', [ ChildImmunizationController::class, 'index_children_id' ]);
Route::get('/child_immunization/{id}', [ ChildImmunizationController::class, 'show' ]);
Route::post('/child_immunization', [ ChildImmunizationController::class, 'store' ]);
Route::post('/child_immunization/update', [ ChildImmunizationController::class, 'update' ]);
Route::delete('/child_immunization/{id}', [ ChildImmunizationController::class, 'destroy' ]);

// officer growth routing
Route::get('/child_growths', [ ChildGrowthController::class, 'index' ]);
Route::get('/child_growths/{children_id}', [ ChildGrowthController::class, 'index_children_id' ]);
Route::get('/child_growth/{id}', [ ChildGrowthController::class, 'show' ]);
Route::post('/child_growth', [ ChildGrowthController::class, 'store' ]);
Route::put('/child_growth', [ ChildGrowthController::class, 'update' ]);
Route::delete('/child_growth/{id}', [ ChildGrowthController::class, 'destroy' ]);

// officer milestone routing
Route::get('/officer/dashboard/milestones/page', function () {
    return view('milestones_page');
});
Route::get('/milestones', [ MilestoneController::class, 'index' ]);
Route::get('/milestone/{id}', [ MilestoneController::class, 'show' ]);
Route::post('/milestone', [ MilestoneController::class, 'store' ]);
Route::put('/milestone', [ MilestoneController::class, 'update' ]);
Route::delete('/milestone/{id}', [ MilestoneController::class, 'destroy' ]);

// officer question routing
Route::get('/officer/dashboard/questions/page', function () {
    return view('questions_page');
});
Route::get('/questions', [ QuestionController::class, 'index' ]);
Route::get('/question/{id}', [ QuestionController::class, 'show' ]);
Route::get('/milestone/question/{milestone_id}', [ QuestionController::class, 'index_milestone_id' ]);
Route::post('/question', [ QuestionController::class, 'store' ]);
Route::put('/question', [ QuestionController::class, 'update' ]);
Route::delete('/question/{id}', [ QuestionController::class, 'destroy' ]);

// Admin milestone question routing
Route::get('/officer/dashboard/milestones/questions/{id}', function () {
    return view('officer_milestones_questions_page');
});
Route::get('/parent/dashboard/milestones/questions/{milestone_id}/{children_id}', function () {
    return view('parent_milestones_questions_page');
});
Route::get('/milestones/questions/{milestone_id}', [ MilestoneQuestionController::class, 'index_milestone_id' ]);
Route::get('/milestones/questions/{milestone_id}/{children_id}', [ MilestoneQuestionController::class, 'index_milestone_id_children_id' ]);
Route::post('/milestone/question', [ MilestoneQuestionController::class, 'store' ]);
Route::delete('/milestone/question/{id}', [ MilestoneQuestionController::class, 'destroy' ]);

Route::post('/child_development', [ ChildDevelopmentController::class, 'store' ]);
Route::post('/child_development/update', [ ChildDevelopmentController::class, 'update' ]);

Route::get('/parent/dashboard/immunizations/page/{id}', function () {
    return view('immunization_page');
});
Route::get('/parent/dashboard/growths/page/{id}', function () {
    return view('growth_page');
});
Route::get('/parent/dashboard/developments/page/{id}', function () {
    return view('development_page');
});

// officer tip routing
Route::get('/officer/dashboard/tips/page', function () {
    return view('officer_tip_page');
});
Route::get('/parent/dashboard/tips/page', function () {
    return view('parent_tip_page');
});
Route::get('/tip/page/{id}', function () {
    return view('index_tip_page');
});
Route::get('/tips', [ TipController::class, 'index' ]);
Route::get('/tip/image/{id}', [ TipController::class, 'fetch' ]);
Route::get('/image/{id}', [ TipController::class, 'fetch_image' ]);
Route::get('/tip/{id}', [ TipController::class, 'show' ]);
Route::post('/tip', [ TipController::class, 'store' ]);
Route::post('/tip/update', [ TipController::class, 'update' ]);
Route::delete('/tip/{id}', [ TipController::class, 'destroy' ]);

// officer vaccine routing
Route::get('/officer/dashboard/admins/page', function () {
    return view('admins_page');
});
Route::get('/admins', [ UserController::class, 'indexOfficer' ]);
Route::post('/admin/update', [ UserController::class, 'updateOfficerStatus' ]);