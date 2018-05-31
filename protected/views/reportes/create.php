<?php
/* @var $this ReportesController */
/* @var $model Reportes */

$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	'Generar',
);
?>

<h1>Reportes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>