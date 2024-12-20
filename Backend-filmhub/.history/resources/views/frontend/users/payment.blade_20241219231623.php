@extends('frontend.layouts.master2')
@section('content')
@php
    $userId = session('user_id');

    $payments = \DB::table('payments')->where('user_id', $userId)->get();

@endphp
<div class="prs_es_about_main_section_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <div class="prs_es_payment_table_wrapper">
                    <h3>Lịch sử thanh toán </h3>
                    <table class="table table-bordered" style="width: 100%; border-radius: 8px; overflow: hidden;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tổng tiền </th>
                                <th>Phương thức thanh toán</th>
                                <th>Ngày tạo</th>
                                <th>Vé đã mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->payment_id }}</td>
                                <td>{{ number_format($payment->amount, 0, ',', '.') }} VND</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->payment_time }}</td>
                                <td>{{ $payment->ticket_id}}</td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
