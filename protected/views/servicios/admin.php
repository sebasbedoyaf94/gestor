<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Servicios';
$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Servicios','url'=>array('index')),
	array('label'=>'Crear Servicio',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Servicios']['Crear']),
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

<h1>Administrar Servicios</h1>


<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'servicios-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'serv_prog_id',
			// 'value' => '$data->servProg->prog_nombre',
			'value'=>'$data->servProg->prog_nombre." <small>(".$data->servProg->progCli->cli_nombre.")</small>"',
			'filter' => CHtml::textField('servProg_prog_nombre', Yii::app()->request->getParam('servProg_prog_nombre')),
			'type'=>'raw',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_prog_id', 'serv_prog_id'),
			// <span class="badge">42</span>
		),
		array(
			'name' => 'serv_nombre',
			'value' => '$data->serv_nombre',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_nombre', 'serv_nombre'),
		),
		array(
			'name' => 'serv_descripcion',
			'value' => '$data->serv_descripcion',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_descripcion', 'serv_descripcion'),
		),
		array(
			'name' => 'serv_habilitado',
			'value' => '$data->serv_habilitado',
			'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_habilitado', 'serv_habilitado'),
		),
		/*
		array(
			'name' => 'serv_horaInicioLunes',
			'value' => '$data->serv_horaInicioLunes',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioLunes', 'serv_horaInicioLunes'),
		),
		array(
			'name' => 'serv_horaFinLunes',
			'value' => '$data->serv_horaFinLunes',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinLunes', 'serv_horaFinLunes'),
		),
		array(
			'name' => 'serv_horaInicioMartes',
			'value' => '$data->serv_horaInicioMartes',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioMartes', 'serv_horaInicioMartes'),
		),
		array(
			'name' => 'serv_horaFinMartes',
			'value' => '$data->serv_horaFinMartes',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinMartes', 'serv_horaFinMartes'),
		),
		array(
			'name' => 'serv_horaInicioMiercoles',
			'value' => '$data->serv_horaInicioMiercoles',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioMiercoles', 'serv_horaInicioMiercoles'),
		),
		array(
			'name' => 'serv_horaFinMiercoles',
			'value' => '$data->serv_horaFinMiercoles',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinMiercoles', 'serv_horaFinMiercoles'),
		),
		array(
			'name' => 'serv_horaInicioJueves',
			'value' => '$data->serv_horaInicioJueves',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioJueves', 'serv_horaInicioJueves'),
		),
		array(
			'name' => 'serv_horaFinJueves',
			'value' => '$data->serv_horaFinJueves',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinJueves', 'serv_horaFinJueves'),
		),
		array(
			'name' => 'serv_horaInicioViernes',
			'value' => '$data->serv_horaInicioViernes',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioViernes', 'serv_horaInicioViernes'),
		),
		array(
			'name' => 'serv_horaFinViernes',
			'value' => '$data->serv_horaFinViernes',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinViernes', 'serv_horaFinViernes'),
		),
		array(
			'name' => 'serv_horaInicioSabado',
			'value' => '$data->serv_horaInicioSabado',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioSabado', 'serv_horaInicioSabado'),
		),
		array(
			'name' => 'serv_horaFinSabado',
			'value' => '$data->serv_horaFinSabado',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinSabado', 'serv_horaFinSabado'),
		),
		array(
			'name' => 'serv_horaInicioDomingo',
			'value' => '$data->serv_horaInicioDomingo',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaInicioDomingo', 'serv_horaInicioDomingo'),
		),
		array(
			'name' => 'serv_horaFinDomingo',
			'value' => '$data->serv_horaFinDomingo',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_horaFinDomingo', 'serv_horaFinDomingo'),
		),
		array(
			'name' => 'serv_fechacreado',
			'value' => '$data->serv_fechacreado',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_fechacreado', 'serv_fechacreado'),
		),
		array(
			'name' => 'serv_creadopor',
			'value' => '$data->serv_creadopor',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_creadopor', 'serv_creadopor'),
		),
		array(
			'name' => 'serv_fechamodificado',
			'value' => '$data->serv_fechamodificado',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_fechamodificado', 'serv_fechamodificado'),
		),
		array(
			'name' => 'serv_modificadopor',
			'value' => '$data->serv_modificadopor',
			// 'filter'=> CHtml::listData(Servicios::model()->findAll(), 'serv_modificadopor', 'serv_modificadopor'),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['Servicios']['Modificar'])",
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
