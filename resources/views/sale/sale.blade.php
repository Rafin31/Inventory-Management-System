<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Sale Table</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center h-auto w-auto">
            <marquee class="h3 p-3 text-light text-bold bg-primary w-100" behavior="" direction="right">Inventroy system
            </marquee>

            <div class="col-10 my-5">
                <div class="card">
                    <div class="card-header">
                        Sale Table
                    </div>
                    <div class="card-body table-responsive-sm">
                        <div class="col-12 d-flex justify-content-end">
                            <a class="btn btn-primary mb-3 w-25 " href="/">Stocks Table</a>
                        </div>
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Seller Name</th>
                                    <th scope="col">Selling Quantity</th>
                                    <th scope="col">Selling Price (Each)</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Profit</th>
                                    <th scope="col">Date</th>

                                </tr>
                            </thead>
                            <tbody>

                                <td colspan="6">
                                    <div class="text-center text-dark h3" id="loading" style="display: none;">
                                        Loading..
                                    </div>
                                </td>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



            <script>
                $(document).ajaxStart(function(){
                $("#loading").show();
                }).ajaxStop(function() {
                $("#loading").delay(5000).hide();
                });


                $.ajaxSetup({
                    headers:{
                     "x-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                function allData() {
                    $.ajax({
                        'type' : 'GET',
                        'dataType' : 'json',
                        'url' : "/sale_data",


                        success: function (response) {
                            var data = " " ;
               $.each(response ,function(key , value) {
                   console.log(value);

                data = data + "<tr>"
                   data = data + "<td>"+value.id+"</td>"
                   data = data + "<td>"+value.Product_Id+"</td>"
                   data = data + "<td>"+value.Product_Name+"</td>"
                   data = data + "<td>"+value.Seller_Name+"</td>"
                   data = data + "<td>"+value.sale_quantity+"</td>"
                   data = data + "<td>"+value.selling_price+"</td>"
                   data = data + "<td>"+value.total_selling_price+"</td>"
                   data = data + "<td>"+value.Profit+"</td>"
                   data = data + "<td>"+value.date+"</td>"
                   data = data + "<tr>"
              
               })
               $('tbody').html(data);
                        }
                    })
                }

                allData()
            </script>

</body>

</html>