<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/api/avaliacao', function (HttpRequest $request) {
    
    $validated = $request->validate([
        'energia' => 'required|string',
        'desempenho' => 'required|string',
        'custo' => 'required|numeric',
        'aplicacao' => 'required|string',
    ]);

    // igor colocar aqui sua chamada para api e fazer o que for preciso para devoler no front :
    /* 
        Tem que ter todas essas informações como resposta da api no minimo , monta um texto base para poder enviar no gpt
        para garantir que vai ter essas resposta no minino , ai passa ela formatada no $response 
        H --> I["Tipo de Processador"]
        H --> J["Tipo de Arquitetura"]
        H --> K["Memória Cache"]
        H --> L["Frequência da CPU"]
        H --> M["Justificativa Técnica"]
        */    
    $response = "Consumo de Energia: {$validated['energia']}, Desempenho: {$validated['desempenho']}, Custo: {$validated['custo']}, Aplicação: {$validated['aplicacao']}.";

    return inertia('Dashboard', ['response' => $response]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
