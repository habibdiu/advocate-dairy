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
                        <h3 class=" text-center mb-2">Student Edit</h3>
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
                        <form action="{{ route('admin.student.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-3">
    <label class="form-label" for="">Batch No </label>
    <input type="text" name="batch_no" id="batch_no" class="form-control" 
        placeholder="Enter Batch No"  value="{{ old('batch_no', $data['details']->batch_no ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Branch Id </label>
    <input type="text" name="branch_id" id="branch_id" class="form-control" 
        placeholder="Enter Branch Id"  value="{{ old('branch_id', $data['details']->branch_id ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Roll Number </label>
    <input type="text" name="roll_number" id="roll_number" class="form-control" 
        placeholder="Enter Roll Number"  value="{{ old('roll_number', $data['details']->roll_number ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Name </label>
    <input type="text" name="name" id="name" class="form-control" 
        placeholder="Enter Name"  value="{{ old('name', $data['details']->name ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Phone </label>
    <input type="text" name="phone" id="phone" class="form-control" 
        placeholder="Enter Phone"  value="{{ old('phone', $data['details']->phone ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Guardian Phone </label>
    <input type="text" name="guardian_phone" id="guardian_phone" class="form-control" 
        placeholder="Enter Guardian Phone"  value="{{ old('guardian_phone', $data['details']->guardian_phone ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Guardian Phone2 </label>
    <input type="text" name="guardian_phone2" id="guardian_phone2" class="form-control" 
        placeholder="Enter Guardian Phone2"  value="{{ old('guardian_phone2', $data['details']->guardian_phone2 ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Guardian Phone3 </label>
    <input type="text" name="guardian_phone3" id="guardian_phone3" class="form-control" 
        placeholder="Enter Guardian Phone3"  value="{{ old('guardian_phone3', $data['details']->guardian_phone3 ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Unit Id </label>
    <input type="text" name="unit_id" id="unit_id" class="form-control" 
        placeholder="Enter Unit Id"  value="{{ old('unit_id', $data['details']->unit_id ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Student Type </label>
    <input type="text" name="student_type" id="student_type" class="form-control" 
        placeholder="Enter Student Type"  value="{{ old('student_type', $data['details']->student_type ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Fee Amount </label>
    <input type="text" name="fee_amount" id="fee_amount" class="form-control" 
        placeholder="Enter Fee Amount"  value="{{ old('fee_amount', $data['details']->fee_amount ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Created By </label>
    <input type="text" name="created_by" id="created_by" class="form-control" 
        placeholder="Enter Created By"  value="{{ old('created_by', $data['details']->created_by ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Created At </label>
    <input type="datetime-local" name="created_at" id="created_at" class="form-control" 
        placeholder="Enter Created At"  value="{{ old('created_at', $data['details']->created_at ?? '') }}">
</div>
<div class="col-md-3 mb-3">
    <label class="form-label" for="">Updated At </label>
    <input type="datetime-local" name="updated_at" id="updated_at" class="form-control" 
        placeholder="Enter Updated At"  value="{{ old('updated_at', $data['details']->updated_at ?? '') }}">
</div>

                            </div>

                            <div class="row">
                                <div class="text-center mt-2">
                                    <button class="btn btn-xs btn-success" type="submit">Update</button>
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
