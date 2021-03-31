@extends('main')

@section('content')
<div class="page-content">

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
    <div class="container">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Agregar Rubros</span>
                            </div>
                        </div>
                        <div class="portlet-body">  
                                         

                           

                            <!-- END FORM-->
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>
        </div>


        <div class="portlet-body" style="padding-top:10px;padding-bottom: 5px">ADMINISTRACION DE ARCHIVOS PARA CARGUE DE MOVIMIENTOS CONTABLES
                
                <div id="buttonsGroupC" style="float: right; border:1px solid #aaaaaa;margin-left: 1em; padding: 2px 4px 2px 4px">
                    <div style="float: right; padding-top: 8px"><button id="btn_CargarPlantillaExcel">Cargar Archivo Nuevo</button></div>
                     <input type="text" name="archivoProcesado" id="archivoProcesado" val="">
                </div>
                <br>
                <br>  
                <div id="buttonsGroupC" style="float: right; border:1px solid #aaaaaa;margin-left: 1em; padding: 2px 4px 2px 4px">
                    <div style="float: right; padding-top: 8px"><button id="btn_validarArchivo" class="btn_Procesar">Validar Archivo</button></div>
                   
                </div>  
                
        </div>

        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
 <!-- Dialogo de cargue -->
    <div id="dialog-confirm" title="¿Cargar Archivo?" style="text-align: justify; font-size: 10pt">
        <p>
            <form action="{{ route('cargar-pto-rubros') }}" name="formulario_carguearchivo" id="formulario_carguearchivo" method="post" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="file" name="archivo" id="archivo" >
                
                 
            </form>    
        </p>
    </div>
 
    <!-- Dialogo de procesamiento -->   
    <div id="dialogo-procesar" title="Procesar Plantilla" style="text-align: justify; font-size: 10pt">

        <input type="hidden" id="archivoProcesado" name="archivoProcesado">
        <div class="tablas_formulario_p" style="width: 95%; float: left;">          
            <div class="titulo_tabla" style="width: 100%; float: left;">PROCESAMIENTO DE PLANTILLA CARGADA</div>
            
            <div style="float: left; margin: 5px; width: 100%; text-align: center">
                Plantilla: <span id="infoNombrePlantilla"></span> - Vigencia: <span id="infoVigencia"></span>
            </div>
            
            <div id="progressbar" style="float: left; width: 100%">
                <div style="float: left;" class="progress-label">Procesando...</div>
            </div>

            <div style="float: left; width: 100%; margin-top: 5px;">
                <textarea readonly style="width:99%;height:250px;resize: none" id="registrosProceso" name="registrosProceso"></textarea>
            </div>

            <div style="float: left; width: 100%;margin-top: 10px;">
                <div style="text-align: center; float: left; width: 100%;">
                    <button id="iniciarValidacion" name="iniciarValidacion">Validar Archivo</button>
                </div>
                                
                <div style="float: left; width: 100%;margin-top: 10px;">
                    <div style="float: left;width: 220px">
                        <button id="iniciarProcesoRubros" name="iniciarProcesoRubros" style="padding-top: 1px; padding-bottom: 3px;" >Procesar Rubros</button>
                    </div>                  
                    <div style="float: left;"><input id="txt_ActoAdministrativo" type="text" placeholder="No. Acto Admnin." style="width: 175px"></div>
                    <div style="float: left; margin-left: 5px;">
                                        
                        <input id="file_Rubros_txt" type="text" placeholder="Seleccionar Archivo" disabled="disabled" style="width: 200px"/>
                        <div class="fileUpload btnUpload btn-primary" id="file_Rubros_btn">
                            <span>Cargar</span>
                            <input id="file_Rubros_element" type="file" class="upload" />
                        </div>                  
                    
                    </div>                      
                </div>
                    
                <div style="float: left; width: 92%; margin-top: 6px;">
                    <div style="float: left;width: 220px">
                        <button id="iniciarProcesoApropiaciones" name="iniciarProcesoApropiaciones" style="padding-top: 1px; padding-bottom: 3px;">Procesar Apropiacion Inicial</button>
                    </div>
                    <div style="float: left"><input id="txt_Acuerdo" type="text" placeholder="No. Acuerdo" style="width: 175px"></div>
                    <div style="float: left; margin-left: 5px;">                                            
                        
                        <input id="file_Apropiacion_txt" type="text" placeholder="Seleccionar Archivo" disabled="disabled" style="width: 200px" />
                        <div class="fileUpload btnUpload btn-primary" id="file_Apropiacion_btn">
                            <span>Cargar</span>
                            <input id="file_Apropiacion_element" type="file" class="upload" />
                        </div>                  
                    </div>  
                </div>

                <div id="btn_verpdf" style="float: left; text-align: right; width: 4%;margin-top: 6px;display: none">           
                    <a href="" class="fancybox_Pdf">
                        <img src='imagenes/globales/pdf.png' 
                        border='0' class='.icon' width='26' height='26' title='Ver PDF' style="vertical-align: top;">
                    </a>
                </div>                                      

                <div id="btn_CrearReporteExcel" style="float: left; text-align: right; width: 4%;margin-top: 6px;display: none">            
                    <a href="" class="fancybox_InformeExcel">
                        <img src='imagenes/globales/excel.jpg' 
                        border='0' class='.icon' width='26' height='26' title='Generar Excel' style="vertical-align: top;">
                    </a>
                </div>  
            </div>
        </div>

    </div>






@endsection


@section('scripts')
<script type="text/javascript">
    var controlProcesos = false;
    var maxProgressBar=100;
    var arregloEnEspera;

    jQuery(document).ready(function() {
        //Configuración de dialogo para procesamiento de plantillas
        $( "#dialogo-procesar" ).dialog({
                width: 800,
                autoOpen: false,
                modal: true,
                closeOnEscape: false,
                resizable: false,
                open: function() {
                    $( "#progressbar" ).progressbar( "option", "value", true );
                    $( ".progress-label" ).text( "Listo para procesar..." );
                    
                    $( "#registrosProceso" ).val("");
                    
                    $( "#iniciarProcesoRubros" ).prop("disabled",true);
                    $( "#txt_ActoAdministrativo" ).prop("disabled",true)
                    $( "#file_Rubros" ).prop("disabled",true)
                    $( "#file_Rubros_btn" ).addClass("disabled");
                    
                    $( "#iniciarProcesoApropiaciones" ).prop("disabled",true);
                    $( "#txt_Acuerdo" ).prop("disabled",true);
                    $( "#file_Apropiacion" ).prop("disabled",true);
                    $( "#file_Apropiacion_btn" ).addClass("disabled");
                },
                beforeClose: function(event, ui){
                    if(controlProcesos){
                        event.preventDefault();
                        alert("Debe esperar a que se culmine el proceso");
                    }
                }
        });

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
                       
                        $.ajax({
                            url: "{{ route('cargar-pto-rubros') }}",
                            type: "POST",
                            data: formData,
                            enctype: 'multipart/form-data',
                            processData: false,  // tell jQuery not to process the data
                            contentType: false ,  // tell jQuery not to set contentType
                            success: function(respuesta)
                            {   
                               
                                if(respuesta.valor){                                  
                                    $(dialogo ).dialog( "close" );                                   
                                    $('#btn_CargarPlantillaExcel').prop('disabled',true);
                          //preguntar a Dario como recibo datos de respuesta          
                                    $('#archivoProcesado').val('adjuntos/prueba.txt');
                                }
                                else{
                                    alert(respuesta.mensaje);
                                    $(dialogo ).dialog( "close" );
                                    $('#btn_CargarPlantillaExcel').prop('disabled',true);
                                     $('#archivoProcesado').val('adjuntos/prueba.txt');
                                }

                            }
                        })

                    }
                },
                close: function( event, ui ) {                   
                    $("#archivo").val("");
                } 
            });

        $('#btn_CargarPlantillaExcel').click(function (e) {           
            e.preventDefault();  
            $( "#dialog-confirm" ).dialog( "open" );
               
        });

        $(document).on("click",'.btn_Procesar',function(event){
                event.preventDefault();
                

                var archivo=$("archivoProcesado").val();
                 $( "#infoNombrePlantilla" ).text( archivo );
                 $( "#dialogo-procesar" ).dialog( "open" );
                /*
                var rutaArchivo=$(this).attr("href");
                var archivo=rutaArchivo.split('/',2)[1];
                var vigencia=rutaArchivo.split('_',1)[0];
                vigencia=vigencia.substring(vigencia.length-4,vigencia.length+1);
                
                $( "#archivoProcesado" ).val( rutaArchivo );
                $( "#infoNombrePlantilla" ).text( archivo );
                $( "#infoVigencia" ).text( vigencia );
                
                
                
                $( "#dialogo-procesar" ).dialog( "open" );*/
        });


            $(document).on("click",'#iniciarValidacion',function(event){
                if(!controlProcesos){
                    //Start the long running process                    
                    $.ajax({
                       url: "{{ route('validar-pto-rubros') }}",
                        type: "POST",
                        data: { iniciar: "true", proceso: "validar", archivo: $("#archivoProcesado").val(), modo: "upload" },
                        success: function(data) {
                            var respuesta = $.parseJSON(data);                  
                            var progreso = parseInt( respuesta.progreso );
                            var mensaje = respuesta.mensaje;
                            var valor = respuesta.valor;
                            controlProcesos=false;
                            terminarEnEspera();
                            if(valor != null){
                                $( "#progressbar" ).progressbar( "value", progreso);
                                $( "#registrosProceso" ).val(mensaje);
                                if(!valor){
                                    $( ".progress-label" )
                                        .text( "Proceso Fallido: " + progreso + "%" );
                                    $( "#iniciarProcesoRubros" ).prop("disabled",true);
                                    $( "#txt_ActoAdministrativo" ).prop("disabled",true)
                                    $( "#file_Rubros" ).prop("disabled",true)
                                    $( "#file_Rubros_btn" ).addClass("disabled");
                                    
                                    $( "#iniciarProcesoApropiaciones" ).prop("disabled",true);
                                    $( "#txt_Acuerdo" ).prop("disabled",true);
                                    $( "#file_Apropiacion" ).prop("disabled",true);
                                    $( "#file_Apropiacion_btn" ).addClass("disabled");
                                }
                                else{
                                    $( "#iniciarProcesoRubros" ).prop("disabled",false);
                                    $( "#txt_ActoAdministrativo" ).prop("disabled",false)
                                    $( "#file_Rubros" ).prop("disabled",false)
                                    $( "#file_Rubros_btn" ).removeClass("disabled");
                                    
                                    $( "#iniciarProcesoApropiaciones" ).prop("disabled",false);
                                    $( "#txt_Acuerdo" ).prop("disabled",false);
                                    $( "#file_Apropiacion" ).prop("disabled",false);
                                    $( "#file_Apropiacion_btn" ).removeClass("disabled");                           
                                }
                            }
                            else{
                                alert("Ocurrio una falla al procesar el archivo");
                            }
                        }
                    });
                    
                    $( "#progressbar" ).progressbar( "option", "value", true );
                    $( ".progress-label" ).text( "Listo para procesar..." );            
                    arregloEnEspera = new Array();
                    controlProcesos = true;
                    getProgress("validar");
                }
                else{
                    alert("YA EXISTE UN PROCESO EN CURSO");
                }

            });        
        



    });
</script>
@endsection