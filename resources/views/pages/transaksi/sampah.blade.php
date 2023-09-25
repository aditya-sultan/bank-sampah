@extends('layouts.main')

@section('title')
    Jenis-Jenis Sampah
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
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach ($sampah as $item)
                                <tr>
                                    <td class="p-0 text-center">
                                        {{ $i }}
                                    </td>
                                    <td>
                                        {{ $item->jenis->nama }}
                                    </td>
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    <td>
                                        <img alt="image" src="{{ asset('image/' . $item->foto) }}" class="rounded-circle"
                                            width="35" data-toggle="tooltip">
                                    </td>
                                    <td>{!! $item->deskripsi !!}</td>
                                    <td>Rp.{{ $item->harga }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter{{ $item->id }}">Pilih</button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </table>
                        <div>
                            {{ $sampah->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@foreach ($sampah as $item)
    <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ $item->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaksi.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="id_sampah" value="{{ $item->id }}">
                        <input type="number" class="form-control" name="qty">
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
