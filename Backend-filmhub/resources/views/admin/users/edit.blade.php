@extends('admin.layouts.master')

@section('title')
    Users
@endsection
@section('content')
    <style>
        table {
            width: 100%;
        }

        td,
        th {
            padding: 6px 8px;
        }

        .edit {
            padding: 6px 12px;
            background-color: rgb(229, 229, 46);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            margin-bottom: 6px;
        }

        .delete {
            padding: 6px 12px;
            background-color: rgb(224, 69, 22);
            color: hsl(0, 0%, 97%);
            border: none;
            border-radius: 6px;
            margin-bottom: 6px;

        }

        .btn-add-user {
            padding: 6px 12px;
            background-color: rgb(36, 245, 8);
            color: hsl(90, 100%, 100%);
            border: none;
            border-radius: 6px;
            margin-bottom: 6px;

        }

        .form-radius {
            border-radius: 8px !important;
        }
    </style>
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="theater_id">Theater</label>
                        @if ($user->theater)
                            <!-- Input display the current theater's name, not editable -->
                            <input type="text" name="theater_name" class="form-control" value="{{ $user->theater->name }}" readonly>
                            <!-- Select theater to choose another one if needed -->
                            <select name="theater_id" class="form-control" id="theater_id">
                                <option value="">Select Theater</option>
                                @foreach ($theaters as $theater)
                                    <option value="{{ $theater->theater_id }}" {{ old('theater_id', $user->theater_id) == $theater->id ? 'selected' : '' }}>
                                        {{ $theater->name }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <!-- If no theater is assigned, just show select dropdown -->
                            <select name="theater_id" class="form-control" id="theater_id">
                                <option value="">Select Theater</option>
                                @foreach ($theaters as $theater)
                                    <option value="{{ $theater->theater_id }}" {{ old('theater_id') == $theater->id ? 'selected' : '' }}>
                                        {{ $theater->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
