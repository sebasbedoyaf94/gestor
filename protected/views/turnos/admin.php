<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Turnos';
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Turnos','url'=>array('index')),
	//array('label'=>'Ver Turno','url'=>array('view','id'=>$model->tur_id)),
	//array('label'=>'Administrar Turnos','url'=>array('admin')),
);
?>

<h1>Administrar Turnos</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'turnos-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'tur_nombre',
			'value' => '$data->tur_nombre',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_nombre', 'tur_nombre'),
		),
		array(
			'name' => 'tur_horaInicioLunes',
			'value' => '$data->tur_horaInicioLunes',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioLunes', 'tur_horaInicioLunes'),
		),
		array(
			'name' => 'tur_horaFinLunes',
			'value' => '$data->tur_horaFinLunes',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinLunes', 'tur_horaFinLunes'),
		),
		array(
			'name' => 'tur_horaInicioMartes',
			'value' => '$data->tur_horaInicioMartes',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioMartes', 'tur_horaInicioMartes'),
		),
		array(
			'name' => 'tur_horaFinMartes',
			'value' => '$data->tur_horaFinMartes',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinMartes', 'tur_horaFinMartes'),
		),
		/*
		array(
			'name' => 'tur_horaInicioMiercoles',
			'value' => '$data->tur_horaInicioMiercoles',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioMiercoles', 'tur_horaInicioMiercoles'),
		),
		array(
			'name' => 'tur_horaFinMiercoles',
			'value' => '$data->tur_horaFinMiercoles',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinMiercoles', 'tur_horaFinMiercoles'),
		),
		array(
			'name' => 'tur_horaInicioJueves',
			'value' => '$data->tur_horaInicioJueves',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioJueves', 'tur_horaInicioJueves'),
		),
		array(
			'name' => 'tur_horaFinJueves',
			'value' => '$data->tur_horaFinJueves',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinJueves', 'tur_horaFinJueves'),
		),
		array(
			'name' => 'tur_horaInicioViernes',
			'value' => '$data->tur_horaInicioViernes',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioViernes', 'tur_horaInicioViernes'),
		),
		array(
			'name' => 'tur_horaFinViernes',
			'value' => '$data->tur_horaFinViernes',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinViernes', 'tur_horaFinViernes'),
		),
		array(
			'name' => 'tur_horaInicioSabado',
			'value' => '$data->tur_horaInicioSabado',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioSabado', 'tur_horaInicioSabado'),
		),
		array(
			'name' => 'tur_horaFinSabado',
			'value' => '$data->tur_horaFinSabado',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinSabado', 'tur_horaFinSabado'),
		),
		array(
			'name' => 'tur_horaInicioDomingo',
			'value' => '$data->tur_horaInicioDomingo',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaInicioDomingo', 'tur_horaInicioDomingo'),
		),
		array(
			'name' => 'tur_horaFinDomingo',
			'value' => '$data->tur_horaFinDomingo',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_horaFinDomingo', 'tur_horaFinDomingo'),
		),
		array(
			'name' => 'tur_habilitado',
			'value' => '$data->tur_habilitado',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_habilitado', 'tur_habilitado'),
		),
		array(
			'name' => 'tur_fechacreado',
			'value' => '$data->tur_fechacreado',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_fechacreado', 'tur_fechacreado'),
		),
		array(
			'name' => 'tur_creadopor',
			'value' => '$data->tur_creadopor',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_creadopor', 'tur_creadopor'),
		),
		array(
			'name' => 'tur_fechamodificado',
			'value' => '$data->tur_fechamodificado',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_fechamodificado', 'tur_fechamodificado'),
		),
		array(
			'name' => 'tur_modificadopor',
			'value' => '$data->tur_modificadopor',
			// 'filter'=> CHtml::listData(Turnos::model()->findAll(), 'tur_modificadopor', 'tur_modificadopor'),
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
	            	'visible' => '!empty(Yii::app()->session["permisosRol"]["Turnos"]["Modificar"])',
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
