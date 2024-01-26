@include('header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Surat</li>
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
                <th>Jenis Surat / Keterangan</th>
                <th>Nomor Surat</th>
                <th>Keterangan</th>
                <th width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                 $no = 1;
              @endphp
              @forelse ( $listSurat as $row )
                <tr>
                  <td align="center">{{ $no++ }}</td>
                  <td>{{ $row->jenis_surat }} / {{ $row->keterangan }}</td>
                  <td>{{ $row->kode_surat }}</td>
                  <td>{{ $row->perihal }}</td>
                  <td>
                      <div class="btn-group">
                        <a href="{{ asset('uploads/'.$row->file ) }}" type="button" class="btn btn-sm btn-primary" target="_blank">
                          <i class="fas fa-file"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEdit{{$row->id_surat}}">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus{{$row->id_surat}}">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                  </td>
                </tr>
              @empty
                <td colspan="5" align="center">
                    Data surat belum tersedia.
                </td>
              @endforelse
                
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card -->
      <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Surat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('surat.tambah') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('POST')
              <div class="modal-body">
                <div class="col-12">
                  <label class="pt-2">Jenis Surat</label>
                  <select name="jenis_surat" class="form-control form-control-sm select2">
                    <option value="Null">Pilih Jenis</option>
                    <option value="Masuk">Surat Masuk</option>
                    <option value="Keluar">Surat Keluar</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="pt-2">Keterangan Surat</label>
                  <select class="form-control form-control-sm select2" name="id_keterangan">
                    <option value="Null">Pilih Keterangan</option>
                    @foreach ($listKeterangan as $row2)
                    <option value="{{ $row2->id_keterangan }}">{{$row2->keterangan}} ({{$row2->kode_keterangan}})</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12">
                  <label class="pt-2">Nomor Surat</label>
                  <input class="form-control form-control-sm" type="text" required name="kode_surat" placeholder="Contoh : MA.SKet/001/VI/2023" value="<kode keterangan> / {{ $no }} / {{ $bulan }} / {{ $tahun }}">
                </div>
                <div class="col-12">
                  <label class="pt-2">Perihal</label>
                  <input class="form-control form-control-sm" type="text" required name="perihal" placeholder="Contoh : Arsip surat keputusan panitia kegiatan PPDB">
                </div>
                <div class="col-12">
                  <label class="pt-2">Berkas</label>
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file" required>
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
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
      @foreach ( $listSurat as $rowedit)

      <div class="modal fade" id="modalHapus{{ $rowedit->id_surat }}">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('surat.hapus', $rowedit->id_surat) }}" method="POST">
              @csrf
              <div class="modal-body">
                <input type="text" value="{{$rowedit->id_surat}}" name="id" hidden>
                Anda yakin ingin menghapus data {{ $rowedit->perihal }} ?
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

      <div class="modal fade" id="modalEdit{{ $rowedit->id_surat }}">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Data Surat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('surat.ubah', $rowedit->id_surat) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('POST')
              <div class="modal-body">
                <div class="col-12">
                  <label class="pt-2">Jenis Surat</label>
                  <select name="jenis_surat" class="form-control form-control-sm select2">
                    @if ($rowedit->jenis_surat == 'Masuk')
                      <option value="Masuk" selected>Masuk</option>
                      <option value="Keluar">Keluar</option>
                    @else
                      <option value="Masuk">Masuk</option>
                      <option value="Keluar" selected>Keluar</option>
                    @endif
                  </select>
                </div>
                <div class="col-12">
                  <label class="pt-2">Keterangan Surat</label>
                  <select class="form-control form-control-sm select2" name="id_keterangan">
                    <option value="Null">Pilih Keterangan</option>
                    @foreach ($listKeterangan as $row2)
                    <option value="{{ $row2->id_keterangan }}" {{ $rowedit->id_keterangan == $row2->id_keterangan ? "selected" : "" }}>{{$row2->keterangan}} ({{$row2->kode_keterangan}})</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-12">
                  <label class="pt-2">Nomor Surat</label>
                  <input class="form-control form-control-sm" type="text" required name="kode_surat" placeholder="Contoh : MA.SKet/001/VI/2023" value="{{ $rowedit->kode_surat }}">
                </div>
                <div class="col-12">
                  <label class="pt-2">Perihal</label>
                  <input class="form-control form-control-sm" type="text" required name="perihal" placeholder="Contoh : Arsip surat keputusan panitia kegiatan PPDB" value="{{ $rowedit->perihal }}">
                </div>
                <div class="col-12">
                  <label class="pt-2">Berkas</label>
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
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