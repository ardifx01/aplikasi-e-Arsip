<script type="text/javascript">
    $(function() {
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            const id_unit = $('#id_unit').val();

            $.ajax({
                url: "<?= site_url('laporan/getSuratMasukByUnit') ?>",
                type: "GET",
                data: {
                    id_unit: id_unit
                },
                dataType: "json",
                success: function(response) {
                    const tableBody = $('#tableSuratMasuk tbody');
                    tableBody.empty();

                    if (response.data.length > 0) {
                        response.data.forEach((item, index) => {
                            tableBody.append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.no_surat}</td>
                                    <td>${item.koresponden}</td>
                                    <td>${item.tgl_surat}</td>
                                    <td>${item.perihal}</td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append(`<tr><td colspan="5" class="text-center">Tidak ada data.</td></tr>`);
                    }
                }
            });
        });
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            const id_unit = $('#id_unit').val();

            $.ajax({
                url: "<?= site_url('laporan/getSuratKeluarByUnit') ?>",
                type: "GET",
                data: {
                    id_unit: id_unit
                },
                dataType: "json",
                success: function(response) {
                    const tableBody = $('#tableSuratKeluar tbody');
                    tableBody.empty();

                    if (response.data.length > 0) {
                        response.data.forEach((item, index) => {
                            tableBody.append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.no_surat}</td>
                                    <td>${item.koresponden}</td>
                                    <td>${item.tgl_surat}</td>
                                    <td>${item.perihal}</td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append(`<tr><td colspan="5" class="text-center">Tidak ada data.</td></tr>`);
                    }
                }
            });
        });
    });
</script>