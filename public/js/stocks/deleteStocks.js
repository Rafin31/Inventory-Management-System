function deleteData(id) {


    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {

        if (result.isConfirmed) {


            $.ajax({
                type: "POST",
                dataType: "json",
                data: { id: id },
                url: "/delete/" + id,

                success: function(data) {
                    allData();
                },
                error: function(data) {
                    alert("Something Went Worng");

                }

            })

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your data has been deleted',
                showConfirmButton: false,
                timer: 1500
            })

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            )
        }
    })



}