<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /************************
     * Funciones del modelo *
     ************************/

    /**
     * Devuelve el arreglo con la información del usuario
     * en el formato esperado.
     * 
     * @return array
     */
    public function formatted()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => date('Y-m-d, h:i:s', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d, h:i:s', strtotime($this->updated_at)),
        ];
    }
}
