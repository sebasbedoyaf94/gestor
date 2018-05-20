<?php
/* @var $this CargaController */
/* @var $model Carga */

$this->breadcrumbs=array(
	'Cargas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Cargas', 'url'=>array('index')),
	array('label'=>'Crear Cargas', 'url'=>array('create')),
);
?>

<h1>Administrar Cargas</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'carga-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'carga_nombre_archivo',
			'value' => '$data->carga_nombre_archivo',
		),
		array(
			'name' => 'carga_proy_id',
			'value' => '$data->cargaProy->proy_nombre',
			'filter' => CHtml::textField('cargaProy_proy_nombre', Yii::app()->request->getParam('cargaProy_proy_nombre')),
		),
		array(
			'name' => 'carga_fase',
			'value' => '$data->carga_fase',
		),
		array(
			'name' => 'carga_descripcion',
			'value' => '$data->carga_descripcion',
		),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
			'template' => '{view} {download}',
			'buttons' => array(
	            'view' => array(
	                'options' => array(
	                	'title' => Yii::t('app', 'Ver'),
	                ),
	            ),
	            'download' => array(
	            	'label' => 'Descargar',
                    'icon' => 'download',
                    'url'=>'Yii::app()->createUrl("carga/download", array("fileName"=>$data->carga_nombre_archivo))',
                    'options'=>array(
                        'class'=>'btn btn-small',
                    ),
	            ),           
	        ),
		),
),
)); ?>


