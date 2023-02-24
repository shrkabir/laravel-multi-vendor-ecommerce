@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Admin Password</h4>
                    <p class="card-description">
                        Basic form layout
                    </p>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" value="{{ $adminDetails->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" value="{{ $adminDetails->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Admin Type</label>
                            <input type="text" class="form-control" @if($adminDetails->type == 1)
                            value="Super Admin"
                            @elseif($adminDetails->type == 2)
                            value="Admin"
                            @elseif($adminDetails->type == 3)
                            value="Sub Admin"
                            @elseif($adminDetails->type == 4)
                            value="Vendor"
                            @endif
                            readonly>
                        </div>
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection