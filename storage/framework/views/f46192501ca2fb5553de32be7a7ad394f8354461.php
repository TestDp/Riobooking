<?php $__env->startSection('content'); ?>
    <form id="formUsuario">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear Usuario</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                Nombre
                                <input id="name" name="name" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorname"></span>
                            </div>
                            <div class="col-md-4">
                                Apellidos
                                <input id="last_name" name="last_name" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorlast_name"></span>
                            </div>
                            <div class="col-md-4">
                                Cedula
                                <input id="username" name="username" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorusername"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Correo Electrónico
                                <input id="email" name="email" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="erroremail"></span>
                            </div>
                            <div class="col-md-4">
                                Contraseña
                                <input id="password" name="password" type="password" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorpassword"></span>
                            </div>
                            <div class="col-md-4">
                                Confirmar Contraseña
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorpassword_confirmation"></span>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-4">
                              <label>Telefono</label>
                                <input id="telefono" name="telefono" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errortelefono"></span>
                            </div>
                            <div class="col-md-4">
                                   <label>Compañia</label>
                                <select id="Sede_id" name="Sede_id"  class="form-control"  name="language">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $listCompanias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $compania): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($compania->id); ?>"><?php echo e($compania->Nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="invalid-feedback" role="alert" id="errorSede_id"></span>
                            </div>
                            <div class="col-md-4">
                                   <label>Roles</label>
                                <select id="Roles_id" name="Roles_id[]"  class="form-control" multiple name="language">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $listRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rol->id); ?>"><?php echo e($rol->Nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="invalid-feedback" role="alert" id="errorRoles_id"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarUsuario()" type="button" class="btn btn-success">Crear Usuario</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

    <link href="<?php echo e(asset('js/Plugins/fastselect-master/dist/fastselect.min.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/jquery-3.1.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/Plugins/fastselect-master/dist/fastsearch.js')); ?>"></script>
    <script src="<?php echo e(asset('js/Plugins/fastselect-master/dist/fastselect.js')); ?>"></script>

    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#Sede_id').fastselect({
                placeholder: 'Seleccione la sede',
                searchPlaceholder: 'Buscar opciones'
            });
            $('#Roles_id').fastselect({
                placeholder: 'Seleccione los roles',
                searchPlaceholder: 'Buscar opciones'
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>