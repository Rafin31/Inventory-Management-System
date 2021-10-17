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

    <title>Inventroy System | Stocks</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center h-auto w-auto">
            <marquee class="h3 p-3 text-light text-bold bg-primary w-100" behavior="" direction="right">Inventroy system
            </marquee>

            <div class="col-10 my-5">
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

                                <td colspan="9">
                                    <div class="text-center text-dark h3" id="loading" style="display: none;">
                                        Loading..
                                    </div>
                                </td>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-10 col-md-5">
                <div class="card ">
                    <div class="card-header">
                        <p id="addP"><strong>Add Product</strong></p>
                        <p id="updateP"><strong>Update Product</strong></p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name"
                                aria-describedby="emailHelp" placeholder="Product Name">


                            <span class="alert-danger" id="product_name_error"></span>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Catagory</label>
                            <input type="text" class="form-control" name="catagory" id="catagory"
                                placeholder="Catagory">
                            <div class="errors">
                                <span class="alert-danger " id="catagory_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Seller Name</label>
                            <input type="text" class="form-control" name="seller_name" id="seller_name"
                                placeholder="Seller Name">
                            <div class="errors">
                                <span class="alert-danger " id="seller_name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Price Each</label>
                            <input type="text" class="form-control" name="price_each" id="price_each"
                                placeholder="Price Each">
                            <div class="errors">
                                <span class="alert-danger " id="price_each_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity"
                                placeholder="Quantity">
                            <div class="errors">
                                <span class="alert-danger w-100" id="quantity_error"></span>
                            </div>
                            <input type="hidden" id="id">
                        </div>

                        <button type="submit" id="addButton" onclick="addData()"
                            class="btn btn-primary w-100 ">Add</button>
                        <button type="submit" id="updateButton" class="btn btn-info w-100"
                            onclick="updated()">Update</button>
                        <div class="errors">
                            <span class="alert-danger " id="updateButton"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ajaxStart(function(){
          $("#loading").show();
        }).ajaxStop(function() {
          $("#loading").delay(5000).hide();
        });



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
                   data = data + "<a href='#updateButton' class='btn btn-info mx-3' onclick='editData("+value.id+")'  >Edit</a>"
                   data = data + "<button class='btn btn-danger' onclick='deleteData("+value.id+")' >Delete</button>"
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
                    $(".form-control").val('');

                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
                   
                    
                },
                error:function(data){

                  $("#product_name_error").text(data.responseJSON.errors.product_name);
                  $("#seller_name_error").text(data.responseJSON.errors.seller_name);
                  $("#catagory_error").text(data.responseJSON.errors.catagory);
                  $("#price_each_error").text(data.responseJSON.errors.price_each);
                  $("#quantity_error").text(data.responseJSON.errors.quantity);
                }
            })
        
        }

        function editData(id) {
            

            $.ajax({
                type : "GET",
                dataType:"json",
                url:"/edit/"+id,


                success:function(data) {

                    $('#addP').hide();
                    $('#updateP').show();
                    $('#addButton').hide();
                    $('#updateButton').show();

                    let product_name = $('#product_name').val(data.Product_Name);
                    let catagory =  $('#catagory').val(data.Catagory);
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
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {

                let id = $('#id').val();
                let product_name = $('#product_name').val();
                let catagory =  $('#catagory').val();
                let seller_name = $('#seller_name').val();
                let price_each = $('#price_each').val();
                let quantity = $('#quantity').val();

            $.ajax({
                type:"POST",
                dataType:"json",
                data:{product_name:product_name , catagory:catagory , seller_name:seller_name , price_each:price_each , quantity:quantity},
                url:"/edit/"+id+"/updated",

                success:function(data){
                    allData();
                },
                error:function(data){

                $("#product_name_error").text(data.responseJSON.errors.product_name);
                $("#seller_name_error").text(data.responseJSON.errors.seller_name);
                $("#catagory_error").text(data.responseJSON.errors.catagory);
                $("#price_each_error").text(data.responseJSON.errors.price_each);
                $("#quantity_error").text(data.responseJSON.errors.quantity);
            }

            })

                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

         
               
           

        }

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
                type:"POST",
                dataType:"json",
                data:{id:id},
                url:"/delete/"+id,

                success:function(data){
                    allData();
                },
                error:function(data){
                    alert("Something Went Worng");
               
            }

            })

            swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
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

    </script>


</body>



</html>