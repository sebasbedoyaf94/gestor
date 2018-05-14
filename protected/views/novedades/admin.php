<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Novedades';
$this->breadcrumbs=array(
	'Novedades'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Novedades','url'=>array('index')),
	array('label'=>'Crear Novedad','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Novedades']['Crear'])),
);

?>

<h1>Administrar Novedades</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'novedades-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'nov_nombre',
			'value' => '$data->nov_nombre',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_nombre', 'nov_nombre'),
		),
		array(
			'name' => 'nov_abreviatura',
			'value' => '$data->nov_abreviatura',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_abreviatura', 'nov_abreviatura'),
		),
		array(
			'name' => 'nov_descripcion',
			'value' => '$data->nov_descripcion',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_descripcion', 'nov_descripcion'),
		),
		array(
			'name' => 'nov_paga',
			'value' => '$data->nov_paga',
			'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_paga', 'nov_paga'),
		),
		array(
			'name' => 'nov_habilitado',
			'value' => '$data->nov_habilitado',
			'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_habilitado', 'nov_habilitado'),
		),
		/*
		array(
			'name' => 'nov_fechacreado',
			'value' => '$data->nov_fechacreado',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_fechacreado', 'nov_fechacreado'),
		),
		array(
			'name' => 'nov_creadopor',
			'value' => '$data->nov_creadopor',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_creadopor', 'nov_creadopor'),
		),
		array(
			'name' => 'nov_fechamodificado',
			'value' => '$data->nov_fechamodificado',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_fechamodificado', 'nov_fechamodificado'),
		),
		array(
			'name' => 'nov_modificadopor',
			'value' => '$data->nov_modificadopor',
			// 'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_modificadopor', 'nov_modificadopor'),
		),
		*/
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
			'template' => '{view} {update}',
			'buttons' => array(
	            'view' => array(
	                'options' => array(
	                	'title' => Yii::t('app', 'Ver'),
	                	// 'ajax'=>array(
                  //           'type'=>'POST',
                  //           'url'=>"js:$(this).attr('href')",
                  //           'success'=>'function(data) { 
                  //           	$("#viewModal .modal-body").html(data); 
                  //           	$("#viewModal").modal(); 
                  //           }'
                  //       ),
	                ),
	            ),
	            'update' => array(
	            	'visible' => '!empty(Yii::app()->session["permisosRol"]["Novedades"]["Modificar"])',
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                	// 'ajax'=>array(
                  //           'type'=>'POST',
                  //           'url'=>"js:$(this).attr('href')",
                  //           'success'=>'function(data) { 
                  //           	$("#viewModal .modal-body").html(data); 
                  //           	$("#viewModal").modal();
                  //           }'
                  //       ),
	                ),
	            ),            
	        ),
		),
),
)); ?>
