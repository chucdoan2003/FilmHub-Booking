@extends('admin.layouts.master')

@section('title', 'Danh sách phòng')


@section('style-libs')
    <!-- Plugins css -->
    <link href="{{ asset('theme/admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script-libs')
    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('theme/admin/js/create-product.init.js') }}"></script>
@endsection
@section('content')

    {{-- <h1 class="mb-4">Danh sách phòng</h1> --}}

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        @foreach($theaters as $theater)
        <h3>{{ $theater->name }}</h3>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên phòng</th>
                    <th>Sức chứa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if($theater->rooms->isEmpty())
                    <tr>
                        <td colspan="3">Không có phòng nào.</td>
                    </tr>
                @else
                    @foreach($theater->rooms as $room)
                        <tr>
                            <td>{{ $room->room_id }}</td>
                            <td>{{ $room->room_name }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>
                                <a href="{{ route('theaters.editRoom', $room->room_id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('theaters.destroyRoom', $room->room_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @endforeach
    </table>

@endsection
