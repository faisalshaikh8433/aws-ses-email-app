<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('send_email');
});

Route::get('/sent_emails', function () {
    $sent_emails = App\SentEmail::latest()->paginate(5);
    return view('all_emails', compact('sent_emails'));
})->name('sent_emails');

Route::post('/send-email', 'AmazonController@sendEmail')->name('send_email');

Route::post('amazon-sns/email-notifications', 'AmazonController@emailNotifications');