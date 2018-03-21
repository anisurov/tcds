<?php

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


/*Route::get('/', function () {
    return view('auth/login');
});*/


/*
Route::get('/', function () {
    return view('layouts.app');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'profileController@index')->name('profile');


Route::get('/registration','registrationController@index');
Route::post('/registration','registrationController@teacherRegs');

/*Route::get('/course_reg', function (){
    return view('course_reg');
});
*/
Route::get('/teacher', function (){
    return view('teacher');
});



/*Routes, Handles Error exceptions [START]*/
Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']);

Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);
/*Routes, Handles Error exceptions [END]*/


/*profile Setting[start]*/
Route::get('/setting',['as'=>'setting','uses'=>'SettingController@index']);
Route::get('/edit/{id}',['as'=>'updateProfile','uses'=>'SettingController@showProfileEditForm']);
Route::post('/update',['as'=>'update','uses'=>'SettingController@updateProfile']);
Route::post('/change/password',['as'=>'changepass','uses'=>'SettingController@changePassword']);
/*profile Setting[end]*/


/**********************************[ User area ]********************************************/
Route::group(['middleware' => ['auth']], function()
{
Route::get('teacher/course/add','CourseRequestController@addform')->name('teacherAddcourseForm');
Route::post('teacher/course/add','CourseRequestController@add')->name('teacherAddcourse');


});
/**********************************[End User area ]****************************************/


/***********************************[  Admin Area  ]********************************/

Route::group(['middleware' => ['auth', 'admin']], function()
{

/************************[Course]***********************************/
Route::get('/course/all','CourseController@index')->name('allcourse');
Route::view('/course/add','admin.course.add')->name('addcourseform');
Route::post('/course/add','CourseController@add')->name('addcourse');
Route::get('/course/edit','CourseController@edit')->name('editcourseform');
Route::post('/course/update','CourseController@update')->name('updatecourse');
/************************[end of Course]****************************/


/************************[Semester]***********************************/
Route::get('/semester/all','SemesterController@index')->name('allsemester');
Route::post('/semester/active','SemesterController@toggleStatus')->name('activesemester');
Route::post('/semester/delete','SemesterController@delete')->name('deletesemester');
Route::view('/semester/add','admin.semester.add')->name('addsemesterform');
Route::post('/semester/add','SemesterController@add')->name('addsemester');
Route::get('/semester/edit','SemesterController@edit')->name('editsemesterform');
Route::get('/semester/addcourse','SemesterController@addCourseForm')->name('addcourseTosemesterForm');
Route::post('/semester/addcourse','SemesterController@addCourse')->name('addcourseTosemester');
Route::get('/semester/course/alloted','SemesterController@alloted')->name('allotedCourse');
/************************[end of Semester]****************************/


/************************[Course Distribution]***********************************/
Route::get('/distribution/notify','DistributionController@notifyForm')->name('notifyForm');
Route::post('/distribution/notify','DistributionController@notify')->name('notify');
Route::get('/distribution/approve','DistributionController@approve')->name('requestapprove');
Route::get('/distribution/active','DistributionController@active')->name('active');
/************************[end of Course Distribution]****************************/
});


/***********************************[ end of Admin Area  ]********************************/
