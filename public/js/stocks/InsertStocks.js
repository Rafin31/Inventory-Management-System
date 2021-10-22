function addData() {
    let product_name = $('#product_name').val();
    let catagory = $('#catagory').val();
    let seller_name = $('#seller_name').val();
    let price_each = $('#price_each').val();
    let quantity = $('#quantity').val();



    $.ajax({
        type: "POST",
        dataType: 'json',
        data: { product_name: product_name, catagory: catagory, seller_name: seller_name, price_each: price_each, quantity: quantity },
        url: "/addProduct",

        success: function(data) {
            allData();
            $(".form-control").val('');

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            })


        },
        error: function(data) {

            $("#product_name_error").text(data.responseJSON.errors.product_name);
            $("#seller_name_error").text(data.responseJSON.errors.seller_name);
            $("#catagory_error").text(data.responseJSON.errors.catagory);
            $("#price_each_error").text(data.responseJSON.errors.price_each);
            $("#quantity_error").text(data.responseJSON.errors.quantity);
        }
    })

}