<?php
/* @var $this ProyectosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Proyectos',
);

$this->menu=array(
	array('label'=>'Crear Proyectos', 'url'=>array('create'), 'visible'=>!empty(Yii::app()->session['permisosRol']['Proyectos']['Crear']),),
	array('label'=>'Administrar Proyectos', 'url'=>array('admin')),
);
?>

<h1>Proyectos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
