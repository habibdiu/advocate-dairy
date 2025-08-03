<?php

function generate_add_edit_blades($modelName, $fields) {
    // Input templates
    $templates = [
        'text' => '<div class="col-md-3 mb-3">
    <label class="form-label" for="">[label_name] [required_star]</label>
    <input type="text" name="[column_name]" id="[column_name]" class="form-control" 
        placeholder="[placeholder]" [required_value] value="[value]">
</div>',

        'Number' => '<div class="col-md-3 mb-3">
    <label class="form-label" for="">[label_name] [required_star]</label>
    <input type="number" name="[column_name]" id="[column_name]" class="form-control" 
        placeholder="[placeholder]" [required_value] value="[value]">
</div>',

        'textarea' => '<div class="col-md-3 mb-3">
    <label class="form-label" for="">[label_name] [required_star]</label>
    <textarea name="[column_name]" id="[column_name]" class="form-control" cols="20" rows="5">[value]</textarea>
</div>',

        'select' => '<div class="col-md-3 mb-3">
    <label class="form-label">[label_name] [required_star]</label> 
    <select name="[column_name]" class="form-select select2 js-example-basic-single" id="[column_name]">
        <option value="">Select Option</option>
        {{-- Add your options here --}}
    </select>
</div>',

        'photo' => '<div class="col-md-3 mb-3">
    <label class="form-label">[label_name] [required_star]</label>
    <input name="[column_name]" id="[column_name]" class="form-control" type="file" [required_value]>
</div>',

        'date' => '<div class="col-md-3 mb-3">
    <label class="form-label" for="">[label_name] [required_star]</label>
    <input type="date" name="[column_name]" id="[column_name]" class="form-control" 
        placeholder="[placeholder]" [required_value] value="[value]">
</div>',

        'datetime' => '<div class="col-md-3 mb-3">
    <label class="form-label" for="">[label_name] [required_star]</label>
    <input type="datetime-local" name="[column_name]" id="[column_name]" class="form-control" 
        placeholder="[placeholder]" [required_value] value="[value]">
</div>',

'timestamp' => '<div class="col-md-3 mb-3">
    <label class="form-label" for="">[label_name] [required_star]</label>
    <input type="datetime-local" name="[column_name]" id="[column_name]" class="form-control" 
        placeholder="[placeholder]" [required_value] value="[value]">
</div>',
    ];

    $page_name = strtolower($modelName);
    $sample_layout = file_get_contents("sample_add.blade.php");

    foreach (['add', 'edit'] as $mode) {
        $input_html = "";

        foreach ($fields as $field) {
            $type = strtolower($field['input_type'] ?? 'text');
            $template = $templates[$type] ?? $templates['text'];

            $label_name = ucwords(str_replace('_', ' ', $field['name']));
            $placeholder = "Enter " . $label_name;
            $required_value = ($field['required'] === 'yes') ? "required" : "";
            $required_star = ($field['required'] === 'yes') ? "<span style='color:red'>*</span>" : "";

            // Blade dynamic value binding for edit
            $value = ($mode === 'edit')
                ? "{{ old('" . $field['name'] . "', \$data['details']->" . $field['name'] . " ?? '') }}"
                : "";

            $field_html = str_replace(
                ['[label_name]', '[column_name]', '[placeholder]', '[required_value]', '[required_star]', '[value]'],
                [$label_name, $field['name'], $placeholder, $required_value, $required_star, $value],
                $template
            );

            $input_html .= $field_html . "\n";
        }

        $action_button = $mode == 'edit' ? 'Update' : 'Save';
        $form_route = $mode == 'edit' ? '.update' : '.create';

        $final_layout = str_replace("<?= \$my_input_fields ;?>", $input_html, $sample_layout);
        $final_layout = str_replace("[page_title]", $modelName . ' ' . ucfirst($mode), $final_layout);
        $final_layout = str_replace("[form_route]", $form_route, $final_layout);
        $final_layout = str_replace("[action_button]", $action_button, $final_layout);

        file_put_contents("output/{$page_name}_{$mode}.blade.php", $final_layout);
    }
}
