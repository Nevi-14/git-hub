<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use App\Models\orderItems;
use Illuminate\Http\Request;

use Cart;
class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


  //  Todos los datos del usuario  $user = Auth::user();
  $user = Auth::id();

  $request->validate([
    'name' => 'required',
    'contact_number' => 'required',
    'email' => 'required',
    'addrress' => 'required'
]);




$order = orders::create(
    [
        'user_id' =>$user ,
        'name' => $request->name ,
        'addrress' =>$request->addrress  ,
        'contact_number' => $request->contact_number ,
        'email' =>$request->email,   

    ]


    );


    
$id = $order->id;


    $cartItems =  Cart::getContent();

 
    foreach($cartItems as $item){

        $order = orderItems::create(
            [
                'order_id' =>$id  ,
                'product_id' =>$item->id ,
                'price' => $item->price,           
                'quantity' => $item->quantity ,
                  
        
            ]
            );
   
            DB::table('products')->where('id',$item->id)->decrement('stock',$item->quantity);

    }

      Cart::clear();

return redirect()->route('products.index')
                ->with('success','Product created successfully.');

    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ordes  $ordes
     * @return \Illuminate\Http\Response
     */
    public function show(ordes $ordes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ordes  $ordes
     * @return \Illuminate\Http\Response
     */
    public function edit(ordes $ordes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ordes  $ordes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ordes $ordes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ordes  $ordes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ordes $ordes)
    {
        //
    }
}