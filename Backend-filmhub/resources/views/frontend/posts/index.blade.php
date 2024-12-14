@extends('frontend.layouts.master2')
@section('title', $post->name ?? '')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v21.0"></script>

    <div class="prs_title_main_sec_wrapper">
        <div class="prs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_title_heading_wrapper">
                        <h2>{{ $post->name ?? 'Blog' }}</h2>
                        <ul>
                            <li><a href="{{ route('movies.index') }}">Home</a>
                            </li>
                            <li>&nbsp;&nbsp; >&nbsp;&nbsp; {{ $post->name ?? 'Blog' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs title wrapper End -->
    <div class="hs_blog_categories_main_wrapper hs_blog_categories_main_wrapper2">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="hs_blog_left_sidebar_main_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="hs_blog_box1_main_wrapper">
                                    <div class="hs_blog_box1_img_wrapper">
                                        <img src="{{ isset($post->avatar) ? asset($post->avatar) : asset('theme/admin/img/no_image.jpg') }}" alt="{{ $post->name }}">
                                    </div>
                                    <div class="hs_blog_box1_cont_main_wrapper">
                                        <div class="hs_blog_cont_heading_wrapper">
                                            <ul>
                                                <li>{{ $post->created_at ?? '' }}</li>
                                                <li>by Admin</li>
                                            </ul>
                                            <h2>{{ $post->name ?? '' }}</h2>
                                            <p>{{{ $post->description ?? '' }}}</p>
                                            </p>

                                            {!!$post->content ?? 'Đang cập nhật nội dung.'!!}
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="prs_bs_comment_heading_wrapper">
                                    <h2>Comments</h2>
                            </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="hs_rs_comment_main_wrapper hs_rs_comment_main_wrapper2">
                                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
								</div>
							</div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="hs_blog_right_sidebar_main_wrapper">
                        <div class="prs_mcc_bro_title_wrapper">
                            <h2>Category</h2>
                            <ul>

                                @foreach ($listCategory as $item)
                                    <li><i class="fa fa-caret-right"></i> &nbsp;&nbsp;&nbsp;<a
                                            href="{{ route('categoryPost', $item->id) }}">{{ $item->name }}
                                            <span>{{ $item->posts->count() }}</span></a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        @if ($postNew->count() > 0)
                            <div class="prs_mcc_bro_title_wrapper">
                                <h2>Recent News</h2>
                                @foreach ($postNew as $item)
                                    <a href="{{ route('postDetail', $item->id) }}">
                                        <div class="hs_blog_right_recnt_cont_wrapper">
                                            <div class="hs_footer_ln_img_wrapper">
                                                <img width="80px" height="80px"
                                                    src="{{ isset($item->avatar) ? asset($item->avatar) : asset('theme/admin/img/no_image.jpg') }}"
                                                    alt="{{ $item->name }}" />
                                            </div>
                                            <div class="hs_footer_ln_cont_wrapper">
                                                <h4>{{ $item->name }}</h4>
                                                <p>{{ date('d-m-Y', strtotime($item->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


