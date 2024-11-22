@extends('admin.layouts.master')

@section('title')
    Vourcher
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
                    <h6 class="m-0 font-weight-bold text-primary">Add new vourcher</h6>
                </div>
               
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('vourchers.update', $vourcher->id) }}" method="POST" class="user">
                        @csrf
                        @method("PUT")
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="Vourcher code" name="vourcher_code" value="{{$vourcher->vourcher_code}}">
                                    @if ($errors->has('vourcher_code'))
                                        <div class="text-danger mt-1">{{ $errors->first('vourcher_code') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Vourcher price" name="vourcher_price" min="0" max="100" value="{{$vourcher->vourcher_price}}">
                                    @if ($errors->has('vourcher_price'))
                                        <div class="text-danger mt-1">{{ $errors->first('vourcher_price') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-sm-6">
                                <label for="">Start time</label>

                                <input type="datetime-local" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Start time" name="start_time" value="{{$vourcher->start_time}}" >
                                    @if ($errors->has('start_time'))
                                        <div class="text-danger mt-1">{{ $errors->first('start_time') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="">End time</label>
                                <input type="datetime-local" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="End time" name="end_time" value="{{$vourcher->end_time}}">
                                    @if ($errors->has('end_time'))
                                        <div class="text-danger mt-1">{{ $errors->first('end_time') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6 mt-3 ">
                                <label class="mr-3" for="">Loại mã giảm giá</label>
                                <select name="vourcher_type" id="">
                                    <option value="1" @if($vourcher->type==1){ @selected(true)} @endif>Giảm giá %</option>
                                    <option value="0" @if($vourcher->type==0){ @selected(true)} @endif>Giảm giá trực tiếp</option>
                                </select>
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
