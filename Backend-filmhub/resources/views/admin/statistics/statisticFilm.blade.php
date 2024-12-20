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
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Thống kê doanh số phim trong hệ thống</h1>
<div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tên Phim</th>
                        <th>Số Lượng Suất Chiếu</th>
                        <th>Số Lượng vé</th>
                        <th>Tổng Doanh Thu</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalRevenue = 0; // Khởi tạo biến tổng doanh thu
                    @endphp
                    @foreach($movies as $movie)
                        <tr>
                            <td>{{ $movie->movie_name }}</td>
                            <td>{{ $movie->show_count }}</td>
                            <td>{{ $movie->ticket_count }}</td>
                            <td>{{ number_format($movie->total_revenue, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <a href="{{ route('admin.statistics.statisticDetailFilm', $movie->movie_id) }}" class="btn btn-info">Xem Chi Tiết</a>
                            </td>
                        </tr>
                        @php
                            $totalRevenue += $movie->total_revenue; // Cộng dồn doanh thu
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right;"><strong>Tổng tiền:</strong></td>
                        <td><strong style="color: red;">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection