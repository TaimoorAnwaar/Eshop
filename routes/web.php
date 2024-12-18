<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', [HomeController::class, 'index'])->name( 'home');

Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');

Route::get('/messages', [ChatController::class, 'viewMessages'])->name('messages.view');

Route::get('/manager/messages', [ChatController::class, 'viewManagerMessages'])->name('manager.messages.view');


Route::post('/reply-message', [ChatController::class, 'replyMessage'])->name('reply.message');

Route::get('/messages/count', [ChatController::class, 'getMessageCount'])->name('messages.count');




Route::get('/login', function () {
    return view('auth.login');
});


Auth::routes();

// For customers: Protect home route
Route::middleware([RoleMiddleware::class . ':customer'])->group(function () {
    Route::get('/about', [HomeController::class, 'About'])->name('about');
    Route::get('/home', [HomeController::class, 'index'])->name(name: 'home');
    Route::get('/products/{id}', [HomeController::class, 'getProductDetails'])->name('products.details');

    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/thank-you', [CheckoutController::class, 'thankYou'])->name('checkout.thankyou');

    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// Handle Form Submission
Route::post('/contact', [ContactController::class, 'submitContactMessage'])->name('contact.submit');

// Customer order history route
Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.history');




    
});


// Admin Routes: Only accessible by users with the 'admin' role
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/assign-role/{user}', [AdminController::class, 'assignRole'])->name('admin.assignRole');
});


// Manager Routes: Only accessible by users with the 'manager' role




Route::middleware([RoleMiddleware::class . ':manager'])->group(function () {
    Route::get('/manager/products', [ProductController::class, 'index'])->name('manager.products.index');
    Route::get('/manager/products/create', [ProductController::class, 'create'])->name('manager.products.create');
    Route::post('/manager/products', [ProductController::class, 'store'])->name('manager.products.store');
    Route::get('/manager/products/{product}/edit', [ProductController::class, 'edit'])->name('manager.products.edit');
    Route::put('/manager/products/{product}', [ProductController::class, 'update'])->name('manager.products.update');
    Route::delete('/manager/products/{product}', [ProductController::class, 'destroy'])->name('manager.products.destroy');

    Route::get('/manager/order', [OrderController::class, 'index'])->name('manager.order.index');

Route::patch('/manager/orders/{order}', [OrderController::class, 'update'])->name('manager.order.update');

Route::get('/manager/notifications', [NotificationController::class, 'showNotification'])->name('manager.notifications');
Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
Route::get('/unread-notifications-count', function () {
    return response()->json([
        'count' => auth()->user()->unreadNotifications->count()
    ]);

});

});




