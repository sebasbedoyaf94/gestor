<?php /** @var TbActiveForm $form */
/*$form = $this->beginWidget(
	'booster.widgets.TbActiveForm',
	array(
		'id' => 'upload-form',
		'type' => 'horizontal',
	)
); ?>

<h1>Carga Masiva Turnos</h1>

<?php echo $form->fileFieldGroup($model, 'fileField',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
			)
		); 
		?>

		<div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=> 'Cargar Archivo',
				)); ?>
		</div>
	</div>

		<?php
$this->endWidget();*/
?>

<?php 
$form = $this->beginWidget(
        'CActiveForm',
        array(
                'id' => 'upload-form',
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
                'enableClientValidation'=>true,
                'clientOptions'=>array('validateOnSubmit'=>true,),
                )
        );
                ?>

<div class="row">
    <?php echo $form->labelEx($model, 'sourceCode');?>
    <br><?php echo $form->fileField($model, 'sourceCode');?>
    <?php echo $form->error($model, 'sourceCode');?>

</div>

<!--<div class="row buttons">
        <?php //echo CHtml::submitButton('Submit'); ?>
    </div>-->

    <div class="col-xs-12 text-center">
		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=> 'Cargar Archivo',
				)); ?>
		</div>
	</div>
<?php 
// ...
$this->endWidget();?>