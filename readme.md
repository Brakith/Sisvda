# Sisvda - SISTEMA PROTOTIPO PARA LA EMISIÓN Y VERIFICACIÓN DE LA INTEGRIDAD DE DOCUMENTOS ACADÉMICOS

El presente proyecto tiene como propósito fundamental automatizar la generación de documentos académicos que son emitidos en las universidades por lo que se plantea un prototipo el cual generar documentos académicos de una manera inmediata mediante una plataforma en la cual se pueda verificar la integridad de los mismos. 

## Comenzando 🚀

Para comenzar a probar se debe primero clonar este repositorio: 
```
git clone https://github.com/Brakith/SisvdaPublic.git
```


### Pre-requisitos 📋

Se debe tener instalado:
- MongoDb
- Php
- Servidor local como Xampp
- Composer
- MongoDB PHP driver, puede encontrar una guía de instalación en http://php.net/manual/en/mongodb.installation.php

Debe tener registrada la aplicación en https://www.google.com/recaptcha/admin/create para poder usar goggle recaptcha.



### Instalación 🔧

Para la instalación del presente proyecto se debe seguir los siguientes pasos:

_Instalar las dependencias necesarias para que funcione el proyecto_

```
composer install
```

_Generar una key para el proyecto_

```
php artisan key:generate 
```

_Editar el archivo .env con sus credenciales de la base de datos, mail, recaptchakeys_




## Construido con 🛠️

Para construir el presente proyecto se uso las siguientes herramientas:

* [Laravel](https://laravel.com/) - El framework web mas popular de php.
* [Composer](https://getcomposer.org/monog) - Manejador de dependencias de php.
* [MongoDB](https://www.mongodb.com/es) - La base de datos líder para aplicaciones modernas


## Autor ✒️

* **Eduardo Guzmán** - *Trabajo Inicial* - [Perfil GitHub](https://github.com/brakith)


