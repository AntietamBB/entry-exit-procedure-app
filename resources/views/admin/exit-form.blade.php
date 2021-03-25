@extends('layouts.admin')

@section('content')
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Employee Exit Form</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="<?= url('employee') ?>" method="post">
                	@csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Rutherford">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Start Date</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Mar 15, 2021">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Department</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Department">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Manager</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Manager">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Position</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Position">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Form Date</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Mar 10, 2021">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                        <hr>
                        </div>
                        
                        <div class="col-lg-12">
                            <label class="form-label" for="phone-no">Category 1</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck7" disabled="">
                                        <label class="custom-control-label" for="customCheck7">Notify HR</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck8" disabled="">
                                        <label class="custom-control-label" for="customCheck8">Circulate Exit Procedure Checklist</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 2</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck9">
                                        <label class="custom-control-label" for="customCheck9">Verify Windows login\Email account deleted</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck10">
                                        <label class="custom-control-label" for="customCheck10">Collect laptop (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11" disabled="">
                                        <label class="custom-control-label" for="customCheck11">Collect cellphone and remove from cell phonebook (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck12" disabled="">
                                        <label class="custom-control-label" for="customCheck12">Delete LastPass account</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck13">
                                        <label class="custom-control-label" for="customCheck13">Delete user from Jive phone system</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck14">
                                        <label class="custom-control-label" for="customCheck14">Provide update for phone list to Cindy Albin</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck15" disabled="">
                                        <label class="custom-control-label" for="customCheck15">Delete employee from printer address book</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck16" disabled="">
                                        <label class="custom-control-label" for="customCheck16">Update Herald Mail password in LastPass (CSSR)</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 3</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck17">
                                        <label class="custom-control-label" for="customCheck17">Change Door Alarm (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck18">
                                        <label class="custom-control-label" for="customCheck18">Collet or disable Door Card</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 4</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck19" disabled="">
                                        <label class="custom-control-label" for="customCheck19">Provide cell phone form for return of cell phone (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 5</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck20" disabled="">
                                        <label class="custom-control-label" for="customCheck20">Collect PCard</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck21">
                                        <label class="custom-control-label" for="customCheck21">Remove Works account</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 6</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck22">
                                        <label class="custom-control-label" for="customCheck22">Delete Footprints Account</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck23" disabled="">
                                        <label class="custom-control-label" for="customCheck23">Delete CentraVizion Account</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck24" disabled="">
                                        <label class="custom-control-label" for="customCheck24">Delete RPX Account</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 7</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck25">
                                        <label class="custom-control-label" for="customCheck25">Delete user from CXone (Call Center and Dispatch only)</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 8</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck26">
                                        <label class="custom-control-label" for="customCheck26">Delete ICOMS account</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck27" disabled="">
                                        <label class="custom-control-label" for="customCheck27">Delete PeakView account</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck28" disabled="">
                                        <label class="custom-control-label" for="customCheck28">Remove Data Realty access</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck29">
                                        <label class="custom-control-label" for="customCheck29">Schedule termination of free service/convert</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 9</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck30">
                                        <label class="custom-control-label" for="customCheck30">Delete OpenVault account (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck31" disabled="">
                                        <label class="custom-control-label" for="customCheck31">Delete Calix account (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck32" disabled="">
                                        <label class="custom-control-label" for="customCheck32">Delete BBX account (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 10</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck33">
                                        <label class="custom-control-label" for="customCheck33">Change CPE/Wiki/Staff password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck34">
                                        <label class="custom-control-label" for="customCheck34">Change password for the internet support email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck35" disabled="">
                                        <label class="custom-control-label" for="customCheck35">Update shared passwords in LastPass</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck36" disabled="">
                                        <label class="custom-control-label" for="customCheck36">Delete MIB tool account</label>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label" for="phone-no">Category 11</label>
                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck37">
                                        <label class="custom-control-label" for="customCheck37">Delete VPN Account (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="g">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck38">
                                        <label class="custom-control-label" for="customCheck38">Scan document and store on OneDrive</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                        <hr>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="rutherford@yopmail.com">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Phone Ext</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="+1">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
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