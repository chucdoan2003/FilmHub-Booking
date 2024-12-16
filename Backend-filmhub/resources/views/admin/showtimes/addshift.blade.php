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
            @if(isset($errors['isNotEnoughtTime']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'isNotEnoughtTime'
                ]}}</span>
            </div>
            @endif
            @if(isset($errors['price_not_except']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'price_not_except'
                ]}}</span>
            </div>
            @endif
            @if(isset($errors['start_end_time']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'start_end_time'
                ]}}</span>
            </div>
            @endif
            @if(isset($errors['normal_price_null']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'normal_price_null'
                ]}}</span>
            </div>
            @endif

            @if(isset($errors['vip_price_null']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'vip_price_null'
                ]}}</span>
            </div>
            @endif

            @if(isset($errors['startime_endtime']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'startime_endtime'
                ]}}</span>
            </div>
            @endif

            @if(isset($errors['shift_not_except']))
            <div class="alert alert-danger" role="alert">
                <span>{{$errors[
                   'shift_not_except'
                ]}}</span>
                <h5>List shift in date </h5>
                <ul>
                    @foreach( $showtimes as $show)
                        <li>
                            {{$show->start_time}} - {{$show->end_time}}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Date</h6>
</div>


                        <!-- Card Body -->

                        <div class="card-body">
                            <input type="date" name="datetime" @if(isset($datetime)) value="{{$datetime}}" @endif id="datetime" >

                        </div>

                </div>
            {{-- <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Theater</h6>
                    </div>


                    <!-- Card Body -->

                    <div class="card-body">
                        <input @if(!empty($theaters)) type="text" name="theater"  value="{{$theaters->name}}"

                        @else
                        type="hidden" value="Theater not found"

                        @endif   disabled >

                    </div>

            </div> --}}



                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Movie</h6>
                    </div>

                    <!-- Card Body -->

                    <div class="card-body">
                        <select name="movie">
                            @foreach ($movies as $item)
                                <option value="{{ $item->movie_id }}"
                                    @if (isset($movie_id) && $item->movie_id == $movie_id)
                                    @selected(true)
                                @endif
                                >{{ $item->title }}</option>
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
                        <select name="room"  >
                            @foreach ($rooms as $item)
                                <option value="{{ $item->room_id }}"
                                    @if (isset($room_id) && $item->room_id == $room_id)
                                    @selected(true)
                                @endif

                                    >{{ $item->room_name }}</option>
                            @endforeach
</select>
                    </div>

                </div>

                {{-- <div class="card shadow mb-4">
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
                                    @if (in_array($item->shift_id, $shiftInroomBook))
                                    @disabled(true)

                                    @endif
                                    >{{ $item->shift_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div> --}}
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Start time</h6>
                    </div>


                    <!-- Card Body -->

                    <div class="card-body">
                        <input type="time" class="form-control form-control-user form-radius" id="start_time"
                        name="start_time" @if(isset($start_time)) value="{{$start_time}}" @endif>
                    </div>

                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">End time</h6>

                    </div>


                    <!-- Card Body -->

                    <div class="card-body">
                        <input type="time" class="form-control form-control-user form-radius" id="end_time"
                        name="end_time" @if(isset($end_time)) value="{{$end_time}}" @endif>
                        <div id="error_message" style="color: red"></div>

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
                        placeholder="100.000" name="normal_price" @if(isset($normal_price)) value="{{$normal_price}}" @endif id="normal_price">
                    </div>

                </div>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Vip Price</h6>
                    </div>


                    <!-- Card Body -->

                    <div class="card-body">
                        <input type="text" class="form-control form-control-user form-radius" id="exampleLastName"
                        placeholder="100.000" name="vip_price" @if(isset($vip_price)) value="{{$vip_price}}" @endif id="vip_price">
                        <div id="price_message" style="color: red"></div>
                    </div>

                </div>
                <input type="hidden" id="between_timestart_end" value="11" name="shift_minute">

            <button class="btn btn-primary btn-user btn-block">
                        Submit
            </button>
        </form>
    </div>
    <script>
  document.getElementById('myForm').addEventListener('submit', function(e) {
    const select1 = document.querySelector('select[name="movie"]');
    const select2 = document.querySelector('select[name="room"]');
    const select3 = document.querySelector('input[name="datetime"]');

    const shift_minute = document.querySelector('input[name="shift_minute"]');
    const select4 = document.querySelector('select[name="theater"]');
    select1.disabled = false;  // Kích hoạt lại trước khi submit
    select2.disabled = false;  // Kích hoạt lại trước khi submit
    select3.disabled = false;  // Kích hoạt lại trước khi submit
    select4.disabled = false;  // Kích hoạt lại trước khi submit
    var start_time = document.getElementById("start_time").value;
    var end_time = document.getElementById("end_time").value;
    var normal_price = document.getElementById('normal_price').value;
    var vip_price = document.getElementById('vip_price').value;

    // Convert times to Date objects for comparison
    // var start = new Date("1970-01-01T" + start_time + "Z");
    // var end = new Date("1970-01-01T" + end_time + "Z");
    // if (start >= end) {
    //     // Display error message if validation fails
    //     document.getElementById("error_message").innerText = "end time must be larger than start time.";
    //     e.preventDefault();

    // }

    // var differenceInMilliseconds = end - start;
    // var differenceInMinutes = differenceInMilliseconds / (1000 * 60);
    // shift_minute.value = differenceInMinutes;



  });

</script>
@endsection
