<?php
$this->pageTitle=Yii::app()->name . ' - Ver Usuarios';
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usua_nombre.' '.$model->usua_apellidos,
);

$this->menu=array(
	array('label'=>'Listar Usuarios','url'=>array('index')),
	array('label'=>'Crear Usuario','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear'])),
	array('label'=>'Modificar Usuario','url'=>array('update','id'=>$model->usua_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Modificar'])),
	array('label'=>'Administrar Usuarios','url'=>array('admin')),
);
?>

<h1>Usuario <b><?php echo $model->usua_nombre.' '.$model->usua_apellidos; ?></b></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Usuario</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				// 'usua_id',
				'usua_nombre',
				'usua_apellidos',
				'usua_usuariored',
				array(
			        'name'=>'usua_rol_id',
			        'value'=>$model->usuaRol->rol_nombre,
			    ),
				'usua_habilitado',
				'usua_fechacreado',
				array(
			        'name'=>'usua_creadopor',
			        'value'=>$model->usuaCreadopor->usua_usuariored,
			    ),
				'usua_fechamodificado',
				array(
			        'name'=>'usua_modificadopor',
			        'value'=>$model->usuaModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>

	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Servicios disponibles para asignar al Usuario</h3>
		</div>

		

		<!-- LISTAR CLIENTES ORDENADOS ALFABETICAMENTE -->
		<?php foreach ($modelClientes as $kcli => $cliente): ?>
			<div class="panel panel-danger col-xs-12 col-sm-12">
				<div class="panel-heading">
					<h3><?php echo $cliente->cli_nombre; ?></h3>
				</div>

				<!-- LISTAR PROGRAMAS DEL CLIENTE ORDENADOS ALFABETICAMENTE -->
				<?php foreach ($modelProgramas as $kprog => $programa): ?>
					<?php if ($programa->prog_cli_id == $cliente->cli_id): ?>
						<div class="col-xs-12 col-sm-6">

							<div class="panel-title">
								<h4><?php echo $programa->prog_nombre; ?></h4>
							</div>

							<div class="panel-body well">
								<!-- LISTAR LOS SERVICIOS DEL PROGRAMA  ORDENADOS ALFABETICAMENTE-->
								<?php foreach ($modelServicios as $kserv => $servicio): ?>
									<?php 
										$dataServicios = array();
										if ($servicio->serv_prog_id == $programa->prog_id): ?>
											<?php 
												//identificar si el servicio esta seleccionado para el usuario
												
												$glyphicon = 'glyphicon glyphicon-remove text-danger';
												$text = 'bg-danger';
												
												if (in_array($servicio->serv_id, $usuarioServiciosExistentes)) {
													$glyphicon = 'glyphicon glyphicon-ok text-success';
													$text = 'bg-success';
												}

												echo "<div class='$text'> <spam class='$glyphicon'></spam> <b>".$servicio->serv_nombre."</b></div>";
		                                    ?>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>

					<?php endif ?>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>

	</div>
