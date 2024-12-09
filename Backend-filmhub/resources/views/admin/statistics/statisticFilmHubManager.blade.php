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
    <!-- biều đồ cột -->
    <!-- <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('admin.statistics.statisticFilmHubData') }}",
                method: 'GET',
                success: function(data) {
                    const ctx = document.getElementById('revenueChart').getContext('2d');
                    const myBarChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.months.map(month => month + ' tháng'),
                            datasets: [{
                                label: 'Tổng Doanh Thu (VNĐ)',
                                backgroundColor: '#4e73df',
                                data: data.revenues,
                            }],
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Biểu đồ cột thống kê doanh thu hệ thống FilmHub'
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function(value) {
                                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' VNĐ';
                                        }
                                    }
                                }]
                            }
                        }
                    });
                }
            });
        });
    </script> -->
    <!-- biều đồ tròn -->
    <!-- <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('admin.statistics.statisticTheaterData') }}",
                method: 'GET',
                success: function(data) {
                    const labels = data.map(item => item.theater_name);
                    const revenues = data.map(item => item.total_revenue);
                    
                    var ctx = document.getElementById("PieChart").getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: revenues,
                                backgroundColor: [
                                    '#FF6384',
                                    '#36A2EB',
                                    '#FFCE56',
                                    '#FF5733',
                                    '#33FF57',
                                    '#3357FF'
                                ],
                                hoverBackgroundColor: [
                                    '#FF6384',
                                    '#36A2EB',
                                    '#FFCE56',
                                    '#FF5733',
                                    '#33FF57',
                                    '#3357FF'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Biểu đồ tròn thống kê doanh thu hệ thống FilmHub'
                            },
                            maintainAspectRatio: false,
                        
                            animation: {
                                animateScale: true,  
                                animateRotate: true    
                            },
                            tooltips: {
                                enabled: true
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi lấy dữ liệu: ", error);
                }
            });
        });
    </script> -->
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
    <!-- <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <canvas id="PieChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div> -->
</div>
</div>
</div>


@endsection