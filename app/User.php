<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;//EDU //edu
use Illuminate\Auth\Authenticatable as AuthenticableTrait; //edu
use Illuminate\Auth\Passwords\CanResetPassword;//parche
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;//parche
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract; //parche

//parche
class User extends Moloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use AuthenticableTrait; //edu
    use Notifiable;
    use CanResetPassword;//parche

    // Cambiar de nombre timestamp
    const CREATED_AT = 'FechaHora_creación';
    const UPDATED_AT = 'FechaHora_actualización'; 


    // Por defecto, todos los modelos Eloquent usarán la conexión de base de datos predeterminada configurada para su aplicación. Si desea especificar una conexión diferente para el modelo, use la $connectionpropiedad:
    // protected $connection = 'mongodb'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // Las lineas siguientes hay que borrar
    /**
     * The attributes that should be cast to native types.
     *
     *  @var array 
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}