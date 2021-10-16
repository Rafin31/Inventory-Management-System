<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>

    <title>Inventroy System | Stocks</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center flex-wrap  h-auto">
            <marquee class="h3 p-3 text-light text-bold bg-primary" behavior="" direction="right">Inventroy system
            </marquee>

            <div class="col-12 my-3">
                <div class="card">
                    <div class="card-header">
                        Products
                    </div>
                    <div class="card-body table-responsive-sm">
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Catagory</th>
                                    <th scope="col">Seller Name</th>
                                    <th scope="col">Price Each</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Stock In</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-7 col-md-5">
                <div class="card ">
                    <div class="card-header">
                        <p id="addP"><strong>Add Product</strong></p>
                        <p id="updateP"><strong>Update Product</strong></p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control" id="product_name" aria-describedby="emailHelp"
                                placeholder="Product Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Catagory</label>
                            <input type="text" class="form-control" id="catagory" placeholder="Catagory">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Seller Name</label>
                            <input type="text" class="form-control" id="seller_name" placeholder="Seller Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Price Each</label>
                            <input type="text" class="form-control" id="price_each" placeholder="Price Each">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quantity</label>
                            <input type="text" class="form-control" id="quantity" placeholder="Quantity">
                        </div>

                        <button type="submit" id="addButton" onclick="addData()"
                            class="btn btn-primary w-100 ">Add</button>
                        <button type="submit" id="updateButton" class="btn btn-info w-100 ">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#addP').show();
        $('#updateP').hide();
        $('#addButton').show();
        $('#updateButton').hide();


        $.ajaxSetup({
            headers:{
                "x-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        function allData(params){
            $.ajax({
            type:"GET",
            dataType: 'json',
            url: "/stocks",
            success:function(response){
                var data = " " ;
               $.each(response ,function(key , value) {

                data = data + "<tr>"
                   data = data + "<td>"+value.id+"</td>"
                   data = data + "<td>"+value.Product_Name+"</td>"
                   data = data + "<td>"+value.Catagory+"</td>"
                   data = data + "<td>"+value.Seller_Name+"</td>"
                   data = data + "<td>"+value.Product_Price+"</td>"
                   data = data + "<td>"+value.Quantity+"</td>"
                   data = data + "<td>"+value.Total_Price+"</td>"
                   data = data + "<td>"+value.Stock_in_date+"</td>"
                   data = data + "<td>"
                   data = data + "<button class='btn btn-success'>Sold</button>"
                   data = data + "<button class='btn btn-info mx-3'>Edit</button>"
                   data = data + "<button class='btn btn-danger'>Delete</button>"
                   data = data + "</td>"
                   data = data + "<tr>"
                  
               })
               $('tbody').html(data);
            }
        })
        }

        allData();

        function addData(){
            let product_name = $('#product_name').val();
            let catagory =  $('#catagory').val();
            let seller_name = $('#seller_name').val();
            let price_each = $('#price_each').val();
            let quantity = $('#quantity').val();



            $.ajax({
                type:"POST",
                dataType: 'json',
                data: {product_name:product_name , catagory:catagory , seller_name:seller_name , price_each:price_each , quantity:quantity},
                url:"/addProduct",

                success:function(data){
                    allData();
                    alert("Added");
                }
            })


        
        }

    </script>


</body>



</html>