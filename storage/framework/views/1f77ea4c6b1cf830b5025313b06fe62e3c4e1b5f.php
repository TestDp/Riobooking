<?php $__env->startSection('content'); ?>

    <div class="container">
              <div id="ascrail2000" class="nicescroll-rails" style="width: 6px; z-index: 1000; background: rgb(66, 79, 99); cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; display: block; opacity: 0;"><div style="position: relative; top: 34px; float: right; width: 6px; height: 116px; background-color: rgb(242, 179, 63); border: 0px; background-clip: padding-box; border-radius: 10px;"></div></div>
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Citas Reservadas</h3></div>
                <div class="panel-body">
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaCitasUsuario">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Tipo cita</th>
                            <th scope="col">Usuario Reserva</th>
                            <th>           </th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $listCitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($Cita->id); ?></th>
                                <td ><?php echo e($Cita->Fecha); ?></td>
                                <td><?php echo e($Cita->Inicio); ?></td>
                                <td><?php echo e($Cita->Fin); ?></td>
                                <td><?php echo e($Cita->NombreCita); ?></td>
                                <td><?php echo e($Cita->Nombre.$Cita->Apellidos); ?></td>
                                <td> <button onclick="GuardarCancelacion(<?php echo e($Cita->id); ?>)" type="button" class="btn btn-success">Cancelar</button></td>
                            
                               

         

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                
                </div>
            </div>

        </div>
    </div>
 <link href="<?php echo e(asset('js/Plugins/data-table/datatables.css')); ?>" rel="stylesheet">
    <!-- Plugins-->
    <script src="<?php echo e(asset('js/Plugins/data-table/datatables.js')); ?>"></script>
     <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaCitasUsuario').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page'
                },
                language: {
                    "lengthMenu": "Registros por página _MENU_",
                    "info":"Mostrando del _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":"Mostrando del 0 a 0 de 0 registros",
                    "infoFiltered": "(Registros filtrados _MAX_ )",
                    "zeroRecords": "No hay registros",
                    "search": "Buscador:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
        });

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>