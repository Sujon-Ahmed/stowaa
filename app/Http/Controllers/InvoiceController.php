<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function invoiceDownload($id)
    {
        $order = Order::findOrFail($id);
        $orderProducts = OrderedProduct::where('order_id', $id)->get();
        $billingDetails = BillingDetail::where('order_id', $id)->get();
        // return view('frontend.customer_order_invoice', [
        //     'order' => $order,
        //     'orderProducts' => $orderProducts,
        //     'billingDetails' => $billingDetails,
        // ]);
        return PDF::loadView('frontend.customer_order_invoice',[
            'order' => $order,
            'orderProducts' => $orderProducts,
            'billingDetails' => $billingDetails,
        ])->download('order-'.$order->id.'.pdf');
    }
}
