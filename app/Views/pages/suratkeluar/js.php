<script type="text/javascript">
    $(function() {
        _getSuratKeluar();
        // Saat file diubah, tampilkan nama file di label
        $('#file_surat').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

    });

    function _getSuratKeluar() {
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
            ],
            "ajax": {
                "url": "<?= site_url('suratkeluar/getData') ?>",
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
            "<?= site_url('suratkeluar/insert_data') ?>" :
            "<?= site_url('suratkeluar/update_data') ?>";

        const fields = [{
                id: "koresponden",
                required: true
            },
            {
                id: "no_surat",
                required: true
            },
            {
                id: "tgl_surat",
                required: true
            },
            {
                id: "id_unit",
                required: true
            },
            {
                id: "id_jenis",
                required: true
            },
            {
                id: "id_sifat",
                required: true
            },
            {
                id: "id_klasifikasi",
                required: true
            },
            {
                id: "perihal",
                required: true
            },
            {
                id: "keterangan",
                required: true
            }
        ];

        let isValid = true;
        fields.forEach(field => {
            const el = $("#" + field.id);
            if (field.required && !el.val()) {
                el.addClass("is-invalid");
                isValid = false;
            } else {
                el.removeClass("is-invalid");
            }
        });

        // Validasi file PDF
        const file = $('#file_surat')[0].files[0];
        if (file && file.type !== "application/pdf") {
            Swal.fire({
                icon: 'error',
                title: 'Format Tidak Valid',
                text: 'Hanya file PDF yang diperbolehkan.'
            });
            return;
        }

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Belum Lengkap',
                text: 'Mohon lengkapi semua data yang wajib diisi.'
            });
            return;
        }

        Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan data sudah benar.",
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
                                text: 'Data berhasil disimpan.'
                            });
                            $('#modal-form').modal('hide');
                            $('#formInput')[0].reset();
                            $('.select2').val(null).trigger('change');
                            $('#viewTable').DataTable().ajax.reload();
                        } else if (data.gagal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: `Nomor surat <b>${$("#no_surat").val()}</b> sudah ada. Gunakan yang lain.`
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Terjadi kesalahan saat menyimpan data.'
                        });
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    }

    function _btnEdit(id) {
        method = "edit";
        $.ajax({
            url: "<?= site_url('suratkeluar/get_edit') ?>",
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
                // Isi field form
                $('[name=id]').val(data.id);
                $('[name=koresponden]').val(data.koresponden);
                $('[name=no_surat]').val(data.no_surat);
                $('[name=tgl_surat]').val(data.tgl_surat);
                $('[name=perihal]').val(data.perihal);
                $('[name=keterangan]').val(data.keterangan);

                // Set nilai select2
                $('[name=id_unit]').val(data.id_unit).trigger('change');
                $('[name=id_jenis]').val(data.id_jenis).trigger('change');
                $('[name=id_sifat]').val(data.id_sifat).trigger('change');
                $('[name=id_klasifikasi]').val(data.id_klasifikasi).trigger('change');

                // Preview file PDF jika ada
                if (data.file_surat) {
                    $('#file-preview').show();
                    $('#file-link').attr('href', '<?= base_url('uploads/surat') ?>/' + data.file_surat);
                } else {
                    $('#file-preview').hide();
                }
                // Tampilkan modal
                $('.select2').select2({
                    dropdownParent: $('#modal-form')
                });
                $('#modal-form').modal('show');
                $('#modal-title').text('Ubah Data');
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }
    function _btnDelete(id, no_surat) {
        Swal.fire({
            title: `Hapus Data`,
            html: `Apakah Anda yakin ingin menghapus data <b>${no_surat}</b>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('suratkeluar/del_data') ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: 'Berhasil!',
                                html: `Data <b>${no_surat}</b> telah dihapus.`,
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
</script>