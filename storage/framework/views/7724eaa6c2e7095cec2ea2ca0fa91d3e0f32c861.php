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
        <input type="hidden" id="Empresa_id" name="Empresa_id" >
        <input type="hidden" id="id" name="id" value="<?php echo e($rol->id); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Editar Rol</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control" value="<?php echo e($rol->Nombre); ?>">
                                    <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                            <div class="col-md-4">
                                <label>DescripciÃ³n</label>
                                <input id="Descripcion" name="Descripcion" type="text" class="form-control" value="<?php echo e($rol->Descripcion); ?>">
                                <span class="invalid-feedback" role="alert" id="errorDescripcion"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul id="menu_arbol" >
                                    <?php $__currentLoopData = $listRecursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recursoPadre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($recursoPadre->RecursoSistemaPadre_id == null): ?>
                                            <li name="liPadre">
                                                <?php ($b = false); ?>
                                                <?php $__currentLoopData = $recursosDelRol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recusroRol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($recursoPadre->id == $recusroRol->RecursoSistema_id): ?>
                                                        <?php ($b = true); ?>
                                                        <?php break; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($b): ?>
                                               <input name="idRecurso[]" type="checkbox" value="<?php echo e($recursoPadre->id); ?>" onclick="checkRecursosHijos(this)" checked>
                                                <a href="#ul<?php echo e($recursoPadre->id); ?>" data-toggle="collapse"><?php echo e($recursoPadre->Descripcion); ?> </a>
                                                <?php else: ?>
                                                    <input name="idRecurso[]" type="checkbox" value="<?php echo e($recursoPadre->id); ?>" onclick="checkRecursosHijos(this)">
                                                    <a href="#ul<?php echo e($recursoPadre->id); ?>" data-toggle="collapse"><?php echo e($recursoPadre->Descripcion); ?> </a>
                                                <?php endif; ?>
                                                <ul class="nav nav-second-level collapse" id="ul<?php echo e($recursoPadre->id); ?>" name="ulhijo">

                                                    <?php $__currentLoopData = $listRecursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recurso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($recurso->RecursoSistemaPadre_id == $recursoPadre->id): ?>
                                                            <?php ($a = false); ?>
                                                            <?php $__currentLoopData = $recursosDelRol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recusroRol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($recurso->id == $recusroRol->RecursoSistema_id): ?>
                                                                    <?php ($a = true); ?>
                                                                    <?php break; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($a): ?>
                                                            <li>
                                                                <input name="idRecurso[]" type="checkbox" value="<?php echo e($recurso->id); ?>" onclick="checkRecursoPadre(this)" checked><?php echo e($recurso->Descripcion); ?>

                                                            </li>
                                                            <?php else: ?>
                                                                <li>
                                                                    <input name="idRecurso[]" type="checkbox" value="<?php echo e($recurso->id); ?>" onclick="checkRecursoPadre(this)" ><?php echo e($recurso->Descripcion); ?>

                                                                </li>
                                                            <?php endif; ?>
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