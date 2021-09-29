@extends('layouts.app')

@section('content')
<div class='containter'>
    <div class='row justify-content-md-center'>
        <div class='col-md-4'>
            <h1>Products</h1>
            <ul class="list-group">
                <?php $total = 0 ?>
                @foreach( $cart as $key => $item )
                    @if($item->dateBuy == '1900-01-01 12:12:12' and $item->dateNotBuy == '1900-01-01 12:12:12')
                        <li class="list-group-item">
                            <div class='row'>
                                <div class='col-md-4'>
                                <b>{{$item->productName}}</b><br>
                                    <img src='{{asset('storage/product/' . $item->productPathImage)}}' class='product-image' style='width:100px;height:100px'>
                                </div>
                                <div class='col-md-3 align-middle'>
                                    {{$item->productShortDescription}}
                                </div>
                                <div class='col-md-3 align-middle'>
                                    <h1><b>{{$item->productPrice}}€</b></h1> 
                                </div>
                                <div class='col-md-2 align-middle'>

                                    <a href='{{ route('delBuy', ["id" => $item->cartId]) }}' class="btn btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php $total = $total + $item->productPrice ?>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class='col-md-2'>
            <h1>Total</h1>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class='row'>
                        <div class='col-md-6'>
                            <h2 style='margin:0px'><?php echo $total ?>€</h2>
                        </div>
                        <div class='col-md-6'>
                            <a href="{{ route('Buy') }}" class=" btn btn-block btn-primary btn-xs" style='padding:2px'>
                                Buy
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
