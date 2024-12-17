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
                    <h3>Payment History</h3>
                    <table class="table table-bordered" style="width: 100%; border-radius: 8px; overflow: hidden;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ number_format($payment->amount, 0, ',', '.') }} VND</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y H:i') }}</td>
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
