<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/tickets', [UserController::class, 'tickets'])->name('user.tickets');
        Route::get('/tickets/create', [UserController::class, 'createTicket'])->name('user.ticket.create');
        Route::post('/tickets', [UserController::class, 'storeTicket'])->name('user.ticket.store');
        Route::get('/tickets/{ticket}', [UserController::class, 'ticket'])->name('user.ticket');
        Route::get('/tickets/{ticket}/edit', [UserController::class, 'editTicket'])->name('user.ticket.edit');
        Route::put('/tickets/{ticket}', [UserController::class, 'updateTicket'])->name('user.ticket.update');
        Route::delete('/tickets/{ticket}', [UserController::class, 'deleteTicket'])->name('user.ticket.delete');

        Route::post('/agent-request', [UserController::class, 'submitAgentRequest'])->name('user.agent-request.submit');
    });

    Route::prefix('agent')->middleware('role:agent')->group(function () {
        Route::get('/', [AgentController::class, 'index'])->name('agent');
        Route::get('/tickets', [AgentController::class, 'tickets'])->name('agent.tickets');
        Route::get('/tickets/{ticket}', [AgentController::class, 'ticket'])->name('agent.ticket');
        Route::get('/tickets/{ticket}/edit', [AgentController::class, 'editTicket'])->name('agent.ticket.edit');
        Route::put('/tickets/{ticket}', [AgentController::class, 'updateTicket'])->name('agent.ticket.update');
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');

        Route::prefix('tickets')->group(function () {
            Route::get('/', [AdminController::class, 'tickets'])->name('admin.tickets');
            Route::get('/{ticket}', [AdminController::class, 'ticket'])->name('admin.ticket');
            Route::get('/{ticket}/edit', [AdminController::class, 'editTicket'])->name('admin.ticket.edit');
            Route::delete('/{ticket}', [AdminController::class, 'deleteTicket'])->name('admin.ticket.delete');
        });

        Route::prefix('agent-requests')->group(function () {
            Route::get('/', [AdminController::class, 'agentRequests'])->name('admin.agent-requests');
            Route::put('/{agentRequest}/approve', [AdminController::class, 'approveAgentRequest'])->name('admin.agent-requests.approve');
            Route::put('/{agentRequest}/reject', [AdminController::class, 'rejectAgentRequest'])->name('admin.agent-requests.reject');
        });
    });
});
