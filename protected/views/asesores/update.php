<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Asesor';
$this->breadcrumbs=array(
	'Asesores'=>array('index'),
	$model->ase_usuariored=>array('view','id'=>$model->ase_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Asesores','url'=>array('index')),
	array('label'=>'Crear Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Asesores']['Crear'])),
	array('label'=>'Ver Asesor','url'=>array('view','id'=>$model->ase_id)),
	array('label'=>'Administrar Asesores','url'=>array('admin')),
);
?>

	<h1>Modificar Asesor <?php echo $model->ase_usuariored; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>