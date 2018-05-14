<?php
$this->pageTitle=Yii::app()->name . ' - Ver Novedades Asesores';
$this->breadcrumbs=array(
	'Novedades Asesores'=>array('index'),
	$model->novaseAse->ase_nombre,
);

$this->menu=array(
array('label'=>'Listar Novedades Asesores','url'=>array('index')),
array('label'=>'Crear Novedad Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['NovedadesAsesores']['Crear']),),
array('label'=>'Modificar Novedades Asesores','url'=>array('update','id'=>$model->novase_id)),
array('label'=>'Administrar Novedades Asesores','url'=>array('admin')),
);
?>

<h1>Ver novedad de <?php echo $model->novaseAse->ase_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información novedad del asesor</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'novase_ase_id',
			        'value'=>$model->novaseAse->ase_nombre . " " . $model->novaseAse->ase_apellidos,
			    ),
				array(
			        'name'=>'novase_nov_id',
			        'value'=>$model->novaseNov->nov_nombre,
			    ),
				'novase_fecha',
				'novase_horaInicio',
				'novase_horaFin',
				'novase_observaciones',
				'novase_fechacreado',
				array(
			        'name'=>'novase_creadopor',
			        'value'=>$model->novaseCreadopor->usua_usuariored,
			    ),
				'novase_fechamodificado',
				array(
			        'name'=>'novase_modificadopor',
			        'value'=>$model->novaseModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
