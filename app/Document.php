<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;//EDU

class Document extends Moloquent
{
    //

    public $timestamps = FALSE;
    // // Cambiar de nombre timestamp
    // const CREATED_AT = 'FechaHora_creación';
    // const UPDATED_AT = 'FechaHora_actualización'; 
    
    protected $connection = 'mongodb'; //edu
    protected $guarded = [];
       //public $primarykey = 'email'; //if use custom primary key si no se usa el id  or default
    //Solo permite el ingreso de campos especificos
    //protected $fillable = [
      //  'name', 'email', 'password',
    //];
}
