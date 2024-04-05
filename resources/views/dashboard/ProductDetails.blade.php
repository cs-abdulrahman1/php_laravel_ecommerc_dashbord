@extends('layouts.base')

@section('content')


    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row mt-5">
            <div class="col">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-dark">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add New Product Details
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-success" id="staticBackdropLabel">Add New Product</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                           
                                    </div>
                            <div class="modal-body">
                                <form action="{{ route('createproductdetails') }}" method="POST">
                                    @csrf
                                    <div class="col">
                                        <label for="name" class="form-label text-dark">Product Name</label>
                                        <select  class="form-select text-dark" aria-label="Default select example"
                                            name="product_id" required>
                                            <option selected>Open this select menu</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->ProductName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row ">
                                        <div class="col">
                                            <label for="qty" class="form-label text-dark">Quantity</label>
                                            <input type="text" id="qty" required
                                                class="form-control @error('qty') is-invalid @enderror" name="qty">
                                        </div>
                                        <div class="col">
                                            <label for="description" class="form-label text-dark">Description</label>
                                            <input type="text" id="description" class="form-control" name="description" required
                                            class="form-control @error('description') is-invalid @enderror" name="description">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col ">
                                            <label for="color" class="form-label text-dark">Color</label>
                                            <input type="text" id="color" class="form-control" name="color" required
                                            class="form-control @error('color') is-invalid @enderror" name="color">
                                            
                                        </div>
                                        <div class="col ">
                                            <label for="price" class="form-label text-dark">Price</label>
                                            <input type="text" id="id" class="form-control" name="price" required
                                            class="form-control @error('price') is-invalid @enderror" name="price">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info mt-3">save</button>
                                    <button type="button" class="btn btn-secondary mt-3"
                                        data-bs-dismiss="modal">cancel</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-8">
            <form action="{{ route('product-details') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control me-3" placeholder="Search" name="search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
                <a href="{{ url('/dashboard/products') }}" class="btn btn-secondary" type="submit">Show All Products Details</a>
            </div>
        </div>
        <div class="row mt-5 text-dark">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-light">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-info">
                                <tr>
                                @foreach ($ProductDetails as $items)
                                <tr>
                                    <th scope="row" class="text-dark">{{ $items->id }}</th>
                                    <td class="text-dark">{{ $items->productName }}</td>
                                    <td class="text-dark">{{ $items->qty }}</td>
                                    <td class="text-dark">{{ $items->description }}</td>
                                    <td class="text-dark">{{ $items->color }}</td>
                                    <td class="text-dark">{{ $items->price }}</td>
                                    <td><a href="{{ route('delete_details', ['id' => $items->id]) }}"><i
                                                class="fa fa-trash text-danger"></i></a>
                                        {{-- <a id="edit" href="{{}}"><i class="fa fa-edit text-success"></i></a></td> --}}
                                        <a href="#" class="edit" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal" data-id="{{ $items->id }}"
                                            data-name="{{ $items->productName }}"><i
                                                class="fa fa-edit text-success"></i></a>

                                        {{-- <td><a href="{{ route('del', ['id' => $items->id]) }}"><i
                                                class="fa fa-trash text-danger"></i></a>
                                        {{-- <a id="edit" href="{{}}"><i class="fa fa-edit text-success"></i></a></td> --}}
                                        {{-- <a href="#" class="edit" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal" data-id="{{ $items->id }}"
                                            data-name="{{ $items->ProductName }}"><i
                                                class="fa fa-edit text-success"></i></a> --}}

                                </tr>
                                @endforeach
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade text-dark" id="editProductModal" tabindex="-1"
                    aria-labelledby="editProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog text-dark">
                        <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>