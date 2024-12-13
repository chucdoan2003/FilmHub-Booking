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
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách banners</h6>
                    <a href="{{ route("banners.create") }}"><button class="btn-success"> Thêm banner mới</button></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table border="1" class="w-full">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tên ảnh</th>
                                <th>Ảnh</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $item)
                                <tr>
                                    <td>{{ $item->banner_id  }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img src="{{Storage::url($item->image)}}" style="max-width: ̃318px; max-height: 159px; object-fit:cover" alt=""></td>
                                    <td>
                                        <a href="{{ route('banner.edit', $item->banner_id) }}"><button class="btn-warning">Edit</button></a>
                                        <form action="{{ route('banner.destroy', $item->banner_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn-danger" onclick="return confirm('Do you want to delete this banner ?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
<script>

</script>
@endsection
