@extends('admin.layouts.master')
@section('content')
    <h1>Combo</h1>
    <a href="{{ route('admin.combos.create') }}" class="btn btn-success">Create New Combo</a>

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
            @foreach ($combos as $combo)
                <tr>
                    <td>{{ $combo->name }}</td>
                    <td>{{ $combo->price }}</td>
                    <td>
                        <a href="{{ route('admin.combos.edit', $combo->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.combos.destroy', $combo->id) }}" method="POST" style="display:inline;">
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
