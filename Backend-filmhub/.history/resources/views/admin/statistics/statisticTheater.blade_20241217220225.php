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
    <h1 class="h3 mb-2 text-gray-800">Chi tiết thống kê {{ $theater->name}}</h1>
    <a style="margin-bottom: 10px;" href="{{route('admin.statistics.statisticFilmHub')}}" class="btn btn-secondary">Quay lại</a>
    <form method="GET" action="{{ route('admin.statistics.statisticTheater', $theater->theater_id) }}">
        <div class="form-row mb-4">
            <div class="col">
                <input type="month" name="month" class="form-control" placeholder="Chọn tháng" value="{{ request('month') }}">
            </div>
            <div class="col">
                <input type="date" name="datetime" class="form-control" placeholder="Chọn ngày" value="{{ request('datetime') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <div class="card shadow mb-4">
        <div class="card-body">
                <h4>Thống kê doanh số {{ $theater->name}}</h4>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số lượng Phim</th>
                            <th>Số lượng suất chiếu</th>
                            <th>Số lượng vé</th>
                            <th>Tổng doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $totalMoviesCount }}</td>
                            <td>{{ $totalShowtimesCount }}</td>
                            <td>{{ $totalTicketsCount }}</td>
                            <td style="color:red" >{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4>Thống kê doanh số các phim trong {{$theater->name}}</h4>
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
                    @foreach($showtimes as $movie)
                        <tr>
                            <td>{{ $movie->movie_name }}</td>
                            <td>{{ $movie->show_count }}</td>
                            <td>{{ $movie->ticket_count }}</td>
                            <td>{{ number_format($movie->total_revenue, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <a href="{{ route('admin.statistics.statisticFilmTheater', ['theater_id' => $movie->theater_id, 'movie_id' => $movie->movie_id]) }}" class="btn btn-info">Xem Chi Tiết</a>
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

</div>
@endsection
