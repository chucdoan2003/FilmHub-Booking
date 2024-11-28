@extends('admin.layouts.master')

@section('title')
    Showtimes
@endsection
@section('content')
<style>
    table{
        width: 100%;
    }
    td, th{
        padding: 6px 8px;
    }
    .pagination{
        justify-content: center;
        margin-top: 12px;
    }
    .areaPage{
        padding: 2px 8px;
        cursor: pointer;
        border-radius: 6px;
        box-shadow: 1px 2px 0 rgba(0,0, 0, 0.3)

    }
    .pagination .active{
        background-color: rgb(21, 189, 94);
        color:#fff
    }



</style>
   <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Showtimes</h6>
                    <a href="{{ route("showtimes.create") }}"><button class="btn-success"> Add new showtimes</button></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table border="1" class="w-full">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Movie</th>
                                <th>Room</th>
                                <th>Shift</th>
                                <th>Date</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Giá thường</th>
                                <th>Giá vip</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showtimes as $item)
                                <tr>
                                    <td>{{ $item->showtime_id  }}</td>
                                    <td>{{ $item->movie_name }}</td>
                                    <td>{{ $item->room_name }}</td>
                                    <td>{{ $item->shift_name }}</td>
                                    <td>{{ $item->datetime}}</td>
                                    <td>{{ $item->shift_start_time}}</td>
                                    <td>{{ $item->shift_end_time}}</td>
                                    <td>{{ number_format($item->normal_price, 0, ',', '.') }} VND</td>
                                    <td>{{ number_format($item->vip_price, 0, ',', '.') }} VND</td>

                                    <td>
                                        <a href="{{ route('showtimes.edit', $item->showtime_id) }}"><button class="btn-warning">Edit</button></a>
                                        <form action="{{ route('showtimes.destroy', $item->showtime_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn-danger" onclick="return confirm('Do you want to delete this showtime ?')">Delete</button>


                                        </form>
                                    </td>
                                </tr>

                            @endforeach


                        </tbody>
                    </table>
                    <div class="pagination">
                        @if ($showtimes->onFirstPage())
                            <span class="disabled mx-2 areaPage" >« Previous</span>
                        @else
                            <a href="{{ $showtimes->previousPageUrl() }}" class="mx-2">« Previous</a>
                        @endif

                        @foreach ($showtimes->getUrlRange(1, $showtimes->lastPage()) as $page => $url)
                            @if ($page == $showtimes->currentPage())
                                <span class="active mx-2 areaPage">{{ $page }}</span>
                            @else
                                <a href="{{ $url }} " class="mx-2 areaPage">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($showtimes->hasMorePages())
                            <a href="{{ $showtimes->nextPageUrl() }}" class="mx-2 areaPage">Next »</a>
                        @else
                            <span class="disabled" class="mx-2 areaPage">Next »</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
<script>

</script>
@endsection
