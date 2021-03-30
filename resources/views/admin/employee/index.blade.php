@extends('layouts.admin')
@section('content')
<style>
.dropdown-menu-xs {
    min-width: 130px;
}
.tb-tnx-action {
    text-align:center;
    min-width: 110px;
}
</style>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Employees</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a class="btn btn-primary" href="{{ url('employee/create') }}" style="float:right"><em class="icon ni ni-plus"></em><span>Add Employee</span></a>
                    
                    <div class="form-control-select" style="float: right;margin-right: 10px;">
                        
                        <select class="form-control" id="default-06">
                            <option value="default_option">All</option>
                            <option value="option_select_name">Active</option>
                            <option value="option_select_name">Pending Entry</option>
                            <option value="option_select_name">Pending Exit</option>
                        </select>
                    </div>

                    <label style="float:right;margin-right:7px;margin-top:7px;margin-bottom:0;font-weight:bold;">Filter By</label>

                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @if (session('message'))
            <div class="alert alert-pro alert-{{ session('alert_class') }} alert-dismissible">
                <div class="alert-text">
                    <h6>{{ session('message') }}</h6>
                </div>
                <button class="close" data-dismiss="alert"></button>
            </div>
        @endif
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card card-bordered card-preview">
                    <table class="table table-tranx table-hover">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;?>
                        @foreach($user as $users)
                            <tr class="tb-tnx-item">
                                <td class="tb-id">{{$no++}}</td>
                                <td>{{$users->name}}</td>
                                <td>{{$users->email}}</td>
                                <td>{{$users->phone}}</td>
                                <td>
                                    <span class="badge badge-dot badge-success">Active</span>
                                </td>
                                <td>{{ date('M d, Y', time()) }}</td>
                                <td class="tb-tnx-action">
                                    <a href="{{ url('employee/'.$users->id.'/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                    <a href="#" class="text-danger"><em class="icon ni ni-minus-circle-fill"></em><span>Exit</span></a><br>
        
                                   <a href="{{ url('employee/delete/' . $users->id) }}" onclick="return confirm('Are you sure you want to delete ?')" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a><br>
                                   
                                </td>
                            </tr>

                            <!-- <tr class="tb-tnx-item">
                                <td class="tb-id">2</td>
                                <td>Sebastian</td>
                                <td>sebastian@yopmail.com</td>
                                <td>1234567890</td>
                                <td>
                                    <span class="badge badge-dot badge-danger">Pending Exit</span>
                                </td>
                                <td>{{ date('M d, Y', time()) }}</td>
                                <td class="tb-tnx-action">
                                    <a href="{{ url('employee/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                    <a href="{{ url('exit-form') }}"><em class="icon ni ni-file-check"></em><span>Exit Form</span></a><br>
                                    <a href="#" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a><br>
                                </td>
                            </tr>
                            <tr class="tb-tnx-item">
                                <td class="tb-id">3</td>
                                <td>McDonald</td>
                                <td>donald@yopmail.com</td>
                                <td>1234567890</td>
                                <td>
                                    <span class="badge badge-dot badge-danger">Pending Entry</span>
                                </td>
                                <td>{{ date('M d, Y', time()) }}</td>
                                <td class="tb-tnx-action">
                                    <a href="{{ url('employee/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                    <a href="{{ url('entry-form') }}"><em class="icon ni ni-file-check"></em><span>Entry Form</span></a><br>
                                    <a href="#" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a><br>
                                </td>
                            </tr>
                            <tr class="tb-tnx-item">
                                <td class="tb-id">4</td>
                                <td>Thomson</td>
                                <td>thomson@yopmail.com</td>
                                <td>1234567890</td>
                                <td>
                                    <span class="badge badge-dot badge-success">Active</span>
                                </td>
                                <td>{{ date('M d, Y', time()) }}</td>
                                <td class="tb-tnx-action">
                                    <a href="{{ url('employee/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                    <a href="#" class="text-danger"><em class="icon ni ni-minus-circle-fill"></em><span>Exit</span></a><br>
                                    <a href="#" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a><br>
                                </td>
                            </tr>
                            <tr class="tb-tnx-item">
                                <td class="tb-id">5</td>
                                <td>Walker</td>
                                <td>walker@yopmail.com</td>
                                <td>1234567890</td>
                                <td>
                                    <span class="badge badge-dot badge-danger">Pending Exit</span>
                                </td>
                                <td>{{ date('M d, Y', time()) }}</td>
                                <td class="tb-tnx-action">
                                    <a href="{{ url('employee/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                    <a href="{{ url('exit-form') }}"><em class="icon ni ni-file-check"></em><span>Exit Form</span></a><br>
                                    <a href="#" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a><br>
                                </td> -->
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card-inner">
                <div class="nk-block-between-md g-3">
                    <div class="g">
                        <ul class="pagination justify-content-center justify-content-md-start">
                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection