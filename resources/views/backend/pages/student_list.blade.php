@extends('backend.includes.backend_layout')
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 text-center">
                            <h3>Student List</h3>
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
                                        <th style="">SL</th>
                                            <th>Batch No</th>
                                            <th>Branch Id</th>
                                            <th>Roll Number</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Guardian Phone</th>
                                            <th>Guardian Phone2</th>
                                            <th>Guardian Phone3</th>
                                            <th>Unit Id</th>
                                            <th>Student Type</th>
                                            <th>Fee Amount</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th style="width:15%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    @foreach ( $data['student_list'] as $key => $single_student)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $single_student->batch_no ?? '' }}</td>
                                        <td>{{ $single_student->branch_id ?? '' }}</td>
                                        <td>{{ $single_student->roll_number ?? '' }}</td>
                                        <td>{{ $single_student->name ?? '' }}</td>
                                        <td>{{ $single_student->phone ?? '' }}</td>
                                        <td>{{ $single_student->guardian_phone ?? '' }}</td>
                                        <td>{{ $single_student->guardian_phone2 ?? '' }}</td>
                                        <td>{{ $single_student->guardian_phone3 ?? '' }}</td>
                                        <td>{{ $single_student->unit_id ?? '' }}</td>
                                        <td>{{ $single_student->student_type ?? '' }}</td>
                                        <td>{{ $single_student->fee_amount ?? '' }}</td>
                                        <td>{{ $single_student->created_by ?? '' }}</td>
                                        <td>{{ $single_student->created_at ?? '' }}</td>
                                        <td>{{ $single_student->updated_at ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.student.edit', $single_student->id) }}" class="btn btn-success btn-icon">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-icon" data-delete="{{ $single_student->id }}" id="delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
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
    $(document).on('click', '#delete', function() {
        if (confirm('Are You Sure ?')) {
            let id = $(this).attr('data-delete');
            let row = $(this).closest('tr');
            $.ajax({
                url: '/distroy/' + id,
                success: function(data) {
                    var data_object = JSON.parse(data);
                    if (data_object.status == 'SUCCESS') {
                        row.remove();
                        $('#dataTableExample tbody tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                        });
                        $('#success').html(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success! </strong>' +
                            data_object.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>'
                        );
                    } else {
                        $('#failed').html(
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