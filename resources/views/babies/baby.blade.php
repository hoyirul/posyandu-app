@extends('layout.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container fs-normal">

  <!-- Page Heading -->
  <p class="mb-3">Tabel / Data / <span class="color-primary">Babies</span></p>

  @if(session('status'))
    <div class="alert alert-success">
      {{session('status')}}
    </div>
  @endif
  @if(session('danger'))
  <div class="alert alert-danger">
    {{session('danger')}}
  </div>
  @endif

  <!-- DataTales Example -->
  <div class="card shadow mb-5 border-0">
    <div class="card-body">
      <h5 class="m-0 font-weight-bold color-primary mb-2">Tabel Data Bayi</h5>
      <p class="mb-3 float-left">Halaman ini untuk engelolaan data bayi</p>
      <a href="/baby/create" class="btn btn-primary py-2 px-3 mx-2 fs-normal float-right mb-3 shadow-sm"><span class="fas fa-user-plus mx-1"></span> Tambah Data</a>
      <a class="btn btn-primary py-2 px-3 fs-normal float-right mb-3 shadow-sm" href="/baby/export">Export ke Excel</a>
      
      <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">NO</th>
              <th>Nama Bayi</th>
              <th>Nama Ibu</th>
              <th>Nama Ayah</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($babies as $baby)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $baby->nama }}</td>
              <td>{{ $baby->nama_ibu }}</td>
              <td>{{ $baby->nama_ayah }}</td>
              <td class="text-center">
                <a href="{{ url('/baby').'/'.$baby->id }}" class="btn fs-small btn-info text-decoration-none">
                  <span class="fa fa-fw fa-eye mx-1"></span>
                  Detail
                </a>
                {{-- <a href="#" class="btn-sm btn-warning rounded-circle"><img class="mt-n1" src="img/edit.svg"></a>
                <a href="#" class="btn-sm btn-danger rounded-circle"><img class="mt-n1" src="img/delete.svg"></a> --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection