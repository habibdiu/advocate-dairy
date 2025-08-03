<?php

$columns = [];
$input_types = array('text' => 'Text', 'number' => 'Number', 'int'=>'Number', 'double'=>'Number','timestamp'=>'Date Time', 'textarea' => 'Textarea', 'date' => 'Date', 'datetime' => 'Date Time', 'select' => 'Select', 'select2' => 'Select 2');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['sql_file'])) {
    $file = $_FILES['sql_file']['tmp_name'];
    $sql = file_get_contents($file);


    if (preg_match('/CREATE TABLE.*?\((.*?)\)\s*;/is', $sql, $matches)) {
        $column_lines = explode(",", $matches[1]);

        foreach ($column_lines as $line) {
            if (preg_match('/^\s*`?(\w+)`?\s+(\w+)/', trim($line), $col_match)) {
                if($col_match[1] == 'id'){

                } else {
                    $columns[] = [
                        'name' => $col_match[1],
                        'type' => strtolower($col_match[2])
                    ];    
                }
                
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dynamic Form SQL</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white shadow-lg p-6 rounded-xl">
        <h2 class="text-xl font-bold mb-4 text-center text-blue-600">Upload SQL File</h2>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="sql_file" accept=".sql" required class="file-input file-input-bordered w-full mb-4" />
            <button type="submit" class="btn btn-primary w-full">View Table Setting</button>
        </form>

        <?php if (!empty($columns)): ?>
            <hr class="my-6" />
            <h3 class="text-lg font-semibold mb-2 text-center">Input Fields</h3>
            <form id="dynamicForm">
                <table class="table w-full border border-collapse border-gray-300 mb-4">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="p-2 border">Column Name</th>
                            <th class="p-2 border">Database Type</th>
                            <th class="p-2 border">Input Type</th>
                            <th class="p-2 border">Show</th>
                            <th class="p-2 border">Required</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($columns as $index => $col): ?>
                            <tr class="border-t">
                                <td class="p-2 border"><?= htmlspecialchars($col['name']) ?>
                                    <input type="hidden" name="fields[<?= $index ?>][name]" value="<?= $col['name'] ?>">
                                </td>
                                <td class="p-2 border"><?= $col['type'] ?>
                                    <input type="hidden" name="fields[<?= $index ?>][db_type]" value="<?= $col['type'] ?>">
                                </td>
                                <td class="p-2 border">
                                    <select name="fields[<?= $index ?>][input_type]" class="select select-bordered w-full">
                                        <?php foreach($input_types as $key => $single_type) { ?>
                                            <option value="<?= $key ?>" <?= $col['type'] === $key ? 'selected' : '' ?>> <?= $single_type ?> </option>
                                        <?php } ?> 

                                    </select>
                                </td>
                                <td class="p-2 border text-center">
                                    <input type="checkbox" name="fields[<?= $index ?>][show]" checked class="checkbox" />
                                </td>
                                <td class="p-2 border text-center">
                                    <input type="checkbox" name="fields[<?= $index ?>][required]" checked class="checkbox" />
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Process</button>
                </div>
            </form>

         
        <?php endif; ?>
    </div>


<script>
    const form = document.getElementById('dynamicForm');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const fields = {};

            for (const [key, value] of formData.entries()) {
                const match = key.match(/fields\[(\d+)\]\[(\w+)\]/);
                if (match) {
                    const index = match[1];
                    const fieldName = match[2];

                    if (!fields[index]) fields[index] = {};
                    fields[index][fieldName] = value;
                }
            }

            // Checkboxes
            document.querySelectorAll('input[type="checkbox"]').forEach(input => {
                const match = input.name.match(/fields\[(\d+)\]\[(show|required)\]/);
                if (match) {
                    const index = match[1];
                    const field = match[2];
                    if (!fields[index]) fields[index] = {};
                    fields[index][field] = input.checked ? "yes" : "no";
                }
            });

            const jsonString = JSON.stringify(Object.values(fields), null, 2);
            const originalFileName = "<?= $_FILES['sql_file']['name'] ?? '' ?>";

        
            const submitForm = document.createElement("form");
            submitForm.method = "POST";
            submitForm.action = "process.php";

            const jsonInput = document.createElement("input");
            jsonInput.type = "hidden";
            jsonInput.name = "table_json_format";
            jsonInput.value = jsonString;
            submitForm.appendChild(jsonInput);

            const filenameInput = document.createElement("input");
            filenameInput.type = "hidden";
            filenameInput.name = "original_table_name";
            filenameInput.value = originalFileName;
            submitForm.appendChild(filenameInput);

            document.body.appendChild(submitForm);
            submitForm.submit();
        });
    }
</script>


</body>

</html>