<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Auth\Events\PasswordReset;

// Validate email address and send password reset link
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


// Show password reset form
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// Update password in database
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

// Main routes

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::get('/mon-travail', [HomeController::class,'myWork'])->name('work');
Route::get('/mentions-legales', [HomeController::class,'legalNotice'])->name('legalnotice');
Route::get('/politique-de-confidentialite', [HomeController::class,'privacyPolicy'])->name('privacypolicy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/creations', [AdminController::class,'index'])->name('creations.index');
Route::get('/creations/create', [AdminController::class,'create'])->name('creations.create');
Route::post('/creations/store', [AdminController::class,'store'])->name('creations.store');

Route::post('/images/store/{creation}', [AdminController::class,'storeImage'])->name('images.store');
Route::get('/creations/edit/{creation}', [AdminController::class,'edit'])->name('creations.edit');

Route::delete('/images/destroy/{image}', [AdminController::class,'destroyImage'])->name('images.destroy');
Route::put('/creations/update/{creation}', [AdminController::class,'update'])->name('creations.update');
Route::delete('/creations/destroy/{creation}', [AdminController::class,'destroyCreation'])->name('creations.destroy');
});
