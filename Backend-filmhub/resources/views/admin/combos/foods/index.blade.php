@extends('admin.layouts.master')
@section('content')
    <h1>Combo</h1>
    <a href="{{ route('admin.foods.create') }}" class="btn btn-success">Create New Food</a>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->price }}</td>
                    <td>
                        <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this combo?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
