<div class="form-body">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
        </div>
    @endif
	@if ($errors->has())
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo.<br> 
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button> Tiene algunos errores. Por favor, consulte más abajo. 
        </div>
    @endif
   

    <form action="cargar" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit">
    </form>
    <br>
    <br>
    
        <div class="titulos" style="padding-top:10px;padding-bottom: 5px">ADMINISTRACION DE ARCHIVOS PARA CARGUE DE MOVIMIENTOS CONTABLES
                
                <div id="buttonsGroupC" style="float: right; border:1px solid #aaaaaa;margin-left: 1em; padding: 2px 4px 2px 4px">
                    <div style="float: right; padding-top: 8px"><button id="btn_CargarPlantillaExcel">Cargar Archivo Nuevo</button></div>
                    
                </div>  
                
        </div>
    
</div> 

   <!-- Dialogo de cargue
    <div id="dialog-confirm" title="¿Cargar Archivo?" style="text-align: justify; font-size: 10pt">
        <p>
            <form name="formulario_carguearchivo" id="formulario_carguearchivo" method="post" action="" enctype="multipart/form-data">
                <table style="width:550px" class="tablas_formulario_p">         
                    <tr>
                        <td class="titulo_tabla">CARGUE DE ARCHIVO PARA RUBROS</td>
                    </tr>
                        
                    <tr class="texto"><td>&nbsp;</td></tr>
                    <tr class="texto">
                        <td>
                            <div style="float:left;width:90px">
                                Archivo: <span class="texto_requerido" title="Campo Requerido">(*) </span>
                            </div>
                            <div style="float:left;text-align: left">
                                <input name="RutaOrigen" id="RutaOrigen" type="text" readonly style="width: 412px"/>
                            </div>                          
                        </td>
                    </tr>
                    <tr class="texto">
                        <td style="text-align: left">
                            <div style="float:right; width: 50%; text-align: center">
                                <div class="inputWrapper" style="float: right">
                                    <input 
                                        name="archivo" 
                                        id="archivo" 
                                        type="file" 
                                        class="custom-file-input" 
                                        accept="text/plain" 
                                        required
                                    /> 
                                </div>
                            </div>
                        </td>
                    </tr>           
                </table>
                
            </form>
        </p>
    </div>
 -->
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function() {
        $( "#dialog-confirm" ).dialog({
                resizable: false,               
                width: 575,
                modal: true,
                autoOpen: false,               
                closeOnEscape: true,
                buttons: {
                    "Cargar Archivo": function() {
                        var dialogo = this;                        

                        var formData = new FormData($("#formulario_carguearchivo")[0]);
                        /*
                        $.ajax({
                            url: "ajaxpost_cargararchivo.php",
                            type: "POST",
                            data: formData,
                            enctype: 'multipart/form-data',
                            processData: false,  // tell jQuery not to process the data
                            contentType: false   // tell jQuery not to set contentType
                        }).done(function( respuesta ) {
                            var respuesta = $.parseJSON(respuesta);
                            if(respuesta.valor){
                                $("#dataTables_CarguePlantillas").DataTable().ajax.reload();
                                $(dialogo ).dialog( "close" );
                            }
                            else{
                                alert(respuesta.mensaje);
                            }
                            $.fancybox.hideLoading();
                        }); */
                    }
                },
                close: function( event, ui ) {
                    $("#RutaOrigen").val("");
                    $("#archivo").val("");
                } 
            });

        $('#btn_CargarPlantillaExcel').click(function (e) {           
            e.preventDefault();  
            $( "#dialog-confirm" ).dialog( "open" );
               
        });



    });
</script>
@endsection