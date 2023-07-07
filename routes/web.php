<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// handle search along with pagination
Route::get('search', function (Request $request) {
    $query = $request->input("query");

    $sortKey = $request->input("sortKey");
    $sortOrder = $request->input("sortOrder");

    // surely query will be set
    $results = Product::where('name', 'like', "%$query%");

    // if sorting applied then orderBy name
    // otherwise sort by latest
    if (isset($sortKey)) {
        $results = $results->orderBy($sortKey, $sortOrder);
    } else {
        $results = $results->latest('updated_at');
    }
    $results = $results->paginate(5);

    // append extra query params in case of pagination, query and sorting
    $pagination_ = array();
    $data = array();
    $data['results'] = $results;
    if (isset($sortKey)) {
        $pagination_['sortKey'] = $sortKey;
        $pagination_['sortOrder'] = $sortOrder;
        $data['sortOrder'] = $sortOrder;
        $data['sortKey'] = $sortKey;
    }
    if (isset($query)) {
        $pagination_['query'] = $query;
        $data['query'] = $query;
    }
    if (!empty($pagination_)) {
        $pagination = $results->appends($pagination_);
    }
    return view('products.index')->with($data);
    // return view('products.index')->with(compact('results', 'sortOrder', 'query'));
})->name('products.find');

// define Route with Controller
// Route::get('/users', [UserController::class, 'index']);

// named route products.index
// Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

// Route::get('products/{id}/edit', [ProductController::class, 'edit']);

// Route::put('products/{id}/update', [ProductController::class, 'update']);

// Route::delete('products/{id}/delete', [ProductController::class, 'destroy']);

// Route::get('products/{id}/show', [ProductController::class, 'show']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('products.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    // products routes
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

    Route::get('products/{id}/edit', [ProductController::class, 'edit']);

    Route::put('products/{id}/update', [ProductController::class, 'update']);

    Route::delete('products/{id}/delete', [ProductController::class, 'destroy']);

    Route::get('products/{id}/show', [ProductController::class, 'show']);
});

require __DIR__ . '/auth.php';