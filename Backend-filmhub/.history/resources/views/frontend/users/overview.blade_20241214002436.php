@extends('frontend.layouts.master2')
@section('content')
<div class="prs_es_about_main_section_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="prs_es_about_left_wrapper">
                    <h2>User Overview</h2>
                    <h4>User name:

                    @if (Auth::user()->name==null)
                        Trống
                    @else
                        {{Auth::user()->name}}

                    @endif</h4>
                    <p>Email: {{Auth::user()->email}} </p>
                    <p>Member poin: {{Auth::user()->member_point}} </p>
                    <p>Description: </p>
                    <a href="{{route('editUserInfor')}}"><button style="padding: 6px 8px; margin: 12px 0; background-color: rgb(33, 127, 203); border-radius: 5px; color: #fff; border: none">Edit information</button></a>
                    <a href="{{route('editUserInfor')}}"><button style="padding: 6px 8px; margin: 12px 0; background-color: rgb(33, 127, 203); border-radius: 5px; color: #fff; border: none">Payment History</button></a>
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
