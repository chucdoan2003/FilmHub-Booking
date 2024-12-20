@extends('admin.layouts.master')

@section('title')
    List Tickets
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
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
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

        #reader {
        width: 100%;
        height: 300px;
        border: 1px solid #ccc;
        display: none; /* Ẩn ban đầu */
    }
    </style>
    @if (session('message'))
        <h4>{{ session('message') }}</h4>
    @endif

    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quét Mã QR</h6>
        </div>
        <div class="card-body">
            <button id="scan-qr" class="btn btn-primary">Scan QR</button>
            <div id="reader" style="width: 600px; height: 300px; display:none;"></div>
            <div id="result" style="margin-top: 20px;"></div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách phim</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người dùng</th>
                            <th>Phim</th>
                            <th>Phòng </th>
                            <th>Thời gian </th>
                            <th>Rạp</th>
                            <th>Seats</th>
                            <th>Combo</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Movie</th>
                            <th>Room</th>
                            <th>Shift</th>
                            <th>Theater</th>
                            <th>Seats</th>
                            <th>Combo</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($tickets as $index => $ticket)
                            <tr>
                                <td>{{ $ticket->ticket_id }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->showtime->movie->title }}</td>
                                <td>Phòng {{ $ticket->showtime->rooms->room_name }}</td>
                                <td> {{ $ticket->showtime->shifts->start_time }} to {{ $ticket->showtime->shifts->end_time }}</td>
                                <td>{{ $ticket->showtime->rooms->theater->name }}</td>
                                <td>{{ $ticket->ticketsSeats->count() }} Ghế</td>
                                <td>{{ $ticket->combo ? $ticket->combo->name : 'N/A' }}</td>
                                <td>{{ $ticket->total_price }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-info">View</a>
                                    {{-- <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script>
        document.getElementById('scan-qr').addEventListener('click', function() {
            var html5QrCode = new Html5Qrcode("reader");

            // Kiểm tra xem camera có sẵn không
            Html5Qrcode.getCameras().then(devices => {
                if (devices.length === 0) {
                    console.error("No cameras found.");
                    return;
                }
                var cameraId = devices[0].id; // Chọn camera đầu tiên

                html5QrCode.start(
                    cameraId,
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    function(decodedText, decodedResult) {
                        // Xử lý khi quét thành công
                        document.getElementById('result').innerText = "Mã QR: " + decodedText;
                        html5QrCode.stop();

                        // Chuyển hướng đến liên kết
                        window.location.href = decodedText; // Chuyển hướng tới URL quét được
                    },
                    function(errorMessage) {
                        // Xử lý khi có lỗi
                        console.warn("QR code scan error: ", errorMessage);
                    })
                .catch(err => {
                    console.error("Unable to start scanning: ", err);
                });

                document.getElementById('reader').style.display = "block"; // Hiển thị khu vực quét
            }).catch(err => {
                console.error("Error getting cameras: ", err);
            });
        });
    </script>
@endsection
