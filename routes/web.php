<?php

use App\Http\Controllers\{AuthController, LandingController, TopUpController, WalletController, TransferController, TransactionController, ProfileController, AdminDashboardController, AdminUserController};
use App\Http\Controllers\AdminWithdrawalController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

// --- Guest Routes ---
Route::middleware('guest')->group(function () {
    Route::get('/', [LandingController::class, 'home'])->name('landing');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// --- User Routes ---
Route::middleware(['auth', 'user'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Route::get('/', function () {
       // return redirect()->route('wallet.index');
    //});

    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');

    // Top-up
    Route::get('/wallet/top-up', [TopUpController::class, 'show'])->name('wallet.topup.show');
    Route::post('/wallet/top-up/pay', [TopUpController::class, 'createSession'])->name('stripe.pay');
    Route::get('/wallet/top-up/success', [TopUpController::class, 'handleSuccess'])->name('wallet.topup.success');

    // Transfer
    Route::get('/transfer', [TransferController::class, 'show'])->name('transfer.show');
    Route::post('/transfer', [TransferController::class, 'store'])->name('transfer.store');

    // Transactions
    Route::get('/wallet/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/wallet/transaction/{id}', [TransactionController::class, 'show'])->name('transactions.show');

    // Withdraw
    Route::get('/withdraw', [WithdrawController::class, 'show'])->name('wallet.withdraw.show');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('wallet.withdraw.process');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// --- Admin Routes ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminDashboardController::class, 'logout'])->name('logout');

    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::post('/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('toggle-status');
    });
    // Withdrawals Management
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('/withdrawals/{id}', [AdminWithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::post('/withdrawals/{id}/update', [AdminWithdrawalController::class, 'updateStatus'])->name('withdrawals.update');
});
