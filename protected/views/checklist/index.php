<?php
/* @var $this ChecklistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Checklists',
);

$this->menu=array(
	array('label'=>'Crear Checklist', 'url'=>array('create')),
	array('label'=>'Administrar Checklist', 'url'=>array('admin')),
);
?>

<h1>Checklists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
