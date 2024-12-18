@extends('frontend.layouts.master4')
@section('content')
    <div class="container mt-5">
        <h2>Danh sách Voucher đang có</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Mã Giảm Giá</th>
                    <th>Tên Giảm Giá</th>
                    <th>Giảm Giá (%)</th>
                    <th>Số Tiền Giảm Tối Đa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vouchers as $voucher)
                <tr class="{{ in_array($voucher->id, $usedVouchers) ? 'used' : '' }}">
                    <td>{{ $voucher->id }}</td>
                    <td>{{ $voucher->user->email ?? 'N/A' }}</td> <!-- Hiển thị email -->
                    <td>{{ $voucher->vourcher_code }}</td>
                    <td>{{ $voucher->vourcher_name }}</td>
                    <td>{{ $voucher->discount_percentage }}</td>
                    <td>{{ $voucher->max_discount_amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('redeem.form') }}" class="btn btn-primary">Đổi Voucher</a>

        <h2 class="mt-5">Danh sách Voucher Event</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sự Kiện</th>
                    <th>Mã Giảm Giá</th>
                    <th>Mô tả</th>
                    <th>Giảm Giá (%)</th>
                    <th>Số Tiền Giảm Tối Đa</th>
                    <th>Thời Gian Bắt Đầu</th>
                    <th>Thời Gian Kết Thúc</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vourcherEvents as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->vourcher_code }}</td>
                    <td>{{ $event->vourcher_name }}</td>
                    <td>{{ $event->discount_percentage }}</td>
                    <td>{{ $event->max_discount_amount }}</td>
                    <td>{{ $event->start_time }}</td>
                    <td>{{ $event->end_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
