@extends('layouts.admin')

@section('content')
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Edit Employee</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="<?= url('employee/update/') ?>" method="post">
                @method('PATCH')
                <input type="hidden" name="id" value="<?php echo $employee[0]->id;?>">
                	@csrf
                
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Full Name</label>
                                <div class="form-control-wrap">
                                    <input type="text"  class="form-control" id="full-name" value="<?php echo $employee[0]->name;?>" name="name" >
                                    @error('name')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="<?php echo $employee[0]->email;?>">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="phone-no">Phone No</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="phone-no" name="phone" value="<?php echo $employee[0]->phone;?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <a href="{{ url('employee') }}"><button type="button" class="btn btn-lg btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection