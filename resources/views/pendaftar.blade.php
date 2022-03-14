<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JFLS TEST</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="m-4">
        <a class="btn btn-success" href="javascript:void(0)" id="tambah"> Tambah</a>
    </div>
    <div class="m-4">
        <table class="table table-bordered" id="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor registrasi</th>
                    <th>Nama lengkap</th>
                    <th>Jenis kelamin</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="pendaftarForm" name="pendaftarForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="nomor_register" class="col-md-4 control-label">Nomor pendaftar</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nomor" name="nomor_register"
                                    placeholder="Masukan nomor pendaftar" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Nama lengkap</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama_lengkap"
                                    placeholder="Masukan nama" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenkel" class="col-md-4 control-label">Jenis kelamin</label>
                            <div class="row" id="jenkel">
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radioL" name="jenis_kelamin"
                                            value="L">L
                                        <label class="form-check-label" for="radio1"></label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radioP" name="jenis_kelamin"
                                            value="P">P
                                        <label class="form-check-label" for="radio2"></label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nohp" class="col-md-4 control-label">No. Telp</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nohp" name="no_hp"
                                    placeholder="Masukan nomor telpon" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="name@example.com">
                            </div>
                        </div>

                        <div class="mt-4 float-end">
                            <button type="button" id="batal" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('pendaftar') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nomor_register',
                    name: 'nomor_register'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
        });

        $('#tambah').click(function () {
        $('#ajaxModel').modal('show');

        $('#saveBtn').val("create-data");
        $('#id').val('');
        $('#pendaftarForm').trigger("reset");
        $('#modelHeading').html("Tambah Data");

    });

    $('#batal').click(function () {
            $('#ajaxModel').modal('hide');
        })

    $('body').on('click', '.edit', function () {
      var id = $(this).data('id');
      $.get("{{ url('pendaftar') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Book");
          $('#saveBtn').val("edit-pendaftar");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#nomor').val(data.nomor_register);
          $('#nama').val(data.nama_lengkap);
          if(data.jenis_kelamin === "L")
          {
            $('.form-group').find(':radio[name=jenis_kelamin][value="L"]').prop('checked', true);  // #rdGender is  name  of the  RB
            $('.form-group').find(':radio[name=jenis_kelamin][value="P"]').prop('checked', false);
          }else {
            $('.form-group').find(':radio[name=jenis_kelamin][value="L"]').prop('checked', false);  // #rdGender is  name  of the  RB
            $('.form-group').find(':radio[name=jenis_kelamin][value="P"]').prop('checked', true);
          }
          
          $('#nohp').val(data.no_hp);
          $('#email').val(data.email);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Memproses..');

        $.ajax({
            data: $('#pendaftarForm').serialize(),
            url: "{{ url('pendaftar/store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#pendaftarForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                $('#saveBtn').html('Simpan');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Simpan');
            }
        });
    });

    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        var result = confirm("Are You sure want to delete !");
        if (result) {
            $.ajax({
                type: "DELETE",
                url: "{{    ('pendaftar/delete') }}" + '/' + id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        } else {
            return false;
        }
    });

    });
   

</script>

</html>
