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
            @if(isset($errors['image']))
                <div class="alert alert-danger" role="alert">
                    <span>{{$errors[
                    'image'
                    ]}}</span>
                </div>
            @endif
        <form action="{{ route('banner.update', $banner->banner_id) }}" method="POST" class="user" enctype="multipart/form-data" >
            @csrf
            @method("PUT")
                <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<<<<<<< HEAD:Backend-filmhub/resources/views/admin/showtimes/add2.blade.php
                            <h6 class="m-0 font-weight-bold text-primary">Date</h6>
=======
                            <h6 class="m-0 font-weight-bold text-primary">Tên ảnh</h6>
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5:Backend-filmhub/resources/views/admin/banner/edit.blade.php
                        </div>

                        <!-- Card Body -->

                        <div class="card-body">
                            <input type="text" value="{{$banner->name}}" class="form-control form-control-user form-radius" placeholder="Avt..." name="name">
                        </div>

                </div>
<<<<<<< HEAD:Backend-filmhub/resources/views/admin/showtimes/add2.blade.php
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Theaters</h6>
                    </div>

                    <!-- Card Body -->

                    <div class="card-body">
                        <select name="theater" id="" disabled>
                            @foreach ($theaters as $item)
                                <option value="{{$item->theater_id}}"
                                     @if($item->theater_id == $theater)
                                        @selected(true)
                                    @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

=======
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5:Backend-filmhub/resources/views/admin/banner/edit.blade.php
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Image</h6>
                    </div>

                    <!-- Card Body -->

                    <div class="card-body">
                        <input type="file"  name="image">
                    </div>
                    <div>
                        <img src="{{Storage::url($banner->image)}}" style="max-width: ̃318px; max-height: 159px; object-fit:cover" alt="">
                    </div>

                </div>
            <button class="btn btn-primary btn-user btn-block">
                       Submit
            </button>
        </form>
    </div>
<<<<<<< HEAD:Backend-filmhub/resources/views/admin/showtimes/add2.blade.php

<script>
  document.getElementById('myForm').addEventListener('submit', function() {
    // const select1 = document.querySelector('select[name="movie"]');
    const select2 = document.querySelector('select[name="theater"]');
    const select3 = document.querySelector('input[name="datetime"]');
    // select1.disabled = false;  // Kích hoạt lại trước khi submit
    select2.disabled = false;  // Kích hoạt lại trước khi submit
    select3.disabled = false;  // Kích hoạt lại trước khi submit
  });
</script>
=======
>>>>>>> c34dbe889404f10f96635ee1e20595a13ffb06b5:Backend-filmhub/resources/views/admin/banner/edit.blade.php
@endsection
