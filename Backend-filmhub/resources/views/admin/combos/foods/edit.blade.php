@extends('admin.layouts.master')
@section('content')
    <h1>Edit Food</h1>

    <form action="{{ route('admin.foods.update', $food) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $food->name }}" class="form-control" required>
        <label for="price">Price:</label>
        <input type="text" name="price" value="{{ $food->price }}" class="form-control" required>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
