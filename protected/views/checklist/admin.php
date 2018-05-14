<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Checklist', 'url'=>array('index')),
	array('label'=>'Create Checklist', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#checklist-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Checklists</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'checklist-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'check_id',
		'check_proy_id',
		'check_url_pruebas',
		'check_ruta_doc_funcional',
		'check_ruta_doc_tecnica',
		'check_observaciones',
		/*
		'check_usuario_pruebas',
		'check_contrasena_pruebas',
		'check_creadopor',
		'check_fechacreado',
		'check_modificadopor',
		'check_fechamodificado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
