@extends('layouts.admin')
@section('content')
<style>
.tb-tnx-action {
    text-align:center;
    min-width: 250px;
}
</style>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Categories</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a class="btn btn-primary" href="{{ url('category/create') }}"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
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
                                <th scope="col">Category Name</th>
                                <th scope="col">Category Form</th>
                                <th scope="col">Created On</th>
                                <th style="text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
							@php
                                $i = 1
                            @endphp
                            @forelse ($categories as $category)
								<tr class="tb-tnx-item">
									<td class="tb-id">{{ $i++ }}</td>
									<td>{{ $category->title }}</td>
									<td>{{ ($category->form_type == 1) ? 'Entry Form' : 'Exit Form' }}</td>
									<td>@if($category->created_at) {{ date('M d, Y', strtotime($category->created_at)) }} @endif</td>
									<td class="tb-tnx-action">
										<a href="{{ url('category/'.$category->id.'/edit') }}"><em class="icon ni ni-edit-alt"></em><span> Edit</span></a>
										<a href="{{ url('category/'.$category->id.'/item') }}" style="margin-left: 10px;"><em class="icon ni ni-edit-alt"></em><span> View Items</span></a>
										<form method="post" action="<?= url('category/'.$category->id) ?>" id="category_{{ $category->id }}" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <a onClick="deleteCategory({{ $category->id }})" href="javascript:void(0)" rel="nofollow" class="text-danger" style="margin-left: 7px;"><em class="icon ni ni-trash"></em><span>Remove</span></a>
                                        </form>
									</td>
									</td>
								</tr>
								
							@empty
								<tr>
									<td colspan="4" class="text-center tb-empty">Nothing Found!</td>
								</tr>
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
<script>
    function deleteCategory(id){
        if(confirm('Are you sure you want to delte this item ?')){
            $('#category_'+id).submit();
        }
    }
</script>