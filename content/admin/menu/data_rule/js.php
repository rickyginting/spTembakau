<script>
    var this_folder = "menu/data_rule/";

    $(document).ready(function() {
        datatable();

        getDataPenyakit();
        getDataGejala();

        $('.select2').select2({
            theme: 'bootstrap4'
        })
    })

    function getDataPenyakit() {
        optionText = '-- Pilih --';
        optionValue = '';

        $('#kode_penyakit')
            .find('option')
            .remove()
            .end()
            .append(`<option value="${optionValue}"> ${optionText} </option>`)
            .val('');

        $.ajax({
            url: this_folder + 'proses.php',
            type: 'GET',
            data: {
                'proses': 'getDataPenyakit',
            },
            success: function(response) {
                let dataResult = JSON.parse(response);

                let data = dataResult.data;

                for (const key in data) {
                    if (!data.hasOwnProperty(key)) continue;

                    var obj = data[key];

                    optionValue = obj['kode_penyakit'];
                    optionText = obj['kode_penyakit'] + " - " + obj['nama_penyakit'];

                    $('#kode_penyakit').append(`<option value="${optionValue}"> ${optionText} </option>`)
                }
            },
            error: function(xhr) {
                alert(xhr);
            }
        });
    }

    function getDataGejala() {
        optionText = '-- Pilih --';
        optionValue = '';

        $('#kode_gejala')
            .find('option')
            .remove()
            .end()
            .append(`<option value="${optionValue}"> ${optionText} </option>`)
            .val('');

        $.ajax({
            url: this_folder + 'proses.php',
            type: 'GET',
            data: {
                'proses': 'getDataGejala',
            },
            success: function(response) {
                let dataResult = JSON.parse(response);

                let data = dataResult.data;

                for (const key in data) {
                    if (!data.hasOwnProperty(key)) continue;

                    var obj = data[key];

                    optionValue = obj['kode_gejala'];
                    optionText = obj['kode_gejala'] + " - " + obj['nama_gejala'];

                    $('#kode_gejala').append(`<option value="${optionValue}"> ${optionText} </option>`)
                }
            },
            error: function(xhr) {
                alert(xhr);
            }
        });
    }

    function datatable() {
        $('#dataTable').load(this_folder + 'data.php');
    }

    $('body').on('click', '#btn_tambah', function(event) {
        event.preventDefault();

        $('#modalFormData').modal('show');
        $('#modalFormData .modal-title').text('Tambah Data Basis Pengetahuan');
        $('#modalFormData #btn_simpan').text('Simpan');

        $('#formData').parsley().reset();

        $('#id_rule').val('');
        $('#kode_penyakit').val('').trigger('change');
        $('#kode_gejala').val('').trigger('change');
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
                $('#modalFormData .modal-title').text('Update Data Basis Pengetahuan');
                $('#modalFormData #btn_simpan').text('Update');

                // isi inputan
                $('#id_rule').val(dataResult.data.id_rule);
                $('#kode_penyakit').val(dataResult.data.kode_penyakit).trigger('change');
                $('#kode_gejala').val(dataResult.data.kode_gejala).trigger('change');
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
</script>