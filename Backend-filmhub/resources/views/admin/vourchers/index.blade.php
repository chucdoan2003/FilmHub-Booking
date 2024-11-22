@extends('admin.layouts.master')

@section('title')
    Vourhcer
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
                    <h6 class="m-0 font-weight-bold text-primary">List Vourcher</h6>
                    <a href="{{ route("vourchers.create") }}"><button class="btn-success"> Add new vourcher</button></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table border="1" class="w-full">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Vourcher_code</th>
                                <th>Vourcher_price</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Status</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vourchers as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->vourcher_code}}</td>
                                <td>{{$item->vourcher_price}}</td>
                                <td>{{ $item->start_time}}</td>
                                <td>{{ $item->end_time}}</td>
                                <td>@if ($item->start_time  < $now && $item->end_time > $now) 
                                    Còn hạn
                                @else
                                    Hết hạn
                                 @endif
                             </td>
                                <td>
                                    <a href="{{ route('vourchers.edit', $item->id) }}"><button class="btn-warning my-2">Edit</button></a>
                                    <form id="deleteForm" action="{{ route('vourchers.destroy', $item->id) }}" method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Do you want to delete this Vourcher ?')" class="btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach;
                        </tbody>
                    </table>
                    <div class="pagination">
                        @if ($vourchers->onFirstPage())
                            <span class="disabled mx-2 areaPage" >« Previous</span>
                        @else
                            <a href="{{ $vourchers->previousPageUrl() }}" class="mx-2">« Previous</a>
                        @endif

                        @foreach ($vourchers->getUrlRange(1, $vourchers->lastPage()) as $page => $url)
                            @if ($page == $vourchers->currentPage())
                                <span class="active mx-2 areaPage">{{ $page }}</span>
                            @else
                                <a href="{{ $url }} " class="mx-2 areaPage">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($vourchers->hasMorePages())
                            <a href="{{ $vourchers->nextPageUrl() }}" class="mx-2 areaPage">Next »</a>
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
