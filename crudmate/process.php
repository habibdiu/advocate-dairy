<?php
date_default_timezone_set('Asia/Dhaka');
@include_once('generate_model.php');
@include_once('generate_controller.php');
@include_once('generate_route.php');
@include_once('generate_input.php');
@include_once('generate_listpage.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table_json_format = $_POST['table_json_format'] ?? '';
    $table_name_full = $_POST['original_table_name'] ?? 'table_'. time();
    $table_name = explode('.',$table_name_full)[0];

    if (isset($_POST['download'])) {
        if (!$table_json_format || !$table_name) {
            die("❌ Missing 'table_json_format' or 'original_table_name'");
        }

        $fields = json_decode($table_json_format, true);
        if (!is_array($fields)) {
            die("❌ Invalid JSON format for 'table_json_format'");
        }

        // Convert table name to StudlyCase Model name
        function studlyCase($string) {
            return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $string)));
        }

        // Singular helper (simple fallback)
        function str_singular($word) {
            return rtrim($word, 's');
        }

        $modelName = studlyCase(str_singular($table_name));
        $controllerName = $modelName . "Controller";

        // Output folder
        @mkdir("output", 0777, true);

        generate_model($modelName, $table_name, $fields);
        generate_controller($modelName, $controllerName, $fields);
        generate_route($table_name, $controllerName);
        generate_add_edit_blades($modelName, $fields);
        generate_listpage($modelName, $fields);

        echo "✅ Files generated in 'output/' folder:<br>";
        echo "📄 Model: {$modelName}.php<br>";
        echo "📄 Controller: {$controllerName}.php<br>";
        echo "📄 Routes: web.php<br>";
        exit;
    } else {
        // Show JSON preview and download button
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Process JSON</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="bg-gray-100 p-10">
            <div class="max-w-4xl mx-auto bg-white shadow-lg p-6 rounded-xl">
                <h2 class="text-xl font-bold text-center mb-4 text-blue-700">JSON Data Preview</h2>
                <pre class="bg-gray-200 p-4 rounded text-sm overflow-x-auto"><?= htmlspecialchars($table_json_format) ?></pre>

                <form method="POST" class="text-center mt-6">
                    <input type="hidden" name="table_json_format" value='<?= htmlspecialchars($table_json_format, ENT_QUOTES) ?>'>
                    <input type="hidden" name="original_table_name" value="<?= htmlspecialchars($table_name) ?>">
                    <input type="hidden" name="download" value="1">
                    <button type="submit" class="btn btn-primary px-6 py-2 bg-green-600 text-white rounded">Download JSON</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}
?>
