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
    <h1 class="h3 mb-2 text-gray-800">Thống kê doanh số phim</h1>
    <a style="margin-bottom: 10px;" href="{{route('admin.statistics.statisticTheater', $theater_id)}}" class="btn btn-secondary">Quay lại</a>
    <div class="alert alert-info">
        <strong>Tên Phim: {{ $movie->title }}</strong>
    </div>
    <form method="GET" action="{{ route('admin.statistics.statisticFilmTheater', [$theater_id, $movie->movie_id]) }}">
        <div class="form-row mb-4">
            <div class="col">
                <input type="month" name="month" class="form-control" placeholder="Chọn tháng" value="{{ request('month') }}">
            </div>
            <div class="col">
                <input type="week" name="week" class="form-control" placeholder="Chọn tuần" value="{{ request('week') }}">
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ca chiếu</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Ngày chiếu</th>
                        <th>Số lượng vé</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalRevenue = 0; // Khởi tạo biến tổng doanh thu
                    @endphp
                    @foreach($showtimes as $showtime)
                        <tr>
                            <td>{{ $showtime->shift_name }}</td>
                            <td>{{ $showtime->start_time }}</td>
                            <td>{{ $showtime->end_time }}</td>
                            <td>{{ $showtime->showtime_date }}</td>
                            <td>{{ $showtime->ticket_count }}</td>
                            <td>{{ number_format($showtime->total_revenue, 0, ',', '.') }} VNĐ</td>
                        </tr>
                        @php
                            $totalRevenue += $showtime->total_revenue; // Cộng dồn doanh thu
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right;"><strong>Tổng Doanh Thu:</strong></td>
                        <td><strong style="color:red">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</div>
@endsection