<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $nombre
 * @property $telefono
 * @property $ingresoquincenal
 * @property $disponiblequincenal
 * @property $ajuste
 * @property $confirmaciontelefono
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Documento[] $documentos
 * @property Solicitude[] $solicitudes
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'telefono' => 'required',
		//'ingresoquincenal' => 'required',
		//'disponiblequincenal' => 'required',
		'confirmaciontelefono' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'convenio', 'telefono','ingresoquincenal','disponiblequincenal','ajuste','user_id','confirmaciontelefono'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentos()
    {
        return $this->hasMany('App\Models\Documento', 'idcliente', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes()
    {
        return $this->hasMany('App\Models\Solicitude', 'idcliente', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
