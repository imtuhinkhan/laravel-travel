<?php

use App\Http\Controllers\AccessioriesController;
use App\Http\Controllers\ActiveTour;
use App\Http\Controllers\CarAirportController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClassicTour;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodArmeniaController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GastroTour;
use App\Http\Controllers\GuranteeTour;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MiceController;
use App\Http\Controllers\NearbyArmeniaController;
use App\Http\Controllers\OneDayController;
use App\Http\Controllers\ThemedTour;
use App\Http\Controllers\ThingsToDoController;
use App\Http\Controllers\ThingsToSeeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourEventController;
use App\Models\NearbyArmenia;
use Illuminate\Support\Facades\Route;

//============login===============

Route::get('/login', function () {
    return view('Backend.Admin.login.login');
});

//============ Add facility page==============

Route::get('/AddFacility', function () {
    return view('Backend.Admin.Tours.classicTours.AddFacility');
});

//================add highlight============

Route::get('/AddHighlight', function () {
    return view('Backend.Admin.Tours.classicTours.AddHighlights');
});


//----- dashboard page ---------

Route::get("/main", [DashboardController::class, 'index']);


//---- tour page ---------

Route::get("/admin/tours/{name}", [TourController::class, "index"]);
Route::get("/admin/tours/detail/{id}", [TourController::class, "show"]);
Route::post("/admin/tours/add", [TourController::class, "store"]);
Route::get('/admin/CreateClassicTour',[TourController::class, "create"]);
Route::delete("/admin/tour/delete/{id}",[TourController::class,"destroy"])->name('tourDelete');
Route::get('/admin/UpdateTourPage/{id}',[TourController::class,'edit']);
Route::put('/admin/tour/update/{id}',[TourController::class,'update']);
Route::post("/admin/highlight/{id}",[TourController::class,"addTourHighlights"])->name('addHighlight');
Route::post("/admin/facility/{id}",[TourController::class,"addTourFacility"])->name('addFacility');
Route::post("/admin/tourprogram/{id}",[TourController::class,"addTourProgram"])->name('addTourProgram');
Route::delete("/admin/highlight/delete/{id}",[TourController::class,"deleteHighlights"])->name('highlightDelete');
Route::delete("/admin/facility/delete/{id}",[TourController::class,"deleteTourFacility"])->name('facilityDelete');
Route::delete("/admin/tourprogram/delete/{id}",[TourController::class,"deleteTourProgram"])->name('tourProgramDelete');


//----------- Frontend -------------

Route::get('/', [FrontendController::class,'index'])->name('home');
Route::get('/tour/detail/{id}',[FrontendController::class,'tourDescription'])->name('tourDescription');
Route::get('/tour/{name}',[FrontendController::class,'getTours'])->name('getTours');



//=========== classic tours==========

Route::get('/Bv', [ClassicTour::class, 'getClasicTours']);
Route::get('/getClassicTour/{id}', [ClassicTour::class, 'getClassicTour']);

//=====gurantee Tour===========

Route::get('/guaranteeTour',[GuranteeTour::class,'getTours']);

//=========Gastro Tours=========


Route::get('/GastroTours',[GastroTour::class,'getTours']);

//=========Active Tours=========

Route::get('/activeTours', [ActiveTour::class, 'getTours']);

//=======theme tours==========

Route::get('/themed',[ThemedTour::class,'getTours']);

Route::get('/check', [TourController::class, 'index']);
Route::post('/checkpost', [TourController::class, 'checkStore']);

//========Admin Car=========

Route::get('/cars', [CarController::class, 'index'])->named('cars');
Route::get('/car/create', [CarController::class, 'create']);
Route::get('/car/{id}', [CarController::class, 'show']);
Route::post('/car/store', [CarController::class, 'store']);
Route::get('/car/edit/{id}', [CarController::class, 'edit']);
Route::put('/car/update/{id}', [CarController::class, 'update']);
Route::delete('/car/delete/{id}', [CarController::class, 'destroy']);


//========Admin CarAirport=========

Route::get('/admin/CarAtAirport',[CarAirportController::class,'index']);
Route::get('/admin/CarAtAirport/create',[CarAirportController::class,'create']);
Route::get('/admin/CarAtAirport/{id}',[CarAirportController::class,'show']);
Route::post('/admin/CarAtAirport/store',[CarAirportController::class,'store']);
Route::get('/admin/CarAtAirport/edit/{id}',[CarAirportController::class,'edit']);
Route::put('/admin/CarAtAirport/update/{id}',[CarAirportController::class,'update']);



//==========Admin Accessiories=========

Route::get('/admin/Accessiories',[AccessioriesController::class,'index']);
Route::get('/admin/accessiories/create',[AccessioriesController::class,'create']);
Route::get('/admin/accessiories/{id}',[AccessioriesController::class,'show']);
Route::post('/admin/accessiories/store',[AccessioriesController::class,'store']);
Route::get('/admin/accessiories/edit/{id}',[AccessioriesController::class,'edit']);
Route::put('/admin/accessiories/update/{id}',[AccessioriesController::class,'update']);
Route::delete('/admin/accessiories/delete/{id}',[AccessioriesController::class,'destroy']);


//==========Admin Hotel=========

Route::get('/admin/Hotel',[HotelController::class,'index']);
Route::get('/admin/Hotel/create',[HotelController::class,'create']);
Route::get('/admin/Hotel/{id}',[HotelController::class,'show']);
Route::post('/admin/Hotel/store',[HotelController::class,'store']);
Route::put('/admin/Hotel/update/{id}',[HotelController::class,'update']);
Route::delete('/admin/Hotel/delete/{id}',[HotelController::class,'destroy']);

//===========Admin Mice=========

Route::get('/admin/Mice',[MiceController::class,'index']);
Route::get('/admin/Mice/create',[MiceController::class,'create']);
Route::get('/admin/Mice/{id}',[MiceController::class,'show']);
Route::post('/admin/Mice/store',[MiceController::class,'store']);
Route::put('/admin/Mice/update/{id}',[MiceController::class,'update']);
Route::delete('/admin/Mice/delete/{id}',[MiceController::class,'destroy']);

//===========Admin Tour Events=========

Route::get('/admin/events',[TourEventController::class,'index']);
Route::get('/admin/events/create',[TourEventController::class,'create']);
Route::get('/admin/events/{id}',[TourEventController::class,'show']);
Route::post('/admin/events/store',[TourEventController::class,'store']);
Route::put('/admin/events/update/{id}',[TourEventController::class,'update']);
Route::delete('/admin/events/delete/{id}',[TourEventController::class,'destroy']);

//===========Admin Things to see=========

Route::get('/admin/thingsToSee',[ThingsToSeeController::class,'index']);
Route::get('/admin//admin/thingstoSeeCreate',[ThingsToSeeController::class,'create']);
Route::get('/admin/thingsToSee/{id}',[ThingsToSeeController::class,'show']);
Route::post('/admin/thingsToSee/store',[ThingsToSeeController::class,'store']);
Route::put('/admin/thingsToSee/update/{id}',[ThingsToSeeController::class,'update']);
Route::delete('/admin/thingsToSee/delete/{id}',[ThingsToSeeController::class,'destroy']);

//=====Admin things to do=========
Route::get('/admin/thingsToDo',[ThingsToDoController::class,'index']);
Route::get('/admin/admin/thingstoDoCreate',[ThingsToDoController::class,'create']);
Route::get('/admin/thingsToDo/{id}',[ThingsToDoController::class,'show']);
Route::post('/admin/thingsToDo/store',[ThingsToDoController::class,'store']);
Route::put('/admin/thingsToDo/update/{id}',[ThingsToDoController::class,'update']);
Route::delete('/admin/thingsToDo/delete/{id}',[ThingsToDoController::class,'destroy']);


//========Admin Nearby=========
Route::get('/admin/nearby',[NearbyArmeniaController::class,'index']);
Route::get('/admin/nearby/Create',[NearbyArmeniaController::class,'create']);
Route::get('/admin/nearby/{id}',[NearbyArmeniaController::class,'show']);
Route::post('/admin/nearby/store',[NearbyArmeniaController::class,'store']);
Route::put('/admin/nearby/update/{id}',[NearbyArmeniaController::class,'update']);
Route::delete('/admin/nearby/delete/{id}',[NearbyArmeniaController::class,'destroy']);

//=============Frontend Nearby ===========
Route::get('/getAllThingsToSee',[ThingsToSeeController::class,'getAllThingsToSee']);
Route::get('/getThingsToSeeByCategoryId/{id}',[ThingsToSeeController::class,'getThingsToSeeByCategory']);
Route::get('/getThingsToSeeById/{id}',[ThingsToSeeController::class,'getThingsToSeeById']);


//==========Things to see Frontend=========
Route::get('/todoSorrounding',[NearbyArmeniaController::class,'getAllNearby']);
Route::get('/nearbyByCategoryId/{id}',[NearbyArmeniaController::class,'getNearbyByCategory']);
Route::get('/nearbyById/{id}',[NearbyArmeniaController::class,'getNearbyById']);


//==========Things to do Frontend=========
Route::get('/getAllThingsToDo',[ThingsToDoController::class,'getAllThingsToDo']);
Route::get('/getThingsToDoByCategoryId/{id}',[ThingsToDoController::class,'getThingsToDoByCategory']);
Route::get('/getThingsToDoById/{id}',[ThingsToDoController::class,'getThingsToDoById']);



//==========Armenia admin food=========
Route::get('/admin/foods',[FoodArmeniaController::class,'index']);
Route::get('/admin/foods/create',[FoodArmeniaController::class,'create']);
Route::get('/admin/foods/{id}',[FoodArmeniaController::class,'show']);
Route::post('/admin/foods/store',[FoodArmeniaController::class,'store']);
Route::put('/admin/foods/update/{id}',[FoodArmeniaController::class,'update']);
Route::delete('/admin/foods/delete/{id}',[FoodArmeniaController::class,'destroy']);


//==========Armenia Frontend food=========
Route::get('/food',[FoodArmeniaController::class,'getAllFoods']);
Route::get('/getfoodsByCategory/{id}',[FoodArmeniaController::class,'getfoodsByCategory']);
Route::get('/getfoodsById/{id}',[FoodArmeniaController::class,'getfoodsById']);


//===========Frontend Tour Events=========
Route::get('/cs',[TourEventController::class,'showFrontend']);
Route::get('/c',[TourEventController::class,'showFrontendDetails']);


//==========Frontend Hotel=========

Route::get('/hs',[HotelController::class,'getHotels']);
Route::get('/h/{id}', [HotelController::class, 'getHotelDetails']);



//==========Frontend Accessiories=========

Route::get('/acs',[AccessioriesController::class,'getAccessiories']);
Route::get('/ac/{id}',[AccessioriesController::class,'getAccessioriesDetails']);


//========Frontend CarAirport=========
Route::get('/MT',[CarAirportController::class,'getAllCarAirport']);


//============= car frontend==============

Route::get('caa', [CarController::class, 'getCars']);
Route::get('/car/detail/{id}', [CarController::class, 'getCarDetails']);

//=========Mice frontend=========

Route::get('/mices', [MiceController::class, 'showMice']);
Route::get('/mices/{id}', [MiceController::class, 'showMiceDetails']);


Route::get("/dashboard/hello", [TourController::class, "index"]);



Route::get('/c2', function () {
    return view('Frontend.About.AboutUs');
});


Route::get('/privacy', function () {
    return view('Frontend.About.PrivacyPolicy');
});

Route::get('/ways', function () {
    return view('Frontend.About.waysToBook');
});


Route::get('/vacancy', function () {
    return view('Frontend.Vacancy.vacancy');
});








Route::get('/TourFrontPage', function () {
    return view('Frontend.Tours.Tour');
});




Route::get('/Rv', function () {
    return view('Frontend.BasicTours.RequestABasicTour');
});

Route::get('/Articles', function () {
    return view('Frontend.Blogs.Articles');
});

Route::get('/Article', function () {
    return view('Frontend.Blogs.Article');
});


Route::get('/b', function () {
    return view('Frontend.Brochures.Brochures');
});

Route::get('/withDriver', function () {
    return view('Frontend.Cars.WithDriver');
});





Route::get('/RF', function () {
    return view('Frontend.Cars.RentACarForm');
});





Route::get('/TentForm', function () {
    return view('Frontend.TourAccesories.TentForm');
});


Route::get('/mice', function () {
    return view('Frontend.Mice.Micee');
});

Route::get('/oneDay',[OneDayController::class,'index']);








Route::get('/ClassicTour', function () {
    return view('Frontend.BasicTours.BasicTours');
});


Route::get('/RenACar', function () {
    return view('Frontend.Cars.RentACarForm');
});





Route::get('/article', function () {
    return view('Frontend.Blogs.Article');
});



Route::get('/contact', function () {
    return view('Frontend.Contact.Contact');
});

Route::get('/BookHotel', function () {
    return view('Frontend.Hotels.BookHotelForm');
});











Route::get('/UpdateClassicTour', function () {
    return view('Backend.Admin.Tours.classicTours.UpdateClassicTour');
});


Route::get('/driver', function () {
    return view('Frontend.Cars.DriverCar');
});


Route::get('/usefulToKnow', function () {
    return view('Frontend.Armenia.UsefulToKnow');
});




Route::get('/review', function () {
    return view('Frontend.About.reviews');
});

Route::get('/AddReview', function () {
    return view('Frontend.Reviews.AddReview');
});


Route::get('/pageSee', function () {
    return view('Frontend.Armenia.ThingsToSeePage');
});





//================ view routes ====================


Route::get('/admin/thingstoDo', function () {
    return view('Backend.Admin.Armenia.ThingsToDo.view');
});



Route::get('/admin/usefulToKnow', function () {
    return view('Backend.Admin.Armenia.Informations.view');
});



Route::get('/admin/brochure', function () {
    return view('Backend.Admin.Armenia.Brochure.view');
});

Route::get('/admin/TravelBlog', function () {
    return view('Backend.Admin.Armenia.TravelBlog.view');
});



Route::get('/admin/CarWithDriver', function () {
    return view('Backend.Admin.Services.CarWithDriver.view');
});







//============destination routes=============

Route::get('/admin/d', function () {
    return view('Backend.Admin.Destination.view');
});



//===============Services Update routes=============

Route::get('/admin/UpdateCar', function () {
    return view('Backend.Admin.Services.Car.update');
});


Route::get('/admin/UpdateCarWithDriver', function () {
    return view('Backend.Admin.Services.CarWithDriver.update');
});




Route::get('/admin/updateHotel', function () {
    return view('Backend.Admin.Services.Hotels.update');
});








//============Armenia Create routes=============

Route::get('/admin/createBrochur', function () {
    return view('Backend.Admin.Armenia.Brochure.create');
});


Route::get('/admin/createInformation', function () {
    return view('Backend.Admin.Armenia.Informations.create');
});



Route::get('/admin/createTravelBlog', function () {
    return view('Backend.Admin.Armenia.TravelBlog.create');
});



//=============Armenia Update routes=============


Route::get('/admin/Brochure', function () {
    return view('Backend.Admin.Armenia.Brochure.update');
});


Route::get('/admin/updateFoodAndDrnk', function () {
    return view('Backend.Admin.Armenia.FoodAndDrink.update');
});

Route::get('/admin/updateInformation', function () {
    return view('Backend.Admin.Armenia.Informations.update');
});

Route::get('/admin/updateThingsToDo', function () {
    return view('Backend.Admin.Armenia.ThingsToDo.update');
});
Route::get('/admin/updateTravelBlog', function () {
    return view('Backend.Admin.Armenia.TravelBlog.update');
});



//======frontend send step route ==========


Route::get('/secondStep', function () {
    return view('partials.secondStepReq');
});

Route::get('/ThirdStep', function () {
    return view('partials.SendAMsg');
});




