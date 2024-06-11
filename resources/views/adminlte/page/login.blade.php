@extends(env('ADMIN_TEMPLATE').'._base.login')

@section('title', __('general.login'))

@section('content')
    <!-- /.login-logo -->
    <div class="">

        <div class="d-flex">
            <a href="#" class="h1 mx-auto"><b>{{ env('WEBSITE_NAME') }}</b></a>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">@lang('general.welcome_login')</p>
    
                {{ Form::open(['route' => 'admin.login.post', 'id'=>'form'])  }}
                    <div class="input-group mb-3">
                        {{ Form::text('username', old('username'), ['id'=>'username',
                                    'class'=> $errors->has('username') ? 'form-control is-invalid' : 'form-control',
                                    'placeholder'=>__('general.username'), 'required'=>'required']) }}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        {{ Form::password('password', ['id'=>'password',
                        'class'=> $errors->has('password') ? 'form-control is-invalid' : 'form-control',
                        'placeholder'=>__('general.password'), 'required'=>'required']) }}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock togglePassword"></span>
                            </div>
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="row">
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <p><code>{{ $error }}</code></p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            &nbsp;
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger btn-block w-100">@lang('general.login')</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {{ Form::close() }}
    
            </div>
        </div>
        
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@section('script-bottom')
    @parent
    <script type="text/javascript">
        'use strict';
        $('.togglePassword').on('click', function () {
            if ($(this).parent().parent().parent().find('input')[0].type === 'password') {
                $(this).parent().parent().parent().find('input')[0].type = 'text';
                $(this).removeClass('fa-lock');
                $(this).addClass('fa-lock-open');
            }
            else {
                $(this).parent().parent().parent().find('input')[0].type = 'password';
                $(this).removeClass('fa-lock-open');
                $(this).addClass('fa-lock');
            }
        });
    </script>
@stop
