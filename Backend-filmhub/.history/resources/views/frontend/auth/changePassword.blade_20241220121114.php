@extends('frontend.layouts.master4')
@section('content')
<style>
    .btn-register{
        background-color: #36e40a;
        color: white;
        padding: 8px 20px;
        margin: 16px 0 0 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .btn-register:hover{
        background-color: #6ed140;
    }
    .btn-login{
        background-color: #e21b10;
        color: white;
        padding: 8px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .btn-login:hover{
        background-color: #d14740;
    }
</style>

<form action="{{route('changePassword')}}" method="POST">
    @csrf
    @method("POST")
<div class=" st_pop_form_wrapper" >
    <div class="modal-dialog">
        <div class="modal-content">
            @if (isset($user))
                <div>
                    <h2 style="font-size: 20px">Đổi mật khẩu thành công , vui lòng <a href="{{route("getLogin")}}" style="color: #fff"><button type="button" class="btn-login">Login</button></a> </h2>
                </div>

            @else

                <div class="st_pop_form_heading_wrapper float_left">
                    <h3>Đổi mật khẩu </h3>
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password" name="password" id="password">
                    @if ($errors->has('password'))
                        <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                     @endif
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password confirmation" name="password_confirmation" id="password_confirm">
                    @if ($errors->has('password_confirmation'))
                                <div class="text-danger mt-1">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <div id="showmatkhau" style="margin-left: 170px; font-size: 14px; margin-top: 5px; cursor: pointer">Hiển thị mật khẩu</div>
                <input type="hidden" value="{{$email}}" name="email">
                <div class="st_form_pop_login_btn float_left">
                    <button type="submit" class="btn-register">Xác nhận</button>
                </div>
                @endif
        </div>
    </div>
</div>
</form>

<script>
    const showmatkhau = document.getElementById('showmatkhau');
    const password = document.getElementById('password');
    const password_confirm = document.getElementById('password_confirm');
    showmatkhau.addEventListener('click', function() {
        let isPassword = password.type === 'password';
        password.type = isPassword ? 'text' : 'password';
        password_confirm.type = isPassword ? 'text' : 'password';
        showmatkhau.textContent = isPassword ? 'Ẩn mật khẩu' : 'Hiển thị mật khẩu' ;
    });

</script>
@endsection
