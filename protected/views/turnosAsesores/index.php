<?php
$this->pageTitle=Yii::app()->name . ' - Turnos Asesores';
$this->breadcrumbs=array(
	'Turnos Asesores',
);

$this->menu=array(
	array('label'=>'Crear Turno Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Crear']),),
	array('label'=>'Administrar Turnos Asesores','url'=>array('admin')),
);
?>

<h1>Turnos Asesores</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
