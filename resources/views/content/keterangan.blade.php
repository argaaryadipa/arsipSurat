@include('header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Keterangan Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Keterangan Surat</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><button class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Data</button></h3>
        </div>
        <div class="card-body">
          <table id="example2" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Keterangan</th>
                <th>Format Keterangan</th>
                <th width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!--tabel data-->
              @php
                 $no = 1;
              @endphp
              @forelse ( $listKeterangan as $row )
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->keterangan }}</td>
                  <td>{{ $row->kode_keterangan }}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus{{$row->id_keterangan}}">
                        <i class="fas fa-trash"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEdit{{$row->id_keterangan}}">
                        <i class="fas fa-edit"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <td colspan="4" align="center">
                    Data keterangan belum tersedia.
                </td>
              @endforelse
                
            </tbody>
          </table>
        </div>
      </div>
      <!-- form input -->
      <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Keterangan Surat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('keterangan.tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="col-12">
                <label class="pt-2">Format</label>
                <input class="form-control form-control-sm" type="text" required name="KodeKeterangan" placeholder="Contoh : SKet">
              </div>
              {{-- <div class="col-12">
                <label class="pt-2">Nama Keterangan</label>
                <input class="form-control form-control-sm" type="number" required name="nomer" placeholder="Contoh : Surat Keterangan">
              </div> --}}
              <div class="col-12">
                <label class="pt-2">Nama Keterangan</label>
                <input class="form-control form-control-sm" type="text" required name="Keterangan" placeholder="Contoh : Surat Keterangan">
              </div>
            </div>
            <div class="modal-footer justify-content">
              <button type="reset" class="btn btn-warning btn-sm"><i class="fas fa-refresh" arial-hidden="true"></i> Kosongkan</button>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @foreach ($listKeterangan as $row2)
      <div class="modal fade" id="modalHapus{{ $row2->id_keterangan }}">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('keterangan.hapus') }}" method="POST">
              @csrf
              <div class="modal-body">
                <input type="text" value="{{$row2->id_keterangan}}" name="id" hidden>
                Anda yakin ingin menghapus data {{ $row2->keterangan }} ?
              </div>
              <div class="modal-footer justify-content">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-refresh" arial-hidden="true"></i> Batalkan</button>
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
              </div>
              @method('DELETE')
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modalEdit{{ $row2->id_keterangan }}">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Keterangan Surat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('keterangan.edit', $row2->id_keterangan ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="col-12">
                <label class="pt-2">Format</label>
                <input type="text" name="id" value="{{ $row2->id_keterangan }}" hidden>
                <input class="form-control form-control-sm" type="text" required name="KodeKeterangan" value="{{ $row2->kode_keterangan }}">
              </div>
              <div class="col-12">
                <label class="pt-2">Nama Keterangan</label>
                <input class="form-control form-control-sm" type="text" required name="Keterangan" value="{{ $row2->keterangan }}">
              </div>
            </div>
            <div class="modal-footer justify-content">
              <button type="reset" class="btn btn-warning btn-sm"><i class="fas fa-refresh" arial-hidden="true"></i> Kosongkan</button>
              <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endforeach
    </section>
    <!-- /.content -->
  </div>
  @include('footer')