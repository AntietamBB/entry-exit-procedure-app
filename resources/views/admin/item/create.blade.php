@extends('layouts.admin')

@section('content')
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Item for Category 1</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="<?= url('category') ?>" method="post">
                	@csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label" for="full-name">Item Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="full-name" name="name" value="{{ old('name') }}">
                                    @error('name')
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