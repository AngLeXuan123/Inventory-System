@extends('layouts.app')
@section('content')

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-bold my-4">Register</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                            <label for="name" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>

                                            <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <label for="email" class="col-md-4 col-form-label text-md-right"><b>E-Mail Address</b></label>

                                            <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                               </span>
                                            @enderror
                                          
                                            <label for="password" class="col-md-4 col-form-label text-md-right"><b>Password</b></label>

                                            <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
      
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>Confirm Password</b></label>
                                            <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation">

                                        <br>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Register
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{route('login')}}">Have an account? Go to login</a></div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
</body>

</html>
@endsection