@extends('admin.layouts.master')
@section('content')
    <h1>Đồ uống </h1>
    <a href="{{ route('admin.drinks.create') }}" class="btn btn-success">Create New Drink</a>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tên </th>
                <th scope="col">Giá </th>
                <th scope="col">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drinks as $drink)
                <tr>
                    <td>{{ $drink->name }}</td>
                    <td>{{ $drink->price }}</td>
                    <td>
                        <a href="{{ route('admin.drinks.edit', $drink->id) }}" class="btn btn-primary">Sửa </a>
                        <form action="{{ route('admin.drinks.destroy', $drink->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this Drink?');">Xóa </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
