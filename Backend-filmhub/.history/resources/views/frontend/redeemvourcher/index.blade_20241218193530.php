<style>
    .table {
        width: 100%;
        margin-bottom: 20px;
        background-color: #fff;
        border-collapse: collapse;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: center;
        font-size: 1rem;
        color: #444;
    }

    .table thead {
        background-color: rgb(255, 38, 0);
        color: #fff;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-bordered {
        border: 1px solid #090909;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
    }

    .table-danger {
        background-color: #f8d7da !important;
    }

    .table td {
        font-size: 1rem;
        color: #333;
    }

    /* Button Style */
    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn:focus {
        outline: none;
    }

    /* Responsive Design
    @media (max-width: 768px) {

        .table th,
        .table td {
            font-size: 0.9rem;
            padding: 8px;
        }

        .container {
            padding: 10px;
        }
    } */
</style>

@extends('frontend.layouts.master4')
@section('content')
    <div class="container mt-5">
        <h1>Ví Mã Giảm Giá</h1>
        <a href="{{ route('redeem.form') }}" class="btn btn-primary mt-3">Đổi Voucher</a>
        <table class="table table-bordered table-striped table-hover mt-3">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-white">Mã</th>
                    <th class="text-white">Nội dung</th>
                    <th class="text-white">Giảm Giá (%)</th>
                    <th class="text-white">Số Tiền Giảm Tối Đa</th>
                    <th class="text-white">Số lượng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voucherCounts  as $voucher)
                <tr class="">
                <td>{{ $voucher['code'] }}</td>
                <td>{{ $voucher['name'] }}</td>
                <td>{{ $voucher['discount_percentage'] }}</td>
                <td>{{ $voucher['max_discount_amount'] }}</td>
                <td>{{ $voucher['count'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <h2 class="mt-5">Danh sách Voucher Event</h2>
        <table class="table table-bordered table-striped table-hover mt-4">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-white">Tên Sự Kiện</th>
                    <th class="text-white">Mã</th>
                    <th class="text-white">Nội dung</th>
                    <th class="text-white">Giảm Giá (%)</th>
                    <th class="text-white">Số Tiền Giảm Tối Đa</th>
                    <th class="text-white">Thời Gian Kết Thúc</th>
                    <th class="text-white">Thời hạn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vourcherEvents as $event)
                <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ $event->vourcher_code }}</td>
                    <td>{{ $event->vourcher_name }}</td>
                    <td>{{ $event->discount_percentage }}</td>
                    <td>{{ $event->max_discount_amount }}</td>
                    <td>{{ $event->end_time }}</td>
                    <td>
                        @if (\Carbon\Carbon::now()->greaterThan($event->end_time))
                            <span class="text-danger">Hết hạn</span>
                        @else
                            <span class="text-success">Còn thời hạn</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
