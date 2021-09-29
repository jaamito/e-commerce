@extends('layouts.app')

@section('content')

@if($err == 0)
    <section class="content">
        <div class='col-md-12'>
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                            <div class="col-12">
                                <img src='{{asset('storage/product/' . $product->productPathImage)}}' class='product-image' style='width:70%;height:70%'>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3 class="my-3">{{$product->productName}}</h3>
                            <p>{{$product->productShortDescription}}</p>
                            <hr>
                            <h4>Description</h4>
                            <div class="" data-toggle="">
                                
                                    {{$product->productDescription}}    
                               
                            </div>
                            <hr>
                            <h4>Category</h4>
                            
                            @foreach( $categories as $key => $category )
                                <a href="{{ route('categoryInfo', ['id' => $category->id]) }}"><span class="badge">{{$category->categoryName}}</span></a>   
                            @endforeach
                        
                            <hr>
                            <h4>Price</h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-default text-center active">
                                    {{$product->productPrice}}€    
                                </label>
                            </div>

                            <div class="m-t text-righ">
                              <a href="{{ route('addToCartProduct', ['id' => $product->id]) }}" class="btn btn-xs btn-outline btn-primary"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg> 
                                Add to cart 
                                <i class="fa fa-long-arrow-right"></i> 
                              </a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <div class='containter text-center'>
        <div class='row'>
            <div class='col-md-12'>
                <h1>Oops!</h1>
                <br>
                <h4>Product not found...</h4>
            </div>
        </div>
    </div>
@endif

@endsection
