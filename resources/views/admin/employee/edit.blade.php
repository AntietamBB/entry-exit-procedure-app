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
            <form action="<?= url('employee/' . $employee->id); ?>" method="post">
                @method('PUT')

                @csrf

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="full-name">Full Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="full-name" value="{{ old('name',$employee->name) }}" name="name">
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
                                <input type="text" class="form-control" id="email-address" name="email" value="{{ old('email',$employee->email) }}">
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
                                <input type="text" class="form-control" id="phone-no" name="phone" value="{{ old('phone',$employee->phone) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="startdate">Start Date</label>
                                <div class="form-control-wrap">
                                <input data-provide="datepicker" id="startdate" class="form-control" name="startdate" data-date-format="mm/dd/yyyy" placeholder="Select date"  value="{{old('startdate',date('m/d/Y', strtotime($employee->startdate)))}}">
                                @error('startdate')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="exitdate">Exit Date</label>
                                <div class="form-control-wrap">
                               <input data-provide="datepicker" id="exitdate"  class="form-control" name="exitdate" data-date-format="mm/dd/yyyy" placeholder="Select date" value="{{($employee->exitdate ? date('m/d/Y', strtotime($employee->exitdate)):'')}}">
                             </div>
                               
                            </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="taskdate">Task Completion Date</label>
                                <div class="form-control-wrap">
                                    <input data-provide="datepicker" id="taskdate"  class="form-control" name="taskdate" data-date-format="mm/dd/yyyy" placeholder="Select date" value="{{($employee->task_completion_date ? date('m/d/Y', strtotime($employee->task_completion_date)):'')}}">
                                </div>
                               
                        </div>
                    </div>
                     
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="department">Department</label>
                                <div class="form-control-wrap">
                                <input type="text" class="form-control" id="department" name="department" value="{{ old('department',$employee->department) }}">
                                @error('department')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="position">Position</label>
                                <div class="form-control-wrap">
                                <input type="text" class="form-control" id="position" name="position" value="{{ old('position',$employee->position) }}">
                                @error('position')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    <div id="cat" class="col-lg-12">
                        <div class="form-group" >
                                <label class="form-label" for="phone-no">Exit Form Abilities</label>
                        </div>

                        <div class="row">
                            @foreach($exit_categories as $role)
                               <div class="col-lg-4">
                                  <div class="form-group">
                                  		<label for="{{ $role->name }}">{{ $role->title }}</label>
                                  </div>
                               </div>
                            
                               <div class="col-lg-6">
                                    <div class="form-control-select" style="float:left;margin-right:10px;margin-bottom:10px;">
                                      <select class="form-control" name="selectadmin[{{ $role->id }}][]">
                                            <option value="">---Select---</option>
                                            @foreach($admin as $adm)
                                                @foreach($adm['roles'] as $rle)
													@if($rle['id'] == $role->id)
														<option value="{{ $adm['id'] }}"
															{{ (isset($tasks[$role->id]) && $tasks[$role->id]['admin_id'] == $adm['id']) ? 'selected': '' }}
														>
															{{ $adm['name'] }}
														</option>
														@continue
													@endif
                                            	@endforeach
                                            @endforeach
                                      </select>
                                    </div>
                               </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#startdate').datepicker({
            autoclose: true
        });

        $('#exitdate').datepicker({
            autoclose: true
        });

        $('#taskdate').datepicker({
            autoclose: true
        });

        if($("#taskdate").val() == "" || $("#taskdate").val() == null) {
            $("#cat").hide(); 
        } else {
            $("#cat").show();
        }

        $("#taskdate").change(function(){
            if($(this).val() == "" || $(this).val() == null) {
                $("#cat").hide();
            } else {
                $("#cat").show();
            }
        });
    });
</script>

@endsection
