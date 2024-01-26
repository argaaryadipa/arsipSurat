@include('header')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Data Instansi</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Instansi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      @if (!empty($listInstansi))
        <!-- Default box -->
        @foreach ($listInstansi as $row)
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <i class="fa fa-university"></i> Data Instansi
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="card card-body">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <b>Opps!</b> {!! str_replace('_', ' ', implode('', $errors->all(':message<br>'))) !!}
              </div>
              @endif
                <center><img class="img-fluid img-circle" width="50%" height="50%"
                  src="{{asset('uploads/'.$row->file)}}"
                  alt="User profile picture">
                </center>
                <center><button class="btn btn-block btn-sm btn-primary mt-3" data-toggle="modal" data-target="#modalEditFoto"><i class="fa fa-image"></i> Ganti Foto</button></center>
              </div>
            </div>
            <div class="col-md-8">
              
              <div class="card card-primary">
                <div class="card-body box-profile">
    
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Nama Instansi</b> <a class="float-right">{{$row->nama_instansi}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Jenjang</b> <a class="float-right">{{$row->jenjang_instansi}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>NPSN</b> <a class="float-right">{{$row->npsn}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Alamat</b> <a class="float-right">{{$row->alamat_instansi}}</a>
                    </li>
                  </ul>
    
                  <a href="#" class="btn btn-primary btn-sm text-right" data-toggle="modal" data-target="#modalEdit"><b><i class="fas fa-edit"></i> Edit</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              
              <!-- Profile Image -->
            </div>
            
          </div>
        </div>
      </div>
      @endforeach
      <!-- /.card -->
      @foreach ($listInstansi as $row2)
      <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data Instansi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('instansi.edit', $row->id_instansi ) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="col-12">
                  <label class="pt-2">Nama Instansi</label>
                  <input type="text" name="id" value="{{ $row2->id_instansi }}" hidden>
                  <input class="form-control form-control-sm" type="text" required name="namaInstansi" value="{{$row2->nama_instansi}}">
                </div>
                <div class="col-12">
                  <label class="pt-2">Alamat</label>
                  <input class="form-control form-control-sm" type="text" required name="alamatInstansi" value="{{$row2->alamat_instansi}}">
                </div>
              </div>
              <div class="modal-footer justify-content">
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</button>
              </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modalEditFoto">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Foto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('instansi.editgambar', $row->id_instansi ) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="col-12">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="file">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content">
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</button>
              </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endforeach
      @else
        <h3>jajajajajja</h3>
      @endif
      
    </section>
    <!-- /.content -->
  </div>
  @include('footer')