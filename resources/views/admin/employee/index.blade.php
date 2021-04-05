@extends('layouts.admin')
@section('content')
<style>
    .dropdown-menu-xs {
        min-width: 130px;
    }

    .tb-tnx-action {
        text-align: center;
        min-width: 110px;
        line-height: 24px;
       
    }
</style>
@if($message=Session::get('success'))
                <div class="alert alert-success">
                <p style="text-align:center;">{{$message}}</p>
                </div>
                @endif
                @if($message=Session::get('error'))
                <div class="alert alert-danger">
                <p style="text-align:center;">{{$message}}</p>
                </div>
               @endif
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
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($users as $user)
                        <tr class="tb-tnx-item">
                            <td class="tb-id">{{$no++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>
                                @if($user->status=="1")

                                <span class="badge badge-dot badge-success">Active</span>


                                @else


                                <span class="badge badge-dot badge-danger">Inactive</span>
                                @endif
                            </td>

                            <td>{{ date('M d, Y', time()) }}</td>
                            <td class="tb-tnx-action">
                                <a href="{{ url('employee/'.$user->id.'/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                
                                <a href="#" class="text-danger"><em class="icon ni ni-minus-circle-fill"></em><span>Exit</span></a><br>
                                <a href="{{url('entry-form/'.$user->id)}}" ><em class="icon ni ni-minus-circle-fill"></em><span>Entry Form</span></a><br>
                                <a href="{{url('exit-form/'.$user->id)}}" ><em class="icon ni ni-minus-circle-fill"></em><span>Exit Form</span></a><br>
                                <form method="post" action="<?= url('employee/' . $user->id) ?>" id="employee_{{ $user->id }}">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <a onClick="deleteUser({{ $user->id }})" href="javascript:void(0)" rel="nofollow" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                                </form>


                            </td>
                        </tr>


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
<script>
    function deleteUser(id) {
        console.log(id);
        if (confirm('Are you sure you want to delete this employee ?')) {
            $('#employee_' + id).submit();
        }
    }
</script>