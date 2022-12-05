<script>
    var this_folder = "content/user/diagnosa/";

    $('#formData').parsley().on('form:error', function() {
        toastr.warning('Terdapat data yang belum terisi. Silahkan isi semua data yang diperlukan!')
    }).on('form:submit', function(e) {
        let formElement = document.getElementById("formData");
        let formData = new FormData(formElement);

        var proses = 'proses_diagnosa';
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

                    window.setTimeout(function() {
                        window.open('content/user/diagnosa/hasil_diagnosa.php?id_diagnosa=' + dataResult.data.id_diagnosa)
                    }, 3000);
                } else {
                    toastr.error(dataResult.message)
                }
            }
        });

        return false;
    });
</script>