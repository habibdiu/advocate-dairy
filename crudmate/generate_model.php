<?php 

function generate_model($modelName, $table_name, $fields) {
	// Model content
    $model = "<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class $modelName extends Model
    {
        use HasFactory;

        protected \$table = '$table_name';

        protected \$guarded = [];


        protected \$fillable = [
		    " . implode(",\n    ", array_map(fn($f) => "'".$f['name']."'", array_filter($fields, fn($f) => $f['required'] === 'yes'))) . "
		];
    }
    ";
    file_put_contents("output/{$modelName}.php", $model);
}
