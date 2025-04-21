<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;
use Botble\CustomerTickets\Http\Controllers\CommentController;
use Botble\CustomerTickets\Http\Controllers\CustomerController;
use Botble\CustomerTickets\Http\Controllers\TicketsController;

// Add below this line:
AdminHelper::registerRoutes(function () {

    // Customers Routes
    Route::prefix('customers')->as('customer.')->group(function () {
        Route::resource('', CustomerController::class)->parameters(['' => 'customer']);
        Route::get('status/{id}', [CustomerController::class, 'updateStatus'])->name('status');
        Route::get('{id}/show', [CustomerController::class, 'show'])->name('show');
    });

    // Tickets Routes
    Route::prefix('tickets')->as('tickets.')->group(function () {
        Route::resource('', TicketsController::class)
            ->parameters(['' => 'tickets'])
            ->except(['edit', 'update']);

        Route::get('{ticket}/edit', [TicketsController::class, 'edit'])->name('edit');
        Route::put('{tickets}', [TicketsController::class, 'update'])->name('update');
        Route::get('{id}/show', [TicketsController::class, 'show'])->name('show');
    });

    // Comments Routes
    Route::prefix('comments')->as('comments.')->group(function () {
        Route::post('store', [CommentController::class, 'store'])->name('store');
        Route::put('{id}', [CommentController::class, 'update'])->name('update');
        Route::delete('{id}', [CommentController::class, 'destroy'])->name('destroy');
    });
});
