<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'deposit_id',
        'quantity'
    ];

    /**************
     * Relaciones *
     **************/

    /**
     * Relación a productos. Devuelve el prodcuto con el 
     * que este inventario se relaciona.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relación a depósitos. Devuelve el prodcuto con el 
     * que este inventario se relaciona.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    /************************
     * Funciones del modelo *
     ************************/

    /**
     * Devuelve el arreglo con la información del inventario
     * en el formato esperado.
     * 
     * @return array
     */
    public function formatted()
    {
        return [
            'inventory_id' => $this->inventory_id,
            'product_id' => $this->product->id,
            'product_description' => $this->product->description,
            'quantity' => $this->quantity,
            'unit_description' => $this->product->unit->description,
            'unit_short_name' => $this->product->unit->short_name,
            'unit_id' => $this->product->unit->id,
            'created_at' => date('Y-m-d, h:i:s', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d, h:i:s', strtotime($this->updated_at)),
        ];
    }
}
