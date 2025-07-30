@extends('backend.includes.backend_layout')
@push('css')
<style>
    input.form-control,
    textarea.form-control {
        font-weight: bold;
        border-color: #7a7878;
    }
</style>
@endpush
@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-center mb-2">SMS Add</h3>
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
                            <form action="{{ route('admin.sms.add') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">


                                    <div class="col-md-6 mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" rows="4" name="message" placeholder="Type here..." required></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                    <label for="receiver_numbers" class="form-label">Receiver Numbers *</label>
                                    <textarea id="receiver_numbers" class="form-control" name="receiver_numbers" rows="4" required></textarea>
                                    </div>

                                    <div class="col-md-3">
                                    <label for="sms_parts" class="form-label">SMS Parts</label>
                                    <input type="text" class="form-control" id="sms_parts" name="sms_parts"  />
                                    </div>


                                    <div class="col-md-3">
                                    <label for="total_receivers" class="form-label">Total Receivers</label>
                                    <input type="number" class="form-control" id="total_receivers" name="total_receivers" min="0" />
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label for="branch_id" class="form-label">Branch ID</label>
                                        <input type="number" class="form-control" id="branch_id" name="branch_id" min="0" value="0" required>
                                    </div>


                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="">Send Date Time</label>
                                        <input type="datetime-local" name="send_date_time" class="form-control">
                                    </div>
                                    

                                    <div class="col-md-3">
                                        <label for="" class="form-label"> Toatl SMS Cost</label>
                                        <input type="number" class="form-control" min="0"  name="total_sms_cost">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="sms_sent_status" class="form-label">SMS Sent Status</label>
                                            <select class="form-select" id="sms_sent_status" name="sms_sent_status">
                                                <option value="0" selected>Not Sent</option>
                                                <option value="1">Sent</option>
                                            </select>
                                    </div>

                                    
                                        
                                </div>
                                <div class="text-center mt-2 ">
                                    <button class="btn btn-xs btn-primary" type="submit">Add</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
  const textareaMessage = document.getElementById('message');
  const smsPartsOutput = document.getElementById('sms_parts');

  const mobileTextarea = document.getElementById('receiver_numbers');
  const receiverCountOutput = document.getElementById('total_receivers');


  textareaMessage.addEventListener('input', () => {
    const length = textareaMessage.value.length;
    smsPartsOutput.value = Math.floor(length / 5);
  });


  mobileTextarea.addEventListener('input', () => {
    const digitsOnly = mobileTextarea.value.replace(/\D/g, '');
    receiverCountOutput.value = Math.floor(digitsOnly.length / 11);
  });
</script>
@endpush


