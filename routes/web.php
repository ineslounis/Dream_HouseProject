<?php

use App\Http\Controllers\Admin\BienController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisiteController;
use App\Http\Middleware\AgenceRole;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Rdv;
use App\Models\Visite;
use Illuminate\Http\Request;



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

Route::get('/', [\App\Http\Controllers\HomeController::class,'index' ])->name('index');
// Route::view('/', 'index')->name('index');
Route::view('/contact', 'contact')->name('contact');
// Route::get('/index', [\App\Http\Controllers\HomeController::class,'index' ]);
Route::get('/visites', [VisiteController::class, 'index'])->name('biens.vistes')->middleware('auth');

// Route::middleware(['auth', 'role:admin,agence'])->get('/indexcontrat', [ContratController::class, 'index'])->name('contrats.index');



Route::post('/envoyer', [ContactController::class, 'envoyer'])->name('envoyer.email');
// Route::post('biens/{bien}/contact', [HomeController::class, 'contact'])->name('contact.email');
Route::get('agents.agent', [\App\Http\Controllers\HomeController::class,'agent' ])->name('agents.agent');
Route::get('admin.bien.annonce', [\App\Http\Controllers\HomeController::class,'annonce' ]);
// Route::get('users.index', [\App\Http\Controllers\HomeController::class,'user' ]);
Route::get('dashboard', [\App\Http\Controllers\HomeController::class, "recherche"])->name('dashboard');
Route::get('biens.annonce', [\App\Http\Controllers\HomeController::class, "recherche"])->name('biens.annonce');
Route::get('admin.bien.annonce', [\App\Http\Controllers\HomeController::class, "recherche"])->name('admin.bien.annonce');
// Route::get('admin.bien.annonce', [\App\Http\Controllers\HomeController::class, "recherche"])->name('admin.bien.annonce');
Route::get('admin.users.index', [\App\Http\Controllers\HomeController::class, "rechercher"])->name('admin.users.index');
// Route::get('admin.users.index', [\App\Http\Controllers\HomeController::class, "recherche1"])->name('admin.users.index');
Route::get('dashboard', [\App\Http\Controllers\BienController::class, "index"])->name('dashboard');
// Route::get('/index', [HomeController::class, 'index1']);
Route::get('/agence', [HomeController::class, 'index2']);
// Route::post('/biens/{bien}/contact', [BienController::class, 'contact'])->name('biens.contact');


// route de contrat
Route::get('/contrat/{bien}', [ContratController::class, 'create'])->name('contrat.create');
Route::post('/contrat', [ContratController::class, 'store'])->name('contrat.store');
Route::post('/schedule-visite', [VisiteController::class, 'scheduleVisite'])->name('schedule.visite');

// Route::get('/rdv/{bien}', [VisiteController::class, 'showForm'])->name('rdv.showForm');
Route::get('/heures-disponibles', function (Request $request) {
    $date = $request->query('date');
    $id_annonce = $request->query('id_annonce');
    
    // Récupérer toutes les heures réservées pour une date et une annonce spécifiques
    $rdvs = Visite::where('date_visite', $date)->where('id_annonce', $id_annonce)->get();
    $bookedHours = $rdvs->pluck('heure_visite')->toArray();

    // Définir toutes les heures possibles (vous pouvez ajuster cette liste selon vos besoins)
    $allHours = ['08:00','09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
    
    // Séparer les heures disponibles et non disponibles
    $availableHours = array_diff($allHours, $bookedHours);
    $unavailableHours = $bookedHours;

    return response()->json([
        'available' => array_values($availableHours),
        'unavailable' => array_values($unavailableHours)
    ]);
});

// Dans votre fichier de routes web.php
Route::get('/heures-disponibles', [VisiteController::class, 'getHeuresDisponibles'])->name('heures-disponibles');







// Route::get('/biens.rdv/{bien}', [\App\Http\Controllers\HomeController::class, 'showRdvForm'])->name('rdv.showForm');

Route::get('/biens.rdv/{bien}', [VisiteController::class, 'showForm'])->name('rdv.showForm');

Route::post('/rdv', [VisiteController::class, 'store'])->name('rdv.store');
Route::get('/heures-disponibles', [VisiteController::class, 'getHeuresDisponibles'])->name('heures-disponibles');


// Route::view('/contact')


Route::middleware([AgenceRole::class])->group(function(){
    Route::get('/indexcontrat', [ContratController::class, 'index'])->name('indexcontrat');

    Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function() {
        Route::resource('bien', \App\Http\Controllers\Admin\BienController::class)->except(['show']);
          
    });
});
Route::middleware([CheckRole::class])->group(function(){
    Route::get('/indexcontrat', [ContratController::class, 'index'])->name('indexcontrat');

    Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function() {
        Route::resource('bien', \App\Http\Controllers\Admin\BienController::class)->except(['show']);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
        // Route::delete('/admin/users/{utilisateur}', [UserController::class, 'destroy'])->name('admin.users.destroy');
         Route::delete('/admin/users/{utilisateur}', [UserController::class, 'destroy'])->name('admin.users.destroy');

          
    });
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'connexion'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
// Route::get('biens.show', [\App\Http\Controllers\AnnonceController::class, 'show'])->name('biens.show');
Route::get('/biens/{slug}-{bien}', [\App\Http\Controllers\HomeController::class, 'show'])->name('biens.show')->where([
    'bien' => $idRegex,
    'slug' => $slugRegex
]);



Route::post('biens/{bien}/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('biens.contact')->where([
    'bien' => $idRegex
]);
Route::get('/signup', function () {
    return view('signup');
});

Route::get('/admin.bien.annonce', function () {
    return view('admin.bien.annonce');
});

Route::get('/condition', function () {
    return view('condition');
});

// Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function() {
//     Route::resource('bien', \App\Http\Controllers\Admin\BienController::class)->except(['show']);
//     Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
// });
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';