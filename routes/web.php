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

Route::get('/welcome', function () {
   return \view('welcome2');
	
});
Route::model('emps', 'emp');
Route::resource('emp','EmployeeController');
// Route::get('show/{id}', [
//         'uses' => 'EmployeeController@show'
//     ]);
Route::get('/datatable', function () {
   return \view('employees.dtexample');
})->name('dtexample');

Route::get('/performance', function () {
   return \view('employees.performance');
})->name('performance');

Route::get('/engluardt', function () {
   return \view('employees.dtangular_ex');
})->name('engluardt');

Route::post('emp/delete_emp',  ['uses' => 'EmployeeController@deleteEmp'])->middleware('auth');
/*Route::post('emp/edit_emp',  ['uses' => 'EmployeeController@editEmp'])->middleware('auth');*/
/*Route::post('/dashboard',  ['uses' => 'EmployeeController@viewDashboard'])->middleware('auth');*/
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', 'Auth\LoginController@index');
Route::post('/get-employess-data',['uses' => 'EmployeeController@getEmpData'])->middleware('auth');
Route::get('/data-json',['uses' => 'EmployeeController@getJson'])->middleware('auth');

Route::get('/checklayout', function(){ return \view('layouts.innerpageLayout'); })->middleware('auth');
Route::get('/employeeList', 'EmployeeController@getEmpList');
Route::post('/saveperformance', 'EmployeeController@savePerformanceData');
Route::post('/deleteperformance','EmployeeController@delPerformanceData');
Route::get('/performancedata','EmployeeController@getPerformanceData');

Route::get('test',function(){
    $message  = "hello";
    $data = array('receiver'=>"Krutika Modi",'demo_one'=>'Demo 1','demo_two'=>"Demo 2",'sender'=>"Kruti Modi");
   
    Mail::send('mails.demo_plain', $data, function($message) {
        $message->to('krutika.m@crestinfosystems.net', 'Krutika Modi')->subject('Laravel Basic command scheduling Mail');
    });
   // Storage::disk('local')->put('krutika.txt', 'Contents');
});

Route::get('/message', 'MessageController@index');
Route::get('/message/send', 'MessageController@send');

Route::get('/onlineUsers','HomeController@getLoggedUser');

/*Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => 'client_id',
        'redirect_uri' => 'http://localhost/employee/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost/employee/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/employee/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'redirect_uri' => 'http://localhost/employee/api/get-user-details',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});*/
