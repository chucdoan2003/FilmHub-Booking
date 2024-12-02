@extends('frontend.layouts.master')
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

<form action="{{route("register")}}" method="POST">
    @csrf
    @method("POST")
<div class=" st_pop_form_wrapper" >
    <div class="modal-dialog">
        <div class="modal-content">
          
           
                
            @if (isset($user))
            <div>
                <h2 style="font-size: 20px">Register successfully, please <button type="button" class="btn-login"><a href="{{route("getLogin")}}" style="color: #fff">Login</a></button> </h2>
            </div>
                
            @else
                <div class="st_pop_form_heading_wrapper float_left">
                    <h3>Sign Up</h3>
                </div>
                <div class="st_profile_input float_left">
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password confirmation" name="password_confirmation">
                </div>
                
                <div class="st_form_pop_login_btn float_left">
                    <button type="submit" class="btn-register">Sign Up</button>
                </div>
                <div class="st_form_pop_or_btn float_left">
                    <h4>or</h4>
                </div>
                <div class="st_form_pop_signin_btn float_left">
                    <h4>You have an account? <a href="{{route('getLogin')}}">Log in</a></h4>
                    <h5>I agree to the <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></h5>
                </div>
                
                <div class="st_form_pop_signin_btn st_form_pop_signin_btn_signup float_left">
                    <h5>I agree to the <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a></h5>
                </div>
                
            @endif
            
            
        </div>
    </div>
</div>
</form>
@endsection