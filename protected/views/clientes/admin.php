<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Clientes';
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Clientes','url'=>array('index')),
	array('label'=>'Crear Cliente',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Clientes']['Crear']),
	),
);

?>

<h1>Administrar Clientes</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'clientes-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'cli_nombre',
			'value' => '$data->cli_nombre',
		),
		array(
			'name' => 'cli_habilitado',
			'value' => '$data->cli_habilitado',
			'filter'=> CHtml::listData(Clientes::model()->findAll(), 'cli_habilitado', 'cli_habilitado'),
		),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
			'template' => '{view} {update}',
			'buttons' => array(
	            'view' => array(
	                'options' => array(
	                	'title' => Yii::t('app', 'Ver'),
	                ),
	            ),
	            'update' => array(
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['Clientes']['Modificar'])",
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                ),
	            ),            
	        ),
		),
),
)); ?>
