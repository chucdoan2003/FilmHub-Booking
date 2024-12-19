@extends('admin.layouts.master')

@section('content')
    <h1>Thêm đồ uống </h1>

    <form action="{{ route('admin.drinks.store') }}" method="POST">
        @csrf
        <label for="name">Tên :</label>
        <input type="text" name="name" class="form-control" required>
        <label for="price">Giá :</label>
        <input type="text" name="price" class="form-control" required>



        <button type="submit" class="mt-3 btn btn-success">Tạo </button>
    </form>
@endsection
