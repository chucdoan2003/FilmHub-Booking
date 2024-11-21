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
    <h1>Thống kê cho phim: {{ $statistics->movie_id }} - Tháng: {{ $selectedMonth->format('F Y') }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tổng doanh thu</th>
                <th>Số lượng vé</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ number_format($statistics->total_revenue) }} VNĐ</td>
                <td>{{ $statistics->total_tickets }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{route('admin.statistics.index')}}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection