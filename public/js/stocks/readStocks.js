function allData(params) {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/stocks",
        success: function(response) {
            var data = " ";
            console.log(response)
            $.each(response.data, function(key, value) {

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
            $('tbody').html(data);

            // var links = " ";
            // $.each(response.links, function(key, links) {


            // })

            // links = links + ' </ul>'
            // links = links + '</nav> '
            // $('#pagination').html(links);
            console.log(response);
            var links = " "
            links = links + '<nav aria-label="Page navigation example w-100">'
            links = links + ' <ul class="pagination justify-content-center">'
            $.each(response.links, function(key, url) {
                links = links + ' <li class="page-item"><a class="page-link" href=' + url.url + '>' + url.label + '</a></li>'
            })
            links = links + ' </ul>'
            links = links + '</nav> '
            $('#pagination').html(links);


        }
    })

    $(document).on("click", ".page-item a", function(event) {
        event.preventDefault();
        var page = $(this).attr('href');
        fetch_data(page);
        // var last_child = $('.page-item').parent().find('.child').find('li');
        // var list = last_child.prevObject.prevObject.prevObject;
        // var last_child = list[list.length - 1];
        // var last_child = last_child.find('.child').find('a')
        // console.log(last_child)
    })

    function fetch_data(page) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: page,

            success: function(response) {
                var data = " ";
                $.each(response.data, function(key, value) {

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
                $('tbody').html(data);
            }

        })
    }



}

allData();