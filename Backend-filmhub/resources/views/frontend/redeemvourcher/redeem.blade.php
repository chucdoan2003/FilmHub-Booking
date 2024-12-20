@extends('frontend.layouts.master4')

@section('content')
<style>
    .voucher-card {
    border: 1px solid #aba9a9; /* Thêm border cho thẻ card */
    border-radius: 8px; /* Bo góc cho border */
    margin-bottom: 20px; /* Khoảng trống giữa các sản phẩm */
    padding: 15px; /* Padding bên trong thẻ card */
    transition: box-shadow 0.3s; /* Hiệu ứng khi hover */
}

.voucher-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng khi hover */
}
</style>
<div class="container mt-5">
    <h1>Danh sách Voucher</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>
    <h4 class="mt-3"><strong>Điểm hiện tại của bạn:</strong> {{ $user->member_point }} điểm</h4> <!-- Hiển thị điểm của người dùng --> <br>
    <div class="row mt-4">
        @foreach ($vouchers as $voucher)
            <div class="col-md-4 mb-3">
                <div class="voucher-card shadow-sm">
                    <div class=" shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 30px; color:rgb(255, 0, 68)">{{ $voucher->vourcher_code }}</h5>
                        <p class="card-text"><strong>Chi tiết:</strong> {{ $voucher->vourcher_name }}</p>
                        <p class="card-text"><strong>Điểm cần thiết:</strong> {{ $voucher->required_points }}</p>
                        <p class="card-text"><strong>Giảm Giá:</strong> {{ $voucher->discount_percentage }}%</p>
                        <p class="card-text"><strong>Số Tiền Giảm Tối Đa:</strong> {{ number_format($voucher->max_discount_amount, 0, ',', '.') }} VNĐ</p>
                        <form action="{{ route('redeem.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="voucher_code" value="{{ $voucher->vourcher_code }}">
                            <button type="submit" class="btn btn-primary w-100 mt-3">Đổi Voucher</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
