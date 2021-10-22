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
            console.log(data);

        },
        error: function(data) {

            $("#sold_quantity").text(data.responseJSON.errors.selling_quantity)
            $("#sold_price").text(data.responseJSON.errors.selling_price)

        }
    })

}