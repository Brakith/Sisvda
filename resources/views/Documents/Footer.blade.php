<footer>      
    <div>
        @if ($DataPDF['CódigoHash'])
            <div class="footer-title">Código de autenticidad</div>
            <div class="footer-p">
                Verifique la autenticidad de este documento ingresando a la pagina  <span class="font-weight-bold">{{$DataPDF['URLSistema']}}</span>  e ingresado el siguiente codigo: 
            </div>
            <div class="footer-hash">{{$DataPDF['CódigoHash']}}</div>
        @endif

        <div>
            SISVDA
            <br>
            {{$DataPDF['Universidad']}}
            <br>
            {{$DataPDF['UniversidadDirección']}}
            <br>
            {{$DataPDF['URLSistema']}}
        </div>
    </div>
</footer>