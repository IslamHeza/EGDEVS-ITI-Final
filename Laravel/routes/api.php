<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Notifications\newNotification;

use App\Models\Review;
use App\Models\User;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\MessageController;

use \App\Http\Controllers\UploadController;




use App\Models\Purposal;
use App\Http\Controllers\PurposalController;
use App\Models\Task;
use App\Http\Controllers\TaskController;
// use App\Http\Controllers\Api\VerificationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/*routes don't need auth*/

//signup & login
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//download file
Route::get('/download/{fileName}',[ProjectController::class,'download']);

//users
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::post('upload/{id}',[UploadController::class,'upload']);

//home
Route::get('/developers',[UserController::class,'getDevelopers']);
Route::get('/mostProjects',[ProjectController::class,'getMostProjects']);
Route::get('/reviews',[ReviewController::class,'index']);
Route::get('/HomeReviews',[ReviewController::class,'HomeReviews']);
Route::get('/review/{id}',[ReviewController::class,'show']);
Route::get('/review/rate/{id}',[ReviewController::class,'avgRate']);

//catagories

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/categories/{categoryname}',[CategoryController::class,'show']);

//project
Route::get('/project',[ProjectController::class,'index']);
Route::get('/project/{id}',[ProjectController::class,'show']);
Route::get('/project/{id}',[ProjectController::class,'gettProject']);
Route::post('/project',[projectController::class,'store']);
Route::post('/project/{id}',[ProjectController::class,'store']);
Route::put('/project/{id}',[ProjectController::class,'update']);
Route::delete('/project/{id}',[ProjectController::class,'destroy']);
Route::get('/project/client/{id}',[ProjectController::class,'getClientProject']);
Route::get('/project/pending/{userId}',[ProjectController::class,'getPending']);

   //chat
//    Route::get('/messages',[MessageController::class,'index']);
//     Route::get('/messages/{id1}/{id2}',[MessageController::class,'getmessage']);
//     Route::post('/messages',[MessageController::class,'store']);
Route::post('/realTimeChat/{reciever_id}',[ChatController::class,'message']);
Route::get('/realTimeChat/{id1}/{id2}',[ChatController::class,'getmessage']);

//tasks
// Route::post('/task/{id}',[TaskController::class,'store']);
// Route::get('/task',[TaskController::class,'index']);
// Route::get('/task/{id}',[TaskController::class,'getTask']);
// Route::put('/task/{id}',[TaskController::class,'update']);
// Route::get('/task/rate/{id}',[TaskController::class,'avgRate']);



   //portofolios
//    Route::get('/portfolio/',[PortfolioController::class,'index']);
   Route::get('/portfolio/all/{id}',[PortfolioController::class,'all']);
   Route::get('/portfolio/{id}',[PortfolioController::class,'show']);
   Route::get('/portfolio/count/{id}',[PortfolioController::class,'count']);
   Route::get('/project/count/{id}/{status}',[ProjectController::class,'count']);
   Route::get('/project/active/{id}',[ProjectController::class,'active']);
   Route::get('/project/recent/{categry_id}',[ProjectController::class,'recent']);
   Route::post('/portfolio/{id}',[PortfolioController::class,'store']);
//purposals
   //purposals
   Route::get('/purposal/all/{id}',[PurposalController::class,'index']);
   Route::get('/purposal/{id}',[PurposalController::class,'getPurposal']);
   Route::get('/purposal/project/{project_id}/{userId}',[PurposalController::class,'getProposalOfProject']);
   Route::get('/purposal/owner/{userId}',[PurposalController::class,'getProposalForClient']);
   // Route::get('/purposal/pending/{userId}',[PurposalController::class,'getPending']);

   
   
   //tasks
   Route::get('/task',[TaskController::class,'index']);
   Route::get('/task/{id}',[TaskController::class,'getTask']);
   Route::put('/task/{id}',[TaskController::class,'update']);
   Route::post('/task/{id}',[TaskController::class,'store']);
   Route::delete('/task/{id}',[TaskController::class,'destroy']);
   Route::post('/task/accept/{id}',[TaskController::class,'makeAccepted']);

   //contact
   Route::post('/contact',[ContactController::class,'store']);

   // Route::put('/users/rate/{id}/{rate}',[UserController::class,'updateRate']);


/*******auth***********/
Route::group(['middleware' => ['auth:sanctum'] ], function() {
    /*routes need to access */
//     //users
    Route::post('/users',[UserController::class,'store']);
    Route::put('/users/{id}',[UserController::class,'update']);
    Route::delete('/users/{id}',[UserController::class,'destroy']);
    Route::get('/users/category/{id}',[UserController::class,'getCategory']);
   //  Route::put('/users/rate/{id}/{rate}',[UserController::class,'updateRate']);


    //projects



  //portofolios

  Route::put('/portfolio/{id}',[PortfolioController::class,'update']);
  Route::delete('/portfolio/{id}',[PortfolioController::class,'destroy']);


   //purposals
   Route::post('/purposal',[PurposalController::class,'store']);
   Route::put('/purposal/{id}',[PurposalController::class,'update']);
   Route::post('/reviews',[ReviewController::class,'store']);
   Route::get('/purposal/all/{id}',[PurposalController::class,'index']);
   Route::get('/purposal/{id}',[PurposalController::class,'getPurposal']);

   //chat
   Route::post('/realTimeChat/{reciever_id}',[ChatController::class,'message']);
   Route::get('/realTimeChat/{id1}/{id2}',[ChatController::class,'getmessage']);

// Route::post('/pusher/auth',[ChatController::class,'authorizeUser']);
   //tasks



   Route::delete('/task/{id}',[TaskController::class,'destroy']);
   // Route::post('/task/accept/{id}',[TaskController::class,'makeAccepted']);

    //logout
    Route::post('/logout',[AuthController::class,'logout']);

});


/*==============================================================================================================================================*/
// Route::get('/purposal/all/{id}',[PurposalController::class,'index']);
// Route::get('/purposal/{id}',[PurposalController::class,'getPurposal']);

Route::post('/task/accept/{id}',[TaskController::class,'makeAccepted']);
Route::put('/users/rate/{id}/{rate}',[UserController::class,'updateRate']);

//email vertification

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

Route::post('forget-password', [NewPasswordController::class, 'forgetPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset']);


//email vertification
// Auth::routes(['verify'=>true]);
// Route::get('/email/resend', [VerificationController::class,'resend'])->name('verification.resend')->middleware('auth:sanctum');
// Route::get('/email/verify/{id}/{hash}',[VerificationController::class,'verify'])->name('verification.verify')->middleware('auth:sanctum');

//purposal
// Route::put('/purposal/{id}',[PurposalController::class,'update']);
// Route::delete('/purposal/{id}',[PurposalController::class,'destroy']);

//========================================================================//




Route::post('/contact',[ContactController::class,'store']);
/*Route::get('/event', function () {
     
   event(new NewNotification('Hey how are you beateful dodooo'));
   
});*/

