@extends('admin.layouts.master')

@section('title')
    Tạo mới phòng
@endsection

@section('style-libs')
    <!-- Plugins css -->
    <link href="{{ asset('theme/admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script-libs')
    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('theme/admin/js/create-product.init.js') }}"></script>
@endsection

@section('content')
<form action="{{ route('theaters.storeRoom') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="room_name" class="form-label">Tên phòng</label>
        <input type="text" class="form-control" id="room_name" name="room_name" required>

    </div>



    <div class="mb-3">
        <label for="theater-select" class="form-label">Chọn Rạp</label>
        <select class="form-select" id="theater-select" name="theater_id" required>
            <option value="" disabled selected>Chọn rạp</option>
            @foreach ($theaters as $theater)
                <option value="{{ $theater->theater_id}}">{{ $theater->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="card shadow mb-4">
        <a href="#collapseSeats" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseSeats">
            <h6 class="m-0 font-weight-bold text-primary">
                Thêm ghế
            </h6>
        </a>
        <div class="collapse show" id="collapseSeats">
            <div class="card-body">
                <!-- Nhập số lượng ghế thường -->
                <label for="normal_seats" class="form-label">Số lượng ghế thường</label>
                <input type="number" class="form-control" id="normal_seats" name="normal_seats" min="0" placeholder="Nhập số lượng ghế thường">
                @error('normal_seats')
                    <span style="padding: 10px 0; color: red;">{{$message}}</span>
                @enderror

                <!-- Nhập số lượng ghế VIP -->
                <label for="vip_seats" class="form-label mt-3">Số lượng ghế VIP</label>
                <input type="number" class="form-control" id="vip_seats" name="vip_seats" min="0" placeholder="Nhập số lượng ghế VIP">
                @error('vip_seats')
                    <span style="padding: 10px 0; color: red;">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Lưu</button>
</form>




@endsection
