@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa rạp chiếu
@endsection

@section('content')
<form action="{{ route('admin.theaters.store') }}" method="POST">
    @csrf


    <div class="mb-3">
        <label for="theater-name" class="form-label">Tên rạp</label>
        <input type="text" class="form-control" id="theater-name" name="name"  required>
    </div>
    <div class="mb-3">
        <label for="theater-location" class="form-label">Địa điểm</label>
        <input type="text" class="form-control" id="theater-location" name="location"  required>
    </div>




    <button type="submit" class="btn btn-primary">Thêm</button>
</form>




@endsection
