@extends('layouts.DocumentLayout')

@section('content')
    @extends('Documents.Footer')

    <main>
        <img class="float-left"  src="{{ $DataPDF['UniversidadRutaImagen'] }}" width="50" height="50">
        <img class="float-right" src="{{ $DataPDF['UniversidadRutaImagen'] }}" width="50" height="50">

        <div>
            <h2 class="header-title">{{$DataPDF['Universidad']}}</h5>
            <h3 class="header-subtitle">Carrera de {{$DataPDF['Carrera']}}</h6>
            <br>
            <h3 class="header-date">Emisión: {{$DataPDF['Fecha_creación']}}</h6>
            <br>
            <hr>
            <h2 class="title">Histórico Escolar</h4>

            <h2 class="subtitle">Datos personales:</h6>
            <div>
                {{-- Cuerpo del certificado --}}
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Estudiante</th>
                            <th>Cédula</th>
                        </tr> 
                    </thead>   
                    <tbody>
                        <tr>
                            <td>{{$DataPDF['Nombres']}} {{$DataPDF['Apellidos']}}</td>
                            <td>{{$DataPDF['Cédula']}} </td>
                        </tr> 
                    </tbody>   
                </table>
            </div>

            <h2 class="subtitle">Disciplinas cursadas:</h6>
            <div>
                {{-- Cuerpo del certificado --}}
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código</th>
                            <th>Semestre</th>
                            <th>Materia</th>
                            <th>Calificación</th>
                            <th>Estado</th> 
                        </tr> 
                    </thead>   
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($DataPDF['Materias'] as $post)
                        <tr>
                            <td>{{ $post['Materia_id'] }}</td>
                            <td>{{ $post['Semestre'] }}</td>
                            <td>{{ $post['Nombre'] }}</td>
                            <td>{{ $post['Calificación']}}</td>
                            <td>{{ $post['Estado'] }}</td> 
                        </tr> 
                        <?php $no++; ?>
                        @endforeach
                    </tbody>   
                </table>
            </div>

            <br>
            <br>
            <div>
                {{-- Cuerpo del certificado --}}
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th></th>
                            <th>Promedio Final</th>
                         </tr> 
                    </thead>   
                    <tbody>
                        <tr>
                            <td>Dando un promedio en la carrera de:</td>
                            <td>{{ $DataPDF['Promedio'] }}</td>
                        </tr> 
                    </tbody>   
                </table>
            </div>
            <br>
            <br>
            
            {{-- Firma --}}
            <div class="text-center">
                <span class="font-size-1rem"> {{$DataPDF['CoordinadorNombre']}} </span> <br>
                <span class="font-size-1rem font-weight-bold"> COORDINADOR </span>
            </div>
        </div>
    </main>
@endsection
         
 
    </body>
</html>





