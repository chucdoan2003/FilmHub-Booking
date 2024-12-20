@extends('admin.layouts.master')

@section('title')
    Create Category
@endsection

@section('style-libs')
    <!-- Plugins css -->
    <link href="{{ asset('theme/admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    {{-- multiple choise --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endsection

@section('script-libs')
    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('theme/admin/js/create-product.init.js') }}"></script>

    {{-- multiple choise --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection
<style>
    .bootstrap-select .dropdown-toggle {
        height: 50px;
        border: 2px solid black;
        border-radius: 10px;
        background-color: #f8f9fa;
        color: #495057;
    }

    .bootstrap-select .dropdown-menu {
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .bootstrap-select .dropdown-menu li a {
        color: #495057;
    }

    .bootstrap-select .dropdown-menu li a:hover {
        background-color: #2855a7;
        color: white;
    }
</style>
@section('content')
    <form action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-3 col-12">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" value="{{ old('name', $category->name) }}" id="name"
                    name="name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-12">
                <label for="name" class="form-label">Status:</label>
                <select name="status" class="form-control" id="status">
                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hiện</option>
                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-12">
                <label for="description" class="form-label">Description:</label>
                <textarea type="text" class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ">Save</button>
    </form>
@endsection
