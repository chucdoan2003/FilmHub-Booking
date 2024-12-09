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



    <button type="submit" class="btn btn-primary">Lưu</button>
</form>




@endsection
