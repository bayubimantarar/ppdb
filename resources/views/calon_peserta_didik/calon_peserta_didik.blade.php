@extends('layouts.main')

@section('title')
Dasbor &raquo; Calon peserta didik | PPDB
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Calon peserta didik
    </h1>
</div>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <!-- Default Card Example -->
        <div class="card mb-4">
            <div class="card-header">
                Data calon peserta didik
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <p>
                    <a
                        href="/calon-peserta-didik/form-tambah"
                        class="btn btn-primary"
                    >
                        <i class="fas fa-plus"></i> Tambah calon peserta didik
                    </a>
                </p>
                <table
                    class="table table-bordered"
                    id="calon-peserta-didik-data-table"
                >
                  <thead>
                    <tr>
                      <th>NISN</th>
                      <th>Skor Jarak</th>
                      <th>Nilai NHUN</th>
                      <th>Skor Total</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NISN</th>
                      <th>Skor Jarak</th>
                      <th>Nilai NHUN</th>
                      <th>Skor Total</th>
                      <th>Opsi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script>
var calon_peserta_didik_table = $('#calon-peserta-didik-data-table').DataTable({
  ajax: {
      url: '/calon-peserta-didik/data',
      type: 'get'
  },
  datatype: 'json',
  columns: [
      {data: 'nisn'},
      {data: 'skor_jarak'},
      {data: 'nilai_nhun'},
      {data: 'skor_total'},
      {data: 'action'}
  ]
});

function destroy(id)
{
  var confirmation = confirm("Yakin akan menghapus data ini?");

  if (confirmation) {
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: '/calon-peserta-didik/hapus/'+id,
        type: 'delete',
        dataType: 'json',
        success: function(result){
            alert('Data berhasil dihapus!');
            calon_peserta_didik_table.ajax.reload();
        }
    });
  }
}
</script>
@endsection
