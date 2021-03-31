@extends('main')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
                    <!-- BEGIN VALIDATION STATES-->
              <div class="portlet light portlet-fit portlet-form ">
                <br>
                  <div class="portlet-body">
                      
                      <div class="row no-gutter">
                          <div class="col-md-3">
                            <div class="tree">
                              <ul class="checktree-root">
                                <li class="text-primary parent_li">
                                  
                                    <span title="Ocultar Lista">
                                        <i class="fa fa-folder-open-o"></i>
                                    </span>

                                    <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/admision','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">  
                                        Admision 
                                    </a>  

                                   <ul class="checktree-root">
                                      <li class="text-info parent_li">
                                          <span title="Ocultar Lista">
                                            <i class="fa fa-minus-circle"></i>
                                          </span>
                                        <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/enfermedad','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                          Enfermedad
                                        </a>
                                      </li>

                                     <li class="text-info parent_li">
                                        <span title="Ocultar Lista">
                                          <i class="fa fa-minus-circle"></i>
                                        </span>
                                        <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/antecedentes','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                          Antecedentes
                                        </a>
                                    </li>

                                     <li class="text-info parent_li">
                                        <span title="Ocultar Lista">
                                          <i class="fa fa-minus-circle"></i>
                                        </span>
                                        <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/ayudaddiag','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                          Ayudad Diag
                                        </a>
                                    </li>

                                       <li class="text-info parent_li">
                                          <span title="Ocultar Lista">
                                            <i class="fa fa-minus-circle"></i>
                                          </span>
                                          <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/diagnostico','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                           Diagnóstico
                                          </a>
                                      </li>

                                      <li class="text-info parent_li">
                                          <span title="Ocultar Lista">
                                            <i class="fa fa-minus-circle"></i>
                                          </span>
                                          <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/medicamento','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                            Medicamento
                                          </a> 
                                      </li>

                                      <li class="text-info parent_li">
                                          <span title="Ocultar Lista">
                                            <i class="fa fa-minus-circle"></i>
                                          </span>
                                          <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/procedimiento','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                           Procedimiento
                                           </a>
                                      </li>

                                      <li class="text-info parent_li">
                                          <span title="Ocultar Lista">
                                            <i class="fa fa-minus-circle"></i>
                                          </span>
                                          <a href="javascript:void(0);" style="text-decoration: none" onclick="obj_funciones.globalajax('#contenido','/incapacidad','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');">
                                           Incapacidad/Remisión
                                          </a> 
                                      </li>
                                   </ul>   
                                </li>  
                              </ul>
                            </div> 
                          </div>
                        
                          <div class="col-md-9">  
                               <div id="contenido"></div>
                          </div> 
                        </div>   
                      </div>    
                  </div>   
              </div>
            <!-- END VALIDATION STATES-->
      </div>
  </div>
        <!-- END PAGE CONTENT INNER -->
</div>
@endsection

@section('scripts')
<!--Tab cargados con ajax-->
  <script type="text/javascript">
    $(document).ready(function(){

      obj_funciones.globalajax('#contenido','/admision','admision_id=<?php echo $ingreso->idadmision ?>& pacienteid=<?php echo $ingreso->idpaciente ?>');

        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Ocultar Lista');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Ocultar Lista').find(' > i').removeClass('fa fa-folder-open-o').addClass('fa fa-folder-o');
            } else {

                children.show('fast');
                $(this).attr('title', 'Expander Lista').find(' > i').removeClass('fa fa-folder-o').addClass('fa fa-folder-open-o');
               
            }
            e.stopPropagation();
        });
       $('#permisos ul').checktree(); 
       });   
</script>
@endsection  