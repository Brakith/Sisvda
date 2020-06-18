<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;//EDU

class Document extends Moloquent
{
    public $timestamps = FALSE;
    // // Cambiar de nombre timestamp
    // const CREATED_AT = 'FechaHora_creación';
    // const UPDATED_AT = 'FechaHora_actualización'; 
    
    // Del mismo modo, puede definir una propiedad de conexión para anular el nombre de la conexión de la base de datos que se debe usar al utilizar el modelo.
    // protected $connection = 'mongodb'; 

    // La $guardedpropiedad debe contener una matriz de atributos que no desea que se puedan asignar en masa. 
    // protected $guarded = []; 

       //public $primarykey = 'email'; //if use custom primary key si no se usa el id  or default
    //Solo permite el ingreso de campos especificos
    //protected $fillable = [
      //  'name', 'email', 'password',
    //];
}

