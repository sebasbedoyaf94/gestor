<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Servicio';
$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	$model->serv_nombre." (".$model->servProg->prog_nombre." ".$model->servProg->progCli->cli_nombre.")"=>array('view','id'=>$model->serv_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Servicios','url'=>array('index')),
	array('label'=>'Crear Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Servicios']['Crear'])),
	array('label'=>'Ver Servicio','url'=>array('view','id'=>$model->serv_id)),
	array('label'=>'Administrar Servicios','url'=>array('admin')),
);
?>

	<h1>Modificar Servicio <?php echo $model->serv_nombre." (".$model->servProg->prog_nombre." ".$model->servProg->progCli->cli_nombre.")"; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>