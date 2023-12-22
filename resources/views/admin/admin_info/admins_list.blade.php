@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    @if($type==1)
                    Super Admins List
                    @elseif($type==2)
                    Admins List
                    @elseif($type==3)
                    Sub Admins List
                    @elseif($type==4)
                    Vendors List
                    @else
                    Admins, Sub Admins and Verdors List
                    @endif
                  </h4>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Admin ID#</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($admins as $admin)
                        <tr>
                          <td>{{$admin->id}}</td>
                          <td>{{$admin->name}}</td>
                          <td>
                            @if($admin->type == 1)
                            Super Admin
                            @elseif($admin->type == 2)
                            Admin
                            @elseif($admin->type == 3)
                            Sub Admin
                            @elseif($admin->type == 4)
                            Vendor
                            @endif
                          </td>
                          <td>{{$admin->mobile}}</td>
                          <td>{{$admin->email}}</td>
                          <td>
                            @if($admin->status == 0)
                            <span class="badge badge-danger">Inactive</span>
                            @elseif($admin->status == 1)
                            <span class="badge badge-success">Active</span>
                            @endif
                          </td>
                          <td>
                            @if($admin->type == 4)
                            <a href="{{route('admin.vendor-details', $admin->id)}}"><i class="mdi mdi-eye"></i></a>
                            @endif
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