<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>¡Buen día!</p>

    <div>
        <p>
            El documento <span class="font-weight-bold"> {{$DatosEmail['documento']}} </span>   ha sido generado exitosamente. Para descargarlo diríjase a: {{$DatosEmail['PathCompletoDocumento']}} e ingrese el siguiente código de verificación para poder descargarlo:
        </p>

        <h4>
            {{$DatosEmail['codigohash']}}   
        </h4>

        <p>
            Saludos coordiales.
        </p>
        
    </div>
</body>
</html>
