@extends('admin.layouts.master')

@section('title')
    Danh sách phim
@endsection

@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{ asset('theme/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('theme/admin/js/demo/datatables-demo.js') }}"></script>
@endsection

@section('content')
    @if (session('message'))
        <h4>{{ session('message') }}</h4>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách phim</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description </th>
                            <th>Duration</th>
                            <th>Release date</th>
                            <th>Genre</th>
                            <th>Rating</th>
                            <th>Poster</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description </th>
                            <th>Duration</th>
                            <th>Release date</th>
                            <th>Genre</th>
                            <th>Rating</th>
                            <th>Poster</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $movie)
                            <tr>
                                <td>{{ $movie->movie_id }}</td>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->description }}</td>
                                <td>{{ $movie->duration }} Phút</td>
                                <td>{{ $movie->release_date }}</td>
                                <td>
                                    @foreach ($movie->genres as $genre)
                                        {{ $genre->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $movie->rating }}</td>
                                <td><img src="{{ Storage::url($movie->poster_url) }}" style="width: 100px; height: 100px;" alt="Poster">

                                </td>

                                <td class="">
                                    <a href="{{ route('admin.movies.show', $movie->movie_id) }}"
                                        class="btn btn-info mb-3">Xem</a>
                                    <a href="{{ route('admin.movies.edit', $movie->movie_id) }}"
                                        class="btn btn-success mb-3">Sửa</a>
                                    <form action="{{ route('admin.movies.destroy', $movie->movie_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có muốn xóa phim này không')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
