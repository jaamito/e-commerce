@extends('layouts.app')

@section('content')
<style> /* E-commerce */
.product-box {
  padding: 0;
  border: 1px solid #e7eaec;
}
.product-box:hover,
.product-box.active {
  -webkit-box-shadow: 0 3px 7px 0 #a8a8a8;
  -moz-box-shadow: 0 3px 7px 0 #a8a8a8;
  box-shadow: 0 3px 7px 0 #a8a8a8;
}
.product-imitation {
  text-align: center;
  padding: 10px 0;
  background-color: #f8f8f9;
  color: #bebec3;
  font-weight: 600;
}
.cart-product-imitation {
  text-align: center;
  padding-top: 30px;
  height: 80px;
  width: 80px;
  background-color: #f8f8f9;
}
.product-imitation.xl {
  padding: 120px 0;
}
.product-desc {
  padding: 20px;
  position: relative;
}
.ecommerce .tag-list {
  padding: 0;
}
.ecommerce .fa-star {
  color: #d1dade;
}
.ecommerce .fa-star.active {
  color: #f8ac59;
}
.ecommerce .note-editor {
  border: 1px solid #e7eaec;
}
table.shoping-cart-table {
  margin-bottom: 0;
}
table.shoping-cart-table tr td {
  border: none;
  text-align: right;
}
table.shoping-cart-table tr td.desc,
table.shoping-cart-table tr td:first-child {
  text-align: left;
}
table.shoping-cart-table tr td:last-child {
  width: 80px;
}
.product-name {
  font-size: 16px;
  font-weight: 600;
  color: #676a6c;
  display: block;
  margin: 2px 0 5px 0;
}
.product-name:hover,
.product-name:focus {
  color: #1ab394;
}
.product-price {
  font-size: 14px;
  font-weight: 600;
  color: #ffffff;
  background-color: #1ab394;
  padding: 6px 12px;
  position: absolute;
  top: -32px;
  right: 0;
}
.product-detail .ibox-content {
  padding: 30px 30px 50px 30px;
}
.image-imitation {
  background-color: #f8f8f9;
  text-align: center;
  padding: 200px 0;
}
.product-main-price small {
  font-size: 10px;
}
.product-images {
  margin: 0 20px;
}

.ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox.collapsed .fa.fa-chevron-up:before {
  content: "\f078";
}
.ibox.collapsed .fa.fa-chevron-down:before {
  content: "\f077";
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}</style>
<div class='container-xl'>
    <div class='row'>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://www.vasterad.com/themes/trizzy/images/slider2.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style='font-size:50px'>URBAN STYLE</h5>
                        <p style='font-size:30px'>EVERY CUT AND COLOUR</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.vasterad.com/themes/trizzy/images/slider3.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style='font-size:50px'>NEW IN</h5>
                        <p style='font-size:30px'>PANTS AND T-SHIRTS</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.vasterad.com/themes/trizzy/images/slider.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style='font-size:50px'>DRESS SHARP</h5>
                        <p style='font-size:30px'>LEARN FROM THE CLASSICS</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <br>
    <div class='row'>
      @foreach( $categories as $key => $category )
        <div class='col-md-4'>
          <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="{{asset('storage/category/' . $category->categoryPathImage)}}" alt="Card image cap" style='max-height:170px; max-width:350px'>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$category->categoryName}}</h5>
                </div>
            </div>
          </div>
        </div>
      @endforeach 
    </div>
    <br>
    <div class="row">
        @foreach( $products as $key => $product )
          <div class="col-md-3">
              <div class="ibox">
                  <div class="ibox-content product-box">
                      <div class="product-imitation">
                          <img src='{{asset('storage/product/' . $product->productPathImage)}}' style='width:100%;height:100%;max-height:270px; max-width:215px'>
                      </div>
                      <div class="product-desc">
                          <span class="product-price">
                              {{$product->productPrice}} €
                          </span>
                          <small class="text-muted">{{$product->categoryName}}</small>
                          <a href="{{ route('productInfo', ['id' => $product->id]) }}" class="product-name"> {{$product->productName}}</a>

                          <div class="small m-t-xs">
                            {{$product->productShortDescription}}
                          </div><br>
                          <div class="m-t text-righ">
                              <a href="{{ route('productInfo', ['id' => $product->id]) }}" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
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
        @endforeach
    </div>
</div>

@endsection