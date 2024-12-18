@extends('admin.layouts.master')
@section('title')

@endsection
@section('style-libs')
    <!-- Plugins css -->
    <link href="{{asset('theme/admin/libs/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('theme/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('script-libs')
    <!-- ckeditor -->
    <script src="{{asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <!-- dropzone js -->
    <script src="{{asset('theme/admin/libs/dropzone/dropzone-min.js')}}"></script>

    <script src="{{asset('theme/admin/js/create-product.init.js')}}"></script>
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tạo mới phòng</h1>
        <!--  Page main content   -->
        <!--   Main product information             -->
        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Chọn rạp chiếu -->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="choices-category-input" class="form-label">Thông tin rạp</label>
                                <select class="form-control" aria-label="Default select example"
                                        id="choices-category-input" name="theater_id" required>
                                    <!-- <option value="" disabled selected>Chọn rạp chiếu</option> -->
                                        <option value="{{$theaters->theater_id}}">
                                            {{ $theaters->name }}
                                        </option>
                                </select>
                            </div>
                        </div>
                        <!-- Nhập tên phòng -->
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tên phòng</label>
                                <input type="text" class="form-control" name="room_name" placeholder="Vui lòng nhập phòng" required>
                                @error('room_name')
                                    <span style="padding: 10px 0; color: red;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">Thêm mới</button>
        </form>
    </div>
<!-- /.container-fluid -->
@endsection
