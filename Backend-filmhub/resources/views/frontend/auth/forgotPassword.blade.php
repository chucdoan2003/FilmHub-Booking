@extends('frontend.layouts.master4')
@section('content')
<style>
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
    .st_pop_form_heading_wrapper {
            margin-top: 32px;
        }

        .form-login{
            padding: 0 15px
        }
</style>
<form action="{{route('forgotPassword')}}" method="POST">
    @csrf
    @method("POST")

    <div class="container mt-5 d-flex justify-content-center" style="max-width: 300px">
    <div class="row form-login">
                @if (isset($user) && $user != false)
                    <div class="st_pop_form_heading_wrapper st_pop_form_heading_wrapper_fpass float_left">
                        <h3>Forgot Password</h3>
                        <p>We have sent information to your email, please check your email.</p>
                        <div>
                            <a href="{{route("getLogin")}}" style="color: #fff">
                            <button type="button" class="btn-login">Login !</button>
                            </a>
                        </div>
                    </div>

                @else
                    @if (isset($user) && $user == false)
                        <div class="st_pop_form_heading_wrapper st_pop_form_heading_wrapper_fpass float_left">
                            <h3>Forgot Password</h3>
                            <p>Email not found !</p>
                            <button class="btn-login" type="button"><a href="{{route('getForgotPassword')}}" style="color: #fff">Try again!</a></button>
                        </div>
                    @else
                        <div class="st_pop_form_heading_wrapper st_pop_form_heading_wrapper_fpass float_left">
                            <h3>Forgot Password</h3>
                            <p>We can help! All you need to do is enter your email ID and follow the instructions!</p>
                        </div>

                        <div class="st_profile_input float_left">
                            <label>Email Address</label>
                            <input type="text" name="email">
                        </div>
                        <div class="">
                            <button type="submit" class="btn-login">Verify</button>
                        </div>


                    @endif

                @endif

            </div>
        </div>
    </div>
</form>
@endsection
