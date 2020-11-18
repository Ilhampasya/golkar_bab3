<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Encryption\DecryptException;

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

Route::get('{any}', function () {
    return view('index');
})->where('any', '(?:(?!api|404|verification).)*')->name('index');

Route::get('/404', function () {
    abort(404);
})->name('404');

Route::get('/verification', function (Request $request) {
    if (!$request->token) {
        abort(403);
    }

    try {
        if (!$user = User::where('email', decrypt($request->token))->first()) {
            abort(403);
        }

        if ($user->email_verified_at) {
            abort(403);
        }

        $user->markEmailAsVerified();

        return redirect('/login');
    } catch (DecryptException $e) {
        abort(403);
    }
})->name('verification');