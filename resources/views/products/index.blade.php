@extends('layouts.app')

@section('content')
    @if(Auth::user())
        <div class="container">
            <h2 class="text-center">Products List</h2>
            @if(Session::get('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>{{ \Session::get('status') }}</p>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>{{ \Session::get('success') }}</p>
                </div><br/>
            @endif
            <div class="row mb-4">
               &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <div class="col-4 col-md-8">
                    <a href="{{route('products.create')}}" class="btn btn-info float-right btn-dark">
                        Create Product <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover m-0 text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>OEM</th>
                        <th class="align-middle">Model Number</th>
                        <th>Product Type</th>
                        <th>Price(Rs.)</th>
                        <th>Configuration Assumption</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $product)
                        <tr id="productId-{{$product->id}}">
                            <td>{{$product->id}}</td>
                            <td>{{$product->oem}}</td>
                            <td>{{$product->model_no}}</td>
                            <td>{{$product->product_type}}</td>
                            <td data-mask="000.000,00" data-mask-reverse="true">{{$product->price}}</td>

                            <td>{{$product->config}}</td>
                            
                            <td>
                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('products.show', $product->id)}}" class="btn btn-info">show</a>
                                <button class="delete btn btn-danger" onclick="deleteProduct({{$product->id}})"
                                        type="button">Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links()}}
        </div>
    @else
        <div class="text-center">
            <i style="font-size: 100px" class="material-icons">
                block
            </i>
            <h1>You must be logged for access this page!</h1>
            <a href="{{route('home')}}" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Go to
                login page</a>
        </div>
    @endif
@endsection
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        function deleteProduct(id) {
            $.ajaxSetup({
                headers:
                    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            $.confirm({
                title: 'Delete!',
                content: 'you sure you want delete this product?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: "DELETE",
                            url: `/products/${id}`,
                            success: function (response) {
                                $.alert(response.message);
                                $(`#productId-${id}`).remove();
                            },
                            error: function () {
                                $.alert('Error to delete, try again')
                            }
                        })
                    },

                    cancel: function () {
                        $.alert('Canceled!');
                    },
                }
            });
        }</script>
@endsection
