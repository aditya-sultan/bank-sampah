@extends('layouts.main')

@section('title')
    Invoice
@endsection

@section('container')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>{{ $transaksi->sampah->nama }}</h2>
                                <div class="invoice-number"></div>
                            </div>
                            <hr>
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ \Carbon\Carbon::parse($transaksi->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order By</div>
                            <p class="section-lead">{{ $transaksi->user->name }}</p>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Qty</div>
                                        <div class="invoice-detail-value">{{ $transaksi->qty }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">Rp.{{ $transaksi->total }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
