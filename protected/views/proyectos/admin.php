<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Proyectos', 'url'=>array('index')),
	array('label'=>'Crear Proyectos', 'url'=>array('create')),
);
?>

<h1>Administrar Proyectos</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'proyectos-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'proy_nombre',
			'value' => '$data->proy_nombre',
		),
		array(
			'name' => 'proy_cli_id',
			'value' => '$data->proyCli->cli_nombre',
			'filter' => CHtml::textField('proyCli_cli_nombre', Yii::app()->request->getParam('proyCli_cli_nombre')),
		),
		array(
			'name' => 'proy_fechaInicio',
			'value' => '$data->proy_fechaInicio',
		),
		array(
			'name' => 'proy_fechaFin',
			'value' => '$data->proy_fechaFin',
		),
		array(
			'name' => 'proy_habilitado',
			'value' => '$data->proy_habilitado',
			'filter'=> CHtml::listData(Proyectos::model()->findAll(), 'proy_habilitado', 'proy_habilitado'),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['Proyectos']['Modificar'])",
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                ),
	            ),            
	        ),
		),
),
)); ?>
