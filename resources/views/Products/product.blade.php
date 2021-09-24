@extends('layouts.app')

@section('content')
<div class="container">
    <form method='post' action='{{ url('saveProduct') }}' enctype="multipart/form-data">
    @csrf
        <div class='row'>
            <div class='col-md-9'>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add new product</h3>
                    </div>
                    <div class="card-body">
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" id="productName" name='productName' placeholder="Product name">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label for="productImage">Product image</label>
                                    <input type="file" class="form-control-file" id="productImage" name='productImage'>
                                </div>
                            </div>
                        </div>    
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product short description</label>
                            <textarea class="form-control" id="productShortDescription" rows="2" name='productShortDescription'></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product description</label>
                            <textarea class="form-control" id="productDescription" rows="4" name='productDescription'></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product price</label>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">€</span>
                                </div>
                                <input class="form-control" type='number' step='0.01' id="productPrice" name='productPrice' rows="4">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            <div class='col-md-3'>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product categories</h3>
                    </div>
                    <div class='card-body'>
                        @foreach( $categories as $key => $category )
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value='{{$category->id}}' name='category[]' id="category">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$category->categoryName}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class='card-footer'>
                        <a  href='{{ url('createCategory') }}' class="btn btn-primary">Add new category</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
