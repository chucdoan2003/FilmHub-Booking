@extends('frontend.layouts.master2')
@section('title', $category->name ?? '')
@section('content')
    <div class="prs_title_main_sec_wrapper">
        <div class="prs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="prs_title_heading_wrapper">
                        <h2>{{ $category->name ?? 'Blog Category' }}</h2>
                        <ul>
                            <li><a href="{{ route('movies.index') }}">Home</a>
                            </li>
                            <li>&nbsp;&nbsp; >&nbsp;&nbsp; {{ $category->name ?? 'Blog Category' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs title wrapper End -->
    <!-- hs sidebar Start -->
    <div class="hs_blog_categories_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="hs_blog_left_sidebar_main_wrapper">
                        <div class="row">
                            @forelse ($postByCategory as $item)
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="hs_blog_box1_main_wrapper" style="margin-bottom: 30px">
                                        <div class="hs_blog_box1_img_wrapper" >
                                            <a href="{{ route('postDetail', $item->id) }}"> <img

                                                    src="{{ isset($item->avatar) ? asset($item->avatar) : asset('theme/admin/img/no_image.jpg') }}"
                                                    alt="{{ $item->name }}"></a>
                                        </div>
                                        <div class="hs_blog_box1_cont_main_wrapper">
                                            <div class="hs_blog_cont_heading_wrapper">
                                                <ul>
                                                    <li>{{ $item->created_at }}</li>
                                                    <li>by Admin</li>
                                                </ul>
                                                <h2>{{ $item->name }}</h2>
                                                <p>{{ Str::limit($item->description, 300, '...') }}</p>
                                                <h5><a href="{{ route('postDetail', $item->id) }}">Read More <i
                                                            class="fa fa-long-arrow-right"></i></a>
                                                </h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <p>Không có bài viết nào.</p>
                            @endforelse

                        </div>
                    </div>
                    @if ($postByCategory->lastPage() > 1)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pager_wrapper prs_blog_pagi_wrapper">
                                {{ $postByCategory->links('pagination.custom-pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="hs_blog_right_sidebar_main_wrapper">
                        <div class="prs_mcc_bro_title_wrapper">
                            <h2>Danh mục </h2>
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
                                <h2>Tin tức mới nhất </h2>
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
