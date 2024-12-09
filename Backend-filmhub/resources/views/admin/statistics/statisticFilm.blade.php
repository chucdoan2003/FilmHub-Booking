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
<h1 class="h3 mb-2 text-gray-800">Thống kê doanh số phim</h1>
<form method="GET" action="{{ route('admin.statistics.statisticFilm') }}">
        <div class="form-row mb-4">
            <div class="col">
                <input type="date" name="datetime" class="form-control" placeholder="Chọn thời gian">
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
                        <th>Tên phim</th>
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
                    @foreach($results as $item)
                        <tr>
                            <td>{{ $item->movie_name }}</td>
                            <td>{{ $item->shift_name }}</td>
                            <td>{{ $item->start_time}}</td>
                            <td>{{ $item->end_time}}</td>
                            <td>{{ $item->datetime}}</td>
                            <td>{{ $item->ticket_count}}</td>
                            <td>{{ number_format($item->total_revenue, 0, ',', '.') }} VNĐ</td>
                        </tr>
                        @php
                            $totalRevenue += $item->total_revenue; // Cộng dồn doanh thu
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right; color:red"><strong>Tổng doanh thu phim: </strong></td>
                        <td><strong style="color:red">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection