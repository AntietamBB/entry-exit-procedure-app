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
                    <a class="btn btn-primary" href="{{ url('user/create') }}"><em class="icon ni ni-plus"></em><span>Add Admin User</span></a>
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
                                <th scope="col">Abilities</th>
                                <th scope="col">Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <tr class="tb-tnx-item">
                            <td class="tb-id">1</td>
                            <td>Alexandra</td>
                            <td>alexandra@yopmail.com</td>
                            <td>1234567890</td>
                            <td>Category 1, Category 2</td>
                            <td>{{ date('M d, Y', time()) }}</td>
                            <td class="tb-tnx-action">
                                <a href="{{ url('user/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a>
                                <a href="#" class="text-danger" style="margin-left: 7px;"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                            </td>
                            </td>
                        </tr>
                        <tr class="tb-tnx-item">
                            <td class="tb-id">2</td>
                            <td>Austin</td>
                            <td>austin@yopmail.com</td>
                            <td>1234567890</td>
                            <td>Category 1, Category 4</td>
                            <td>{{ date('M d, Y', time()) }}</td>
                            <td class="tb-tnx-action">
                                <a href="{{ url('user/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a>
                                <a href="#" class="text-danger" style="margin-left: 7px;"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                            </td>
                        </tr>
                        <tr class="tb-tnx-item">
                            <td class="tb-id">3</td>
                            <td>Justin</td>
                            <td>justin@yopmail.com</td>
                            <td>1234567890</td>
                            <td>Category 3, Category 5</td>
                            <td>{{ date('M d, Y', time()) }}</td>
                            <td class="tb-tnx-action">
                                <a href="{{ url('user/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span>Edit</span></a>
                                <a href="#" class="text-danger" style="margin-left: 7px;"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                            </td>
                        </tr>
                            
                            
                            
                            @php
                                $i = 1
                            @endphp
                            @forelse ($users as $user)
                                <tr class="tb-tnx-item">
                                    <td class="tb-id">{{ $i++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $user->user_type)) }}</td>
                                    <td>
                                        @if(is_null($user->password))
                                            <span class="badge badge-dot badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-dot badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                    <td class="tb-tnx-action">
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
                                    </td>
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