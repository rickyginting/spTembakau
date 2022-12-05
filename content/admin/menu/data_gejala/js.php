<script>
    var this_folder = "menu/data_gejala/";

    $(document).ready(function() {
        datatable();

        $('#nilai_mb, #nilai_md').on('change', function() {
            get_nilai_cf();
        })
    })

    function datatable() {
        $('#dataTable').load(this_folder + 'data.php');
    }

    $('#kode_gejala').prop('readonly', true);
    $('#nilai_cf').prop('readonly', true);

    function auto_kode() {
        $.ajax({
            url: this_folder + 'proses.php',
            type: 'GET',
            data: {
                'proses': 'getAutoKode',
            },
            success: function(response) {
                let dataResult = JSON.parse(response);

                $('#kode_gejala').val(dataResult.data).trigger('change');
            },
            error: function(xhr) {
                alert(xhr);
            }
        });
    }

    function get_nilai_cf(nilai_mb = 0, nilai_md = 0) {
        if (!nilai_mb) {
            nilai_mb = $('#nilai_mb').val();
        }

        if (!nilai_md) {
            nilai_md = $('#nilai_md').val();
        }

        var nilai_cf = 0;

        if (nilai_mb && nilai_md) {
            nilai_cf = parseFloat(nilai_mb - nilai_md).toFixed(2);
        }

        $('#nilai_cf').val(nilai_cf);
    }

    $('body').on('click', '#btn_tambah', function(event) {
        event.preventDefault();

        $('#modalFormData').modal('show');
        $('#modalFormData .modal-title').text('Tambah Data Gejala');
        $('#modalFormData #btn_simpan').text('Simpan');

        $('#formData').parsley().reset();

        auto_kode();
        $('#nama_gejala').val('');
        $('#nilai_mb').val('');
        $('#nilai_md').val('');
        get_nilai_cf();
    });

    $('#formData').parsley().on('form:error', function() {
        toastr.warning('Terdapat data yang belum terisi. Silahkan isi semua data yang diperlukan!')
    }).on('form:submit', function(e) {
        let formElement = document.getElementById("formData");
        let formData = new FormData(formElement);

        var proses = 'simpan';
        if ($('#btn_simpan').text() == "Update") {
            proses = "update";
        }

        formData.append('proses', proses);

        $.ajax({
            url: this_folder + 'proses.php',
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let dataResult = JSON.parse(response);

                // pesan berhasil
                if (dataResult.code == 200) {
                    toastr.success(dataResult.message)

                    $('#modalFormData').modal('hide');
                    datatable();
                } else {
                    toastr.error(dataResult.message)
                }
            }
        });

        return false;
    });

    // function button edit
    $('body').on('click', '#btn_edit', function(event) {
        event.preventDefault();

        let me = $(this),
            url = me.attr('href');

        $('#formData').parsley().reset();

        $.ajax({
            url: this_folder + 'proses.php',
            type: 'GET',
            data: {
                'proses': 'edit',
                'data': url
            },
            success: function(response) {
                let dataResult = JSON.parse(response);

                $('#modalFormData').modal('show');
                $('#modalFormData .modal-title').text('Update Data Gejala');
                $('#modalFormData #btn_simpan').text('Update');

                var nilai_mb = dataResult.data.nilai_mb;
                var nilai_md = dataResult.data.nilai_md;
                var nilai_cf = dataResult.data.nilai_cf;

                // isi inputan
                $('#kode_gejala').val(dataResult.data.kode_gejala);
                $('#nama_gejala').val(dataResult.data.nama_gejala);

                $('#nilai_mb').val(nilai_mb);
                $('#nilai_md').val(nilai_md);

                if (!nilai_cf) {
                    get_nilai_cf(nilai_mb, nilai_md);
                } else {
                    $('#nilai_cf').val(nilai_cf);
                }
            },
            error: function(xhr) {
                alert(xhr);
            }
        })
    });

    // function button delete
    $('body').on('click', '#btn_hapus', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let me = $(this),
                    url = me.attr('href');

                $.ajax({
                    url: this_folder + 'proses.php',
                    type: 'GET',
                    data: {
                        'proses': 'delete',
                        'data': url
                    },
                    success: function(response) {
                        let dataResult = JSON.parse(response);

                        // pesan berhasil
                        if (dataResult.code == 200) {
                            toastr.success(dataResult.message)

                            datatable();
                        } else {
                            toastr.error(dataResult.message)
                        }
                    },
                    error: function(xhr) {
                        alert(xhr);
                    }
                })
            }
        })

    });

    // function button detail
    $('body').on('click', '#btn_detail', function(event) {
        event.preventDefault();

        $('#modalDetail').modal('show');
        $('#modalDetail .modal-title').text('Detail Gejala');

        let me = $(this),
            kode_gejala = me.attr('data-kode_gejala');

        $('#modalDetail #detail-gejala').load(this_folder + 'detail.php', {
            kode_gejala: kode_gejala
        });
    });
</script>