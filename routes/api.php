<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Products;
use App\Models\Category;
use App\Models\Product_Category;
use App\Models\Cart;
use App\Models\Shopping_History;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/TalentFY',function(request $request){

//Pregunta 1
    $products = Cart::where('carts.dateBuy','!=','1900-01-01 12:12:12')->count();
    $users    = User::count();

    if(!$products || !$users){
        $res_01 = 0;
    }else{
        $res_01 = $products/$users;
    }
    


//Pregunta 2
    $products = Cart::join('products', 'carts.productId', '=', 'products.id')->where('carts.dateBuy','!=','1900-01-01 12:12:12')->select('products.productName','carts.productId' , Cart::raw('count(*) as total'))->groupBy('productId')->get();
    $res_02 = ["Id Producto" => NULL,"Nombre Producto" => '', "Veces comprado" => 0];
    foreach ($products as $key => $item){

       if($item->total > $res_02["Veces comprado"]){
        $res_02["Id Producto"]     = $item->productId;
        $res_02["Nombre Producto"] = $item->productName;
        $res_02["Veces comprado"]  = $item->total;
       }

    }

//Pregunta 3
    $products = Cart::where('carts.dateBuy','!=','1900-01-01 12:12:12')->get();
    $totalProducts = Cart::where('carts.dateBuy','!=','1900-01-01 12:12:12')->count();
    if(!$totalProducts){$totalProducts = 0;}
    $timeElapsed = 0;

    function convertSecToTime($sec){
        $date1 = new DateTime("@0"); 
        $date2 = new DateTime("@$sec"); 
        $interval =  date_diff($date1, $date2); 
        return $interval->format('%y Años, %m Meses, %d Dias, %h Horas, %i Minutos, %s Segundos'); 
    }

    
    foreach ($products as $key => $item){
        
        $dateBuy = strtotime($item->dateBuy);
        $dateCreate = strtotime($item->created_at);
        $timeElapsed = $timeElapsed + ($dateBuy - $dateCreate);
        
    }
    
    if($timeElapsed == 0 || !$totalProducts){
        $timeElapsed = 0;
    }else{
        $timeElapsed = ($timeElapsed/$totalProducts);
    }

    
    $res_03 = convertSecToTime(round($timeElapsed));

//Pregunta 4

    //Transcurridos 10min (En segundos)
    $tiempoTranscurrido = 600;
    //Producto ID 1;
    $idProducto = 1;
    $res_04 = ["Porcentaje de usuarios que han comprado" => "0%","Cuantos lo han descartado" => 0, "Cuantos lo continúan teniendo en la cesta" => 0];

    //Pregunta 1
    $products = Cart::where('carts.productId','=',$idProducto)->where('carts.dateBuy','!=','1900-01-01 12:12:12')->count();

    $totalProducts = Cart::where('carts.productId','=',$idProducto)->where('carts.dateNotBuy','=','1900-01-01 12:12:12')->get()->count();


    $res_04["Porcentaje de usuarios que han comprado"] = (round($products/$totalProducts,2) *100)."%";
    
    //Pregunta 2
    $products = Cart::where('carts.productId','=',$idProducto)->where('carts.dateNotBuy','!=','1900-01-01 12:12:12')->count();
    
    if($products){
        $res_04["Cuantos lo han descartado"] = $products;
    }else{
        $res_04["Cuantos lo han descartado"] = "0";
    }

    $products = Cart::where('carts.productId','=',$idProducto)->where('carts.dateNotBuy','=','1900-01-01 12:12:12')->where('carts.dateBuy','=','1900-01-01 12:12:12')->count();
    if($products){
        $res_04["Cuantos lo continúan teniendo en la cesta"] = $products;
    }else{
        $res_04["Cuantos lo continúan teniendo en la cesta"] = "0";
    }

    return response()->json([
        'Productos comprados de media por usuario' => $res_01, 
        'Producto más comprado' => $res_02, 
        'Tiempo de media que tardan en comprar un producto' => $res_03,
        'Transcurrido el tiempo de 6minutos (Tiempo HardCode)' => $res_04
    ]);	

});