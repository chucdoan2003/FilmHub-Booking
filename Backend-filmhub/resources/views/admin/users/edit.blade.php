@extends('admin.layouts.master')

@section('title')
    Users
@endsection
@section('content')
<style>
    table{
        width: 100%;
    }
    td, th{
        padding: 6px 8px;
    }
    .edit{
        padding: 6px 12px;
        background-color: rgb(229, 229, 46);
        color: #ffffff;
        border: none;
        border-radius: 6px;
        margin-bottom: 6px;
    }
    .delete{
        padding: 6px 12px;
        background-color: rgb(224, 69, 22);
        color: hsl(0, 0%, 97%);
        border: none;
        border-radius: 6px;
        margin-bottom: 6px;

    }
    .btn-add-user{
        padding: 6px 12px;
        background-color: rgb(36, 245, 8);
        color: hsl(90, 100%, 100%);
        border: none;
        border-radius: 6px;
        margin-bottom: 6px;

    }
    .form-radius{
        border-radius: 8px !important;
    }
</style>
   <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit users</h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('users.update', $user->user_id) }}" method="POST" class="user">
                        @csrf
                        @method("PUT")
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="User Name" name="name" value="{{ $user->name }}">
                                    @if ($errors->has('name'))
                                        <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Email" name="email" value="{{ $user->email }}">
                                    @if ($errors->has('email'))
                                        <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user form-radius"
                                    id="exampleInputPassword" placeholder="Password" name="password" value="{{ $user->password }}"
                                     @if (isset($user->password))
                                        @disabled(true)
                                    @endif>
                                    @if ($errors->has('password'))
                                        <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user form-radius"
                                    id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation" value="{{ $user->password }}"
                                     @if (isset($user->password))
                                        @disabled(true)
                                    @endif>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="text-danger mt-1">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                            </div>

                        </div>
                        <button class="btn btn-primary btn-user btn-block">
                            Edit Account
                        </button>

                    </form>




                </div>
            </div>
        </div>
@endsection
