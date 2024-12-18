@extends('admin.layouts.master')

@section('title')
    Chi tiết rạp phim
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Chi tiết rạp phim</h2>

        @if(session('message'))
            <h4 class="mb-4">{{session('message')}}</h4>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin rạp phim</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        <strong>ID:</strong> {{$theater->theater_id}}
                    </li>
                    <li>
                        <strong>Tên:</strong> {{$theater->name}}
                    </li>
                    <li>
                        <strong>Vị trí:</strong> {{$theater->location}}
                    </li>


                </ul>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách phòng</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        <strong>Tổng số phòng:</strong> {{ count($theater->rooms) }}
                    </li>
                    @foreach($theater->rooms as $room)

                        <li>
                            <strong>Phòng:</strong> {{$room->room_name}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách ca chiếu</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        <strong>Tổng số ca chiếu:</strong> {{ count($shifts) }}
                    </li>
                    @foreach($shifts as $shift)
                    <li>
                        <strong>{{$shift->shift_name}} : </strong>   Từ {{$shift->start_time}} - {{$shift->end_time}}
                    </li>
                @endforeach

                </ul>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.theaters.index') }}" class="btn btn-primary">
                Quay lại danh sách rạp phim
            </a>
        </div>
    </div>
@endsection
