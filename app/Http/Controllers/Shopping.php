<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;



class Shopping extends Controller
{
    public function ShowListItemPhone(Request $request){
        $data = DB::table('products')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->get();
        $tax = 0.15;
        foreach ($data as $key => $value) {
            $data[$key]->total = $value->price * $tax + $value->price;
            $data[$key]->tax = $tax;
            $data[$key]->descount = 10;
            $data[$key]->net = $data[$key]->total - $data[$key]->descount;
        }
        // return $data;
        return view('shopping.list-items' , compact('data'));
    }

    public function ShowDetailsPhone($id){

        $data = DB::table('products')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->where('product_details.id' , $id)
        ->first();
        $tax=0.15;
        $descount = 10;
        $data->total = $data->price * $tax + $data->price;
        $data->tax = $tax;
        $data->descount = 10;
        $data->net = $data->total - $data->descount;
        // return $data;

        return view('shopping.details' , compact('data'));
    }

    
    public function Add_to_cart(Request $request , $id){
        $userid = $request->user()->id;
        $data= DB::table('products')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->where('product_details.id' , $id)
        ->first();
        $tax=0.15;
        $descount = 10;
        $data->total = $data->price * $tax + $data->price;
        $data->tax = $tax;
        $data->descount = 10;
        $data->net = $data->total - $data->descount;

        $row = [
            'product_id'=>$data->id,
            'price'=>$data->price,
            'qty'=>$data->qty,
            'tax'=>$data->tax,
            'total'=>$data->total,
            'discount'=>$data->descount,
            'user_id'=>$userid,
            'Net'=>$data->net,
        ];

        DB::table('carts')->insert($row);
        $count = DB::table('carts')->where('user_id' , $userid)->count();
        Session::put('count' , $count);
        return redirect()->back()->with('message', 'Product Added To Cart');

    }

    public function GetCoffee(){
        $response = Http::get('https://api.sampleapis.com/coffee/hot');
        $data = $response->object();

        return view('shopping.cafe' , compact('data'));
    }

    public function GetUsersApi(){
        $apiURL = 'https://v1.baseball.api-sports.io/leagues';
        $headers = [
            'Content-Type' => 'application/json',
            'X-RapidAPI-Key' => '24c939c2ba293c859d5ecd476932d293',

        ];
        $response = Http::withHeaders($headers)->get($apiURL);
        $data = $response->json();
        return $data;

    }
    public function Cart(){
        $userid = auth()->user()->id;
        $data = DB::table('carts')
        ->join('product_details' , 'product_details.id' , '=' , 'carts.product_id')
        ->where('carts.user_id' , $userid)
        ->get();

        $total_price = DB::table('carts')
        ->join('product_details' , 'product_details.id' , '=' , 'carts.product_id')
        ->where('carts.user_id' , $userid)
        ->sum('carts.price');


        return view('shopping.cart' , compact('data' , 'total_price'));
    }

}