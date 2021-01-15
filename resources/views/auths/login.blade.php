<!doctype html>
<html lang="en">

<head>
    <title>Login Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-no-fit=no">
    @include('master.head')
    <style>
        body {
            height: 100vh;
            background-color: #e9ecef;
            display: flex;
            /* flex-direction: column; */
            align-items: center;

            justify-content: center;
        }

        .card {
            overflow: hidden;
            border: 0;
            /* border-radius: 20px !important; */
            box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 32px;
        }

        .mytxtbox {
            border-radius: 5px;
        }

        .mybtn {
            width: 100%;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/postlogin" method="POST">

                            {{ csrf_field() }}
                            <div class="row mb-2">
                                <div class="col-md text-center">
                                    <h3 class="modal-title">Login</h3>
                                </div>
                            </div>

                            <div class="input-group mb-2">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 40px"><i
                                            class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="username" placeholder="Username"
                                    class="form-control  {{$errors->has('username') ? 'is-invalid' : ''}}"
                                    value="{{old('username')}}">

                                @if($errors->has('username'))
                                <span class="invalid-feedback">{{$errors->first('username')}}</span>
                                @endif

                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 40px"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password" placeholder="Password"
                                    class="form-control mytxtbox {{$errors->has('password') ? 'is-invalid' : ''}}"
                                    value="{{old('password')}}">

                                @if($errors->has('password'))
                                <span class="invalid-feedback">{{$errors->first('password')}}</span>
                                @endif

                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary mybtn">Login</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('master.s')
</body>

</html>
{{-- <!doctype html>
<html lang="en">

<head>
    @include('master.head')

</head>

<body style="background-color: #e9ecef">

    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/postlogin" method="POST">
                            <div class="row mb-2">
                                <div class="col-md text-center">
                                    <h3 class="modal-title">KUE BOLU RM</h3>
                                </div>
                            </div>

                            {{ csrf_field() }}

<div class="form-group row ">
    <div class="col">
        <input type="text" name="username" placeholder="Username"
            class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{old('username')}}">

        @if($errors->has('username'))
        <span class="invalid-feedback">{{$errors->first('username')}}</span>
        @endif
    </div>
</div>
<div class="form-group row ">
    <div class="col">
        <input type="password" name="password" placeholder="Password"
            class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" value="{{old('password')}}">

        @if($errors->has('password'))
        <span class="invalid-feedback">{{$errors->first('password')}}</span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col text-center">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</div>


</form>
</div>
</div>
</div>
<div class="col-3"></div>
</div>
</div>
@include('master.s')

</body>

</html> --}}
