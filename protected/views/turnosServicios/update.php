<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Turno Servicio';
$this->breadcrumbs=array(
	'Turnos Servicios'=>array('index'),
	$model->turservTur->tur_nombre.' '.$model->turservServ->serv_nombre=>array('view','id'=>$model->turserv_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Turnos Servicios','url'=>array('index')),
	array('label'=>'Crear Turno Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosServicios']['Crear']),),
	array('label'=>'Ver Turnos Servicios','url'=>array('view','id'=>$model->turserv_id)),
	array('label'=>'Administrar Turnos Servicios','url'=>array('admin')),
);
?>

	<h1>Modificar turno <?php echo $model->turservTur->tur_nombre ; ?> del servicio <?php echo $model->turservServ->serv_nombre; ?></h1>

<?php echo $this->renderPartial('_form2',array('model'=>$model)); ?>