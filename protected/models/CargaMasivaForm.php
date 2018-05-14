<?php class UploadSolutionForm extends CFormModel
{

public $sourceCode;

	public function rules()
	{
	    return array(
	        array(
	        	'sourceCode', 'file', 
	        	'types'=>'jpg, png', 
	        	'allowEmpty'=>false, 
	        	'wrongType'=>'Only .jpg and .png files.'),
	    );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
	    return array(
	            'sourceCode' => 'Buscar Archivo',
	    );
	}
}