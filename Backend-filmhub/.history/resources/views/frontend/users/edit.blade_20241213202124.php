@extends('frontend.layouts.master2')
@section('content')
<div class="prs_es_about_main_section_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="prs_es_about_left_wrapper">
                    <h2>Edit user information</h2>
                    <form action="{{route('updateUserInfor')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("POST")
                       <div>
                            <p for="">User name</p>
                            <input type="text" value="{{Auth::user()->name}}" name="name" style="width: 100%; border-radius: 5px; padding: 4px 12px;border:1px solid rgb(40, 215, 40)">
                       </div>
                       <div>
                        <p for="">Email</p>
                            <input type="text" value="{{Auth::user()->email}}" name="email"style="width: 100%; border-radius: 5px; padding: 4px 12px; border:1px solid rgb(40, 215, 40)" disabled>
                       </div>
                       <div>
                        <p for="">Image avatar</p>
                        <input type="file" name="avt" style="width: 100%; border-radius: 5px; padding: 4px 12px; border:1px solid rgb(40, 215, 40)">
                       </div>
                       <button style="padding: 6px 8px; margin: 12px 0; background-color: rgb(225, 43, 43); border-radius: 5px; color: #fff; border: none">Submit</button>
                    </form>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="hs_blog_box1_img_wrapper prs_event_single_slider_wrapper">
                    <div class="">
                        <div class="item" style="width: 300px; height: 450px; object-fit: cover">
                            <img src="{{Storage::url(Auth::user()->avt)}}" alt="blog_img">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
