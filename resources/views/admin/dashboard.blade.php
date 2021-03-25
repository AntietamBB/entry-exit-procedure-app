@extends('layouts.admin')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to Antietam Broadband Dashboard.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-4 offset-1">
                <div class="row g-4">
                    <div class="col-sm-10 col-xxl-12">
                        <div class="nk-order-ovwg-data sell">
                            <div class="title"> Total Admin Users</div>
                            <div class="amount">250 </div>
                        </div>
                    </div>
                    
                </div>
            </div><!-- .col -->
			
            <!-- <div class="col-md-4">
                <img src="/images/logo.jpg" />
            </div> -->
            <!-- .col -->
			
            <div class="col-md-4 offset-1">
                <div class="row g-4">
                    <div class="col-sm-10 col-xxl-12">
                        <div class="nk-order-ovwg-data buy">
                            <div class="title"> Total Employees</div>
                            <div class="amount">999 </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection