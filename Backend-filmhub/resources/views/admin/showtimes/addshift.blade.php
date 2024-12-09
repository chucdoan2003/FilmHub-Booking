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
    .form-radius{
        border-radius: 8px !important;
    }
</style>
   <div class="col-xl-12 col-lg-7">
        <form action="{{ route('showtimes.addshowtime') }}" method="POST" id="myForm">
            @csrf
            @method("POST")
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Date</h6>
                        </div>
                    
                        <!-- Card Body -->
                        
                        <div class="card-body">
                            <input type="date" name="datetime" id="datetime" value="{{ $datetime }}" disabled>
                            
                                
                                
                                
                                

                    

                            
                        </div>

                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Theaters</h6>
                    </div>
                
                    <!-- Card Body -->
                    
                    <div class="card-body">
                        <select name="thearter" id="" disabled>
                            @foreach ($thearters as $item)
                                <option value="{{$item->id}}"
                                     @if($item->id == $thearter)
                                        @selected(true)
                                    @endif>{{$item->name}}</option>
                            @endforeach
                        </select>       
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
                        <select name="movie" id="" disabled>
                            @foreach ($movies as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $movie_id)
                                    @selected(true)
                                    
                                @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        
                            
                            
                            
                            

                

                        
                    </div>

                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Room</h6>
                    </div>
                
                    <!-- Card Body -->
                    
                    <div class="card-body">
                        <select name="room" id="" disabled >
                            @foreach ($rooms as $item)
                                <option value="{{ $item->id }}"
                                    @if ($item->id == $room_id)
                                    @selected(true)
                                    
                                    @endif
                                    >{{ $item->name }}</option>
                            @endforeach
                        </select>    
                    </div>

                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Shift</h6>
                    </div>
                
                    <!-- Card Body -->
                    
                    <div class="card-body">
                        <select name="shift" id="" >
                            @foreach ($shifts as $item)
                                <option value="{{ $item->id }}"
                                    @if (in_array($item->id, $shiftInroomBook))
                                    @disabled(true)
                                    
                                    @endif
                                    >{{ $item->name }}</option>
                            @endforeach
                        </select>    
                    </div>

                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Price</h6>
                    </div>
                
                    <!-- Card Body -->
                    
                    <div class="card-body">
                        <input type="text" class="form-control form-control-user form-radius" id="exampleLastName"
                        placeholder="100.000" name="price">
                    </div>

                </div>
                
            <button class="btn btn-primary btn-user btn-block">
                        Submit
            </button>
        </form>
    </div>
    <script>
  document.getElementById('myForm').addEventListener('submit', function() {
    const select1 = document.querySelector('select[name="movie"]');
    const select2 = document.querySelector('select[name="room"]');
    const select3 = document.querySelector('input[name="datetime"]');
    const select4 = document.querySelector('select[name="thearter"]');
    select1.disabled = false;  // Kích hoạt lại trước khi submit
    select2.disabled = false;  // Kích hoạt lại trước khi submit
    select3.disabled = false;  // Kích hoạt lại trước khi submit
    select4.disabled = false;  // Kích hoạt lại trước khi submit
  });
</script>
@endsection
