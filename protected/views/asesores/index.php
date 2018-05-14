<?php
$this->pageTitle=Yii::app()->name . ' - Asesores';
$this->breadcrumbs=array(
	'Asesores',
);

$this->menu=array(
	array('label'=>'Crear Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Asesores']['Crear'])),
	array('label'=>'Administrar Asesores','url'=>array('admin')),
);
?>

<h1>Asesores</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
