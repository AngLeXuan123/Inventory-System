@extends('layouts.app')
@section('content')
<html>
<title>Edit User</title>
<body class="bg-primary">
    <main>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-bold my-4">Edit User</h3>
                                    </div>
                                    <div class="card-body">
                                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update',
                                        $user->id]]) !!}
                                        @if(Session::has('flash_message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('flash_message')}}
                                        </div>
                                        @endif

                                        @if($errors->any())
                                        <div>
                                            @foreach($errors->all() as $error)
                                            <p>{{$error}}</p>
                                            @endforeach
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Name:</strong>
                                                    {!! Form::text('name', null, array('placeholder' => 'Name','class'
                                                    => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Email:</strong>
                                                    {!! Form::text('email', null, array('placeholder' => 'Email','class'
                                                    => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Password:</strong>
                                                    {!! Form::password('password', array('placeholder' =>
                                                    'Password','class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Confirm Password:</strong>
                                                    {!! Form::password('confirm-password', array('placeholder' =>
                                                    'Confirm Password','class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Role:</strong>
                                                    {!! Form::select('roles[]', $roles,$userRole, array('class' =>
                                                    'form-control','multiple')) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
</body>

</html>
@endsection