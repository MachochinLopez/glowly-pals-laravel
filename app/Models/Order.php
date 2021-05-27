<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'order_status_id',
        'address',
        'description',
    ];

    /**************
     * Relaciones *
     **************/

    /**
     * Relación a clientes. Devuelve el cliente con el 
     * que esta orden se relaciona.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relación a la tabla de estados de órdenes. Devuelve 
     * el estado de orden al que se relaciona esta orden.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * Relación a la tabla intermedia entre órdenes y productos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /************************
     * Funciones del modelo *
     ************************/

    /**
     * Devuelve el arreglo con la información de la orden
     * en el formato esperado.
     * 
     * @return array
     */
    public function formatted()
    {
        return [
            'client_id' => $this->client->id,
            'client_full_name' => $this->client->full_name,
            'client_phone' => $this->client->phone,
            'order_status_id' => $this->orderStatus->id,
            'order_status_description' => $this->orderStatus->description,
            'products' => $this->orderProducts->map(function ($orderProduct) {
                return $orderProduct->product->formatted();
            }),
            'address' => $this->address,
            'description' => $this->description,
            'created_at' => date('Y-m-d, h:i:s', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d, h:i:s', strtotime($this->updated_at)),
        ];
    }
}
