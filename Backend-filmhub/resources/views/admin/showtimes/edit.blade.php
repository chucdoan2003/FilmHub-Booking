@extends('admin.layouts.master')

@section('title')
    Edit showtimes
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
        <form action="{{ route('showtimes.update', $showtime->id) }}" method="POST" id="myForm">
            @csrf
            @method("PUT")
            <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Datetime</h6>
                        </div>
                    
                        <!-- Card Body -->
                        
                        <div class="card-body">
                            <input type="date" name="datetime" id="datetime" value="{{ $showtime->datetime }}" >
                            
                                
                                
                                
                                

                    

                            
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
                                <option value="{{ $item->id }}"
                                    @if ($item->id == $showtime->movie_id)
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
                        <select name="room" id="room_id"  >
                            @foreach ($rooms as $item)
                                <option value="{{ $item->id }}"
                                    @if(in_array($item->id, $room_over) && $item->id != $showtime->room_id )
                                    @disabled(true)
                                    @endif
                                    @if ($item->id == $showtime->room_id)
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
                        <select name="shift" id="shift_id" >
                            @foreach ($shifts as $item)
                                <option value="{{ $item->id }}"
                                    @if (in_array($item->id, $shiftInroomBook) && $item->id != $showtime->shift_id )
                                    @disabled(true)
                                    
                                    
                                    @endif
                                    @if ($item->id == $showtime->shift_id)
                                    @selected(true)
                                    @endif
                                    >{{ $item->name }}</option>
                            @endforeach
                        </select>    
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
    const select4 = document.querySelector('select[name="shift"]');
    const select3 = document.querySelector('input[name="datetime"]');
    select1.disabled = false;  // Kích hoạt lại trước khi submit
    select2.disabled = false;  // Kích hoạt lại trước khi submit
    select3.disabled = false;  // Kích hoạt lại trước khi submit
    select4.disabled = false;  // Kích hoạt lại trước khi submit
  });
</script>

<script>
    $(document).ready(function () {
        // Xử lý sự kiện submit form
        $(document).on('change', function(){
            let datetime= $('#datetime').val()
            let room_id = $('#room_id').val()
            console.log("Datetime đã chọn:", datetime); 
            console.log("Phòng đã chọn:", room_id); 
            $.ajax({
                url: "{{ route('showtimes.getAPI') }}",  // Route Laravel
                type: 'POST',
                data: {
                    datetime: datetime,
                    room_id: room_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                
                success: function (response) {
                    let room = "";
                    for (let i = 0; i < response.rooms.length; i++) {
                        room+=`
                        <option value="${response.rooms[i].id}"${response.rooms[i].id ==response.room_selected ? "selected":"" } ${response.rooms[i].isDisable ? "disabled": ""}>${response.rooms[i].name}</option>
                        `
                    }
                    let shift = ""
                    for (let i = 0; i < response.shifts.length; i++) {
                        shift+=`
                        <option value="${response.shifts[i].id}" ${response.shifts[i].isDisable ? "disabled": ""}>${response.shifts[i].name}</option>
                        `
                    }
                    console.log(shift)
                    
                    
                    $('#room_id').html(room);
                    $('#shift_id').html(shift);

                    // $('#myForm')[0].reset();  // Reset form sau khi thêm thành công
                    console.log(response)
                },
                error: function (xhr) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        })
        
    });
</script>

@endsection
