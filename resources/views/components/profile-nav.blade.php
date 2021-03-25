<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
	<div class="card-inner-group" data-simplebar>
		<div class="card-inner">
			<div class="user-card">
				<div class="user-avatar bg-primary">
					<em class="icon ni ni-user-alt"></em>
				</div>
				<div class="user-info">
					<span class="lead-text">{{ Auth::user()->name }}</span>
					<span class="sub-text">{{ Auth::user()->email }}</span>
				</div>
				<div class="user-action">
					<div class="dropdown">
						<a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="link-list-opt no-bdr">
								{{-- <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li> --}}
								<li><a href="{{ url('update-profile') }}"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-inner p-0">
			<ul class="link-list-menu">
				<li>
					<a class="{{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a>
				</li>
				<li>
					<a class="{{ Request::is('update-profile') ? 'active' : '' }}" href="{{ url('update-profile') }}"><em class="icon ni ni-account-setting-fill"></em><span>Update Profile</span></a>
				</li>
				<li>
					<a class="{{ Request::is('change-password') ? 'active' : '' }}" href="{{ url('change-password') }}"><em class="icon ni ni-shield-star-fill"></em><span>Change Password</span></a>
				</li>
			</ul>
		</div>
	</div>
</div>