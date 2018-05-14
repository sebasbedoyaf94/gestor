<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Usuario';
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usua_nombre.' '.$model->usua_apellidos=>array('view','id'=>$model->usua_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Usuarios','url'=>array('index')),
	array('label'=>'Crear Usuario','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear'])),
	array('label'=>'Ver Usuario','url'=>array('view','id'=>$model->usua_id)),
	array('label'=>'Administrar Usuarios','url'=>array('admin')),
);
?>

	<h1>Modificar Usuario <?php echo $model->usua_nombre.' '.$model->usua_apellidos; ?></h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'modelServicios'=>$modelServicios,
	'modelClientes'=>$modelClientes,
	'modelProgramas'=>$modelProgramas,
	'usuarioServiciosExistentes'=>$usuarioServiciosExistentes,
)); ?>