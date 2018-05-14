<?php
$this->pageTitle=Yii::app()->name . ' - Ver Turnos Asesores';
$this->breadcrumbs=array(
	'Turnos Asesores'=>array('index'),
	$model->turaseAseserv->aseservAse->ase_nombre,
);

$this->menu=array(
array('label'=>'Listar Turnos Asesores','url'=>array('index')),
array('label'=>'Crear Turno Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Crear']),),
array('label'=>'Modificar Turno Asesor','url'=>array('update','id'=>$model->turase_id)),
array('label'=>'Administrar Turnos Asesores','url'=>array('admin')),
);
?>

<h1>Ver turno de <?php echo $model->turaseAseserv->aseservAse->ase_nombre . " " . $model->turaseAseserv->aseservAse->ase_apellidos; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del turno</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
					'name' => 'Nombre Turno',
					'value' => $model->turaseTur->tur_nombre,
				),
				array(
			    	'name'=>'Lunes',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioLunes.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinLunes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Martes',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioMartes.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinMartes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Miercoles',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioMiercoles.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinMiercoles.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Jueves',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioJueves.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinJueves.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Viernes',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioViernes.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinViernes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Sabado',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioSabado.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinSabado.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Domingo',
			    	'value'=>'Desde las <b>'.$model->turaseTur->tur_horaInicioDomingo.'</b> hasta las <b>'.$model->turaseTur->tur_horaFinDomingo.'</b>',
			    	'type'=>'raw',
			    ),
				'turase_fechaInicio',
				'turase_fechaFin',
				'turase_fechacreado',
				array(
			        'name'=>'turase_creadopor',
			        'value'=>$model->turaseCreadopor->usua_usuariored,
			    ),
				'turase_fechamodificado',
				array(
			        'name'=>'turase_modificadopor',
			        'value'=>$model->turaseModificadopor->usua_usuariored,
			    ),
				
			),
		)); ?>
	</div>
</div>
