<?php $__env->startSection('content'); ?>

    <div class="container">
     
      
        <div class="row justify-content-center">
   
            <div class="panel panel-success">
                
           
                <div class="panel-heading"><h3>Detalle Jornada</h3></div>
                <div class="panel-body">
                     <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaDetalleJornadas">
                        <thead>
                        <tr>
                          
                            <th scope="col">Fecha</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Tipo Cita</th>
                            <th scope="col">Reservado</th>
                            <th scope="col">Usuario Reserva</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Lugar</th>
                             <th scope="col">Firma</th>
                               <th scope="col">   </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $jornada; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Jornada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                           
                         
                                  <td ><?php echo e($Jornada->Fecha); ?></td>
                                <td ><?php echo e($Jornada->Inicio); ?></td>
                                <td><?php echo e($Jornada->Fin); ?></td>
                                <td><?php echo e($Jornada->NombreCita); ?></td>
                                <td><?php echo e($Jornada->EstadoReserva); ?></td>
                                <td><?php echo e($Jornada->Nombre. " " .$Jornada->Apellidos); ?></td>
                                <td><?php echo e($Jornada->Telefono); ?></td>
                                 <td><?php echo e($Jornada->Lugar); ?></td>
                                 <td>                   </td>

                                 <td> <button onclick="ajaxRenderSectionBorrarCita(<?php echo e($Jornada->id); ?>)" type="button" class="btn btn-default" aria-label="Left Align" title="Borrar Cita">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                                            </button> 
                             
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearJornada()" type="button" class="btn btn-success">Nueva Jornada</button>
                
                        </div>
                     
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>