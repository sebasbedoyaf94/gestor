<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Rol';
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->rol_nombre=>array('view','id'=>$model->rol_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Roles','url'=>array('index')),
	array('label'=>'Crear Rol','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Roles']['Crear'])),
	array('label'=>'Ver Rol','url'=>array('view','id'=>$model->rol_id)),
	array('label'=>'Administrar Roles','url'=>array('admin')),
);
?>

	<h1>Modificar Rol <?php echo $model->rol_nombre; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'dataModelosAcciones'=>$dataModelosAcciones,'titulosAcciones'=>$titulosAcciones,'accionesAsignadas'=>$accionesAsignadas)); ?>