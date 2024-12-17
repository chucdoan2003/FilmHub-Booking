@extends('frontend.layouts.master2')
@section('content')
<div class="prs_es_about_main_section_wrapper">
    <div class="container">
        <div class="row">
            @if (isset($user))
                <p>Chúng tôi gửi yêu cầu đổi mật khẩu về gmail của bạn, vui lòng check mail để đổi mật khẩu
                <a href="{{route('getLogin')}}"><button style="padding: 6px 8px; margin: 12px 0; background-color: rgb(203, 44, 33); border-radius: 5px; color: #fff; border: none">Đăng nhập</button></a>
                </p>
            @else
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
                    <a href="{{route('editUserInfor')}}"><button style="padding: 6px 8px; margin: 12px 0; background-color: rgb(33, 127, 203); border-radius: 5px; color: #fff; border: none">Chỉnh sửa thông tin</button></button></a>
                    <form action="{{route('auth.changePassword')}}" method="POST">
                        @csrf
                        @method('POST')
                        <button onclick="return confirm('Bạn có muốn đổi mật khẩu không ? chúng tôi sẽ gửi link đổi mật khẩu về email của bạn')" type="submit" style="padding: 6px 8px; margin: 12px 0; background-color: rgb(73, 203, 33); border-radius: 5px; color: #fff; border: none">Quên mật khẩu</button>
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
                
            @endif
           
        </div>
    </div>
</div>

@endsection
