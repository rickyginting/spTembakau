<script>
    var this_folder = "menu/data_hasil_diagnosa/";

    $(document).ready(function() {
        datatable();
    })

    function datatable() {
        $('#dataTable').load(this_folder + 'data.php');
    }

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