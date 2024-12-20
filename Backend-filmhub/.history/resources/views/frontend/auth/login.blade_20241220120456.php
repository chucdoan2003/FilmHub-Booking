@extends('frontend.layouts.master4')
@section('content')
    <style>
        .btn-login {
            background-color: #e21b10;
            color: white;
            padding: 8px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #d14740;
        }

        .st_pop_form_heading_wrapper {
            margin-top: 32px;
        }

        .form-login {
            padding: 0 15px
        }
    </style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        @method('POST')
        {{-- <div class="st_pop_form_wrapper">
            <div class="modal-dialog">
                <div class="modal-content"> --}}

        <div class="container mt-5 d-flex justify-content-center" style="max-width: 500px">
            <div class="row form-login">
                @if (isset($isLogin) && $isLogin == true)
                    <div>
                        <h2 style="font-size: 20px">Login successfully <button type="button" class="btn-login"><a
                                    href="{{ route('getLogin') }}" style="color: #fff">Home</a></button> </h2>
                    </div>
                @else

                        <div class="st_pop_form_heading_wrapper float_left">
                            <h3>Đăng nhập </h3>
                        </div>
                        <div class="st_profile_input float_left">
                            <label>Email</label>
                            <input type="text" name="email">
                            @if ($errors->has('email'))
                                <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                            <input type="password" placeholder="Password" name="password">
                            @if ($errors->has('password'))
                                <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                            @endif

                            <div id="showmatkhau" style="margin-left: 170px; font-size: 14px; margin-top: 5px; cursor: pointer">Hiển thị mật khẩu</div>
                            @if (isset($isLogin) && $isLogin == false)
                                <p style="color: red; margin-top: 5px">Tài khoản hoặc mật khẩu không chính xác</p>
                            @endif
                        </div>
                        <div class="st_form_pop_fp float_left">
                            <h3><a href="{{ route('getForgotPassword') }}">Quên mật khẩu?</a></h3>
                        </div>
                        <div class="">
                            <button type="submit" class="btn-login">Đăng nhập </button>
                        </div>

                        <div class="st_form_pop_signin_btn float_left">
                            <h4>Chưa có tài khoản? <a href="{{ route('getRegister') }}">Đăng ký </a></h4>
                            <h5>Tôi đồng ý với <a href="#">Điều khoản & Điều kiện</a> & <a href="#">Chính sách bảo mật</a></h5>
                        </div>

                @endif
            </div>
        </div>

        {{-- <div class="modal fade st_pop_form_wrapper" id="myModa2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="st_pop_form_heading_wrapper st_pop_form_heading_wrapper_fpass float_left">
                    <h3>Forgot Password</h3>
                    <p>We can help! All you need to do is enter your email ID and follow the instructions!</p>
                </div>
                <div class="st_profile_input float_left">
                    <label>Email Address</label>
                    <input type="text">
                </div>
                <div class="st_form_pop_fpass_btn float_left">	<a href="#">Verify</a>
                </div>
            </div>
        </div>
    </div> --}}
        {{-- <div class="modal fade st_pop_form_wrapper" id="myModa3" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="st_pop_form_heading_wrapper float_left">
                    <h3>Sign Up</h3>
                </div>
                <div class="st_profile_input float_left">
                    <label>Email / Mobile Number</label>
                    <input type="text">
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password">
                </div>
                <div class="st_form_pop_fp float_left">
                    <h3><a href="#" data-toggle="modal" data-target="#myModa2" target="_blank">Forgot Password?</a></h3>
                </div>
                <div class="st_form_pop_login_btn float_left">	<a href="https://webstrot.com/html/moviepro/html/page-1-7_profile_settings.html">LOGIN</a>
                </div>
                <div class="st_form_pop_or_btn float_left">
                    <h4>or</h4>
                </div>
                <div class="st_form_pop_facebook_btn float_left">	<a href="#"><i class="fab fa-facebook-f"></i> Connect with Facebook</a>
                </div>
                <div class="st_form_pop_gmail_btn float_left">	<a href="#"><i class="fab fa-google-plus-g"></i> Connect with Google</a>
                </div>
                <div class="st_form_pop_signin_btn st_form_pop_signin_btn_signup float_left">
                    <h5>I agree to the <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></h5>
                </div>
            </div>
        </div>
    </div> --}}

        {{-- <div class="container mt-5 d-flex justify-content-center" style="max-width: 500px">
            <div class="row ">
                <div class="st_pop_form_heading_wrapper mt-5 float_left">
                    <h3>Log in</h3>
                </div>
                <div class="st_profile_input float_left">
                    <label>Email / Mobile Number</label>
                    <input type="text" name="email">
                    @if ($errors->has('email'))
                        <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password" name="password">
                    @if ($errors->has('password'))
                        <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="st_form_pop_fp float_left">
                    <h3><a href="{{ route('getForgotPassword') }}">Forgot Password?</a></h3>
                </div>
                <div class="">
                    <button type="submit" class="btn-login">Login</button>
                </div>

                <div class="st_form_pop_signin_btn float_left">
                    <h4>Don’t have an account? <a href="{{ route('getRegister') }}">Sign Up</a></h4>
                    <h5>I agree to the <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a>
                    </h5>
                </div>
            </div>
        </div> --}}

    </form>


    <script>
        const showmatkhau = document.getElementById('showmatkhau');
        const password = document.getElementById('password');
        showmatkhau.addEventListener('click', function() {
            let isPassword = password.type === 'password';
            password.type = isPassword ? 'text' : 'password';
            showmatkhau.textContent = isPassword ? 'Ẩn mật khẩu' : 'Hiển thị mật khẩu' ;
        });

    </script>
@endsection
