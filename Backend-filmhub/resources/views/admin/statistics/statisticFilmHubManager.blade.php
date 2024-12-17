@extends('admin.layouts.master')
@section('title')
@endsection
@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
@endsection
@section('script-libs')
    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Page level plugins -->
    <script src="{{asset('theme/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    

    <!-- Page level custom scripts -->
    <script src="{{asset('theme/admin/js/demo/datatables-demo.js')}}"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection
@section('content')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4>Thống kê doanh thu {{$theater->name}}</h4>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số Lượng Phim</th>
                            <th>Tổng Doanh Thu</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $item)
                            <tr>
                                <td>{{ $item->movie_count }}</td>
                                <td>{{ number_format($item->total_revenue, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <a href="{{ route('admin.statistics.statisticTheater', $item->theater_id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>
</div>


@endsection