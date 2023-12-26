@extends('layouts.app')
@section('content')
<div class="content-overlay"></div>
            <div class="content-body">
                <!-- Description -->
                <section id="description" class="card">
                    <div class="card-header d-flex">
                        <h4 class="card-title">Data</h4>
                        <a href="{{route('contact.create')}}" class="btn btn-sm btn-primary"><i class="feather icon-plus-circle"></i> Tambah</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table zero-configuration" id="tabledata">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>

</div>

@stop
@section('script')
<script>

    // ini vendor data
    (function() {
            loadDataTable();
        })();

        function loadDataTable() {
            $(document).ready(function () {
                if ($.fn.DataTable.isDataTable('#tabledata')) {
                    $('#tabledata').DataTable().destroy();
                }

                $('#tabledata').DataTable({
                    // "scrollX": true,
                    // "autoWidth": true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                  url: "{{ route('contact.index') }}",
                  type: "GET",
              },
              columns: [
              {
                  data:"DT_RowIndex",
                  name:"DT_RowIndex"
              },
              {
                    data:'first_name',
                    name:'first_name'
                },
              {
                    data:'last_name',
                    name:'last_name'
                },
              {
                    data:'email',
                    name:'email'
                },
              {
                    data:'phone',
                    name:'phone'
                },

                {
                    data: 'action',
                    name: 'action'
                },
              ],
              order: [
                  [0, 'asc']
              ]
                });
            });
        }

        function deleteConfirm(contactId) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        dangerMode: true,
    }).then((result) => {
        if (result.isConfirmed == true) {
            var deleteUrl = "{{ url('contact') }}/" + contactId;

            $.ajax({
                url: deleteUrl,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire('Sukses', 'Data berhasil dihapus', 'success').then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus data', 'error');
                }
            });
        } else {
            Swal.fire('Dibatalkan', 'Data tidak dihapus', 'info');
        }
    });
}



  </script>


@endsection
