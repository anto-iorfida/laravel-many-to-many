<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;

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

// ***per vedere dashbord bisogna passare attraverso questo middleware se no ,non si vede niente
// Route::get('/admin.dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');

// Applica i middleware 'auth' e 'verified' a tutte le rotte nel gruppo. 
// Il middleware 'auth' assicura che l'utente sia autenticato, mentre 'verified' 
// assicura che l'utente abbia verificato il proprio indirizzo email.
Route::middleware(['auth', 'verified'])

    // Imposta un prefisso per i nomi delle rotte del gruppo. Tutte le rotte in questo 
    // gruppo avranno nomi che iniziano con 'admin.'. Ad esempio, una rotta chiamata 'dashboard' 
    // diventerà 'admin.dashboard'.
    ->name('admin.') // nome delle rotte

    // Imposta un prefisso per gli URL delle rotte del gruppo. Tutte le rotte in questo gruppo 
    // avranno URL che iniziano con 'admin'. Ad esempio, una rotta con URL '/dashboard' 
    // diventerà '/admin/dashboard'.
    ->prefix('admin') //nome che si aggiungono allinizio dell'url 

    // Raggruppa tutte le rotte definite all'interno della funzione callback. Le rotte 
    // all'interno di questo gruppo erediteranno i middleware, il prefisso del nome e il prefisso dell'URL
    ->group(function () {
        // le vaie rotte di amministrazione

        // Definisce una rotta GET per '/admin/dashboard' che utilizza il metodo 'index' 
        // del 'DashboardController'. Questa rotta ha il nome 'admin.dashboard' grazie al prefisso 
        // del nome impostato sopra.
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('project', ProjectController::class);
    });

// ***middleware pezzo di codice che sta tra 2 processi
// ***lutente puo vedere una risposta solo se glielo permette auth(controlla se lutente è loggato)
// ***bisogna raggrupare rotte perche hanno cose in comune
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
