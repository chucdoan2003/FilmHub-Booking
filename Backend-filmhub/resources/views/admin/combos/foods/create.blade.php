@extends('admin.layouts.master')

@section('content')
    <h1>Create Foods</h1>

    <form action="{{ route('admin.foods.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" required>
        <label for="price">Price:</label>
        <input type="text" name="price" class="form-control" required>

        <button type="submit" class="mt-3 btn btn-success">Create</button>
    </form>
@endsection
