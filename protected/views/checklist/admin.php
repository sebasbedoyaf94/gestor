<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklist'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Checklist', 'url'=>array('index')),
	array('label'=>'Crear Checklist', 'url'=>array('create')),
);
?>

<h1>Administrar Checklist</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'checklist-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'check_proy_id',
			'value' => '$data->checkProy->proy_nombre',
			'filter' => CHtml::textField('checkProy_proy_nombre', Yii::app()->request->getParam('checkProy_proy_nombre')),
		),
		array(
			'name' => 'check_url_pruebas',
			'value' => '$data->check_url_pruebas',
		),
		array(
			'name' => 'check_usuario_pruebas',
			'value' => '$data->check_usuario_pruebas',
		),
		array(
			'name' => 'check_contrasena_pruebas',
			'value' => '$data->check_contrasena_pruebas',
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
	            	'options' => array(
	            		'title' => Yii::t('app', 'Actualizar'),
	            	),
	            ),          
	        ),
		),
),
)); ?>