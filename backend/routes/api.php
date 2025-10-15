<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ProductController;

Route::get('/health', fn() => response()->json(['status' => 'ok', 'time' => now()->toISOString()]));

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);
    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 422);
    }
    $request->session()->regenerate();
    return response()->json(['message' => 'logged_in']);
});

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['message' => 'logged_out']);
});

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show']);

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'time' => now()->toISOString(),
    ]);
});
