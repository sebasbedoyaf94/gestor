<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */

$this->breadcrumbs=array(
	'Proyectoses'=>array('index'),
	$model->proy_id=>array('view','id'=>$model->proy_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Proyectos', 'url'=>array('index')),
	array('label'=>'Create Proyectos', 'url'=>array('create')),
	array('label'=>'View Proyectos', 'url'=>array('view', 'id'=>$model->proy_id)),
	array('label'=>'Manage Proyectos', 'url'=>array('admin')),
);
?>

<h1>Update Proyectos <?php echo $model->proy_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>