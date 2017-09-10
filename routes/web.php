<?php
use Illuminate\Support\Facades\Log;
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
class User extends Eloquent {}
Route::get('/', function () {
    return view('hello');
});
Route::get('users', function()
{
    $users = User::all();

    return View::make('users')->with('users', $users);
});




/** Machines  */
Route::get('machine/reserver','MachineReservationController@index');
Route::post('machine/reserver','MachineReservationController@store');
Route::resource('machine/reserver','MachineReservationController');
Route::get('machine/reserver/{id}',array('as'=>'machine/reserver','uses'=>'MachineReservationController@show'));

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout',function (){
    Auth::logout();
    return redirect('/');
});
Route::resource('manage','AdminManagerController');
Route::resource('events','EventController');
Route::delete('event_reserve/{user_id}/{event_id}', 'EventListController@destroy');
Route::resource('event_reserve','EventListController');
Route::resource('machine','MachineController');
Route::resource('machine_reservation','MachineReservationController');
Route::resource('blacklist','BlacklistController');
//Route::get('account/{id}','UserAccount@index');
Route::resource('account','UserAccount');
Route::resource('about','AboutController');
Route::resource('projet','ProjectController');
Route::resource('machinetype','TypeController');
Route::resource('defaultcalander','DefaultMachineCalander');
Route::resource('faq','FAQController');
Route::resource('points_default','DefaultPoints');
Route::resource('parse_project','ParseProjectController');

Route::resource('mail', 'EmailController');
Route::resource('validate_registration', 'UserRegistrationRequest');