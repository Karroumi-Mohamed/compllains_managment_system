<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function (){

    Route::middleware('role:user')->group(function (){
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/tickets', [UserController::class, 'tickets'])->name('user.tickets');
        Route::get('/user/tickets/create', [UserController::class, 'createTicket'])->name('user.ticket.create');
        Route::post('/user/tickets', [UserController::class, 'storeTicket'])->name('user.ticket.store');
        Route::get('/user/tickets/{ticket}', [UserController::class, 'ticket'])->name('user.ticket');
        Route::get('/user/tickets/{ticket}/edit', [UserController::class, 'editTicket'])->name('user.ticket.edit');
        Route::put('/user/tickets/{ticket}', [UserController::class, 'updateTicket'])->name('user.ticket.update');
        Route::delete('/user/tickets/{ticket}', [UserController::class, 'deleteTicket'])->name('user.ticket.delete');
    });

    Route::middleware('role:agent')->group(function (){
        Route::get('/agent', [AgentController::class, 'index'])->name('agent');
        Route::get('/agent/tickets', [AgentController::class, 'tickets'])->name('agent.tickets');
        Route::get('/agent/tickets/{ticket}', [AgentController::class, 'ticket'])->name('agent.ticket');
        Route::get('/agent/tickets/{ticket}/edit', [AgentController::class, 'editTicket'])->name('agent.ticket.edit');
        Route::put('/agent/tickets/{ticket}', [AgentController::class, 'updateTicket'])->name('agent.ticket.update');
    });


    Route::middleware('role:admin')->group(function (){
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::get('/admin/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
        Route::get('/admin/tickets/{ticket}', [AdminController::class, 'ticket'])->name('admin.ticket');
        Route::get('/admin/tickets/{ticket}/edit', [AdminController::class, 'editTicket'])->name('admin.ticket.edit');
        Route::delete('/admin/tickets/{ticket}', [AdminController::class, 'deleteTicket'])->name('admin.ticket.delete');
    });
});
require __DIR__.'/auth.php';
