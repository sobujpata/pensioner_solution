<?php

use App\Models\BafCircular;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\users\facController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PensionInfoController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\users\MessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\jobseekersController;
use App\Http\Controllers\users\suggertionController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\users\jobApplicationController;
use App\Http\Controllers\circulars\bafCircularController;
use App\Http\Controllers\users\pensionTrackingController;
use App\Http\Middleware\TokenVerificationMiddlewareAdmin;
use App\Http\Controllers\circulars\cicularFromEmpController;
use App\Http\Middleware\TokenVerificationMiddlewareEmployer;
use App\Http\Controllers\conversation\ConversationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TutorialController;

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
    return view('Home');
});

Route::get('/slider-show', [SettingsController::class, "SliderList"]);
Route::get('/home-about-show', [SettingsController::class, "HomePageAboutList"]);

Route::get('/about-jiggasha/{perosn_type}', [SettingsController::class, "LoginInfo"]);

Route::get('/tutorial-videos', [TutorialController::class, 'index']);



Route::get('/rank', [MiscellaneousController::class,'rank'])->name('rank');
Route::get('/trade', [MiscellaneousController::class,'trade'])->name('trade');
Route::get('/person-type', [MiscellaneousController::class,'personType'])->name('person.type');
Route::get('/retd-type', [MiscellaneousController::class,'RetdType'])->name('retd.type');

//Login API

Route::post('/user-login', [UserController::class, 'userLogin'])->name('login');
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);


//Logout Route
Route::get('/logout-user', [UserController::class, 'UserLogout']);

//user login Route
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);

//user dashboard api
Route::get('/faq-info/{category_id}',[facController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/form-get',[FormController::class,'Forms'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/application-post',[jobApplicationController::class,'ApplicationPost'])->middleware([TokenVerificationMiddleware::class]);

//User dashboard route
Route::get('/user-dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/message/{designation}',[MessageController::class,'MessageInfo'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/faq-info',[facController::class,'Faqpage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/pension-steps', function () {
    return view('users-pages.dashboard.pension-processing-steps');
})->middleware([TokenVerificationMiddleware::class]);
Route::get('/forms-info',[FormController::class,'FormPages'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/pension-traking',[pensionTrackingController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/circular-from-ro',[bafCircularController::class,'index'])->middleware([TokenVerificationMiddleware::class]);

//Highlight notice
Route::get('/circular-notice',[bafCircularController::class,'NoticeHighlight'])->middleware([TokenVerificationMiddleware::class]);


Route::get('/circular-from-employers',[cicularFromEmpController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/job-circuler-list-user',[cicularFromEmpController::class,'CirculerListEMP'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/employers-list',[EmployerController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/employer-list-user',[EmployerController::class,'EmployersListUser'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/job-application',[jobApplicationController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/job-application-edit',[jobApplicationController::class,'edit'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/job-application-update/{id}',[jobApplicationController::class,'update'])->name('application.update')->middleware([TokenVerificationMiddleware::class]);
Route::get('/job-sheekers',[jobApplicationController::class,'JobSheeker'])->middleware([TokenVerificationMiddleware::class]);
// Route::get('/conversation',[ConversationController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/conversation',[ConversationController::class,'demo'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/voice-conversation',[ConversationController::class,'VoiceConversation'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/upload-audio', [ConversationController::class, 'uploadAudio'])->name('upload.audio')->middleware([TokenVerificationMiddleware::class]);
Route::get('/section', [SectionController::class, 'getSection'])->name('get.section')->middleware([TokenVerificationMiddleware::class]);
Route::get('/section-distinct', [SectionController::class, 'onlySection'])->name('get.section');

//API Route
Route::post('/conversation-post',[ConversationController::class,'store'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/conversation-get', [ConversationController::class, 'getConversations'])->middleware([TokenVerificationMiddleware::class]);
Route::delete('/conversation-delete/{id}', [ConversationController::class, 'destroy'])->middleware([TokenVerificationMiddleware::class]);

//suggetion route
Route::get('/suggetions',[suggertionController::class,'index'])->middleware([TokenVerificationMiddleware::class]);
//suggetion api
Route::post('/suggestions', [suggertionController::class, 'store'])->name('suggestion.store')->middleware([TokenVerificationMiddleware::class]);

//Admin API
Route::post('/admin-login', [AdminController::class, 'userLogin']);
Route::get('/admin-logout', [AdminController::class, 'AdminLogout']);
Route::get('/user-profile',[AdminController::class,'UserProfile'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/user-update',[AdminController::class,'UpdateProfile'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/admin-list', [AdminDashboardController::class, 'adminList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/admin-by-id', [AdminDashboardController::class, 'adminEdit'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/user-list', [AdminDashboardController::class, 'userList'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//admin Route
Route::get('/ro-admin', [AdminController::class, 'LoginPage']);
Route::get('/userProfile', [AdminController::class, 'ProfilePage'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/dashboard', [AdminDashboardController::class, 'DashboardPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);
//admin user
Route::get('/admin-users', [AdminDashboardController::class, 'adminUser'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/update-admin', [AdminDashboardController::class, 'adminUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/admin-create', [AdminController::class, 'adminCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/delete-admin', [AdminDashboardController::class, 'adminDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);
//general users
Route::get('/gen-users', [AdminDashboardController::class, 'GenUser'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/user-by-id', [AdminDashboardController::class, 'UserById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/update-user', [AdminDashboardController::class, 'UserUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/approve-user', [UserController::class, 'ApproveUser'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/update-user-password', [AdminDashboardController::class, 'UserUpdatePass'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/update-admin-password', [AdminDashboardController::class, 'AdminUpdatePass'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/delete-user', [AdminDashboardController::class, 'DeleteUser'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//employer User ROUTE
Route::get('/employer-users', [AdminDashboardController::class, 'employerUser'])->middleware([TokenVerificationMiddlewareAdmin::class]);
//Employer User API
Route::get('/employer-list-admin', [AdminDashboardController::class, 'employerUserList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/employer-by-id', [AdminDashboardController::class, 'employerById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/update-employer', [AdminDashboardController::class, 'employerUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/approve-employer', [AdminDashboardController::class, 'Approveemployer'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/update-employer-password', [AdminDashboardController::class, 'employerUpdatePass'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//employer-circuler route
Route::get('/employer-circuler-list', [cicularFromEmpController::class, 'employerCirculerAdminPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//employer-circuler API
Route::get('/employer-circuler-show', [cicularFromEmpController::class, 'CirculerListEMP'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/employer-circuler-create', [cicularFromEmpController::class, 'employerCirculerCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/employer-admin-by-id', [cicularFromEmpController::class, 'CirculerById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/employer-circuler-update', [cicularFromEmpController::class, 'employerCirculerUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/delete-employer-circuler', [cicularFromEmpController::class, 'employerCirculerDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/circuler-status-approved-by-admin', [cicularFromEmpController::class, 'CirculerStatusByAdmin'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/circuler-admin-status-approved', [cicularFromEmpController::class, 'CirculerAdminStatusByAdmin'])->middleware([TokenVerificationMiddlewareAdmin::class]);


//Jobseekers Route
Route::get('/job-seekers-admin', [jobseekersController::class, 'JobseekersPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//jobseekers API
Route::get('/jobseekers-list', [jobseekersController::class, 'JobseekersList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/delete-jobseeker', [jobseekersController::class, 'JobseekerDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//FAQ route
Route::get('/faq-list', [facController::class, 'faqAdminPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//FAQ API
Route::get('/faq-show', [facController::class, 'faqAdminlist'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/faq-create', [facController::class, 'faqCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/faq-by-id', [facController::class, 'faqById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/faq-update', [facController::class, 'faqUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/delete-faq', [facController::class, 'faqDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//Notice route
Route::get('/notice-list', [bafCircularController::class, 'noticeAdminPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//notice API
Route::get('/notice-show', [bafCircularController::class, 'noticeAdminlist'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/notice-create', [bafCircularController::class, 'noticeCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/notice-by-id', [bafCircularController::class, 'noticeById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/notice-update', [bafCircularController::class, 'noticeUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/delete-notice', [bafCircularController::class, 'noticeDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//form route
Route::get('/form-list', [FormController::class, 'formAdminPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//form API
Route::get('/form-show', [FormController::class, 'FormAdminlist'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/form-create', [FormController::class, 'FormCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/form-by-id', [FormController::class, 'FormById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/form-update', [FormController::class, 'FormUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/form-delete', [FormController::class, 'FormDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//Pensioner route
Route::get('/pensioner-list', [PensionInfoController::class, 'index'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//pensioner API
Route::get('/pensioner-show', [PensionInfoController::class, 'pensionerAdminlist'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/pensioner-create', [PensionInfoController::class, 'pensionerCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/pensioner-by-id', [PensionInfoController::class, 'pensionerById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/pensioner-update', [PensionInfoController::class, 'pensionerUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/pensioner-delete', [PensionInfoController::class, 'pensionerDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//Settings Route
Route::get('/settings', [SettingsController::class, 'index'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/slider-list', [SettingsController::class, 'SliderPage'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/home-about-page', [SettingsController::class, 'HomePageAbout'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/home-help-page', [SettingsController::class, 'HomePageHelp'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/home-tutorial-page', [SettingsController::class, 'HomePageTutorial'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//Settings Slider API
Route::get('/sliders', [SettingsController::class, 'SliderList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/slider-create', [SettingsController::class, 'SliderCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/slider-by-id', [SettingsController::class, 'SliderById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/slider-update', [SettingsController::class, 'SliderUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/slider-delete', [SettingsController::class, 'SliderDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);
//Settings Home page about API
Route::get('/home-page-about', [SettingsController::class, 'HomePageAboutList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-about-create', [SettingsController::class, 'HomePageAboutCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-about-by-id', [SettingsController::class, 'HomePageAboutById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-about-update', [SettingsController::class, 'HomePageAboutUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-about-delete', [SettingsController::class, 'HomePageAboutDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);
//Settings Home page Help API
Route::get('/home-page-help', [SettingsController::class, 'HomePageHelpList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-help-create', [SettingsController::class, 'HomePageHelpCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-help-by-id', [SettingsController::class, 'HomePageHelpById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-help-update', [SettingsController::class, 'HomePageHelpUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-help-delete', [SettingsController::class, 'HomePageHelpDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//Settings Home page Tutorial API
Route::get('/home-page-tutorial', [SettingsController::class, 'HomePageTutorialList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-tutorial-create', [SettingsController::class, 'HomePageTutorialCreate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-tutorial-by-id', [SettingsController::class, 'HomePageTutorialById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-tutorial-update', [SettingsController::class, 'HomePageTutorialUpdate'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/home-page-tutorial-delete', [SettingsController::class, 'HomePageTutorialDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);



//pension Status
Route::get('/pension-status', [MiscellaneousController::class, 'PensionStatus'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//Conversation Route
Route::get('/conversation-list', [ConversationController::class, 'ConversationPageAdmin'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/conversation-pension', [ConversationController::class, 'ConversationPagePension'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/conversation-docu-IV', [ConversationController::class, 'ConversationPageDocuIV'])->middleware([TokenVerificationMiddlewareAdmin::class]);
//conversation API
Route::get('/conversation-show', [ConversationController::class, 'ConversationList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/conversation-show-pension', [ConversationController::class, 'ConversationPensionList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::get('/conversation-show-docu-IV', [ConversationController::class, 'ConversationDocuIVList'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/conversation-by-id', [ConversationController::class, 'ConversationById'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/conversation-update-from-admin', [ConversationController::class, 'ConversationUpdateFromAdmin'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/conversation-audio-from-admin', [ConversationController::class, 'ConversationAudioFromAdmin'])->middleware([TokenVerificationMiddlewareAdmin::class]);
Route::post('/conversation-delete', [ConversationController::class, 'ConversationDelete'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//summary
Route::get("/summary",[DashboardController::class,'Summary'])->middleware([TokenVerificationMiddlewareAdmin::class]);

Route::get("/role",[DashboardController::class,'RoleSutatus'])->middleware([TokenVerificationMiddlewareAdmin::class]);

//fa category
Route::get('/list-category', [CategoryController::class, 'CategoryList']);

//Visitor
Route::get('/visitor', [VisitorController::class, 'index']);

//Employer Auth Route
Route::get('/employer-login', [EmployerController::class, 'LoginPageEmployer']);
Route::get('/employerRegistration', [EmployerController::class, 'RegistrationPageEmployer']);
Route::get('/sendOtp-employer',[EmployerController::class,'SendOtpPage']);
Route::get('/verifyOtp-employer',[EmployerController::class,'VerifyOTPPage']);
Route::get('/resetPassword-employer',[EmployerController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);

//Employer Auth API Route
Route::post('/employer-registration', [EmployerController::class, 'employerRegistration']);
Route::post('/employerLogin', [EmployerController::class, 'EmployeLogin']);
Route::post('/send-otp-employer', [EmployerController::class, 'SendOTPCode']);
Route::post('/verify-otp-employer', [EmployerController::class, 'VerifyOTP']);
Route::post('/reset-password-employer', [EmployerController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile-employer',[EmployerController::class,'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update-employer',[EmployerController::class,'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);

//Logout Route
Route::get('/logout', [EmployerController::class, 'Logout']);

//Empoyer Dashboard Route
Route::get('/employer-dashboard',[EmployerDashboardController::class, 'EmpDashboard'])->middleware([TokenVerificationMiddlewareEmployer::class]);

//Job circuler Route
Route::get('/job-circulers', [cicularFromEmpController::class, 'JobCircullerPage'])->middleware([TokenVerificationMiddlewareEmployer::class]);

//Job Circuler List
Route::get('/job-circuler-list', [cicularFromEmpController::class, 'CirculerList'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/job-circuler-create', [cicularFromEmpController::class, 'CirculerCreate'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/circuler-status', [cicularFromEmpController::class, 'CirculerStatus'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/circuler-by-id', [cicularFromEmpController::class, 'CirculerById'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/job-circuler-update', [cicularFromEmpController::class, 'JobCirculerUpdate'])->middleware([TokenVerificationMiddlewareEmployer::class]);

//Job circuler Route
Route::get('/job-seekers', [jobseekersController::class, 'JobSeekersForEmpPage'])->middleware([TokenVerificationMiddlewareEmployer::class]);

//Job Circuler List
Route::get('/job-seekers-list', [jobseekersController::class, 'JobSeekersForEmpList'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/job-seekers-create', [jobseekersController::class, 'SeekersForEmpCreate'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/seekers-status', [jobseekersController::class, 'SeekersForEmpStatus'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/seekers-by-id', [jobseekersController::class, 'SeekersForEmpById'])->middleware([TokenVerificationMiddlewareEmployer::class]);
Route::post('/job-seekers-update', [jobseekersController::class, 'JobSeekersForEmpUpdate'])->middleware([TokenVerificationMiddlewareEmployer::class]);
