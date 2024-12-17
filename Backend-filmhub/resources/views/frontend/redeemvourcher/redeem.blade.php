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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $voucher->vourcher_name }}</h5>
                        <p class="card-text">Mã Giảm Giá: {{ $voucher->vourcher_code }}</p>
                        <p class="card-text">Điểm cần thiết: {{ $voucher->required_points }}</p>
                        <p class="card-text">Giảm Giá: {{ $voucher->discount_percentage }}%</p>
                        <p class="card-text">Số Tiền Giảm Tối Đa: {{ $voucher->max_discount_amount }} VNĐ</p>
                        <form action="{{ route('redeem.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="voucher_code" value="{{ $voucher->vourcher_code }}">
                            <button type="submit" class="btn btn-primary">Đổi Voucher</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection