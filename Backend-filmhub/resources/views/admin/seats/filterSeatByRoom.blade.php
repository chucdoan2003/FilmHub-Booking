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
    <!-- Begin Page Content -->

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách ghế {{$roomName->room_name}}</h1>
        <a href="{{route('admin.seats.create')}}" class="btn btn-success mb-3">Tạo mới</a>
        @if(session('success'))
            <h4 style="padding: 10px 0;color: #17A673; font-weight: bold;">{{session('success')}}</h4>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                <div class="table-responsive">
                    <div class="card-body">
                        <label for="choices-category-input" class="form-label">Chọn phòng</label>
                    <select class="form-control" id="choices-category-input" name="room_id" onchange="location = this.value;">
                        <option value="">-- Chọn phòng --</option>
                        @foreach($rooms as $room_id => $room_name)
                            <option value="{{ route('admin.filterSeatByRoom', $room_id) }}">
                                {{ $room_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phòng</th>
                            <th>Số ghế</th>
                            <th>Loại ghế</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($seats as $item)
                                <tr>
                                    <td>{{$item->seat_id}}</td>
                                    <td>{{$item->rooms->room_name}}</td>
                                    <td>{{$item->seat_number}}</td>
                                    <td>{{$item->types->type_name}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <a href="{{route('admin.seats.edit', $item)}}" class="btn btn-info">Sửa</a>
                                        <form action="{{route('admin.seats.destroy', $item)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection