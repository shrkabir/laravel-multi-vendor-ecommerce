@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Vendor Details</h4>
                    <p class="card-description">
                        Basic form layout
                    </p>
                    @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <strong>Success! </strong>{{ Session::get('success_message') }}
                    </div>
                    @endif
                    @if(Session::has('error_message'))
                    <div class="alert alert-danger">
                        <strong>Error! </strong>{{ Session::get('error_message') }}
                    </div>
                    @endif
                    <form class="forms-sample" action="{{ url('vendor-details/update/personal') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Admin Name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" placeholder="Mobile">
                            @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" class="form-control" id="photo">
                            @error('photo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{$country->name}} ({{$country->code}})</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control">
                                <option value="">Select State</option>
                            </select>
                            @error('state_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">Select City</option>
                            </select>
                            @error('city_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" name="post_code" id="" class="form-control">
                            @error('post_code')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="" class="form-control" cols="10" rows="3"></textarea>
                            @error('address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<!-- <script src="{{ asset('admin/js/custom.js') }}"></script> -->

<script>
    $(document).ready(function() {
        $('#current_password').keyup(function() {
            var currentPassword = $('#current_password').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{url('admin/check-admin-password')}}",
                data: {
                    currentPassword: currentPassword
                },
                success: function(response) {
                    // alert(response);
                    if (response == "false") {
                        $('#check_current_password').html("<font color='red'>Current password not matched yet...</font>");
                    } else if (response == "true") {
                        $('#check_current_password').html("<font color='green'>Current password matched. Type New Password.</font>");
                    }
                },
                error: function() {
                    alert("error");
                }
            });
        });

        $('#country_id').on('change', function(){
            var countryId = $('#country_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : "{{route('admin.get-state')}}",
                type: 'POST',
                data :{
                    countryId: countryId
                },

                success: function(data){
                    $.each(data, function(key){
                        $('#state_id').append('<option value="'+data[key].id+'">'+data[key].name+'</option>');
                    });
                },

                error: function(){
                    alert("error");
                }
            });
        });

        $('#state_id').on('change', function(){
            var stateId = $('#state_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : "{{route('admin.get-city')}}",
                type: 'POST',
                data :{
                    stateId: stateId
                },

                success: function(data){
                    $.each(data, function(key){
                        $('#city_id').append('<option value="'+data[key].id+'">'+data[key].name+'</option>');
                    });
                },

                error: function(){
                    alert("error");
                }
            });
        });
    });
</script>
@endpush
@endsection