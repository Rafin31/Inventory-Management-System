<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">


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
                        <div class="row justify-content-center">
                            <div class="col-12 justify-content-center">
                                <a class="btn btn-primary mb-3 w-25 " href="/sale_table">Sale Table</a>
                            </div>
                            <div class="col-8 form-outline mb-4">
                                <input type="search" class="form-control" id="search_input" placeholder="Search">
                            </div>
                        </div>
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
                                    <div class="text-center text-dark h3 loading">
                                        <h3 class="alert-info text-dark font-weight-bold py-3">Loading...</h3>
                                    </div>
                                </td>
                            </tbody>
                        </table>

                        <div class="pagination" id="pagination">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-10 col-md-5">
                <div class="card ">
                    <div class="card-header">

                        <p id="addP" class="show"><strong>Add Product</strong></p>
                        <p id="updateP" class="show"><strong>Update Product</strong></p>
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
                            class="btn btn-primary w-100 show">Add</button>
                        <button type="submit" id="updateButton" class="btn btn-info w-100 show"
                            onclick="updated()">Update</button>
                        <div class="errors">
                            <span class="alert-danger " id="updateButton"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Product Id</span>
                        </div>
                        <input type="number" id="sale_product_id" class="form-control" aria-label="Small"
                            aria-describedby="inputGroup-sizing-sm" disabled>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                        </div>

                        <input type="number" id="sale_quantity" class="form-control" name="quantity_of_selling"
                            aria-label=" quantity">

                        <span class="alert-danger font-weight-bold" id="sold_quantity"></span>

                    </div>

                    <div class="input-group">
                        <input type="number" id="sale_price" class="form-control" name="price_of_selling"
                            aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">BDT</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div>
                    <div class="error">
                        <span class="alert-danger font-weight-bold" id="sold_price"> </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="sold()">Sold</button>
                </div>
            </div>
        </div>
    </div>

    @include('ajaxSetup.ajaxSetup');

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/InsertStocks.js')}}"></script>
    <script src="{{asset('js/stocks/InsertStocks.js')}}"></script>
    <script src="{{asset('js/stocks/updateStocks.js')}}"></script>
    <script src="{{asset('js/stocks/searchStocks.js')}}"></script>
    <script src="{{asset('js/stocks/deleteStocks.js')}}"></script>
    <script src="{{asset('js/stocks/readStocks.js')}}"></script>
    <script src="{{asset('js/stocks/soldStocks.js')}}"></script>

    <script src="{{asset('js/sale/readSale.js')}}"></script>
    <script src="{{asset('js/sale/searchSale.js')}}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script>
        $(document).ajaxStart(function(){
        $(".loading").show();
        }).ajaxStop(function() {
          $(".loading").hide();
        });

        $('#addP').show();
        $('#updateP').hide();
        $('#addButton').show();
        $('#updateButton').hide();


    </script>


</body>



</html>