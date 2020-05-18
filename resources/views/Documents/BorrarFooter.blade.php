   {{-- Pie de pagina --}}
   <div class="text-center" style="position: absolute; bottom: 0; font-size: 11px;" >
        <div class="bg-dark p-1 text-white font-weight-bold text-uppercase">Código de autenticidad</div>
        <div class="bg-light p-1 ">
            Verifique la autenticidad de este documento ingresando a la pagina  <span class="font-weight-bold">{{$DataPDF['URLSistema']}}</span>  e ingresado el siguiente codigo: 
        </div>
        <div class="bg-danger p-1 text-white font-weight-bold">{{$DataPDF['CódigoHash']}}</div>

        <div class="text-center" style="font-size: 11px">
            SISVDA
            <br>
            {{$DataPDF['Universidad']}}
            <br>
            {{$DataPDF['UniversidadDirección']}}
            <br>
            {{$DataPDF['URLSistema']}}
         </div>
    </div>