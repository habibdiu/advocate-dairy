@extends('backend.admin.includes.admin_layout')
@push('css')
<link rel="stylesheet" href="{{ asset('backend_assets/css/ckeditor.css') }}">
@endpush
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-center mb-2">[page_title]</h3>
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
                        <form action="{{ route('[form_route]') }}" method="post">
                            @csrf
                            <div class="row">
                                <?= $my_input_fields ;?>
                            </div>

                            <div class="row">
                                <div class="text-center mt-2">
                                    <button class="btn btn-xs btn-success" type="submit">[action_button]</button>
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
