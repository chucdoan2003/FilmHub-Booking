@extends('admin.layouts.master')

@section('title', 'Sửa phòng')

@section('script-libs')
    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('theme/admin/js/create-product.init.js') }}"></script>
@endsection


@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('theaters.updateRoom', $room->room_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="room_name" class="form-label">Tên phòng</label>
            <input type="text" class="form-control" id="room_name" name="room_name" value="{{ $room->room_name }}" required>
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Sức chứa</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $room->capacity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
