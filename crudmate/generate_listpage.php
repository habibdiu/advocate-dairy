<?php

function generate_listpage($modelName, $fields) {
    $page_title = $modelName . " List";
    $lower = strtolower($modelName);
    $varName = "\$single_" . $lower;
    $dataKey = $lower . "_list";

    // Generate table headers
    $thead = "<th style=\"\">SL</th>\n";
    foreach ($fields as $field) {
        if ($field['show'] === 'yes') {
            $thead .= "    <th>" . ucwords(str_replace('_', ' ', $field['name'])) . "</th>\n";
        }
    }
    $thead .= "    <th style=\"width:15%\">Action</th>\n";

    // Generate table body
    $tbody = "@foreach ( \$data['$dataKey'] as \$key => $varName)\n<tr>\n    <td>{{ \$key + 1 }}</td>\n";
    foreach ($fields as $field) {
        if ($field['show'] === 'yes') {
            $tbody .= "    <td>{{ {$varName}->{$field['name']} ?? '' }}</td>\n";
        }
    }
    $tbody .= <<<BLADE
    <td>
        <a href="{{ route('admin.{$lower}.edit', {$varName}->id) }}" class="btn btn-success btn-icon">
            <i class="fa-solid fa-edit"></i>
        </a>
        <a class="btn btn-danger btn-icon" data-delete="{{ {$varName}->id }}" id="delete">
            <i class="fa-solid fa-trash"></i>
        </a>
    </td>
</tr>
@endforeach
BLADE;

    // Blade page layout
    $layout = <<<BLADE
@extends('backend.admin.includes.admin_layout')
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 text-center">
                            <h3>$page_title</h3>
                        </div>
                        <div class="mt-3">
                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Failed!</strong> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="btn-close"></button>
                                </div>
                            @endif
                            <div id="success"></div>
                            <div id="failed"></div>
                        </div>
                        <div class="table-responsive" id="print_data">
                            <table id="dataTableExample" class="table" style="width: 100%;">
                                <thead>
                                    <tr>
$thead
                                    </tr>
                                </thead>
                                <tbody>
$tbody
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    \$(document).on('click', '#delete', function() {
        if (confirm('Are You Sure ?')) {
            let id = \$(this).attr('data-delete');
            let row = \$(this).closest('tr');
            \$.ajax({
                url: '/distroy/' + id,
                success: function(data) {
                    var data_object = JSON.parse(data);
                    if (data_object.status == 'SUCCESS') {
                        row.remove();
                        \$('#dataTableExample tbody tr').each(function(index) {
                            \$(this).find('td:first').text(index + 1);
                        });
                        \$('#success').html(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success! </strong>' +
                            data_object.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                        );
                    } else {
                        \$('#failed').html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Failed! </strong>' +
                            data_object.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                        );
                    }
                }
            });
        }
    });
</script>
@endpush
BLADE;

    file_put_contents("output/{$lower}_list.blade.php", $layout);
}
