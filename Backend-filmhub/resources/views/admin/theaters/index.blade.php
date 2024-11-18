@extends('admin.layouts.master')

@section('title')
    Danh sách rạp phim
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
    @if(session('message'))
        <h4>{{session('message')}}</h4>
    @endif


    <a href="{{route('admin.theaters.create')}}" class="mb-3">
        <button class="btn btn-success">Tạo mới</button>
    </a>
    <form action="{{ route('vnpay_payment') }}" method="POST">
        @csrf
        <button type="submit" name="redirect" class="btn btn-success">Thanh toan VNPAY </button>
    </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách rạp phim</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Vị trí</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Vị trí</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($data as $theater)
                            <tr>
                                <td>{{$theater->theater_id}}</td>
                                <td>{{$theater->name}}</td>
                                <td>{{$theater->location}}</td>
                                {{-- <td>
                                    {!! $theater->is_active ? '<span class="badge bg-success text-white">Hoạt động</span>'
                                    : '<span class="badge bg-danger text-white">Không hoạt động</span>'!!}
                                </td> --}}
                                <td class="d-flex">
                                    <a href="{{route('admin.theaters.show', $theater->theater_id)}}" class="btn btn-info mr-3">Xem</a>
                                    <a href="{{route('admin.theaters.edit', $theater->theater_id)}}" class="btn btn-success mr-3">Sửa</a>
                                    <form action="{{route('admin.theaters.destroy', $theater->theater_id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
