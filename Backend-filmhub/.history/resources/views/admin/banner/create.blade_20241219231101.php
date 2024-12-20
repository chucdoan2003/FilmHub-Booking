@extends('admin.layouts.master')

@section('title')
    Tạo banner
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
            @if(isset($errors['image']))
                <div class="alert alert-danger" role="alert">
                    <span>{{$errors[
                    'image'
                    ]}}</span>
                </div>
            @endif
        <form action="{{ route('banner.store') }}" method="POST" class="user" enctype="multipart/form-data" >
            @csrf
            @method("POST")
                <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tên ảnh</h6>
                        </div>

                        <!-- Card Body -->

                        <div class="card-body">
                            <input type="text" class="form-control form-control-user form-radius" placeholder="Ảnh..." name="name">
                        </div>

                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Ảnh</h6>
                    </div>

                    <!-- Card Body -->

                    <div class="card-body">
                        <input type="file"  name="image">

                    </div>

                </div>
            <button class="btn btn-primary btn-user btn-block">
                       Submit
            </button>
        </form>
    </div>
@endsection
