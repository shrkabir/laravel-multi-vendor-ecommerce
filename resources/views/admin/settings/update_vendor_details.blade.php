@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    @if($slug=="personal")
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Vendor Details</h4>
                    <p class="card-description">
                        Vendor's Personal Details
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
                    <form class="forms-sample" action="{{ url('admin/vendor-details/update/personal') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="file" name="photo" class="form-control" id="photo" value="{{ Auth::guard('admin')->user()->photo }}">
                            @error('photo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{$vendorDetails->country_id == $country->id ? 'selected': ''}}>{{$country->name}} ({{$country->code}})</option>
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
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" {{$vendorDetails->state_id == $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" {{$city->id == $vendorDetails->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" name="post_code" id="" class="form-control" value="{{$vendorDetails->post_code}}">
                            @error('post_code')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="" class="form-control" cols="10" rows="3">{{$vendorDetails->address}}</textarea>
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
    @elseif($slug == "business")
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Vendor Details</h4>
                    <p class="card-description">
                        Vendor's Business Details
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
                    <form class="forms-sample" action="{{ url('admin/vendor-details/update/business') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" value="{{ $vendorDetails->shop_email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="shop_name">Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" value="{{ $vendorDetails->shop_name }}" placeholder="Admin Name">
                            @error('shop_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_phone">Shop Phone</label>
                            <input type="text" name="shop_phone" class="form-control" id="mobile" value="{{ $vendorDetails->shop_phone }}" placeholder="Mobile">
                            @error('shop_phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_website">Shop Website</label>
                            <input type="text" name="shop_website" id="" class="form-control" value="{{$vendorDetails->shop_website}}">
                            @error('shop_website')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{$vendorDetails->country_id == $country->id ? 'selected': ''}}>{{$country->name}} ({{$country->code}})</option>
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
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" {{$vendorDetails->state_id == $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" {{$city->id == $vendorDetails->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_pincode">Shop Pincode</label>
                            <input type="text" name="shop_pincode" id="" class="form-control" value="{{$vendorDetails->shop_pincode}}">
                            @error('shop_pincode')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_address">shop_address</label>
                            <textarea name="shop_address" id="" class="form-control" cols="10" rows="3">{{$vendorDetails->shop_address}}</textarea>
                            @error('shop_address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_licence_number">Shop Licence Mumber</label>
                            <input type="text" name="shop_licence_number" id="" class="form-control" value="{{$vendorDetails->shop_licence_number}}">
                            @error('shop_licence_number')
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
    @endif
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