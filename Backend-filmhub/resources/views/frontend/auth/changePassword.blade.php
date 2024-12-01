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

<form action="{{route('changePassword')}}" method="POST">
    @csrf
    @method("POST")
<div class=" st_pop_form_wrapper" >
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="st_pop_form_heading_wrapper float_left">
                    <h3>Change your password</h3>
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="st_profile__pass_input st_profile__pass_input_pop float_left">
                    <input type="password" placeholder="Password confirmation" name="password_confirmation">
                </div>
                <input type="hidden" value="{{$email}}" name="email">
                <div class="st_form_pop_login_btn float_left">
                    <button type="submit" class="btn-register">Submit</button>
                </div>
        </div>
    </div>
</div>
</form>
@endsection