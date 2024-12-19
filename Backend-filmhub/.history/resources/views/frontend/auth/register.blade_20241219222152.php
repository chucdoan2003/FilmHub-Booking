@extends('frontend.layouts.master2')
@section('content')
    <style>
        .btn-register {
            background-color: #36e40a;
            color: white;
            padding: 8px 20px;
            margin: 16px 0 0 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .btn-register:hover {
            background-color: #6ed140;
        }

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

        .form-register {
            padding: 0 15px
        }
    </style>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        @method('POST')

        <div class="container mt-5 d-flex justify-content-center" style="max-width: 500px">
            <div class="row form-register ">



                @if (isset($user))
                    <div>
                        <h2 style="font-size: 20px">Register successfully, please
                            <a href="{{ route('getLogin') }}" style="color: #fff">
                                <button type="button" class="btn-login">
                                    Login
                                </button>
                            </a>
                        </h2>
                    </div>
                @else
                    <div class="st_pop_form_heading_wrapper float_left">
                        <h3>Đăng ký</h3>
                    </div>
                    <div class="st_profile_input float_left">
                        <label>Email</label>
                        <input type="text" name="email">
                        @if ($errors->has('email'))
                            <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                        @endif
                        @if (isset($email_exits))
                            <p style="color: red">Email đã tồn tại, vui lòng nhập email khác</p>
                        @endif


                    </div>
                    <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                        <input type="password" placeholder="Password" name="password">
                        @if ($errors->has('password'))
                            <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                        <input type="password" placeholder="Password confirmation" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <div class="text-danger mt-1">{{ $errors->first('password_confirmation') }}</div>
                        @endif

                        @if (isset($email) && $email != "")
                            <p style="margin-top: 5px; ">Chúng tôi đã gửi xác nhận đăng ký tài khoản về email {{$email}}</p>
                        @endif
                    </div>

                    <div class="st_form_pop_login_btn float_left">
                        <button type="submit" class="btn-login">Đăng ký </button>
                    </div>
                    <div class="st_form_pop_or_btn float_left">
                        <h4>or</h4>
                    </div>
                    <div class="st_form_pop_signin_btn float_left">
                        <h4>Bạn đã có tài khoản? <a href="{{ route('getLogin') }}">Đăng nhập </a></h4>
                        <h5>Tôi đồng ý với <a href="#">Điều khoản & Điều kiện</a> & <a href="#">Chính sách bảo mật</a></h5>
                    </div>


                @endif



            </div>
        </div>
    </form>
@endsection
