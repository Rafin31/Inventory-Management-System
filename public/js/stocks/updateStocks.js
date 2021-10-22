function editData(id) {


    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/edit/" + id,


        success: function(data) {

            $('#addP').hide();
            $('#updateP').show();
            $('#addButton').hide();
            $('#updateButton').show();

            let product_name = $('#product_name').val(data.Product_Name);
            let catagory = $('#catagory').val(data.Catagory);
            let id = $('#id').val(data.id);
            let seller_name = $('#seller_name').val(data.Seller_Name);
            let price_each = $('#price_each').val(data.Product_Price);
            let quantity = $('#quantity').val(data.Quantity);
        }
    })
}

function updated(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update it!'
    }).then((result) => {
        if (result.isConfirmed) {

            let id = $('#id').val();
            let product_name = $('#product_name').val();
            let catagory = $('#catagory').val();
            let seller_name = $('#seller_name').val();
            let price_each = $('#price_each').val();
            let quantity = $('#quantity').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                data: { product_name: product_name, catagory: catagory, seller_name: seller_name, price_each: price_each, quantity: quantity },
                url: "/edit/" + id + "/updated",

                success: function(data) {
                    allData();
                },
                error: function(data) {

                    $("#product_name_error").text(data.responseJSON.errors.product_name);
                    $("#seller_name_error").text(data.responseJSON.errors.seller_name);
                    $("#catagory_error").text(data.responseJSON.errors.catagory);
                    $("#price_each_error").text(data.responseJSON.errors.price_each);
                    $("#quantity_error").text(data.responseJSON.errors.quantity);
                }

            })

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your data has been updated',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })





}