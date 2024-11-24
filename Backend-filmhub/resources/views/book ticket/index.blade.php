@extends('admin.layouts.master')

@section('title')
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
    <div class="container">
        <h1>Danh sách Showtime</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Hình ảnh phim</th>
                    <th>Tiêu đề phim</th>
                    <th>Mô tả</th>

                    <th>Phòng</th>
                    <th>Thời gian chiếu</th>
                    <th>Ca chiếu</th>
                    <th>Thời lượng</th>
                    <th>Giá vé</th>
                    <th>Giá ghế vip</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($showtimes as $showtime)
                    <tr>

                        <td>
                            @if ($showtime->movie)
                                <img src="{{ Storage::url($showtime->movie->poster_url) }}" style="width: 100px; height: 100px;" alt="Poster">
                            @endif
                        </td>

                        <td>{{ $showtime->movie->title }}</td>
                        <td>{{ $showtime->movie->description }}</td> <!-- Mô tả phim -->

                        <td>{{ $showtime->room->room_name }}</td>
                        <td>{{ $showtime->datetime}}</td>
                        <!-- Thêm thông tin ca chiếu -->
                        <td>

                                {{ $showtime->shift->shift_name }} - {{ $showtime->shift->start_time }} -
                                {{ $showtime->shift->end_time }}

                        </td>

                        <td>{{ $showtime->movie->duration }} phút</td> <!-- Thời lượng -->
                        <td>{{ number_format($showtime->normal_price) }} VND</td>
                        <td>{{ number_format($showtime->vip_price) }} VND</td>
                        <td>
                            <a href="{{ route('bookings.show', $showtime->showtime_id) }}" class="btn btn-primary">Đặt vé</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
