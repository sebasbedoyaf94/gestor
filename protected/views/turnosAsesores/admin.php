<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Turnos Asesores';
$this->breadcrumbs=array(
	'Turnos Asesores'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Turnos Asesores','url'=>array('index')),
	array('label'=>'Crear Turno Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Crear']),),
);

?>

<h1>Administrar Turnos Asesores</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'turnos-asesores-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'full_turno',
			'value' => '$data->turaseTur->tur_nombre',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_tur_id', 'turase_tur_id'),
		),
		array(
			'name' => 'full_name',
			'value' => '$data->turaseAseserv->aseservAse->ase_nombre . " " . $data->turaseAseserv->aseservAse->ase_apellidos',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_aseserv_id', 'turase_aseserv_id'),
		),
		array(
			'name' => 'turase_fechaInicio',
			'value' => '$data->turase_fechaInicio',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_fechaInicio', 'turase_fechaInicio'),
		),
		array(
			'name' => 'turase_fechaFin',
			'value' => '$data->turase_fechaFin',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_fechaFin', 'turase_fechaFin'),
		),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Modificar'])",
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
		/*array(
			'name' => 'turase_fechacreado',
			'value' => '$data->turase_fechacreado',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_fechacreado', 'turase_fechacreado'),
		),
		
		array(
			'name' => 'turase_creadopor',
			'value' => '$data->turase_creadopor',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_creadopor', 'turase_creadopor'),
		),
		array(
			'name' => 'turase_fechamodificado',
			'value' => '$data->turase_fechamodificado',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_fechamodificado', 'turase_fechamodificado'),
		),
		array(
			'name' => 'turase_modificadopor',
			'value' => '$data->turase_modificadopor',
			// 'filter'=> CHtml::listData(TurnosAsesores::model()->findAll(), 'turase_modificadopor', 'turase_modificadopor'),
		),
		*/
),
)); ?>
