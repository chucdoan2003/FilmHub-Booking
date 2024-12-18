@extends('admin.layouts.master')

@section('title')
    List Movies
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
    <style>
        .description {
            white-space: nowrap;
            /* Không cho xuống dòng */
            overflow: hidden;
            /* Ẩn phần nội dung vượt quá kích thước */
            text-overflow: ellipsis;
            /* Hiển thị dấu "..." */
            max-width: 200px;
            /* Đặt độ rộng tối đa (tuỳ chỉnh theo giao diện) */
        }
    </style>
    @if (session('message'))
        <h4>{{ session('message') }}</h4>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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
                            <th>Tên phim</th>
                            <th>Thời lượng</th>
                            <th>Thể loại</th>
                            <th>Đánh giá</th>
                            <th>Poster</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên phim</th>
                            <th>Thời lượng</th>
                            <th>Thể loại</th>
                            <th>Đánh giá</th>
                            <th>Poster</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $movie)
                            <tr>
                                <td>{{ $movie->movie_id }}</td>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->duration }} Phút</td>
                                <td>
                                    @foreach ($movie->genres as $genre)
                                        {{ $genre->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa fa-star {{ $movie->rating >= $i ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td><img src="{{ Storage::url($movie->poster_url) }}" style="width: 100px; height: 100px;"
                                        alt=""></td>
                                <td>{{ $movie->status }}</td>
                                <td class="">
                                    <a href="{{ route('admin.movies.show', $movie->movie_id) }}"
                                        class="btn btn-primary mb-3">Detail</a>
                                    <a href="{{ route('admin.movies.edit', $movie->movie_id) }}"
                                        class="btn btn-success mb-3">Edit</a>
                                    <form action="{{ route('admin.movies.destroy', $movie->movie_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có muốn xóa phim này không')">Delete</button>
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
