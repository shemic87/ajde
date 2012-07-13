<?php

class Ajde_Crud_Options_Fields_Field extends Ajde_Crud_Options
{		
	/**
	 *
	 * @return Ajde_Crud_Options_Fields
	 */
	public function up($obj = false) {
		return parent::up($this);
	}
	
	// =========================================================================
	// Select functions
	// =========================================================================
	
		
	// =========================================================================
	// Set functions
	// =========================================================================
	
	/**
	 * Set fieldtype for field (see Ajde_Crud_Field_*)
	 * 
	 * @param string $type
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setType($type) { return $this->_set('type', $type); }
	
	/**
	 * For 'file' fieldtypes, sets the dir to save the files relative to the sites root
	 * 
	 * @param string $saveDir
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setSaveDir($saveDir) { return $this->_set('saveDir', $saveDir); }
	
	/**
	 * For 'file' fieldtypes, sets the allowed extensions of the uploaded files
	 * 
	 * @param array $extensions
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setExtensions($extensions) { return $this->_set('extensions', $extensions); }
	
	/**
	 * For 'file' fieldtypes, can multiple files be uploaded at once?
	 * 
	 * @param boolean $multiple
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setMultiple($multiple) { return $this->_set('multiple', $multiple); }
	
	/**
	 * Overrides the field label
	 * 
	 * @param string $label
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setLabel($label) { return $this->_set('label', $label); }
	
	/**
	 * Overrides the field length
	 * 
	 * @param integer $length
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setLength($length) { return $this->_set('length', $length); }
	
	/**
	 * Overrides whether the field is required
	 * 
	 * @param boolean $isRequired
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setIsRequired($isRequired) { return $this->_set('isRequired', $isRequired); }
	
	/**
	 * Overrides the default value
	 * 
	 * @param mixed $default
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setDefault($default) { return $this->_set('default', $default); }
	
	/**
	 * Overrides whether the field has the auto increment attribute
	 * 
	 * @param boolean $isAutoIncrement
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setIsAutoIncrement($isAutoIncrement) { return $this->_set('isAutoIncrement', $isAutoIncrement); }
	
	/**
	 * Sets the helptext
	 * 
	 * @param string help
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setHelp($help) { return $this->_set('help', $help); }
	
	/**
	 * Whether the field is read only
	 * 
	 * @param boolean $isReadonly
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setIsReadonly($isReadonly) { return $this->_set('readonly', $isReadonly); }
	
	/**
	 * Sets the allowed values
	 * 
	 * @param array $filter
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setFilter($filter) { return $this->_set('filter', $filter); }
	
	/**
	 * Sets an array of Ajde_Filter to apply to field
	 * 
	 * @param array $advancedFilter
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setAdvancedFilter($advancedFilter) { return $this->_set('advancedFilter', $advancedFilter); }
	
	/**
	 * Sets the display function of the model for the list view
	 * 
	 * @param string $function
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setFunction($function) { return $this->_set('function', $function); }
				
	/**
	 * Sets thumbnail dimensions of images
	 * 
	 * @param type $width
	 * @param type $height
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setThumbDim($width, $height) { return $this->_set('thumbDim', array('width' => $width, 'height' => $height)); }
	
	/**
	 * Put emphasis on this field
	 * 
	 * @param boolean $emphasis
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setEmphasis($emphasis) { return $this->_set('emphasis', $emphasis); }
	
	/**
	 * Defines a many-to-many relationshop for fields with type 'multiple'
	 * 
	 * @param string $table
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setCrossReferenceTable($table) { return $this->_set('crossReferenceTable', $table); }	
	
	/**
	 * Display the label?
	 * 
	 * @param boolean $display
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setShowLabel($display) { return $this->_set('showLabel', $display); }	
	
	/**
	 * Sets the edit route for fields with type 'multiple'
	 * 
	 * @param string $route
	 * @return Ajde_Crud_Options_Fields_Field 
	 */
	public function setEditRoute($route) { return $this->_set('editRoute', $route); }
}