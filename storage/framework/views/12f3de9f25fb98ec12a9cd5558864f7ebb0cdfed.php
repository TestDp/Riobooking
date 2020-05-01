<?php $__env->startSection('content'); ?>
    <style type="text/css">
        ul#menu_arbol li {
            padding: 0 10px;
        }
        ul#menu_arbol ul {
            margin-left: 5px;
        }
    </style>
    <form id="formRol">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear Rol</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control">
                                    <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Descripción</label>
                                <input id="Descripcion" name="Descripcion" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorDescripcion"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul id="menu_arbol" >
                                    <?php $__currentLoopData = $listRecursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recursoPadre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($recursoPadre->RecursoSistemaPadre_id == null): ?>
                                            <li name="liPadre">
                                               <input name="idRecurso[]" type="checkbox" value="<?php echo e($recursoPadre->id); ?>" onclick="checkRecursosHijos(this)">
                                                <a href="#ul<?php echo e($recursoPadre->id); ?>" data-toggle="collapse"><?php echo e($recursoPadre->Nombre); ?></a>
                                                <ul class="nav nav-second-level collapse" id="ul<?php echo e($recursoPadre->id); ?>" name="ulhijo">
                                                    <?php $__currentLoopData = $listRecursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recurso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($recurso->RecursoSistemaPadre_id == $recursoPadre->id): ?>
                                                            <li>
                                                                <input name="idRecurso[]" type="checkbox" value="<?php echo e($recurso->id); ?>" onclick="checkRecursoPadre(this)"><?php echo e($recurso->Nombre); ?>

                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarRol()" type="button" class="btn btn-success">Crear Rol</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>