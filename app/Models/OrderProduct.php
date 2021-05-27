<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
    ];

    /**************
     * Relaciones *
     **************/

    /**
     * Relación a la tabla de órdenes. Devuelve la orden a la
     * que pertenece este OrderProduct.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relación a productos. Devuelve el cliente con el 
     * que esta OrderProduct se relaciona.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
