<script>
    var this_folder = "menu/data_penyakit/";

    $(document).ready(function() {
        datatable();
    })

    function datatable() {
        $('#dataTable').load(this_folder + 'data.php');
    }

    $('#kode_penyakit').prop('readonly', true);

    function auto_kode() {
        $.ajax({
            url: this_folder + 'proses.php',
            type: 'GET',
            data: {
                'proses': 'getAutoKode',
            },
            success: function(response) {
                let dataResult = JSON.parse(response);

                $('#kode_penyakit').val(dataResult.data).trigger('change');
            },
            error: function(xhr) {
                alert(xhr);
            }
        });
    }

    $('body').on('click', '#btn_tambah', function(event) {
        event.preventDefault();

        $('#modalFormData').modal('show');
        $('#modalFormData .modal-title').text('Tambah Data Penyakit');
        $('#modalFormData #btn_simpan').text('Simpan');

        $('#formData').parsley().reset();

        auto_kode();
        $('#nama_penyakit').val('');
        $('#definisi').val('');
        $('#solusi_mekanis').val('');
        $('#solusi_kimiawi').val('');
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
                $('#modalFormData .modal-title').text('Update Data Penyakit');
                $('#modalFormData #btn_simpan').text('Update');

                // isi inputan
                $('#kode_penyakit').val(dataResult.data.kode_penyakit);
                $('#nama_penyakit').val(dataResult.data.nama_penyakit);
                $('#definisi').val(dataResult.data.definisi);
                $('#solusi_mekanis').val(dataResult.data.solusi_mekanis);
                $('#solusi_kimiawi').val(dataResult.data.solusi_kimiawi);
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
        $('#modalDetail .modal-title').text('Detail Penyakit');

        let me = $(this),
            kode_penyakit = me.attr('data-kode_penyakit');

        $('#modalDetail #detail-penyakit').load(this_folder + 'detail.php', {
            kode_penyakit: kode_penyakit
        });
    });
</script>