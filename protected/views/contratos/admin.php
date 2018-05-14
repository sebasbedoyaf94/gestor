<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Contratos';
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Contratos','url'=>array('index')),
	array('label'=>'Crear Contrato',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Contratos']['Crear']),
		// 'linkOptions' => array(
		//  	'ajax'=>array(
  //               'type'=>'POST',
  //               'url'=>"js:$(this).attr('href')",
  //               'success'=>'function(data) { 
  //               	$("#viewModal .modal-body").html(data); 
  //               	$("#viewModal").modal(); 
  //               }'
  //           )	
		//  )
	),
);

?>

<h1>Administrar Contratos</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'contratos-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'cont_total_horas_semana',
			'value' => '$data->cont_total_horas_semana',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_total_horas_semana', 'cont_total_horas_semana'),
		),
		array(
			'name' => 'cont_min_horas_dia',
			'value' => '$data->cont_min_horas_dia',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_min_horas_dia', 'cont_min_horas_dia'),
		),
		array(
			'name' => 'cont_max_horas_dia',
			'value' => '$data->cont_max_horas_dia',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_max_horas_dia', 'cont_max_horas_dia'),
		),
		array(
			'name' => 'cont_habilitado',
			'value' => '$data->cont_habilitado',
			'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_habilitado', 'cont_habilitado'),
		),
		/*
		array(
			'name' => 'cont_fechacreado',
			'value' => '$data->cont_fechacreado',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_fechacreado', 'cont_fechacreado'),
		),
		array(
			'name' => 'cont_creadopor',
			'value' => '$data->cont_creadopor',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_creadopor', 'cont_creadopor'),
		),
		array(
			'name' => 'cont_modificadopor',
			'value' => '$data->cont_modificadopor',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_modificadopor', 'cont_modificadopor'),
		),
		array(
			'name' => 'cont_fechamodificado',
			'value' => '$data->cont_fechamodificado',
			// 'filter'=> CHtml::listData(Contratos::model()->findAll(), 'cont_fechamodificado', 'cont_fechamodificado'),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['Contratos']['Modificar'])",
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