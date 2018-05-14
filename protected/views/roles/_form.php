<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'roles-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
    ),
)); ?>


<div class="row">
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Información del Rol</h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<?php echo $form->textFieldGroup($model,'rol_nombre',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'')))); ?>
		</div>

		<div class="col-xs-12 col-sm-6">
			<?php echo $form->dropDownListGroup($model,'rol_habilitado', array('widgetOptions'=>array('data'=>array("Si"=>"Si","No"=>"No",), 'htmlOptions'=>array('class'=>'input-large')))); ?>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 well">
		<div class="col-xs-12 col-sm-12">
			<h3 class='subtitulo'>Acciones permitidas para el nuevo rol</h3>
		</div>

		<table class="table table-bordered">
		 	<thead>
		 		<tr>
		 			<th></th>
			 		<?php foreach ($titulosAcciones as $key => $accion): ?>
		 				<th><?php echo $accion; ?></th>
			 		<?php endforeach ?>
		 		</tr>
		 	</thead>
		 	<tbody>

		 		<?php foreach ($dataModelosAcciones as $key => $row): ?>
		 			<tr>
		 			<th><?php echo $key; ?></th>
		 			<?php 	
		 				for ($i=0; $i < count($titulosAcciones) ; $i++) 
		 				{
		 					if (!empty($row[$titulosAcciones[$i]])) {

		 						//asignar el valor por default para el dropdown
		 						//Se asigna valor Si cuando ya tiene asginada la accion (osea que ya existe el rol y la accion)
		 						$default='No';
		 						if (!empty($accionesAsignadas[$row[$titulosAcciones[$i]]])) {
		 							$default='Si';
		 						}

		 						echo "<td class='alert alert-success' role='alert'>"
		 							.CHtml::dropDownList('ModulosAcciones['.$row[$titulosAcciones[$i]].']', $default,
		 								array('Si' => 'Si', 'No' => 'No'),array('class'=>'form-control'))
		 						."</td>";
		 					}
		 					else{
		 						echo "<td class='alert alert-danger' role='alert'></td>";
		 					}
		 				}
		 			?>
		 			</tr>
		 		<?php endforeach ?>
		 	</tbody>
		</table>
	</div>

	<div class="col-xs-12">
		<p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php echo $form->errorSummary($model); ?>
	</div>

	<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>$model->isNewRecord ? 'Crear Rol' : 'Guardar Cambios',
				)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
