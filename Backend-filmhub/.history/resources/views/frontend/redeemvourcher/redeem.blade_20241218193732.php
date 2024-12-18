@extends('frontend.layouts.master4')
@section('content')
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

    <div class="row">
        @foreach ($vouchers as $voucher)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-light" style="margin: 20px; border:1px">
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
        @endforeach
    </div>
</div>
@endsection
