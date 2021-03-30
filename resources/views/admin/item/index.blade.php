@extends('layouts.admin')
@section('content')
<style>
.tb-tnx-action {
    text-align:center;
    min-width: 150px;
}
</style>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Items for {{ $category->title }}</h3>
                <div class="nk-block-des text-soft">
                    <!--<p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit.</p>-->
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a class="btn btn-primary" href="{{ url('category/'.$category->id.'/item/create') }}"><em class="icon ni ni-plus"></em><span>Add Item</span></a>
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
                                <th scope="col">Item Name</th>
                                <th scope="col">Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
							@php
                                $i = 1
                            @endphp
							@forelse ($items as $item)
								<tr class="tb-tnx-item">
									<td class="tb-id">{{ $i++ }}</td>
									<td>{{ $item->title }}</td>
									<td>@if($item->created_at) {{ date('M d, Y', strtotime($item->created_at)) }} @endif</td>
									<td class="tb-tnx-action">
										<a href="{{ url('category/1/item/1/edit') }}"><em class="icon ni ni-edit-alt"></em><span> Edit</span></a>
										<a href="#" class="text-danger" style="margin-left: 7px;"><em class="icon ni ni-trash"></em><span> Remove</span></a>
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