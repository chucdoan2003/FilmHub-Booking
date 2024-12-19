@extends('admin.layouts.master')

@section('title')
    Event Vourcher
@endsection
@section('content')
<style>
    table{
        width: 100%;
    }
    td, th{
        padding: 6px 8px;
    }
    
    .form-radius{
        border-radius: 8px !important;
    }
</style>
   <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sửa mã giảm giá</h6>
                </div>
               
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('vourcher-events.update', $vourcherEvent->id) }}" method="POST" class="user">
                        @csrf
                        @method("PUT")
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="exampleFirstName">Mã giảm giá</label>
                                <input type="text" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="Vourcher code" name="vourcher_code" value="{{$vourcherEvent->vourcher_code}}">
                                    @if ($errors->has('vourcher_code'))
                                        <div class="text-danger mt-1">{{ $errors->first('vourcher_code') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleLastName">Nội dung</label>
                                <input type="text" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Vourcher Name" name="vourcher_name" min="0" max="100" value="{{$vourcherEvent->vourcher_name}}">
                                    @if ($errors->has('vourcher_name'))
                                        <div class="text-danger mt-1">{{ $errors->first('vourcher_name') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="event">Sự kiện</label>
                                <input type="text" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="event_name" name="event_name" value="{{$vourcherEvent->event_name}}">
                                    @if ($errors->has('event_name'))
                                        <div class="text-danger mt-1">{{ $errors->first('event_name') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="start_time">%</label>
                                <input type="number" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="Discount percentage" name="discount_percentage" value="{{$vourcherEvent->discount_percentage}}">
                                    @if ($errors->has('discount_percentage'))
                                        <div class="text-danger mt-1">{{ $errors->first('discount_percentage') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Tối đa</label>
                                <input type="number" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Max discount amount" name="max_discount_amount" value="{{$vourcherEvent->max_discount_amount}}">
                                    @if ($errors->has('max_discount_amount'))
                                        <div class="text-danger mt-1">{{ $errors->first('max_discount_amount') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="start_time">Thời gian bắt đầu</label>
                                <input type="datetime-local" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="start_time" name="start_time" value="{{$vourcherEvent->start_time}}">
                                    @if ($errors->has('start_time'))
                                        <div class="text-danger mt-1">{{ $errors->first('start_time') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="start_time">Thời gian kết thúc</label>
                                <input type="datetime-local" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="end_time" name="end_time" value="{{$vourcherEvent->end_time}}">
                                    @if ($errors->has('end_time'))
                                        <div class="text-danger mt-1">{{ $errors->first('end_time') }}</div>
                                    @endif
                            </div>
                        </div>
                        
                        <button class="btn btn-primary btn-user btn-block">
                            Create Vourcher
                        </button>
                        
                    </form>

            

                    
                </div>
            </div>
        </div>
@endsection
