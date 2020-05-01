<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Regionales</h3></div>
                <div class="panel-body">
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaRegionales">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Activa</th>
                            <th scope="col">Compañia</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $listSedes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Regional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($Regional->id); ?></th>
                                <td ><?php echo e($Regional->Nombre); ?></td>
                                <td><?php echo e($Regional->Activa); ?></td>
                                <td><?php echo e($Regional->NombreCompania); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearSede()" type="button" class="btn btn-success">Nueva Regional</button>
                        </div>
                    </div>
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
            $('#tablaRegionales').DataTable({
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