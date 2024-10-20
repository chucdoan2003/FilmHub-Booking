<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class AdminOrderController extends Controller
{
    const PATH_VIEW = 'admin.order.';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['orderItems.productVariant.productSize', 'orderItems.productVariant.productColor'])->get();

        return view(self::PATH_VIEW.__FUNCTION__, compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */

}
