@extends('admin.layouts.master')
@section('title')
@endsection
@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{asset('theme/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('theme/admin/js/demo/datatables-demo.js')}}"></script>
@endsection
@section('content')
<div class="container">
    <h1>Chọn phim và tháng để xem thống kê</h1>
    <form action="{{route('admin.statistics.show')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="movie_id">Chọn phim:</label>
            <select name="movie_id" id="movie_id" class="form-control" required>
                <option value="">-- Chọn phim --</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->movie_id }}">{{ $movie->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="month">Chọn tháng:</label>
            <input type="month" name="month" id="month" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Xem thống kê</button>
    </form>
</div>
@endsection