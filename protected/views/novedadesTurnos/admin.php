<?php
$this->pageTitle=Yii::app()->name . ' - Administrar NovedadesTurnos';
$this->breadcrumbs=array(
	'Novedades Turnos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar NovedadesTurnos','url'=>array('index')),
	array('label'=>'Crear NovedadesTurnos','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('novedades-turnos-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administrar Novedades Turnos</h1>

<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'novedades-turnos-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'novtur_id',
			'value' => '$data->novtur_id',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_id', 'novtur_id'),
		),
		array(
			'name' => 'novtur_tur_id',
			'value' => '$data->novtur_tur_id',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_tur_id', 'novtur_tur_id'),
		),
		array(
			'name' => 'novtur_nov_id',
			'value' => '$data->novtur_nov_id',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_nov_id', 'novtur_nov_id'),
		),
		array(
			'name' => 'novtur_fecha',
			'value' => '$data->novtur_fecha',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_fecha', 'novtur_fecha'),
		),
		array(
			'name' => 'novtur_horaInicio',
			'value' => '$data->novtur_horaInicio',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_horaInicio', 'novtur_horaInicio'),
		),
		array(
			'name' => 'novtur_horaFin',
			'value' => '$data->novtur_horaFin',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_horaFin', 'novtur_horaFin'),
		),
		/*
		array(
			'name' => 'novtur_observaciones',
			'value' => '$data->novtur_observaciones',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_observaciones', 'novtur_observaciones'),
		),
		array(
			'name' => 'novtur_fechacreado',
			'value' => '$data->novtur_fechacreado',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_fechacreado', 'novtur_fechacreado'),
		),
		array(
			'name' => 'novtur_creadopor',
			'value' => '$data->novtur_creadopor',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_creadopor', 'novtur_creadopor'),
		),
		array(
			'name' => 'novtur_fechamodificado',
			'value' => '$data->novtur_fechamodificado',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_fechamodificado', 'novtur_fechamodificado'),
		),
		array(
			'name' => 'novtur_modificadopor',
			'value' => '$data->novtur_modificadopor',
			// 'filter'=> CHtml::listData(NovedadesTurnos::model()->findAll(), 'novtur_modificadopor', 'novtur_modificadopor'),
		),
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
