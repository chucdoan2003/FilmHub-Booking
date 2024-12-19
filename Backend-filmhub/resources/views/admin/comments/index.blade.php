@extends('admin.layouts.master')

@section('title')
    Danh sách comment
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <form action="{{ route('admin.comments.index') }}" method="GET">
                <select name="movie_id" id="movie_filter" class="form-control mb-3">
                    <option value="">-- Tìm kiếm tất cả --</option>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->movie_id }}"
                            {{ request('movie_id') == $movie->movie_id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Tên phim</th>
                            <th>BÌnh luận</th>
                            <th>Đánh giá</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Tên phim</th>
                            <th>BÌnh luận</th>
                            <th>Đánh giá</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($comments as $index => $comment)
                            <tr data-movie-id="{{ $comment->movie->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $comment->user->name ?? 'Không xác định' }}</td>
                                <td> {{ $comment->movie->title }}</td>
                                <td>{{ $comment->comment }} </td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa fa-star {{ $comment->rating >= $i ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td class="">
                                    <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có muốn xóa phim này không')">Xóa bình luận</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function filterComments() {
            const movieId = document.querySelector('[name="movie_id"]').value;
            const rows = document.querySelectorAll('#comments_table_body tr');

            rows.forEach(row => {
                if (movieId === "" || row.getAttribute('data-movie-id') === movieId) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection
