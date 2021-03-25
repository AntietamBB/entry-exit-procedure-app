@extends('layouts.admin')

@section('content')
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Admin User</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="<?= url('user') ?>" method="post">
                	@csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Full Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name" name="name" value="{{ old('name') }}">
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
                                    <input type="text" class="form-control" id="email-address" name="email" value="{{ old('email') }}">
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
                                    <input type="text" class="form-control" id="phone-no" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="phone-no">Password</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="password-no" name="password" value="{{ old('password') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12" style="padding-bottom: 0px !important;">
                            <label class="form-label" for="phone-no" style="margin-bottom:0px;">Abilities</label>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck10">
                                        <label class="custom-control-label" for="customCheck10">Category 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">Category 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck12">
                                        <label class="custom-control-label" for="customCheck12">Category 3</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck13">
                                        <label class="custom-control-label" for="customCheck13">Category 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck14">
                                        <label class="custom-control-label" for="customCheck14">Category 5</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck15">
                                        <label class="custom-control-label" for="customCheck15">Category 6</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck16">
                                        <label class="custom-control-label" for="customCheck16">Category 7</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck17">
                                        <label class="custom-control-label" for="customCheck17">Category 8</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck18">
                                        <label class="custom-control-label" for="customCheck18">Category 9</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3"> 
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck19">
                                        <label class="custom-control-label" for="customCheck19">Category 10</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck20">
                                        <label class="custom-control-label" for="customCheck20">Category 11</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection