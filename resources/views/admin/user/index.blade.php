@extends('layouts.admin')
@section('content')
<style>
.tb-tnx-action {
    text-align:center;
    min-width: 100px;
}
</style>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Admin Users</h3>

                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>

            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                @if(Auth::user()->user_type == "super_admin")
                    <a class="btn btn-primary" href="{{ url('user/create') }}"><em class="icon ni ni-plus"></em><span>Add Admin User</span></a>
                @endif
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
                                <th scope="col">Entry Form Abilities</th>
                                <th scope="col">Exit Form Abilities</th>
                                <th scope="col">Created On</th>
                                @if(Auth::user()->user_type == "super_admin")
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            
                            @php
                                $i = 1
                            @endphp
                            @forelse ($users as $user)
                                <tr class="tb-tnx-item">
                                    <td class="tb-id">{{ $i++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    @php
                                            $entry_roles = '';
                                            $exit_roles = '';
                                        @endphp
                                        @if ($user->roles != null)
                                            @foreach($user->roles as $role)
                                                @if ($role->form_type == 1)
                                                    @php
                                                        $entry_roles.= $role->title.', '
                                                    @endphp
                                                @else
                                                    @php
                                                        $exit_roles.= $role->title.', '
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        
                                    <td>{{ rtrim($entry_roles,', ') }}</td>
                                    <td>{{ rtrim($exit_roles,', ') }}</td>
                                    <!-- <td>
                                        @if(is_null($user->password))
                                            <span class="badge badge-dot badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-dot badge-success">Active</span>
                                        @endif
                                    </td> -->
                                    <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                                    <!-- <td class="tb-tnx-action">
                                        @if(Auth::user()->user_type == 'super_admin' || $user->created_by == Auth::user()->id || $user->id == Auth::user()->id)
											<div class="dropdown">
												<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
													<ul class="link-list-opt no-bdr">
														<li>
															<a href="{{ url('edit-user' .  '/' . $user->id) }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a>
														</li>
													
														<li>
															<a href="{{ url('delete-user' .  '/' . $user->id) }}" class="text-danger"><em class="icon ni ni-trash"></em><span>Remove</span></a>
														</li>
													</ul>
												</div>
											</div>
										@endif
                                    </td> -->
                                    @if(Auth::user()->user_type == "super_admin")
                                    <td>
                                        <a style="position:relative;top:7px;" href="{{ url('user/'.$user->id.'/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a>
                                        
                                        <form method="post" action="<?= url('user/'.$user->id) ?>" id="user_{{ $user->id }}" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <a style="position:relative;top:7px;"onClick="deleteUser({{ $user->id }})" href="javascript:void(0)" rel="nofollow" class="text-danger" style="margin-left: 7px;"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                                        </form>
                                        <a href="#myModal" data-toggle="modal"  data-id="{{$user->id}}" class="open-Dialog text-info" style="position:relative;top:7px;">Reset Password</a>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                            <!-- <tr>
                                <td colspan="8" class="text-center tb-empty">Nothing Found!</td>
                            </tr> -->
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
			
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header ">
							<h4 class="modal-title w-100 text-center">Reset Password</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							<form method="post" id="resetform" onsubmit="return validateForm()">
								@method("PUT")
								@csrf
								<input type="hidden" class="form-control" id="uid" name="uid" value="" />
								<div class="form-group">
								   <label for="update">New Password</label>
									<input type="text" class="form-control" id="newpw" name="newpw" placeholder="Enter new password">
									<span id="error"></span>
								</div>
		
								<div class="modal-footer border-top-0 d-flex justify-content-center">
									<button type="submit" id="submit" class="btn btn-success">Reset</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>

<script>
    function deleteUser(id){
        console.log(id);
        if(confirm('Are you sure you want to delte this user ?')){
            $('#user_'+id).submit();
        }
    }
    
	$(".open-Dialog").click(function() {
		var myId = $(this).data('id');
		$(".modal-body #uid").val(myId);
	});

	function validateForm() {
		var x = $("#newpw").val();
		if(x == "") {
			error.textContent = "Password is required" 
			error.style.color = "red"
			return false;
		}
	}
</script>
@endsection
