<?php
$this->pageTitle=Yii::app()->name . ' - Roles';
$this->breadcrumbs=array(
	'Roles',
);

$this->menu=array(
	array('label'=>'Crear Rol','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Roles']['Crear'])),
	array('label'=>'Administrar Roles','url'=>array('admin')),
);
?>

<h1>Roles</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
