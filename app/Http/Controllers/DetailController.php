<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\detail;
use App\Models\Product;
use Carbon\Carbon;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pending=detail::whereStatus(0)->whereUserId($id)->get();
        $paid=detail::whereStatus(1)->whereUserId($id)->get();
        $deatils=detail::orderBy('id','desc')->whereUserId($id)->get();
        return view('panel.summary',compact('id','pending','paid','deatils'));
    }
    
    public function createOrder($id)
    {
        $products = Product::get();
        return view('panel.order',compact('id','products'));
    }

    public function change(Request $request)
    {
        $id = $request->id;
        $value = $request->val;
        $detail = detail::find($id);
        if($detail->total < $value)
        {
            return [
                'error' => 'Remaining value must be less or equal to total amount'
            ];
        }
        $status = 0;
        if($detail->total == $value)
            $status = 1;

        $detail->update([
            'paid' => $value,
            'status' => $status
        ]);

        return [
            'success' => 'Record Updated',
            'status' => $status
        ];
        
    }

    public function addOrder(Request $request)
    {
        $product = Product::find($request->product);
        if($product->price < $request->paid)
        {
            return redirect()->back()->withError('Paid value must be less or equal to total price of product');
        }
        $status = 0;
        if($product->price == $request->paid)
            $status = 1;
        detail::create([
            'user_id' => $request->id,
            'product_id' => $request->product,
            'total' => $product->price,
            'paid' => $request->paid,
            'status' => $status
        ]);
        return redirect()->route('user_detail',[$request->id])->withSuccess('Record Created Successfully');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
