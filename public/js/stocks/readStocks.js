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

            //     links = links + '<nav aria-label="Page navigation example">'
            //     links = links + ' <ul class="pagination justify-content-center">'
            //     links = links + ' <li class="page-item"><a class="page-link" active=' + links.active + 'href=' + links.url + '>' + links.label + '</a></li>'
            // })

            // links = links + ' </ul>'
            // links = links + '</nav> '
            // $('#pagination').html(links);


        }
    })
}

allData();

{
    /* 
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav> */
}