<?php $__env->startSection('content'); ?>

    <div class="container">
             <div id="ascrail2000" class="nicescroll-rails" style="width: 6px; z-index: 1000; background: rgb(66, 79, 99); cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; display: block; opacity: 0;"><div style="position: relative; top: 34px; float: right; width: 6px; height: 116px; background-color: rgb(242, 179, 63); border: 0px; background-clip: padding-box; border-radius: 10px;"></div></div> 
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>" />
                <div class="panel-heading"><h3>Citas</h3></div>
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-md-3">
                          <label>Tipo Cita</label>
                                <select id="Tipo_Cita_id" name="Tipo_Cita_id"  class="form-control"  name="language">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $listTiposCitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoCita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tipoCita->Nombre); ?>"><?php echo e($tipoCita->Nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        </div>
                        <div class="col-md-3">
                            Fecha
                            <input type="date" id="fecha" class='form-control'/>
                        </div>
                        <div class="col-md-3">
                             <label>Regional</label>
                                <select id="Regional_id" name="Regional_id"  class="form-control"  name="language" onchange="CargarTiposCitasPorRegional()">
                                    <option value="">Seleccionar</option>
                                    <?php $__currentLoopData = $listRegionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($regional->Nombre); ?>"><?php echo e($regional->Nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
               
                        </div>
                        <div class="col-md-3">
                            <input type="button" onclick="BuscadorCitas()" class='btn btn-success' value="Buscar"/>
                        </div>
                    </div>
                    <br/>
                    <div class="row" id='tablaCitasCompleta'>
                    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered">
                        <thead>
                        <tr>
                        
                            <th scope="col">Fecha</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Tipo cita</th>
                            <th scope="col">Regional</th>
                            <th scope="col">Cupos por Cita</th>
                            <th scope="col">Cupos disponibles</th>
                            <th scope="col">Lugar Cita</th>
                            <th scope="col">    </th>
                        </tr>
                        </thead>
                        <tbody id="tablaCitas">
                        <?php $__currentLoopData = $listCitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                           
                                <td scope="row"><?php echo e($Cita->Fecha); ?></td>
                                <td><?php echo e($Cita->Inicio); ?></td>
                                <td><?php echo e($Cita->Fin); ?></td>
                                <td><?php echo e($Cita->NombreCita); ?></td>
                                <td><?php echo e($Cita->NombreRegional); ?></td>
                                <td><?php echo e($Cita->CuposJornada); ?></td>
                                <td><?php echo e($Cita->Cupos); ?></td>
                                <td><?php echo e($Cita->Lugar); ?></td>
                                <td> <button onclick="GuardarReserva(<?php echo e($Cita->id); ?>)" type="button" class="btn btn-success">Reservar</button></td>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                   <?php echo $listCitas->links(); ?>

                </div>
                </div>
            </div>

        </div>
    </div>
<script type="text/javascript">

       $(document).ready(function() {
          $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();

               $('#tablaCitasCompleta a').css('color', '#dfecf6');
                  $('#tablaPedidosCompleta').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="../images/loader.gif" />');

               var url = $(this).attr('href');
               getArticles(url);
               window.history.pushState("", "", url);
            });

            function getArticles(url) {
              $.ajax({
                   url : url
                }).done(function (data) {
                   $('#tablaCitasCompleta').html(data);
                }).fail(function () {
                   alert('Articles could not be loaded.');
                });
            }
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>