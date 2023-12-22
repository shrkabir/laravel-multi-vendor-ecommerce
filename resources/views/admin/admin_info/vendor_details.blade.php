@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Vendor Details</h4>
                    <p class="card-description">
                        Vendor's Personal Details
                    </p>
                    <div class="personal-details mt-4">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <img src="{{asset('admin/images/photos')}}/img.jpg" alt="" class="rounded-circle">
                            </div>
                            <div class="col-6">
                                <h3>{{$vendorDetails->name}}
                                    <sup>
                                        @if($vendorDetails->status == 1)
                                        <span class="badge badge-pill badge-success ml-2">Active</span>
                                        @elseif($vendorDetails->status == 0)
                                        <span class="badge badge-pill badge-danger ml-2">Inactive</span>
                                        @endif
                                    </sup>
                                </h3>
                                <h4>{{$vendorDetails->email}}</h4>
                                <h4>{{$vendorDetails->mobile}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            
        </div>
    </div> -->
</div>

@push('script')
<!-- <script src="{{ asset('admin/js/custom.js') }}"></script> -->

<script>
    
</script>
@endpush
@endsection