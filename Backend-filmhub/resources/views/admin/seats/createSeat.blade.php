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
        <h1 class="h3 mb-4 text-gray-800">Tạo mới ghế</h1>
        <!--  Page main content   -->
        <!--   Main product information             -->
        <form action="{{route('admin.seats.store')}}" method="POST" >
            @csrf
            <div class="row">
                <!--   left content-->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Main product information -->
                        <a href="#collapseProductInfo" class="d-block card-header py-3" data-toggle="collapse"
                           role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Thông tin chính của ghế</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseProductInfo">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Số lượng ghế</label>
                                    <input type="number" min="1" class="form-control"  name="seat_quantity"
                                           placeholder="Vui lòng nhập số lượng ghế" required>
                                    @if(session('error'))
                                        <div class="alert alert-danger mt-3">
                                            <strong>{{session('error')}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="submit" class="btn btn-success w-sm">Thêm mới</button>
                    </div>
                </div>
                <!-- end left content    -->
                <!-- right content          -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseStatus" class="d-block card-header py-3" data-toggle="collapse"
                           role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Trạng thái ghế
                            </h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseStatus">
                            <!-- end card body -->
                            <div class="card-body">
                                <!-- chọn phòng -->
                                <label for="choices-category-input" class="form-label">Phòng</label>
                                <select class="form-control" aria-label="Default select example"
                                        id="choices-category-input" name="room_id">
                                        <option value="{{$rooms->room_id}}">
                                            {{ $rooms->room_name }}
                                        </option>
                                </select>
                                <!-- chọn hàng ghế -->
                                <label for="choices-category-input" class="form-label">Chọn hàng ghế</label>
                                <select class="form-control" aria-label="Default select example"
                                        id="choices-category-input" name="row_id" required>
                                    <option  value="" disabled selected>-----------Chọn hàng ghế ----------</option>
                                    @foreach($rows as $row_id => $row_name)
                                        <option value="{{$row_id}}"> {{$row_name}}</option>
                                    @endforeach
                                </select>
                                <!-- trạng thái ghế -->
                                <label for="choices-publish-status-input" class="form-label mt-3">Trạng thái</label>
                                <select class="form-control form-select-lg mb-3" id="choices-publish-status-input"
                                        aria-label="Default select example" name="status" required>
                                    <option value="available">Available</option>
                                </select>
                                <br>
                                <!-- Loại sản phẩm -->
                                <label for="choices-publish-type-input" class="form-label">Loại ghế</label>
                                <div class="form-group custom-control custom-radio small d-flex ">
                                    @foreach($types as $key => $value)
                                        <div class="col-md-3">
                                            <input type="radio" class="custom-control-input" value="{{$key}}" name="type_id" id="customCheck-{{$key}}">
                                            <label class="custom-control-label" for="customCheck-{{$key}}">{{$value}}</label>
                                            @error('type_id')
                                                <span style="padding: 10px 0; color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end right content       -->

            </div>
        </form>
</div>
<!-- /.container-fluid -->
@endsection
