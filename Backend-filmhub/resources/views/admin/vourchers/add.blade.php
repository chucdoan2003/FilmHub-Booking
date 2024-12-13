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
                    <form action="{{ route('vourchers.store') }}" method="POST" class="user">
                        @csrf
                        @method("POST")
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="Vourcher code" name="vourcher_code">
                                    @if ($errors->has('vourcher_code'))
                                        <div class="text-danger mt-1">{{ $errors->first('vourcher_code') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Vourcher Name" name="vourcher_name">
                                    @if ($errors->has('vourcher_name'))
                                        <div class="text-danger mt-1">{{ $errors->first('vourcher_name') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="required_points" name="required_points">
                                    @if ($errors->has('required_points'))
                                        <div class="text-danger mt-1">{{ $errors->first('required_points') }}</div>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user form-radius" id="exampleFirstName"
                                    placeholder="Discount percentage" name="discount_percentage">
                                    @if ($errors->has('discount_percentage'))
                                        <div class="text-danger mt-1">{{ $errors->first('discount_percentage') }}</div>
                                    @endif
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user form-radius" id="exampleLastName"
                                    placeholder="Max discount amount" name="max_discount_amount">
                                    @if ($errors->has('max_discount_amount'))
                                        <div class="text-danger mt-1">{{ $errors->first('max_discount_amount') }}</div>
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
