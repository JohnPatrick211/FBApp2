<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>FB Building Login</title>
		
		
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		
		<link rel="stylesheet" href="{{asset('css/global.css?')}}">
    <link rel="stylesheet"href="{{asset('css/login.css')}}">

    </head>
    <body class="bg-dark">
	
	<div class="main" style="background-image: url('{{asset('img/login-bg.jpg')}}');">
    <div class="body box">
            <div class="content1">
                <div class="logo flexCol">
                    <img src="{{asset('img/logo_low.png')}}" alt="logos" >
                </div>

                <form class="text-center" action="check" method="post" style="width: 100%;">
                @csrf
                <div class="input-con">
                    <div class="col">
                        <label class="pure-material-textfield-standard widthCon">
                            <input name="username" type="text" placeholder=" " autofocus>
                            <span class="span">Username</span>
                        </label>
                    </div>
                    <br/>
                    <span class="text-danger">@error('username') {{$message}} @enderror</span>
                    <div class="col" style="margin-top:8px;">
                        <label class="pure-material-textfield-standard widthCon">
                            <input name="password" type="password" class="form-control" placeholder=" " autofocus>
                            <span class="span">Password</span>
                        </label>
                    </div>
                    <br/>
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    <span class="text-danger">@error('fail') {{$message}} @enderror</span>
                    @if(Session::get('fail'))
                    {{Session::get('fail')}}
                    @endif
                    @if(Session::get('success'))
                    {{Session::get('success')}}
                    @endif
                    <br/></br/>
                    <div class="d-flex align-items-center justify-content-center pb-5">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger">Create new</button>
                  </div>
                </div>
                <button id="adminLoginBtn" name="admin-login" type="submit" class="btn_primary_login">Login</button>
            </form>


              
                <!--<a class="ForgotPassword" href="forget_password.html" target="_blank">Forgot Password?</a>-->
            </div>
            <div class="content2" >
                <div class="img-flat" style="background-image: url('{{asset('img/flat-illustration.png')}}');">
                </div>
            </div>
        </div>
    </div>
		<!-- jQuery -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('js/script.js')}}"></script>
		<script src="{{asset('js/index.js')}}"></script>
		
    </body>
</html>