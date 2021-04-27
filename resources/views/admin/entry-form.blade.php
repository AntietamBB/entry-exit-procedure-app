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
            <form action="<?= url('entry-form-save/' . $employee->id) ?>" method="post">
                @csrf

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name :</label>
                            <span id="name">{{ $employee->name }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="startdate">Start Date :</label>
                            <span id="startdate">                 
                            {{date('m/d/Y', strtotime($employee->startdate))}}
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="depart">Department :</label>
                           <span id="depart">{{$employee->department}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="post">Position :</label>
                           <span id="post">{{$employee->position}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="email-address">Form Date :</label>
                            <span id="post">{{date('M d, Y')}}</span>
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
                                    @php
                                    $key = array_search($ability->id, array_column($employee_abilities, 'ability_id'));
                                    @endphp
                                    <input type="checkbox" class="custom-control-input" id="{{ $ability->name }}" name="abilities[]" value="{{ $ability->id }}" {{ (($user->user_type != 'super_admin') and (!in_array($category->name,$user_categories))) ? 'disabled' : '' }} {{ $key !== false ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $ability->name }}">{{ $ability->title }}</label>
                                </div>
                                @if($key !== false )
                                <div style="font-size:11px;margin-left:30px">
                                    <i>
                                        {{ $employee_abilities[$key]['user']['name'] }} - {{ date('M d, Y',strtotime($ability->created_at))}}
                                        <a href="" class="ask_question" id="" data-ability-title="{{ $employee->name }} - {{ $ability->title }}"  data-ability-user-email="{{ $employee_abilities[$key]['user']['email'] }}"  data-toggle="modal" data-target="#emailForm">Ask a Question</a>
                                    </i>
                                </div>
                                @endif
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
                            <label class="form-label" for="email-address">Email Address :</label>
                            <span id="email-address">{{ $employee->email }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone :</label>
                            <span id="phone">+1{{ $employee->phone }}</span>
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

<div class="modal  fade" id="emailForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Ask a Question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <div style="text-align: center;" class="alert alert-success" id="success">
                        Mail has been sent successfully
                    </div>
                    <div style="text-align: center;" class="alert alert-danger" id="danger">
                        Mail has not been sent
                    </div>

                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="{{$employee->id}}">
                    <label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
                    <input type="email" name="email" value="" id="email" class="form-control">
                </div>
          
                <div class="md-form mb-4">
                	<i class="fas fa-lock prefix grey-text"></i> 
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Additional Emails</label>
                    <div class="form-group">
						<select  class="multiselect-ui form-control" multiple="multiple" name="to[]" id="to">
							@foreach ($adminlist as $admin)
								<option value="{{$admin->email}}" title="{{$admin->email}}">{{$admin->name}}</option>
							@endforeach
						</select>
                    </div>
                </div>
                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control ">
                </div>
               
                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Message</label>
                    <textarea name="message" id="message" class="form-control "></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" id="send" class="btn btn-success">Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('select').selectpicker();
        
        $('#startdate').datepicker({
            autoclose: true
        });

        $('.ask_question').click(function() {
            $("#success").hide();
            $('#danger').hide();
 
            $("#subject").val($(this).data('ability-title'));
            $("#email").val($(this).data('ability-user-email'));
        });

        $('#send').click(function(e) {
            var id = $('#id').val();
            var email = $("#email").val();
            var to=$('#to').val();
            var subject = $("#subject").val();
            var message = $("#message").val();
            
            $.ajax({
                type: 'POST',
                url: '/entry-form-email/' + id,
                data: {
                    id: id,
                    email: email,
                    to:to,
                    subject: subject,
                    message: message,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data == 'success') {
                        $("#danger").hide();
						$("#success").show();
                    } else {
                        $("#success").hide();
						$("#danger").show();
                    }
                },
                error: function() {
                    alert("There was an error. Try again please!");
                }
            });

            return false;
        });
    });
</script>
@endsection