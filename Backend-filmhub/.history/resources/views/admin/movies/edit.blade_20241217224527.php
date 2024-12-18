@extends('admin.layouts.master')

@section('title')
    Sửa Phim
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.movies.update', $movie->movie_id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="mb-3 col-6">
                <label for="title" class="form-label">Tên phim:</label>
                <input type="text" class="form-control" value="{{ $movie->title }}" id="title" name="title">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="description" class="form-label">Mô tả:</label>
                <input type="text" class="form-control" value="{{ $movie->description }}" id="description"
                    name="description">
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="duration" class="form-label">Thời lượng:</label>
                <input type="number" class="form-control" value="{{ $movie->duration }}" id="duration" name="duration">
                @error('duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="release_date" class="form-label">Ngày ra mắt:</label>
                <input type="date" class="form-control" value="{{ $movie->release_date }}" id="release_date"
                    name="release_date">
                @error('release_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 col-6">
                <label for="genres" class="form-label">Thể loại:</label>
                <select id="genres" name="genres[]" class="selectpicker form-control" multiple data-live-search="true">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->genre_id }}"
                            {{ $movie->genres && in_array($genre->genre_id, $movie->genres->pluck('genre_id')->toArray()) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genres')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="poster_url" class="form-label">Poster:</label>
                <input type="file" id="imageInput" name="poster_url" id="poster_url">
                <img src="{{ Storage::url($movie->poster_url) }}" style="width: 150px; height: 150px;" alt="">
                @error('poster_url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="status" class="form-label">Trạng thái:</label>
                <select name="status" class="form-control" id="status">
                    <option value="{{ $movie->status }}" selected>{{ $movie->status }}</option>
                    <option value="Sắp ra mắt">Sắp ra mắt</option>
                    <option value="Đang chiếu">Đang chiếu</option>
                    <option value="Ngừng chiếu">Ngừng chiếu</option>
                </select>
                @error('director')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="director" class="form-label">Đạo diễn:</label>
                <input type="text" class="form-control" value="{{ $movie->director }}" id="director" name="director">
                @error('director')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="performer" class="form-label">Diễn viên:</label>
                <input type="text" class="form-control" value="{{ $movie->performer }}" id="performer" name="performer">
                @error('performer')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="trailer" class="form-label">Trailer:</label>
                <input type="text" class="form-control" value="{{ $movie->trailer }}" id="trailer"
                    name="trailer">
                @error('trailer')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="type">Dạng phim</label>
                <select name="type" id="type" class="form-control">
                    <option value="2D" {{ old('type', $movie->type ?? '') == '2D' ? 'selected' : '' }}>2D</option>
                    <option value="3D" {{ old('type', $movie->type ?? '') == '3D' ? 'selected' : '' }}>3D</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
