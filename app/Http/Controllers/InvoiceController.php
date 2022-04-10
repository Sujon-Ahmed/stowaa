<?php

namespace App\Http\Controllers;



use App\Models\OrderedProduct;
use App\Models\BillingDetail;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Order;
use Session;
use PDF;
use Config;

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
