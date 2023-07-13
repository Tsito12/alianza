<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitude
 *
 * @property $id
 * @property $pagominimo
 * @property $pagomaximo
 * @property $pagodeseado
 * @property $plazo
 * @property $creditomaximo
 * @property $prestamosolicitado
 * @property $estado
 * @property $idcliente
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Solicitude extends Model
{
    
    static $rules = [
		'pagominimo' => 'required|float',
		'pagomaximo' => 'required|float|gt:pagominimo',
		'pagodeseado' => 'required|float|gte:pagominimo|lte:pagomaximo',
		'plazo' => 'required|integfloater|digits_between:1,2',
		'creditomaximo' => 'required|float',
		'prestamosolicitado' => 'required|float|lte:creditomaximo',
		//'idcliente' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pagominimo','pagomaximo','pagodeseado','plazo','creditomaximo','prestamosolicitado','estado','idcliente'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'idcliente');
    }
    

}
