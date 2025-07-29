@extends('backend.includes.backend_layout')
@push('css')
<link rel="stylesheet" href="{{ asset('backend_assets/css/ckeditor.css') }}">
@endpush
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-center mb-2">Student Add</h3>
                        @if (session('success'))
                            <div style="width:100%" class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong> Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="btn-close"></button>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Failed!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="btn-close"></button>
                            </div>
                        @endif
                        <form action="{{ route('admin.student.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Batch No </label>
                                <input type="text" name="batch_no" id="batch_no" class="form-control" 
                                    placeholder="Enter Batch No"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Branch Id </label>
                                <input type="text" name="branch_id" id="branch_id" class="form-control" 
                                    placeholder="Enter Branch Id"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Roll Number </label>
                                <input type="text" name="roll_number" id="roll_number" class="form-control" 
                                    placeholder="Enter Roll Number"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Name </label>
                                <input type="text" name="name" id="name" class="form-control" 
                                    placeholder="Enter Name"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Phone </label>
                                <input type="text" name="phone" id="phone" class="form-control" 
                                    placeholder="Enter Phone"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Guardian Phone </label>
                                <input type="text" name="guardian_phone" id="guardian_phone" class="form-control" 
                                    placeholder="Enter Guardian Phone"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Guardian Phone2 </label>
                                <input type="text" name="guardian_phone2" id="guardian_phone2" class="form-control" 
                                    placeholder="Enter Guardian Phone2"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Guardian Phone3 </label>
                                <input type="text" name="guardian_phone3" id="guardian_phone3" class="form-control" 
                                    placeholder="Enter Guardian Phone3"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Unit Id </label>
                                <input type="text" name="unit_id" id="unit_id" class="form-control" 
                                    placeholder="Enter Unit Id"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Student Type </label>
                                <input type="text" name="student_type" id="student_type" class="form-control" 
                                    placeholder="Enter Student Type"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Fee Amount </label>
                                <input type="text" name="fee_amount" id="fee_amount" class="form-control" 
                                    placeholder="Enter Fee Amount"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Created By </label>
                                <input type="text" name="created_by" id="created_by" class="form-control" 
                                    placeholder="Enter Created By"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Created At </label>
                                <input type="datetime-local" name="created_at" id="created_at" class="form-control" 
                                    placeholder="Enter Created At"  value="">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label" for="">Updated At </label>
                                <input type="datetime-local" name="updated_at" id="updated_at" class="form-control" 
                                    placeholder="Enter Updated At"  value="">
                            </div>

                            </div>

                            <div class="row">
                                <div class="text-center mt-2">
                                    <button class="btn btn-xs btn-success" type="submit">Save</button>
                                    <button class="btn btn-xs btn-danger" type="reset">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js') 
@endpush
