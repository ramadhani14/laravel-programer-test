<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <br>
                <div class="container-fluid" style="text-align:right">
                    <form action="{{ url('filterktp') }}" enctype="multipart/form-data" name="filterData"
                        id="filterData" method="post">
                        @csrf
                        <div class="row justify-content-start">
                            <div class="col-3" style="text-align:left">
                                <select id="filterprov" name="filterprov" class="form-select select2">
                                    <option value="" disabled selected>Filter Provinsi</option>
                                    @foreach($mst_provinsi as $k)
                                    <option value="{{$k->id}}" {{$k->id==$provinsi ? "selected" : ""}}>{{$k->nama}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2" style="text-align: left;">
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-outline-dark"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                    <a href="{{url('crud')}}" class="btn btn-outline-dark"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="col-1" style="text-align: left;">

                            </div>

                            <div class="col-6">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#adddata">Tambah Data <i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                    <br><br>
                    <table id="myTable" class="display" style="text-align:left">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat/Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Kab/Kota</th>
                                <th>Provinsi</th>
                                <th>Agama</th>
                                <th>Status</th>
                                <th>Pekerjaan</th>
                                <th>Kewarganegaraan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mst_ktp as $key)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#editdata_{{$key->id}}" type="button"
                                        class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#modalhapus_{{$key->id}}"
                                        type="button" class="btn btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </td>
                                <td>{{$key->no_ktp}}</td>
                                <td>{{$key->nama}}</td>
                                <td>{{$key->tmp_lahir}} / {{$key->tgl_lahir}}</td>
                                <td>{{$key->jns_kel=='L' ? 'Laki-laki' : 'Perempuan'}} </td>
                                <td>{{$key->alamat}}</td>
                                <td>{{$key->kota_r->nama}}</td>
                                <td>{{$key->provinsi_r->nama}}</td>
                                <td>{{$key->agama}}</td>
                                <td>{{$key->status}}</td>
                                <td>{{$key->pekerjaan}}</td>
                                <td>{{$key->warga}}</td>
                            </tr>

                            <!-- Modal Add Data -->
                            <div style="text-align:left" class="modal fade" id="editdata_{{$key->id}}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="" class="form-horizontal" id="formEditData_{{$key->id}}"
                                        name="formEditData_{{$key->id}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data {{$key->nama}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="no_ktp_{{$key->id}}" class="col-form-label">NIK:</label>
                                                    <input value="{{$key->no_ktp}}" type="text"
                                                        class="form-control nomor" maxlength="16"
                                                        id="no_ktp_{{$key->id}}" name="no_ktp_{{$key->id}}">
                                                    <span class="inputerror" id="error_no_ktp_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_{{$key->id}}" class="col-form-label">Nama:</label>
                                                    <input value="{{$key->nama}}" type="text" class="form-control"
                                                        id="nama_{{$key->id}}" name="nama_{{$key->id}}">
                                                    <span class="inputerror" id="error_nama_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tmp_lahir_{{$key->id}}" class="col-form-label">Tempat
                                                        Lahir:</label>
                                                    <input value="{{$key->tmp_lahir}}" type="text" class="form-control"
                                                        id="tmp_lahir_{{$key->id}}" name="tmp_lahir_{{$key->id}}">
                                                    <span class="inputerror" id="error_tmp_lahir_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_lahir_{{$key->id}}"
                                                        class="col-form-label">Tgl.Lahir:</label>
                                                    <input value="{{$key->tgl_lahir}}" type="text"
                                                        class="form-control datepicker" name="tgl_lahir_{{$key->id}}"
                                                        id="tgl_lahir_{{$key->id}}">
                                                    <span class="inputerror" id="error_tgl_lahir_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jns_kel_{{$key->id}}" class="col-form-label">Jenis
                                                        Kelamin:</label>
                                                    <select id="jns_kel_{{$key->id}}" name="jns_kel_{{$key->id}}"
                                                        class="form-select select2" aria-label="Jenis Kelamin">
                                                        <option value="L" {{$key->jns_kel=="L" ? "selected" : ""}}>
                                                            Laki-laki</option>
                                                        <option value="P" {{$key->jns_kel=="P" ? "selected" : ""}}>
                                                            Perempuan</option>
                                                    </select>
                                                    <span class="inputerror" id="error_jns_kel_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat_{{$key->id}}"
                                                        class="col-form-label">Alamat:</label>
                                                    <textarea class="form-control" id="alamat_{{$key->id}}"
                                                        name="alamat_{{$key->id}}">{{$key->alamat}}</textarea>
                                                    <span class="inputerror" id="error_alamat_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="prov_{{$key->id}}"
                                                        class="col-form-label">Provinsi:</label>
                                                    <br>
                                                    <select id="prov_{{$key->id}}" name="prov_{{$key->id}}"
                                                        class="form-select select2 prov" nomor="{{$key->id}}"
                                                        aria-label="Provinsi">
                                                        <option value="" disabled selected>-- Pilih Provinsi --</option>
                                                        @foreach($mst_provinsi as $k)
                                                        <option value="{{$k->id}}"
                                                            {{$key->prov==$k->id ? "selected" : ""}}>{{$k->nama}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="inputerror" id="error_prov_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    @php
                                                    $kabkota =
                                                    App\Models\ms_kota::where('provinsi_id',
                                                    $key->prov)->get();
                                                    @endphp
                                                    <label for="kab_kota_{{$key->id}}"
                                                        class="col-form-label">Kab/Kota:</label>
                                                    <select id="kab_kota_{{$key->id}}" name="kab_kota_{{$key->id}}"
                                                        class="form-select select2" aria-label="Kab/Kota">
                                                        <option value="" disabled selected>-- Pilih Kab/Kota --</option>
                                                        @foreach($kabkota as $k)
                                                        <option value="{{$k->id}}"
                                                            {{$key->kab_kota==$k->id ? "selected" : ""}}>{{$k->nama}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="inputerror" id="error_kab_kota_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="agama_{{$key->id}}"
                                                        class="col-form-label">Agama:</label>
                                                    <select id="agama_{{$key->id}}" name="agama_{{$key->id}}"
                                                        class="form-select select2" aria-label="Agama">
                                                        <option value="Islam"
                                                            {{$key->agama=="Islam" ? "selected" : ""}}>Islam</option>
                                                        <option value="Protestan"
                                                            {{$key->agama=="Protestan" ? "selected" : "" }}> Protestan
                                                        </option>
                                                        <option value="Katolik"
                                                            {{$key->agama=="Katolik" ? "selected" : "" }}>Katolik
                                                        </option>
                                                        <option value="Hindu"
                                                            {{$key->agama=="Hindu" ? "selected" : ""}}>Hindu</option>
                                                        <option value="Buddha"
                                                            {{$key->agama=="Buddha" ? "selected" : "" }}>Buddha</option>
                                                        <option value="Khonghucu"
                                                            {{$key->agama=="Khonghucu" ? "selected" : "" }}>Khonghucu
                                                        </option>
                                                    </select>
                                                    <span class="inputerror" id="error_agama_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status_{{$key->id}}" class="col-form-label">Status
                                                        Perkawinan:</label>
                                                    <select id="status_{{$key->id}}" name="status_{{$key->id}}"
                                                        class="form-select select2" aria-label="Status">
                                                        <option value="Menikah"
                                                            {{$key->status=="Menikah" ? "selected" : "" }}>Menikah
                                                        </option>
                                                        <option value="Belum Menikah"
                                                            {{$key->status=="Belum Menikah" ? "selected" : "" }}>Belum
                                                            Menikah</option>
                                                        <option value="Cerai Hidup"
                                                            {{$key->status=="Cerai Hidup" ? "selected" : "" }}>Cerai
                                                            Hidup</option>
                                                        <option value="Cerai Mati"
                                                            {{$key->status=="Cerai Mati" ? "selected" : "" }}>Cerai Mati
                                                        </option>
                                                    </select>
                                                    <span class="inputerror" id="error_status_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pekerjaan_{{$key->id}}"
                                                        class="col-form-label">Pekerjaan:</label>
                                                    <input type="text" class="form-control" id="pekerjaan_{{$key->id}}"
                                                        name="pekerjaan_{{$key->id}}" value="{{$key->pekerjaan}}">
                                                    <span class="inputerror" id="error_pekerjaan_{{$key->id}}"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="warga_{{$key->id}}"
                                                        class="col-form-label">Kewarganegaraan:</label>
                                                    <input type="text" class="form-control" id="warga_{{$key->id}}"
                                                        name="warga_{{$key->id}}" value="{{$key->warga}}">
                                                    <span class="inputerror" id="error_warga_{{$key->id}}"></span>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="button" onclick="updateData({{$key->id}})"
                                                    class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Akhir Modal -->


                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modalhapus_{{$key->id}}">
                                <div class="modal-dialog modal-lg">
                                    <form action="" class="form-horizontal" id="formHapus_{{$key->id}}"
                                        name="formHapus_{{$key->id}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="text-align:left">
                                                <h5>Apakah anda ingin menghapus data {{$key->nama}} ?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="button" onclick="hapusData({{$key->id}})"
                                                    class="btn btn-danger">Hapus</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- Modal Hapus -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <!-- Modal Add Data -->
                <div class="modal fade" id="adddata" tabindex="-1" aria-labelledby="adddataLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="" class="form-horizontal" id="formData" name="formData" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="adddataLabel">Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="no_ktp" class="col-form-label">NIK:</label>
                                        <input type="text" class="form-control nomor" maxlength="16" id="no_ktp"
                                            name="no_ktp">
                                        <span class="inputerror" id="error_no_ktp"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="col-form-label">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                        <span class="inputerror" id="error_nama"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tmp_lahir" class="col-form-label">Tempat Lahir:</label>
                                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir">
                                        <span class="inputerror" id="error_tmp_lahir"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_lahir" class="col-form-label">Tgl.Lahir:</label>
                                        <input type="text" class="form-control datepicker" name="tgl_lahir"
                                            id="tgl_lahir">
                                        <span class="inputerror" id="error_tgl_lahir"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jns_kel" class="col-form-label">Jenis Kelamin:</label>
                                        <select id="jns_kel" name="jns_kel" class="form-select select2"
                                            aria-label="Jenis Kelamin">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <span class="inputerror" id="error_jns_kel"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="col-form-label">Alamat:</label>
                                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                                        <span class="inputerror" id="error_alamat"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="prov" class="col-form-label">Provinsi:</label>
                                        <br>
                                        <select id="prov" name="prov" class="form-select select2 prov" nomor=""
                                            aria-label="Provinsi">
                                            <option value="" disabled selected>-- Pilih Provinsi --</option>
                                            @foreach($mst_provinsi as $k)
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                        <span class="inputerror" id="error_prov"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kab_kota" class="col-form-label">Kab/Kota:</label>
                                        <select id="kab_kota" name="kab_kota" class="form-select select2"
                                            aria-label="Kab/Kota">
                                            <option value="" disabled selected>-- Pilih Kab/Kota --</option>
                                        </select>
                                        <span class="inputerror" id="error_kab_kota"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="agama" class="col-form-label">Agama:</label>
                                        <select id="agama" name="agama" class="form-select select2" aria-label="Agama">
                                            <option value="Islam">Islam</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Khonghucu">Khonghucu</option>
                                        </select>
                                        <span class="inputerror" id="error_agama"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="col-form-label">Status Perkawinan:</label>
                                        <select id="status" name="status" class="form-select select2"
                                            aria-label="Status">
                                            <option value="Menikah">Menikah</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Cerai Hidup">Cerai Hidup</option>
                                            <option value="Cerai Mati">Cerai Mati</option>
                                        </select>
                                        <span class="inputerror" id="error_status"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pekerjaan" class="col-form-label">Pekerjaan:</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                        <span class="inputerror" id="error_pekerjaan"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="warga" class="col-form-label">Kewarganegaraan:</label>
                                        <input type="text" class="form-control" id="warga" name="warga">
                                        <span class="inputerror" id="error_warga"></span>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="button" onclick="simpanData()" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Akhir Modal -->
            </div>
        </div>
    </div>
    @section('footeradd')
    <script>
        $(document).ready(function () {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });

            $('.nomor').on('input blur paste', function () {
                $(this).val($(this).val().replace(/\D/g, ''));
            });

            var dt = $('#myTable').DataTable({
                "scrollX": true,
                "scrollY": 400,
                "scroller": true,
                "columnDefs": [{
                    "searchable": false,
                    "targets": [0, 1],
                    "orderable": false
                }]
            });

            dt.on('order.dt search.dt', function () {
                dt.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            $('.select2').select2();

            // Filter Kota Berdasarkan Provinsi
            $('.prov').on('select2:select', function () {
                nomor = $(this).attr('nomor');
                if (nomor == "") {
                    var url = `{{ url('changeprov') }}`;
                    changeProv(url, 'prov', 'kab_kota', "-- Pilih Kab/Kota --");
                } else {
                    var url = `{{ url('changeprov') }}`;
                    changeProv(url, 'prov_' + nomor, 'kab_kota_' + nomor, "-- Pilih Kab/Kota --");
                }
            });

            // fungsi ajax untuk chained of provinsi
            function changeProv(url, id_prov, id_kota, placeholder) {
                var prov = $('#' + id_prov).val();
                var kota = $('#' + id_kota).val();

                $('#' + id_kota).empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        prov: prov,
                        kota: kota
                    },
                    success: function (datakota) {
                        $("#" + id_kota).html("<option value='' selected>" + placeholder +
                            "</option>");
                        $("#" + id_kota).select2({
                            data: datakota
                        }).val(null).trigger('change');
                    },
                    error: function (xhr, status) {
                        alert('terjadi error ketika menampilkan data kota');
                        console.log(xhr);
                    }

                });
            }

            // Simpan data
            simpanData = () => {
                var formData = new FormData($('#formData')[0]);

                var url = "{{ url('storektp') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "JSON",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $.LoadingOverlay("show", {
                            fade: [5, 5],
                            progressSpeed: '9000',
                            background: "rgba(60, 60, 60, 0.2)"
                        });
                    },
                    success: function (response) {
                        if (response.icon == "success") {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: response.icon
                            }).then((result) => {
                                window.location.href =
                                    "{{url('crud')}}";
                            });
                        } else {
                            Swal.fire(
                                'Peringatan!',
                                response.message,
                                response.icon
                            );
                        }
                    },
                    error: function (xhr, status) {
                        $('.select2-selection--single').css('border-color', '#ced4da');
                        $('.form-control').css('border-color', '#ced4da');
                        $('.inputerror').html('');
                        var a = JSON.parse(xhr.responseText);
                        $.each(a.errors, function (key, value) {
                            var some_id = document.getElementById(key);
                            var tag = some_id.tagName;
                            if (tag == "SELECT") {
                                $("#" + key).parent().find('.select2-selection--single')
                                    .css('border', '1px solid red');
                                $('#error_' + key).html(value[0]);
                            } else {
                                $('#' + key).css('border-color', 'red');
                                $('#error_' + key).html(value[0]);
                            }
                        });
                    },
                    complete: function () {
                        $.LoadingOverlay("hide");
                    }
                });
            }

            updateData = (id) => {
                var formData = new FormData($('#formEditData_' + id)[0]);

                var url = "{{ url('updatektp') }}/" + id;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "JSON",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $.LoadingOverlay("show", {
                            fade: [5, 5],
                            progressSpeed: '9000',
                            background: "rgba(60, 60, 60, 0.2)"
                        });
                    },
                    success: function (response) {
                        if (response.icon == "success") {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: response.icon
                            }).then((result) => {
                                window.location.href =
                                    "{{url('crud')}}";
                            });
                        } else {
                            Swal.fire(
                                'Peringatan!',
                                response.message,
                                response.icon
                            );
                        }
                    },
                    error: function (xhr, status) {
                        $('.select2-selection--single').css('border-color', '#ced4da');
                        $('.form-control').css('border-color', '#ced4da');
                        $('.inputerror').html('');
                        var a = JSON.parse(xhr.responseText);
                        $.each(a.errors, function (key, value) {
                            var some_id = document.getElementById(key);
                            var tag = some_id.tagName;
                            if (tag == "SELECT") {
                                $("#" + key).parent().find('.select2-selection--single')
                                    .css('border', '1px solid red');
                                $('#error_' + key).html(value[0]);
                            } else {
                                $('#' + key).css('border-color', 'red');
                                $('#error_' + key).html(value[0]);
                            }
                        });
                    },
                    complete: function () {
                        $.LoadingOverlay("hide");
                    }
                });
            }

            hapusData = (id) => {
                var formData = new FormData($('#formHapus_' + id)[0]);

                var url = "{{ url('deletektp') }}/" + id;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "JSON",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $.LoadingOverlay("show", {
                            fade: [5, 5],
                            progressSpeed: '9000',
                            background: "rgba(60, 60, 60, 0.2)"
                        });
                    },
                    success: function (response) {
                        if (response.icon == "success") {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: response.icon
                            }).then((result) => {
                                window.location.href =
                                    "{{url('crud')}}";
                            });
                        } else {
                            Swal.fire(
                                'Peringatan!',
                                response.message,
                                response.icon
                            );
                        }
                    },
                    error: function (xhr, status) {
                        $('.select2-selection--single').css('border-color', '#ced4da');
                        $('.form-control').css('border-color', '#ced4da');
                        $('.inputerror').html('');
                        var a = JSON.parse(xhr.responseText);
                        $.each(a.errors, function (key, value) {
                            var some_id = document.getElementById(key);
                            var tag = some_id.tagName;
                            if (tag == "SELECT") {
                                $("#" + key).parent().find('.select2-selection--single')
                                    .css('border', '1px solid red');
                                $('#error_' + key).html(value[0]);
                            } else {
                                $('#' + key).css('border-color', 'red');
                                $('#error_' + key).html(value[0]);
                            }
                        });
                    },
                    complete: function () {
                        $.LoadingOverlay("hide");
                    }
                });
            }

        });

    </script>
    @endsection
</x-app-layout>
