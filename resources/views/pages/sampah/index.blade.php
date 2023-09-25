@extends('layouts.main')

@section('title')
    Jenis-Jenis Sampah
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModalCenter">Tambah</button></h4>
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
                                            data-target="#basicModal{{ $item->id }}">Ubah</button>

                                        <form action="{{ route('sampah.destroy', $item->id) }}" method="post"
                                            onsubmit="return confirm('Anda akan menghapus item ini dari situs anda?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>


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
    <div class="modal fade" id="basicModal{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah {{ $item->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('sampah.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label>Jenis</label>
                        <select name="id_jenis" class="form-control">
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}" {{ $item->id_jenis == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-body">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ $item->nama }}">
                    </div>
                    <div class="modal-body">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" value="{{ $item->harga }}">
                    </div>
                    <div class="modal-body">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{!! $item->deskripsi !!}</textarea>
                    </div>
                    <div class="modal-body">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sampah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>Jenis</label>
                    <select name="id_jenis" class="form-control">
                        @foreach ($jenis as $j)
                            <option value="{{ $j->id }}">{{ $j->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-body">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="modal-body">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div class="modal-body">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>
                <div class="modal-body">
                    <label>Foto</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
