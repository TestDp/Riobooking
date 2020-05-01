<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Compañias</h3></div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Activa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $listCompanias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Compania): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($Compania->id); ?></th>
                                <td ><?php echo e($Compania->Nombre); ?></td>
                                <td><?php echo e($Compania->Activa); ?></td>
                             
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearCompania()" type="button" class="btn btn-success">Nueva Compania</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>