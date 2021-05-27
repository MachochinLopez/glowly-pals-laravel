<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Devuelve los nuevos pedidos con el estado de Pedido Nuevos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('order_status_id')) {
            $orders = Order::where('order_status_id', request()->order_status_id)->get();
        } else {
            $orders = Order::all();
        }

        return response()->json([
            'data' => $orders->map(function ($order) {
                return $order->formatted();
            }),
        ]);
    }

    /**
     * Devuelve los nuevos pedidos con el estado de Pedido Nuevos.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllNewOrders()
    {
        $orders = Order::where('order_status_id', 1)
            ->get()
            ->map(function ($order) {
                return $order->formatted();
            });

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * Devuelve los pedidos con el estado de Listo para entregar.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllOrdersReadyToDeliver()
    {
        $orders = Order::where('order_status_id', 3)
            ->get()
            ->map(function ($order) {
                return $order->formatted();
            });

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * Cambia el estatus del pedido a "Preparando".
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function markAsPreparing(Order $order)
    {
        $order->update([
            'order_status_id' => 2
        ]);

        return [
            'state' => 'success',
            'data' => $order,
        ];
    }

    /**
     * Cambia el estatus del pedido a listo para entregar.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function markAsReadyToDeliver(Order $order)
    {
        $order->update([
            'order_status_id' => 3
        ]);

        return [
            'state' => 'success',
            'data' => $order,
        ];
    }


    public function createDummyOrder()
    {
        DB::table('orders')->insert([
            [
                'client_id' => 1,
                'order_status_id' => 1,
                'address' => 'Bravo 209, Zona Centro, 64700, Monterrey, Nuevo León',
                'description' => 'Empaquetado regular',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ]
        ]);

        return response()->json([
            'state' => 'success'
        ]);
    }
}
