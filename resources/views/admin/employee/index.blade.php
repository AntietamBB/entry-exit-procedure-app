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

                <input type="text" class="form-control" id="keyword" name="keyword" style="float:right;margin-right:10px;width:200px;" onkeyup="filterdata();" placeholder="Search Name/Email">
                
                <div class="form-control-select" style="float:right;margin-right:10px;">
                    <select class="form-control" id="selector" onchange="filterdata(this.value)" style="float:left;">
                        <option value="all">All</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
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
            <div id="employee_list" class="card card-bordered card-preview">
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
                                @if($user->exitdate==NULL)
                                    <span class="badge badge-dot badge-success">Active</span>
                                @else
                                    <span class="badge badge-dot badge-danger">Inactive</span>
                                @endif
                            </td>

                            <td>{{ date('M d, Y', time()) }}</td>
                            <td class="tb-tnx-action">
                                <a href="{{ url('employee/'.$user->id.'/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a><br>
                                
                            
                                @if($user->exitdate==NULL)
                                <a href="{{url('entry-form/'.$user->id)}}" ><em class="icon ni ni-minus-circle-fill"></em><span>Entry Form</span></a><br>
                                @else
                                <a href="{{url('exit-form/'.$user->id)}}" ><em class="icon ni ni-minus-circle-fill"></em><span>Exit Form</span></a><br>
                                @endif
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
    </div>
</div>
@endsection

<script>
    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this employee ?')) {
            $('#employee_' + id).submit();
        }
    } 

    function filterdata(status) {
        var status = $('#selector').val();
        var keyword = $('#keyword').val();
        
        $.ajax({
            type: 'POST',
            url: "employee/filter-data",
            data: {
                status: status,
                keyword: keyword,
                "_token": "{{ csrf_token() }}"
            },
            success: function(result){
                $("#employee_list").html(result);
            }
        });
    }
</script>