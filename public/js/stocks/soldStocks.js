function modalButtonClicked(id) {
    $('#sale_product_id').val(id);
}

function sold() {



    let id = $('#sale_product_id').val();
    let quantity = $('#sale_quantity').val();
    let price = $('#sale_price').val();

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/sold",
        data: { id: id, quantity: quantity, price: price },


        success: function(data) {
            allData();
            if (data.status == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Product Sold',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (data.status == 201) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            }
        },
        error: function(data) {

            $("#sold_quantity").text(data.responseJSON.errors.quantity)
            $("#sold_price").text(data.responseJSON.errors.price)

        }
    })

}