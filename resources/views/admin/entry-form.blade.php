@extends('layouts.admin')

@section('content')
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Employee Entry Form</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
        </div>
    </div>
    
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="<?= url('entry-form-save/'.$user->id) ?>" method="post">
                	@csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="startdate">Start Date</label>
                                <div class="form-control-wrap">
                                <input data-provide="datepicker" data-date-format="mm/dd/yyyy" class="form-control" id="startdate" name="startdate" value="{{date('m/d/Y', strtotime($user->startdate))}}">
                                    @error('startdate')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Department</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="department" name="department" value="{{$user->department}}">
                                    @error('department')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Manager</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="Manager">
                                    @error('email')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Position</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="position" name="position" value="{{$user->position}}">
                                    @error('position')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Form Date</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="formdate" name="formdate" value="{{date('M d, Y')}}">
                                    @error('formdate')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                        <hr>
                        </div>
                        <div class="col-lg-12">
                            @forelse($categories as $category)
                                <label class="form-label" for="category">{{ $category->title}}</label>
                                @forelse($category->abilities as $ability)
                                <div class="form-group">
                                    <div class="g">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="{{ $ability->name }}" name="abilities[]" value="{{ $ability->id }}" {{ !in_array($category->name,$user_categories) ? 'disabled' : '' }} 
                                            {{ in_array($ability->id,$user_abilities) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="{{ $ability->name }}">{{ $ability->title }}</label>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p> No Items Found</p>
                                @endforelse
                            @empty
                                <p> No Categories Found</p>
                            @endforelse
                        </div>
                        

                        <div class="col-lg-12">
                        <hr>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="email-address">Email Address</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="email-address" name="email" value="{{ $user->email }}">
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
                                    <input type="text" class="form-control" id="phone" name="phone" value="+1{{ $user->phone }}">
                                    @error('phone')
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#startdate').datepicker({
        
        autoclose: true
    });
});
</script>