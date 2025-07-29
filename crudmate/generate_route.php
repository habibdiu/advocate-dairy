<?php 

function generate_route($table_name, $controllerName) {
	// Route content
    $route = "use App\Http\Controllers\\$controllerName;
    
    Route::get('/$table_name', [$controllerName::class, 'index']);
    Route::get('/$table_name'/create, [$controllerName::class, 'create']);
    Route::post('/$table_name', [$controllerName::class, 'store']);
    Route::get('/$table_name/show/{id}', [$controllerName::class, 'show']);
    Route::get('/$table_name/edit/{id}', [$controllerName::class, 'edit']);
    Route::post('/$table_name/update/{id}', [$controllerName::class, 'update']);
    Route::delete('/$table_name/delete/{id}', [$controllerName::class, 'destroy']);
    ";
    file_put_contents("output/web.php", $route);
}
