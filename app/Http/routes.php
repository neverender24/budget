<?php

Route::get('/', 'UsersController@dashboard');
Route::get('/expenditures', 'UsersController@expenditures');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('change-password', function(){
    return view('auth/change-password');
});

Route::post('change-password/update', function(){

   $old     = \Request::get('old-password');
   $new     = \Request::get('new-password');
   $confirm = \Request::get('password_confirmation');

    if (!Hash::check($old, \Auth::user()->password))
    {
        \Session::flash('flash_message_delete','Old password incorrect.');
        return view('auth/change-password');
    }

    if($new !== $confirm)
    {
        \Session::flash('flash_message_delete','New password not match with confirm password.');
        return view('auth/change-password');
    }

    $user = App\User::findOrFail( \Auth::user()->id);
    $user->password = bcrypt($new);
    $user->save();
    \Session::flash('flash_message','Password updated.');
    return redirect('/');
});

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('before_index','FuncsController@before_index');
Route::get('before-chrt','ChrtsController@beforeChrt');

//OBRD
Route::controller('funcs/{funcs}/raohs/{raohs}/raods/{raods}/obrds', 'ObrdsController', [
    'anyData'  => 'funcs.raohs.raods.obrds.data',
]);
Route::resource('funcs.raohs.raods.obrds','ObrdsController');

//APPD
Route::controller('funcs/{funcs}/raohs/{raohs}/raods/{raods}/appds', 'AppdsController', [
    'anyData'  => 'funcs.raohs.raods.appds.data',
]);
Route::resource('funcs.raohs.raods.appds','AppdsController');

//ALTD
Route::controller('funcs/{funcs}/raohs/{raohs}/raods/{raods}/altds', 'AltdsController', [
    'anyData'  => 'funcs.raohs.raods.altds.data',
]);
Route::resource('funcs.raohs.raods.altds','AltdsController');

//RAOD
Route::controller('funcs/{funcs}/raohs/{raohs}/raods', 'RaodsController', [
    'anyData'  => 'funcs.raohs.raods.data',
]);
Route::resource('funcs.raohs.raods','RaodsController');

//OBRH
Route::controller('funcs/{funcs}/raohs/{raohs}/obrhs', 'ObrhsController', [
    'anyData'  => 'funcs.raohs.obrhs.data',
]);
Route::resource('funcs.raohs.obrhs','ObrhsController');

//ALTH
Route::controller('funcs/{funcs}/raohs/{raohs}/alths', 'AlthsController', [
    'anyData'  => 'funcs.raohs.alths.data',
]);
Route::resource('funcs.raohs.alths','AlthsController');

//APPH
Route::controller('funcs/{funcs}/raohs/{raohs}/apphs', 'ApphsController', [
    'anyData'  => 'funcs.raohs.apphs.data',
]);
Route::resource('funcs.raohs.apphs','ApphsController');

//FUNC
Route::controller('funcs/{funcs}/raohs', 'RaohsController', [
    'anyData'  => 'funcs.raohs.data',
]);
Route::resource('funcs.raohs','RaohsController');
Route::get('status-report','RaohsController@status_report');
Route::get('status-report/data','RaohsController@anyStatus');

//CHRT
Route::controller('chrts', 'ChrtsController', [
    'anyData'  => 'chrts.data',
]);
Route::resource('chrts','ChrtsController');

//RAOH
Route::post('funcs/raohs','RaohsController@before_index');
Route::resource('funcs','FuncsController');

Route::get('queries','QueriesController@index');

//USERS
Route::get('/users/data/', 'UsersController@anyData');
Route::resource('users','UsersController');

//PERMISSIONS
Route::resource('users.permissions','PermissionsController');

// RAOH PERMISSIONS
Route::get('users/{user_id}/raohs','PermissionsController@setRaoh');
Route::post('users/{user_id}/raohs/create','PermissionsController@createRaoh' );

Route::get('/param', function(){

    $year = \Request::get('year');

    if(\Auth::user()->role != 'admin') {
        $permissions = \App\Func::leftjoin('permissions','func.refid','=','permissions.func_id')
            ->select(\DB::raw('CONCAT(func.ffunction, " - ", func.FFUNCCOD) AS offices'), 'func.FFUNCCOD')
            ->where('user_id', \Auth::user()->id)
            ->where('func.tyear', $year)
            ->get();
    }else{
        $permissions = \App\Func::select(\DB::raw('CONCAT(ffunction, " - ", FFUNCCOD) AS offices'), 'FFUNCCOD')
        ->where('tyear','=', $year)
        ->orderBy('offices')
        ->get();
    }

    return response()->json($permissions);

});


Route::get('rate/{data?}', function(){
    $rate = request()->rate;
    $user = \App\User::find(\Auth::user()->id);
    $user->rating = $rate;
    $user->save();
});
