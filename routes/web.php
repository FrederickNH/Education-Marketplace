<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CompetitionOrganiserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolShuttleController;
use App\Http\Controllers\SubdistrictController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectTeachesController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\vendor\Chatify\MessagesController;
use App\Http\Controllers\AuthController;


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
Route::get('/',[UserController::class,'index'])->name('/');

Route::get('/welcome', function(){
	return view('welcome');
})->name('welcome');
Auth::routes();
// U -> User
// M -> More

Route::get('catalog/competitionList', [UserController::class, 'competitionCatalog'])->name('catalog.competitionList');
Route::get('catalog/schoolList', [UserController::class, 'schoolCatalog'])->name('catalog.schoolList');
Route::get('catalog/shuttleList', [UserController::class, 'shuttleCatalog'])->name('catalog.shuttleList');
Route::get('catalog/tutoringList', [UserController::class, 'tutoringCatalog'])->name('catalog.tutoringList');
Route::get('catalog/tutorList', [UserController::class, 'tutorCatalog'])->name('catalog.tutorList');
Route::get('competitionList', [UserController::class, 'competitionListAll'])->name('competitionList');
Route::get('competitionDetailU/{id}', [UserController::class, 'competitionDetail'])->name('competitionDetailU');
Route::get('shuttleList',[UserController::class,'shuttlelist'])->name('shuttleList');
Route::get('shuttleDetail/{id}',[UserController::class,'shuttleDetail'])->name('shuttleDetail');
Route::get('schoolList',[UserController::class,'schoolList'])->name('schoolList');
Route::get('schoolDetail/{id}',[UserController::class,'schoolDetail'])->name('schoolDetail');
Route::get('subjectListM',[SubjectController::class,'index'])->name('subjectListM');
Route::get('/subjectTutoring/{id}',[SubjectController::class,'subjectTutoringList'])->name('subjectTutoring');
Route::get('/tutoringDetailU/{id}',[TutorController::class,'tutoringGetDetail'])->name('tutoringDetail');
Route::get('tutoringListM', [UserController::class, 'tutoringListAll'])->name('tutoringListM');
Route::get('tutorDetail/{id}',[TutorController::class,'tutorDetail'])->name('tutorDetail');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/logoutUser', [AuthController::class, 'logout'])->name('logoutUser');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('admin', AdminController::class);
	Route::resource('certificate', CertificateController::class);
	Route::resource('competition', CompetitionController::class);
	Route::resource('competitionOrganiser', CompetitionOrganiserController::class);
	Route::resource('promo', PromoController::class);
	Route::resource('rating', RatingController::		class);
	Route::resource('school', SchoolController::class);
	Route::resource('schoolShuttle', SchoolShuttleController::class);
	Route::resource('subdistrict', SubdistrictController::class);
	Route::resource('subject', SubjectController::class);
	Route::resource('subjectTeaches', SubjectTeachesController::class);
	Route::resource('tutor', TutorController::class);
	Route::get('msg',[MessagesController::class,'index'])->name('msg');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile',[UserController::class,'show'])->name('profile');
	Route::put('profileUpdate', [UserController::class, 'update'])->name('profileUpdate');
	Route::get('manageChild',[UserController::class,'manageChild'])->name('manageChild');
	Route::put('addChild', [UserController::class, 'addChild'])->name('addChild');
	// Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	// Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	// Admin
		// Route::get('certificateGet/{id}',[AdminController::class,'getCertificate'])->name('certificateGet');
		// Route::get('validatedSubject',[AdminController::class,'validatedSubject'])->name('validatedSubject');
		// Route::get('validateSubject',[AdminController::class,'validateSubject'])->name('validateSubject');
		// Route::get('validateSubjectGive/{id}/{status}',[AdminController::class,'giveSubjectValidation'])->name('validateSubject');

		// Route::get('validatedSchool',[AdminController::class,'validatedSchool'])->name('validatedSchool');
		// Route::get('validateSchool',[AdminController::class,'validateSchool'])->name('validateSchool');
		// Route::get('validateSchoolGive/{id}/{status}',[AdminController::class,'giveSchoolValidation'])->name('validateSchoolGive');

		// Route::get('validatedOrganisation',[AdminController::class,'validatedOrganisation'])->name('validatedOrganisation');
		// Route::get('validateOrganisation',[AdminController::class,'validateOrganisation'])->name('validateOrganisation');
		// Route::get('validateOrganisationGive/{id}/{status}',[AdminController::class,'giveOrganisationValidation'])->name('validateOrganisationGive');
	//user
		Route::get('merchantRegistration', function () {return view('roleRegistration');})->name('merchantRegistration');
		Route::get('tutorRegistration',[UserController::class,'tutorRegistration'])->name('tutorRegistration');
		Route::get('institutionRegistration',[UserController::class,'institutionRegistration'])->name('institutionRegistration');
		Route::get('schoolRegistration', [UserController::class,'schoolRegistration'])->name('schoolRegistration');
		Route::get('shuttleRegistration', [UserController::class,'shuttleRegistration'])->name('shuttleRegistration');
		Route::get('organiserRegistration', [UserController::class,'organiserRegistration'])->name('organiserRegistration');
		Route::get('bookTutoring/{id}/{promo}/{child}',[UserController::class,'bookTutoring'])->name('bookTutoring');
		Route::get('tutoringList/detail/{id}',[UserController::class,'classDetail'])->name('tutoringListDetail');
		Route::get('saveBooking/{id}',[UserController::class,'saveBooking'])->name('saveBooking');
		Route::get('cancelBooking/{id}',[UserController::class,'cancelBooking'])->name('cancelBooking');
		Route::put('tutorAdd',[TutorController::class,'store'])->name('tutorAdd');
		Route::put('schoolAdd',[SchoolController::class,'store'])->name('schoolAdd');
		Route::put('shuttleAdd',[SchoolShuttleController::class,'store'])->name('shuttleAdd');
		Route::put('organiserAdd',[CompetitionOrganiserController::class,'store'])->name('organiserAdd');
		Route::put('institutionAdd',[TutorController::class,'institutionStore'])->name('institutionAdd');
		//tutor
			Route::get('tutorList',[TutorController::class,'tutorList'])->name('tutorList');
			// Route::get('tutorDetail/{id}',[TutorController::class,'tutorDetail'])->name('tutorDetail');
		//tutoring
			Route::get('tutoringListM', [UserController::class, 'tutoringListAll'])->name('tutoringListM');
			Route::get('tutoringListU', [UserController::class, 'tutoringList'])->name('tutoringListU');
			Route::get('/tutoringDetailM/{id}',[TutorController::class,'tutoringGetDetail'])->name('tutoringDetailM');
			Route::put('tutoringRateInput', [UserController::class, 'inputRateTutoring'])->name('tutoringRateInput');
			Route::get('cancelTutoringBooking/{id}',[UserController::class,'cancelTutoringBooking'])->name('cancelTutoringBooking');
		//subject
			// Route::get('subjectListM',[SubjectController::class,'index'])->name('subjectListM');
			// Route::get('/subjectTutoring/{id}',[SubjectController::class,'subjectTutoringList'])->name('subjectTutoring');
			// Route::get('/tutoringDetailU/{id}',[TutorController::class,'tutoringGetDetail'])->name('tutoringDetail');
		//school

			// Route::get('schoolList',[UserController::class,'schoolList'])->name('schoolList');
			// Route::get('schoolDetail/{id}',[UserController::class,'schoolDetail'])->name('schoolDetail');
		//shuttle
			// Route::get('shuttleList',[UserController::class,'shuttlelist'])->name('shuttleList');
			// Route::get('shuttleDetail/{id}',[UserController::class,'shuttleDetail'])->name('shuttleDetail');
		//seeking tutor
			Route::get('seekingList', [UserController::class, 'seekingList'])->name('seekingList');
			Route::get('seekTutoring', [UserController::class, 'seekTutoring'])->name('seekTutoring');
			Route::put('seekingInput', [UserController::class, 'inputSeeking'])->name('seekingInput');
			Route::get('offerList/{id}', [UserController::class, 'offerList'])->name('offerList');
			Route::get('offerAccepted/{id}', [UserController::class, 'offerAccepted'])->name('offerAccepted');
			Route::get('offerDeclined/{id}', [UserController::class, 'offerRejected'])->name('offerDeclined');
		//request
			Route::get('requestTutoring/{id}',[UserController::class,'requestTutoring'])->name('requestTutoring');
			Route::put('requestInput', [UserController::class, 'inputRequest'])->name('requestInput');
			Route::get('requestCheck/{tutorId}/{date}/{day}/{startTime}/{endTime}',[UserController::class,'checkRequest'])->name('checkRequest');
		//competition
			// Route::get('competitionList', [UserController::class, 'competitionListAll'])->name('competitionList');
			// Route::get('competitionDetailU/{id}', [UserController::class, 'competitionDetail'])->name('competitionDetailU');
			Route::get('competitionRegisterDetail/{id}', [UserController::class, 'competitionRegisterDetail'])->name('competitionRegisterDetail');
			Route::put('competitionRegister', [UserController::class, 'competitionRegister'])->name('competitionRegister');
			Route::put('competitionRegisterDetailU', [UserController::class, 'competitionRegisterDetailU'])->name('competitionRegisterDetailU');
			Route::get('competition', [UserController::class, 'competitionList'])->name('competition');
			Route::get('payRegistration/{id}', [UserController::class, 'payRegistration'])->name('payRegistration');
			Route::put('competitionRateInput', [UserController::class, 'inputRateCompetition'])->name('competitionRateInput');
		//catalog
			// Route::get('catalog/competitionList', [UserController::class, 'competitionCatalog'])->name('catalog.competitionList');
			// Route::get('catalog/schoolList', [UserController::class, 'schoolCatalog'])->name('catalog.schoolList');
			// Route::get('catalog/shuttleList', [UserController::class, 'shuttleCatalog'])->name('catalog.shuttleList');
			// Route::get('catalog/tutoringList', [UserController::class, 'tutoringCatalog'])->name('catalog.tutoringList');
			// Route::get('catalog/tutorList', [UserController::class, 'tutorCatalog'])->name('catalog.tutorList');
	//school
		// Route::put('schoolAdd',[SchoolController::class,'store'])->name('schoolAdd');
		// Route::get('schoolGet',[SchoolController::class,'getSchool'])->name('schoolGet');
		// Route::put('schoolUpdate',[SchoolController::class,'update'])->name('schoolUpdate');
		// //facility
		// 	Route::get('facilityGet',[SchoolController::class,'getFacility'])->name('facilityGet');
		// 	Route::get('facilityEdit/{id}',[SchoolController::class,'editFacility'])->name('facilityEdit');	
		// 	Route::put('facilityAdd',[SchoolController::class,'addFacility'])->name('facilityAdd');
		// 	Route::put('facilityUpdate',[SchoolController::class,'updateFacility'])->name('facilityUpdate');
		// 	Route::get('facilityDelete/{id}',[SchoolController::class,'deleteFacility'])->name('facilityDelete');	
	//competition organiser
		// Route::put('organiserAdd',[CompetitionOrganiserController::class,'store'])->name('organiserAdd');
		// Route::get('organiserGet',[CompetitionOrganiserController::class,'getOrganiser'])->name('organiserGet');
		// Route::put('organiserUpdate',[CompetitionOrganiserController::class,'update'])->name('organiserUpdate');
		// 	//competition
		// 	Route::get('competitionGet',[CompetitionController::class,'index'])->name('competitionGet');
		// 	Route::get('competitionCreate', [CompetitionController::class, 'create'])->name('competitionCreate');
		// 	Route::get('competitionDetail/{id}', [CompetitionController::class, 'detail'])->name('competitionDetail');
		// 	Route::put('competitionAdd',[CompetitionController::class,'store'])->name('competitionAdd');
		// 	Route::put('competitionUpdate',[CompetitionController::class,'edit'])->name('competitionUpdate');
		// 	Route::get('competitionDelete/{id}',[CompetitionController::class,'deleteCompetition'])->name('competitionDelete');	
		// 	//member
		// 	Route::get('memberGetDetail/{vId}/{mId}',[CompetitionController::class,'getMemberDetail'])->name('memberGetDetail');	
	//shuttle
		// Route::put('shuttleAdd',[SchoolShuttleController::class,'store'])->name('shuttleAdd');
		// Route::get('shuttleGet',[SchoolShuttleController::class,'getShuttle'])->name('shuttleGet');
		// Route::put('shuttleUpdate',[SchoolShuttleController::class,'update'])->name('shuttleUpdate');
		// 	//Destination
		// 	Route::get('destinationGet',[SchoolShuttleController::class,'getDestination'])->name('destinationGet');
		// 	Route::get('destinationEdit/{id}',[SchoolShuttleController::class,'editDestination'])->name('destinationEdit');	
		// 	Route::put('destinationAdd',[SchoolShuttleController::class,'addDestination'])->name('destinationAdd');
		// 	Route::put('destinationUpdate',[SchoolShuttleController::class,'updateDestination'])->name('destinationUpdate');
		// 	Route::get('destinationDelete/{id}',[SchoolShuttleController::class,'deleteDestination'])->name('destinationDelete');
	//City

	//Subdistrict
		Route::get('/getSubDistrict/{id}',[SubdistrictController::class,'getSubDistrict'])->name('getSubDistrict');
	//tutor
		// Route::put('tutorAdd',[TutorController::class,'store'])->name('tutorAdd');
		// Route::put('institutionAdd',[TutorController::class,'institutionStore'])->name('institutionAdd');

		// Route::get('tutorGet',[TutorController::class,'tutorGet'])->name('tutorGet');
		// Route::put('tutorUpdate',[TutorController::class,'update'])->name('tutorUpdate');
		// Route::get('institutionGet',[TutorController::class,'institutionGet'])->name('institutionGet');
		// Route::put('institutionUpdate',[TutorController::class,'institutionUpdate'])->name('institutionUpdate');
		// // experience
		// 	Route::get('tutorExperience',[TutorController::class,'experienceList'])->name('tutorExperience');
		// 	Route::put('tutorAddExperience',[TutorController::class,'experienceAdd'])->name('tutorAddExperience');
		// // academic histories
		// 	Route::get('tutorAcademicHistories',[TutorController::class,'academicList'])->name('tutorAcademicHistories');
		// 	Route::put('tutorAddAcademic',[TutorController::class,'academicAdd'])->name('tutorAddAcademic');
		// //award
		// 	Route::get('institutionAward',[TutorController::class,'awardList'])->name('institutionAward');
		// 	Route::put('institutionAddAward',[TutorController::class,'awardAdd'])->name('institutionAddAward');
		// 	Route::get('institutionAwardDelete/{id}',[TutorController::class,'awardDelete'])->name('institutionAwardDelete');
		// //schedule
		// 	Route::get('scheduleList',[TutorController::class,'scheduleList'])->name('scheduleList');
		// 	Route::put('scheduleUpdate',[TutorController::class,'scheduleUpdate'])->name('scheduleUpdate');
		// 	Route::get('/scheduleGet/{id}',[TutorController::class,'scheduleEdit'])->name('scheduleGet');
		// 	Route::get('scheduleClear/{id}',[TutorController::class,'scheduleClear'])->name('scheduleClear');
		// 	Route::put('holidayAdd',[TutorController::class,'addHoliday'])->name('holidayAdd');
		// //tutoring
		// 	Route::get('tutoringList',[TutorController::class,'tutoringList'])->name('tutoringList');
		// 	Route::put('tutoringUpdate',[TutorController::class,'tutoringUpdate'])->name('tutoringUpdate');
		// 	Route::get('tutoringDetail/{id}',[TutorController::class,'tutoringDetail'])->name('tutoringDetail');
		// 	Route::get('tutoringCreate', [TutorController::class, 'tutoringCreate'])->name('tutoringCreate');
		// 	Route::put('tutoringAdd',[TutorController::class, 'tutoringAdd'])->name('tutoringAdd');
		// //request
		// 	Route::get('requestList',[TutorController::class,'requestList'])->name('requestList');
		// 	Route::get('requestNeedActionList',[TutorController::class,'requestNeedActionList'])->name('requestNeedActionList');
		// 	Route::get('requestDetail/{id}',[TutorController::class,'requestDetail'])->name('requestDetail');
		// 	Route::get('requestAccepted/{id}', [TutorController::class, 'requestAccepted'])->name('requestAccepted');
		// 	Route::get('requestDeclined/{id}', [TutorController::class, 'requestRejected'])->name('requestDeclined');
		// //seeking tutor
		// 	Route::get('seekingMarket',[TutorController::class,'seekingMarket'])->name('seekingMarket');
		// 	Route::get('seekingDetailTutor/{id}',[TutorController::class,'seekingDetail'])->name('seekingDetailTutor');
		// 	Route::get('seekingListTutor',[TutorController::class,'seekingList'])->name('seekingListTutor');
		// 	Route::get('offerListTutor/{id}',[TutorController::class,'offerList'])->name('offerListTutor');
		// 	Route::put('offerAdd',[TutorController::class,'offerAdd'])->name('offerAdd');
		// //subject teaches
		// 	Route::get('subjectList',[SubjectTeachesController::class,'index'])->name('subjectList');
		// 	Route::put('subjectAdd',[SubjectTeachesController::class,'subjectAdd'])->name('subjectAdd');
		// 	Route::get('subjectRemove/{id}',[SubjectTeachesController::class,'subjectRemove'])->name('subjectRemove');
});
Route::middleware(['role:tutor'])->group(function () {
		Route::get('tutorDashboard',[TutorController::class,'index'])->name('tutor.dashboard');
		Route::get('tutorGet',[TutorController::class,'tutorGet'])->name('tutorGet');
		Route::put('tutorUpdate',[TutorController::class,'update'])->name('tutorUpdate');
		// experience
			Route::get('tutorExperience',[TutorController::class,'experienceList'])->name('tutorExperience');
			Route::put('tutorAddExperience',[TutorController::class,'experienceAdd'])->name('tutorAddExperience');
		// academic histories
			Route::get('tutorAcademicHistories',[TutorController::class,'academicList'])->name('tutorAcademicHistories');
			Route::put('tutorAddAcademic',[TutorController::class,'academicAdd'])->name('tutorAddAcademic');
		//schedule
			Route::get('scheduleList',[TutorController::class,'scheduleList'])->name('scheduleList');
			Route::put('scheduleUpdate',[TutorController::class,'scheduleUpdate'])->name('scheduleUpdate');
			Route::get('/scheduleGet/{id}',[TutorController::class,'scheduleEdit'])->name('scheduleGet');
			Route::get('scheduleClear/{id}',[TutorController::class,'scheduleClear'])->name('scheduleClear');
			Route::put('holidayAdd',[TutorController::class,'addHoliday'])->name('holidayAdd');
		//tutoring
			Route::get('tutoringList',[TutorController::class,'tutoringList'])->name('tutoringList');
			Route::put('tutoringUpdate',[TutorController::class,'tutoringUpdate'])->name('tutoringUpdate');
			Route::get('tutoringDetail/{id}',[TutorController::class,'tutoringDetail'])->name('tutoringDetail');
			Route::get('tutoringDetail/data/{id}',[TutorController::class,'tutoringClassDetail'])->name('tutoringClassDetail');
			Route::put('tutoringDEtail/save',[TutorController::class,'saveDetailChange'])->name('saveDetailChange');
			Route::get('tutoringCreate', [TutorController::class, 'tutoringCreate'])->name('tutoringCreate');
			Route::put('tutoringAdd',[TutorController::class, 'tutoringAdd'])->name('tutoringAdd');

		//request
			Route::get('requestList',[TutorController::class,'requestList'])->name('requestList');
			Route::get('requestNeedActionList',[TutorController::class,'requestNeedActionList'])->name('requestNeedActionList');
			Route::get('requestDetail/{id}',[TutorController::class,'requestDetail'])->name('requestDetail');
			Route::get('requestAccepted/{id}', [TutorController::class, 'requestAccepted'])->name('requestAccepted');
			Route::get('requestDeclined/{id}', [TutorController::class, 'requestRejected'])->name('requestDeclined');
		//seeking tutor
			Route::get('seekingMarket',[TutorController::class,'seekingMarket'])->name('seekingMarket');
			Route::get('seekingDetailTutor/{id}',[TutorController::class,'seekingDetail'])->name('seekingDetailTutor');
			Route::get('seekingListTutor',[TutorController::class,'seekingList'])->name('seekingListTutor');
			Route::get('offerListTutor/{id}',[TutorController::class,'offerList'])->name('offerListTutor');
			Route::put('offerAdd',[TutorController::class,'offerAdd'])->name('offerAdd');
		//subject teaches
			Route::get('subjectList',[SubjectTeachesController::class,'index'])->name('subjectList');
			Route::put('subjectAdd',[SubjectTeachesController::class,'subjectAdd'])->name('subjectAdd');
			Route::get('subjectRemove/{id}',[SubjectTeachesController::class,'subjectRemove'])->name('subjectRemove');
});
Route::middleware(['role:school'])->group(function () {
   
		Route::get('schoolGet',[SchoolController::class,'getSchool'])->name('schoolGet');
		Route::put('schoolUpdate',[SchoolController::class,'update'])->name('schoolUpdate');
		Route::put('enrollmentPriceAdd',[SchoolController::class,'addEnrollmentPrice'])->name('enrollmentPriceAdd');
		Route::get('enrollmentPrice',[SchoolController::class,'getEnrollmentPrice'])->name('enrollmentPrice');
		//facility
			Route::get('facilityGet',[SchoolController::class,'getFacility'])->name('facilityGet');
			Route::get('facilityEdit/{id}',[SchoolController::class,'editFacility'])->name('facilityEdit');	
			Route::put('facilityAdd',[SchoolController::class,'addFacility'])->name('facilityAdd');
			Route::put('facilityUpdate',[SchoolController::class,'updateFacility'])->name('facilityUpdate');
			Route::get('facilityDelete/{id}',[SchoolController::class,'deleteFacility'])->name('facilityDelete');
});
Route::middleware(['role:shuttle'])->group(function () {
    
		Route::get('shuttleGet',[SchoolShuttleController::class,'getShuttle'])->name('shuttleGet');
		Route::put('shuttleUpdate',[SchoolShuttleController::class,'update'])->name('shuttleUpdate');
			//Destination
			Route::get('destinationGet',[SchoolShuttleController::class,'getDestination'])->name('destinationGet');
			Route::get('destinationEdit/{id}',[SchoolShuttleController::class,'editDestination'])->name('destinationEdit');	
			Route::put('destinationAdd',[SchoolShuttleController::class,'addDestination'])->name('destinationAdd');
			Route::put('destinationUpdate',[SchoolShuttleController::class,'updateDestination'])->name('destinationUpdate');
			Route::get('destinationDelete/{id}',[SchoolShuttleController::class,'deleteDestination'])->name('destinationDelete');
});
Route::middleware(['role:organiser'])->group(function () {
		Route::get('orgDashboard',[CompetitionOrganiserController::class,'index'])->name('orgDashboard');
		Route::get('organiserGet',[CompetitionOrganiserController::class,'getOrganiser'])->name('organiserGet');
		Route::put('organiserUpdate',[CompetitionOrganiserController::class,'update'])->name('organiserUpdate');
			//competition
			Route::get('competitionGet',[CompetitionController::class,'index'])->name('competitionGet');
			Route::get('competitionCreate', [CompetitionController::class, 'create'])->name('competitionCreate');
			Route::get('competitionDetail/{id}', [CompetitionController::class, 'detail'])->name('competitionDetail');
			Route::put('competitionAdd',[CompetitionController::class,'store'])->name('competitionAdd');
			Route::put('competitionUpdate',[CompetitionController::class,'edit'])->name('competitionUpdate');
			Route::get('competitionDelete/{id}',[CompetitionController::class,'deleteCompetition'])->name('competitionDelete');	
			//member
			Route::get('memberGetDetail/{vId}/{mId}',[CompetitionController::class,'getMemberDetail'])->name('memberGetDetail');
});
Route::middleware(['role:admin'])->group(function () {
	Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');
	Route::get('certificateGet/{id}',[AdminController::class,'getCertificate'])->name('certificateGet');
	Route::get('validatedSubject',[AdminController::class,'validatedSubject'])->name('validatedSubject');
	Route::get('validateSubject',[AdminController::class,'validateSubject'])->name('validateSubject');
	Route::get('validateSubjectGive/{id}/{status}',[AdminController::class,'giveSubjectValidation'])->name('validateSubject');

	Route::get('validatedSchool',[AdminController::class,'validatedSchool'])->name('validatedSchool');
	Route::get('validateSchool',[AdminController::class,'validateSchool'])->name('validateSchool');
	Route::get('validateSchoolGive/{id}/{status}',[AdminController::class,'giveSchoolValidation'])->name('validateSchoolGive');

	Route::get('validatedOrganisation',[AdminController::class,'validatedOrganisation'])->name('validatedOrganisation');
	Route::get('validateOrganisation',[AdminController::class,'validateOrganisation'])->name('validateOrganisation');
	Route::get('validateOrganisationGive/{id}/{status}',[AdminController::class,'giveOrganisationValidation'])->name('validateOrganisationGive');

	Route::get('promoList',[PromoController::class,'promoList'])->name('promoList');
	Route::put('promoAdd',[PromoController::class,'store'])->name('promoAdd');
	Route::get('promoEdit/{id}',[PromoController::class,'edit'])->name('promoEdit');
	Route::put('promoUpdate',[PromoController::class,'update'])->name('promoUpdate');
	Route::get('promoDelete/{id}',[PromoController::class,'delete'])->name('promoDelete');

});
Route::middleware(['role:institution'])->group(function () {
	Route::get('institutionDashboard',[TutorController::class,'index'])->name('institution.dashboard');
	Route::get('institutionGet',[TutorController::class,'institutionGet'])->name('institutionGet');
	Route::put('institutionUpdate',[TutorController::class,'institutionUpdate'])->name('institutionUpdate');
	//award
		Route::get('institutionAward',[TutorController::class,'awardList'])->name('institutionAward');
		Route::put('institutionAddAward',[TutorController::class,'awardAdd'])->name('institutionAddAward');
		Route::get('institutionAwardDelete/{id}',[TutorController::class,'awardDelete'])->name('institutionAwardDelete');
	//subject teaches
		Route::get('subjectList',[SubjectTeachesController::class,'index'])->name('subjectList');
		Route::put('subjectAdd',[SubjectTeachesController::class,'subjectAdd'])->name('subjectAdd');
		Route::get('subjectRemove/{id}',[SubjectTeachesController::class,'subjectRemove'])->name('subjectRemove');
	//tutoring
		Route::get('tutoringList',[TutorController::class,'tutoringList'])->name('tutoringList');
		Route::put('tutoringUpdate',[TutorController::class,'tutoringUpdate'])->name('tutoringUpdate');
		Route::get('tutoringDetail/{id}',[TutorController::class,'tutoringDetail'])->name('tutoringDetail');
		Route::get('tutoringCreate', [TutorController::class, 'tutoringCreate'])->name('tutoringCreate');
		Route::put('tutoringAdd',[TutorController::class, 'tutoringAdd'])->name('tutoringAdd');
	//schedule
		Route::get('scheduleList',[TutorController::class,'scheduleList'])->name('scheduleList');
		Route::put('scheduleUpdate',[TutorController::class,'scheduleUpdate'])->name('scheduleUpdate');
		Route::get('/scheduleGet/{id}',[TutorController::class,'scheduleEdit'])->name('scheduleGet');
		Route::get('scheduleClear/{id}',[TutorController::class,'scheduleClear'])->name('scheduleClear');
		Route::put('holidayAdd',[TutorController::class,'addHoliday'])->name('holidayAdd');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
