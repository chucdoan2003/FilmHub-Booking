@extends('admin.layouts.master')

@section('title')
    Create new showtimes
@endsection
@section('content')
<style>
    table{
        width: 100%;
    }
    td, th{
        padding: 6px 8px;
    }
    .edit{
        padding: 6px 12px;
        background-color: rgb(229, 229, 46);
        color: #ffffff;
        border: none;
        border-radius: 6px;
        margin-bottom: 6px;
    }
    .delete{
        padding: 6px 12px;
        background-color: rgb(224, 69, 22);
        color: hsl(0, 0%, 97%);
        border: none;
        border-radius: 6px;
        margin-bottom: 6px;

    }
    .btn-add-user{
        padding: 6px 12px;
        background-color: rgb(36, 245, 8);
        color: hsl(90, 100%, 100%);
        border: none;
        border-radius: 6px;
        margin-bottom: 6px;

    }
    .form-radius{
        border-radius: 8px !important;
    }
</style>
   <div class="col-xl-12 col-lg-7">
        <form action="{{ route('showtimes.store2') }}" method="POST" class="user" id="myForm">
            @csrf
            @method("POST")
                <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Movie</h6>
                        </div>
                    
                        <!-- Card Body -->
                        
                        <div class="card-body">
                            <input type="date" name="datetime" value="{{ $datetime }}" disabled>
                            
                                
                                
    
                        </div>

                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Movie</h6>
                    </div>
                
                    <!-- Card Body -->
                    
                    <div class="card-body">
                        <select name="movie" id="">
                            @foreach ($movies as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        
                            
                            
                            
                            

                

                        
                    </div>

                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Phòng</h6>
                    </div>
                
                    <!-- Card Body -->
                    
                    <div class="card-body">
                        <select name="room" id="" >
                            @foreach ($rooms as $item)
                                <option value="{{ $item->id }}"
                                    @if (in_array($item->id, $room_over))
                                    @disabled(true)
                                    @endif
                                    >{{ $item->name }}</option>
                            @endforeach
                        </select>    
                    </div>

                </div>
                
            <button class="btn btn-primary btn-user btn-block">
                        Continue...
            </button>
        </form>
    </div>

<script>
  document.getElementById('myForm').addEventListener('submit', function() {
    // const select1 = document.querySelector('select[name="movie"]');
    // const select2 = document.querySelector('select[name="room"]');
    const select3 = document.querySelector('input[name="datetime"]');
    // select1.disabled = false;  // Kích hoạt lại trước khi submit
    // select2.disabled = false;  // Kích hoạt lại trước khi submit
    select3.disabled = false;  // Kích hoạt lại trước khi submit
  });
</script>
@endsection
