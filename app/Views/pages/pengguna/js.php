<script type="text/javascript">
    $(function() {
        _getPengguna();
    });

    function _getPengguna() {
        $("#viewTable").DataTable({
            processing: true,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            language: {
                searchPlaceholder: 'Cari...',
                sSearch: '',
                lengthMenu: '_MENU_',
                emptyTable: 'Tidak ada data'
            },
            "order": [],
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }, ],
            "columns": [{
                    "data": "col1"
                },
                {
                    "data": "col2"
                },
                {
                    "data": "col3"
                },
                {
                    "data": "col4"
                },
            ],
            "ajax": {
                "url": "<?= site_url('pengguna/getData') ?>",
                "type": "GET",
                "cache": false,
            },
        });
    }

    function _tambahData() {
        method = 'save';
        $('.select2').select2({
            dropdownParent: $('#modal-form')
        });
        $('#modal-form').modal('show');
        $('#modal-title').text('Tambah Data');
    }

    function _simpanData() {
        const url = method === "save" ?
            "<?= site_url('pengguna/insert_data') ?>" :
            "<?= site_url('pengguna/update_data') ?>";

        const fields = [{
                id: "nama",
                required: true
            },
            {
                id: "jenis_kelamin",
                required: true
            },
            {
                id: "telepon",
                required: true
            },
            {
                id: "email",
                required: true
            },
            {
                id: "username",
                required: true
            },
            {
                id: "level",
                required: true
            },
            {
                id: "status_user",
                required: true
            },
            {
                id: "alamat",
                required: false
            }
        ];

        let isValid = true;

        // Validasi field
        fields.forEach(field => {
            const $el = $("#" + field.id);
            if (field.required && !$el.val()) {
                $el.addClass("is-invalid");
                isValid = false;
            } else {
                $el.removeClass("is-invalid");
            }
        });

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Silakan lengkapi data yang wajib diisi.'
            });
            return;
        }

        // Konfirmasi sebelum simpan
        Swal.fire({
            title: 'Simpan Data?',
            text: "Apakah Anda yakin ingin menyimpan data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData($('#formInput')[0]),
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan!'
                            });
                            $('#modal-form').modal('hide');
                            $('.form-data')[0].reset();

                            // Reload DataTable atau tambahkan baris langsung
                            $('#viewTable').DataTable().ajax.reload();
                        } else if (data.gagal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: `USERNAME: <b>${$("#username").val()}</b> sudah ada, silakan coba yang lain`
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Tidak dapat menyimpan data.'
                        });
                    }
                });
            }
        });
    }

    function _btnDelete(id, nama) {
        Swal.fire({
            title: `Hapus Data`,
            html: `Apakah Anda yakin ingin menghapus data <b>${nama}</b>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('pengguna/del_data') ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: 'Berhasil!',
                                html: `Data <b>${nama}</b> telah dihapus.`,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#viewTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal menghapus data.',
                                icon: 'error',
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseText,
                            icon: 'error',
                        });
                    }
                });
            }
        });
    }
     function _btnReset(id, nama) {
        Swal.fire({
            title: `Reset Password`,
            html: `Apakah Anda yakin ingin mereset password <b>${nama}</b>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('pengguna/reset_data') ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: 'Berhasil!',
                                html: `Password <b>${nama}</b> telah direset.`,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#viewTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal mereset password.',
                                icon: 'error',
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseText,
                            icon: 'error',
                        });
                    }
                });
            }
        });
    }
    function _btnEdit(id, nama) {
        method = "edit";
        $.ajax({
            url: "<?= site_url('pengguna/get_edit') ?>",
            type: 'GET',
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                if (data.error) {
                    toastr.error(data.error);
                    return;
                }
                $('[name=id]').val(data.id);
                $('[name=nama]').val(data.nama);
                $('[name=jenis_kelamin]').val(data.jenis_kelamin);
                $('[name=telepon]').val(data.telepon);
                $('[name=email]').val(data.email);
                $('[name=username]').val(data.username);
                $('[name=level]').val(data.level);
                $('[name=status_user]').val(data.status_user);
                $('[name=alamat]').val(data.alamat);
                $('.select2').select2();
                $('#modal-form').modal('show');
                $('#modal-title').text('Ubah Data');
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }
</script>