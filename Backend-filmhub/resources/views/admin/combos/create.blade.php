@extends('admin.layouts.master')
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
    <h1>Create Combo</h1>

    <form action="{{ route('admin.combos.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" required>
        <label for="price">Price:</label>
        <input type="text" name="price" class="form-control" required>
        <div class="mt-4">
            <label for="foods" class="form-label">Foods:</label>
            <select name="foods[]" id="foods" class="selectpicker form-control" multiple data-live-search="true">
                @foreach ($foods as $food)
                    <option value="{{ $food->id }}">{{ $food->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label for="drinks" class="form-label">Drinks:</label>
            <select name="drinks[]" id="drinks" class="selectpicker form-control" multiple data-live-search="true">
                @foreach ($drinks as $drink)
                    <option value="{{ $drink->id }}">{{ $drink->name }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="mt-3 btn btn-success">Create</button>
    </form>
@endsection
