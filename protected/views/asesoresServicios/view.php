<?php
$this->pageTitle=Yii::app()->name . ' - Ver Asesores Servicios';
$this->breadcrumbs=array(
	'Asesores Servicios'=>array('index'),
	$model->aseservAse->ase_nombre,
);

$this->menu=array(
array('label'=>'Listar Asesores Servicios','url'=>array('index')),
array('label'=>'Crear Asesor Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['AsesoresServicios']['Crear']),),
array('label'=>'Modificar Asesor Servicio','url'=>array('update','id'=>$model->aseserv_id)),
array('label'=>'Administrar Asesores Servicios','url'=>array('admin')),
);
?>

<h1>Ver servicio de <?php echo $model->aseservAse->ase_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información servicio del asesor</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'aseserv_ase_id',
			        'value'=>$model->aseservAse->ase_nombre . " " . $model->aseservAse->ase_apellidos,
			    ),
				array(
			        'name'=>'aseserv_serv_id',
			        'value'=>$model->aseservServ->serv_nombre . " (" . $model->aseservServ->servProg->prog_nombre . " - " . $model->aseservServ->servProg->progCli->cli_nombre . ")",
			    ),
			),
		)); ?>
	</div>
</div>
