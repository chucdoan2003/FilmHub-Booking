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
        <form action="{{ route('showtimes.update', $showtime->showtime_id) }}" method="POST" id="myForm">
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
                            <input type="date" name="date_time" id="datetime" value="{{ $showtime->datetime }}" >
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
                                <option value="{{ $item->movie_id }}"
                                    @if ($item->movie_id == $showtime->movie_id)
                                    @selected(true)
                                @endif>{{ $item->title}}</option>
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
                        <select name="room" id=""  >
                            @foreach ($rooms as $item)
                                <option value="{{ $item->room_id }}"
                                    @if(in_array($item->room_id, $room_over) && $item->room_id != $showtime->room_id )
                                    @disabled(true)
                                    @endif
                                    @if ($item->room_id == $showtime->room_id)
                                    @selected(true)
                                    @endif
                                    >{{ $item->room_name }}</option>
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
                                <option value="{{ $item->shift_id }}"
                                    @if (in_array($item->shift_id, $shiftInroomBook) && $item->shift_id != $showtime->shift_id )
                                    @disabled(true)


                                    @endif
                                    @if ($item->shift_id == $showtime->shift_id)
                                    @selected(true)
                                    @endif
                                    >{{ $item->shift_name }} - {{ $item->start_time }} - {{ $item->end_time }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Giá tiền</h6>
                    </div>
                    <div class="card-body">
                        <label for="value">Nhập giá tiền:</label>
                        <input type="text" name="value" id="value" class="form-control" value="{{$showtime->value}}" required>
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
@endsection
