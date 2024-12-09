@@ -0,0 +1,94 @@
@extends('admin.layouts.master')

@section('title')
    List Comment
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
            <h6 class="m-0 font-weight-bold text-primary">List Comment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Movie</th>
                            <th>Comment</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Movie</th>
                            <th>Comment</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($comments as $index => $comment)
                            <tr>
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
