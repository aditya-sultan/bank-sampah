@extends('layouts.main')

@section('title')
    Riwayat Transaksi {{ Auth::user()->name }}
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Sampah</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="p-0 text-center">No.</th>
                                <th>Jenis Sampah</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Transaksi</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td class="p-0 text-center">
                                        {{ $i }}
                                    </td>
                                    <td>
                                        {{ $item->sampah->jenis->nama }}
                                    </td>
                                    <td>
                                        {{ $item->sampah->nama }}
                                    </td>
                                    <td>
                                        <img alt="image" src="{{ asset('image/' . $item->sampah->foto) }}"
                                            class="rounded-circle" width="35" data-toggle="tooltip">
                                    </td>
                                    <td>{!! $item->sampah->deskripsi !!}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp.{{ $item->total }}</td>
                                    <td>
                                        <a href="{{ route('transaksi.show', $item->id) }}"
                                            class="btn btn-primary">Invoice</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </table>
                        <div>
                            {{ $transaksi->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
