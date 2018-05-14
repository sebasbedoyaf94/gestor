<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Programa';
$this->breadcrumbs=array(
	'Programas'=>array('index'),
	$model->prog_nombre." (".$model->progCli->cli_nombre.")"=>array('view','id'=>$model->prog_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Programas','url'=>array('index')),
	array('label'=>'Crear Programa','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Programas']['Crear'])),
	array('label'=>'Ver Programa','url'=>array('view','id'=>$model->prog_id)),
	array('label'=>'Administrar Programas','url'=>array('admin')),
);
?>

	<h1>Modificar Programa <?php echo $model->prog_nombre." (".$model->progCli->cli_nombre.")"; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>