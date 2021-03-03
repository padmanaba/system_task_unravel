<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Items;
use App\Cart;
use App\Transaction;
use Response;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Items::where('status', 'Active')->get();
        return view('home',compact('items'));
    }

    public function add_cart(Request $request)
    {
        $exists = Cart::where('user_id',Auth::user()->id)->first();
        if($exists)
        {
            $data = 1;
            return $data;
        }

        $already_exists = Cart::where('item_id',$request->id)->where('user_id', Auth::user()->id)->first();

        if(!$already_exists)
        {
            $cart = new Cart;
            $cart->item_id = $request->id;
            $cart->user_id = Auth::user()->id;
            $cart->item_count = '1';
            $cart->save();
        }
        else
        {
            $cart = Cart::find($already_exists->id);
            $cart->item_count = $already_exists->item_count + 1;
            $cart->save();
        }


        return response()->json('success');
    }

    public function cart(Request $request)
    {
        $cart = Cart::with('user','item')->where('user_id', Auth::user()->id)->get();
        // dd($cart);
        return view('cart',compact('cart'));
    }

    public function place_order(Request $request)
    {
        $cart = Cart::where('user_id',Auth::user()->id)->first();
        $rand = rand(10000,99999);
        $transacation = new Transaction;
        $transacation->transaction_id = 'tran'.$rand;
        $transacation->user_id = $cart->user_id;
        $transacation->item_id = $cart->item_id;
        $transacation->total_amount = $request->total_amount;
        $transacation->payment_method = 'Cash';
        $transacation->save();

        $cart->delete();

        return Redirect('home');
    }

    public function transactions(Request $request)
    {
        $transasction = Transaction::with('user','item')->where('user_id', Auth::user()->id)->get();
        return view('transaction',compact('transasction'));
    }

}
