<?php $__env->startSection('content'); ?>
    <form id="formTipoCita">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear Tipo de Cita</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                            
                                <div class="col-md-6">
                                    <label> Regional </label>
                                    <select id="Regional_id" name="Regional_id"  class="form-control"  name="language">
                                        <option value="">Seleccionar</option>
                                       <?php $__currentLoopData = $listRegionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($regional->id); ?>"><?php echo e($regional->Nombre); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                    <span class="invalid-feedback" role="alert" id="errorRegional_id"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarTipoCita()" type="button" class="btn btn-success">Crear Tipo Cita</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>