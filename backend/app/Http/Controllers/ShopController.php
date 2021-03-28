<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Sort;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thanks;

class ShopController extends Controller
{
    public function index()
    {
        $stocks     = Stock::Paginate(6);
        $count      = Stock::count();
        $sort_lists = Sort::all();
        return view('shop',compact('stocks', 'count', 'sort_lists'));
    }

    public function search(Request $request,Stock $stock)
    {
        $stocks = $stock->serchValue($request->search);
        $count  = $stocks->count();
        $stocks = $stocks->Paginate(6);
        return view('shop',compact('stocks', 'count'));
    }

    public function sort(Request $request,Stock $stock)
    {
        $sort_id = $request->sort_id;
        $sort_lists = Sort::all();

        if ($sort_id === '') {
            $stocks = $stock->paginate(6);
            $count  = $stocks->count();
            return view('shop',compact('stocks', 'count', 'sort_lists'));
        } elseif ($sort_id === '1') {
            $stocks = $stock->orderBy('fee','desc')->paginate(6);
            $count  = $stocks->count();
            return view('shop',compact('stocks', 'count', 'sort_lists'));
        } elseif ($sort_id === '2') {
            $stocks = $stock->orderBy('fee','asc')->paginate(6);
            return view('shop',compact('stocks', 'sort_lists'));
        } elseif ($sort_id === '3') {
            $stocks = $stock->orderBy('created_at','desc')->paginate(6);
            return view('shop',compact('stocks', 'sort_lists'));
        }
    }

    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart',$data);
    }

    public function addMycart(Request $request,Cart $cart)
    {
       $stock_id = $request->stock_id;
       $message = $cart->addCart($stock_id);
       $data = $cart->showCart();
       return view('mycart',$data)->with('message',$message);
    }

    public function deleteCart(Request $request,Cart $cart)
    {
       $stock_id = $request->stock_id;
       $message = $cart->deleteCart($stock_id);
       $data = $cart->showCart();
       return view('mycart',$data)->with('message',$message);
    }

    public function checkout(Request $request,Cart $cart,Stock $stock)
    {
        $user = Auth::user();
        $stock_id = $request->stock_id;
        $mail_data['user'] = $user->name;
        $mail_data['checkout_items'] = $cart->checkoutCart();
        $stock->inventoryUpdate($stock_id);

        Mail::to($user->email)->send(new Thanks($mail_data));
        return view('checkout');
    }


}
