@extends('admin.layouts.master')
@section('content')
    <h1>Sửa đồ uống </h1>

    <form action="{{ route('admin.drinks.update', $drink) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Tên :</label>
        <input type="text" name="name" value="{{ $drink->name }}" class="form-control" required>
        <label for="price">Giá :</label>
        <input type="text" name="price" value="{{ $drink->price }}" class="form-control" required>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
