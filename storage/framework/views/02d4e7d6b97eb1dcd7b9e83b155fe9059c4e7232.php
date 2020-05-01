<?php $__env->startSection('content'); ?>

    <form id="formJornada">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">

        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-heading"><h3>Crear nueva Jornada</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Fecha</label>
                                <input type="date"  id="Fecha" name="Fecha" class="form-control"  step="1" min="<?php echo date("Y-m-d");?>" max="2020-12-31" value="<?php echo date("Y-m-d");?>" onchange="validarFecha()">
                                <span class="invalid-feedback" role="alert" id="errorFecha"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Regional</label>
                                <select id="Regional_id" name="Regional_id"  class="form-control"  name="language" onchange="CargarTiposCitasPorRegional()">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $listRegionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($regional->id); ?>"><?php echo e($regional->Nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                                <span class="invalid-feedback" role="alert" id="errorRegional_id"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Tipo Cita</label>
                                <select id="Tipo_Cita_id" name="Tipo_Cita_id"  class="form-control"  name="language">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $listTiposCitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoCita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tipoCita->id); ?>"><?php echo e($tipoCita->Nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="invalid-feedback" role="alert" id="errorTipo_Cita_id"></span>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <label class="radio-inline"><input type="radio" id="opcionCita" name="optradio" checked  onclick="DesactivarCampo()">Individual</label>
                                <label class="radio-inline"><input type="radio" id="opcionCita" name="optradio" onclick="ActivarCampo()">Grupal</label>
                            </div>
                            <div class="col-md-3" id="divCupo" hidden>
                                <label>Cupo </label>
                                <input id="Cupos" name="Cupos" type="number" class="form-control" >
                                <span class="invalid-feedback" role="alert" id="errorCupos"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label> Hora inicio</label>
                                <input type="time" id='Inicio' name="Inicio" value="08:00:00" max="23:30:00" min="07:00:00" step="1" class="form-control" onchange="validarHora()">
                                <span class="invalid-feedback" role="alert" id="errorhoraInicial"></span>
                            </div>
                            <div class="col-md-3">
                                <label> Hora Final</label>
                                <input type="time" id='Fin' name="Fin" value="08:00:00" max="23:30:00" min="07:00:00" step="1" class="form-control" onchange="validarHoraF()">
                                <span class="invalid-feedback" role="alert" id="errorhoraFinal"></span>
                            </div>
                            <div class="col-md-3">
                                <label> Duración Cita Minutos</label>
                                <input type="number" id='Duracion' name="Duracion" step="1" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorDuracion"></span>
                            </div>
                            <div class="col-md-3">
                                <label>Descanso Minutos</label>
                                <input type="number" id="Descanso" name="Descanso" step="1" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorDescanso"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Lugar</label>
                                <input id=" Lugar" name="Lugar" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorLugar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="GuardarJornada()" type="button" class="btn btn-success">Crear Jornada</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>