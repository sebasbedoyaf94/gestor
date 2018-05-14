<?php
$this->pageTitle=Yii::app()->name . ' - Ver Asesores';
$this->breadcrumbs=array(
	'Asesores'=>array('index'),
	$model->ase_nombre,
);

$this->menu=array(
array('label'=>'Listar Asesores','url'=>array('index')),
array('label'=>'Crear Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Turnos']['Crear'])),
array('label'=>'Modificar Asesor','url'=>array('update','id'=>$model->ase_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Turnos']['Modificar'])),
array('label'=>'Administrar Asesor','url'=>array('admin')),
);
?>

<h1>Ver Asesores <?php echo $model->ase_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Asesor</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'ase_cont_id',
			        'value'=>$model->aseCont->cont_total_horas_semana,
			    ),
				'ase_usuariored',
				'ase_nombre',
				'ase_apellidos',
				'ase_identificacion',
				'ase_lider',
				'ase_identificacion_lider',
				'ase_horaInicioLunes',
				'ase_horaFinLunes',
				'ase_horaInicioMartes',
				'ase_horaFinMartes',
				'ase_horaInicioMiercoles',
				'ase_horaFinMiercoles',
				'ase_horaInicioJueves',
				'ase_horaFinJueves',
				'ase_horaInicioViernes',
				'ase_horaFinViernes',
				'ase_horaInicioSabado',
				'ase_horaFinSabado',
				'ase_horaInicioDomingo',
				'ase_horaFinDomingo',
				'ase_habilitado',
				'ase_fechacreado',
				array(
			        'name'=>'ase_creadopor',
			        'value'=>$model->aseCreadopor->usua_usuariored,
			    ),
				'ase_fechamodificado',
				array(
			        'name'=>'ase_modificadopor',
			        'value'=>$model->aseModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
