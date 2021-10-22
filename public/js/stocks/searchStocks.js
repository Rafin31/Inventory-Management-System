$('#search_input').on('keyup', function() {
    let keyword = $(this).val();
    $.ajax({
        type: 'get',
        url: '/search',
        data: { 'search': keyword },
        success: function(response) {
            if (response.status == 200) {
                var data = " ";
                $.each(response.data, function(key, value) {
                    console.log("test")
                    data = data + "<tr>"
                    data = data + "<td>" + value.id + "</td>"
                    data = data + "<td>" + value.Product_Name + "</td>"
                    data = data + "<td>" + value.Catagory + "</td>"
                    data = data + "<td>" + value.Seller_Name + "</td>"
                    data = data + "<td>" + value.Product_Price + "</td>"
                    data = data + "<td>" + value.Quantity + "</td>"
                    data = data + "<td>" + value.Total_Price + "</td>"
                    data = data + "<td>" + value.Stock_in_date + "</td>"
                    data = data + "<td>"
                    data = data + "<button class='btn btn-success sale_modal_button' onclick='modalButtonClicked(" + value.id + ")' data-toggle='modal' data-target='#exampleModal'>Sold</button>"
                    data = data + "<a href='#updateButton' class='btn btn-info mx-3' onclick='editData(" + value.id + ")'  >Edit</a>"
                    data = data + "<button class='btn btn-danger' onclick='deleteData(" + value.id + ")' >Delete</button>"
                    data = data + "</td>"
                    data = data + "<tr>"

                })
            } else if (response.status == 201) {
                console.log("test")
                data = data + "<tr>"
                data = data + "<td colspan='9' class='alert-primary py-3 h3 text-center'>No Result</td>"
                data = data + "<tr>"
            }

            $('tbody').html(data);
        }
    });
})