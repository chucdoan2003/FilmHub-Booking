@extends('admin.layouts.master')

@section('title')
    Users
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
                    <h6 class="m-0 font-weight-bold text-primary">List Users</h6>
                    <a href="{{ route("users.create") }}"><button class="btn-success"> Add new user</button></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table border="1" class="w-full">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($users))
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->status }}</td>
                                        <td><img src="" alt=""></td>
                                        <td>
                                            <a href="{{ route('users.edit', $item->user_id) }}"><button class="btn-warning my-2">Edit</button></a>

                                            <form action="{{ route('users.destroy', $item->user_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>





                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    <div class="pagination">
                        @if ($users->onFirstPage())
                            <span class="disabled mx-2 areaPage" >« Previous</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="mx-2">« Previous</a>
                        @endif

                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="active mx-2 areaPage">{{ $page }}</span>
                            @else
                                <a href="{{ $url }} " class="mx-2 areaPage">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="mx-2 areaPage">Next »</a>
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
