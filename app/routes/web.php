<?php

use App\Http\Controllers\AgentTicketController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserTicketsController;

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
    return view('welcome');
});

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware(['auth', 'check.role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentTicketController::class, 'index'])->name('dashboard');


    Route::get('/tickets', [AgentTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{ticket}', [AgentTicketController::class, 'update'])->name('tickets.update');
});


Route::middleware(['auth', 'check.role:user'])->group(function () {

    Route::resource('mis-tickets', UserTicketsController::class)->parameters([
    'mis-tickets' => 'ticket'
])->names([
        'index' => 'user.tickets.index',
        'show' => 'user.tickets.show',
        'create' => 'user.tickets.create',
        'store' => 'user.tickets.store',
        'edit' => 'user.tickets.edit',
        'update' => 'user.tickets.update',
        'destroy' => 'user.tickets.destroy',
    ]);



});


Route::middleware(['auth'])->post('/tickets/{ticket}/messages', [TicketMessageController::class, 'store'])->name('tickets.messages.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
