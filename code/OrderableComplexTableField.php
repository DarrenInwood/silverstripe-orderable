<?php

// Wrapper to allow modules using OrderableComplexTableField

class OrderableComplexTableField extends GridField {

	public function __construct(
		$controller,
		$name,
		$sourceClass,
		$fieldList = null,
		$detailFormFields = null,
		$sourceFilter = "",
		$sourceSort = "",
		$sourceJoin = ""
	) {
		$dataList = DataObject::get($sourceClass);
		if ( $sourceFilter ) {
			$dataList = $dataList->where($sourceFilter);
		}
		if ( $sourceSort ) {
			$dataList = $dataList->sort($sourceSort);
		}
		if ( $sourceJoin ) {
			$dataList = $dataList->join($sourceJoin);
		}

		$config = GridFieldConfig_RecordEditor::create();

		parent::__construct($name, null, $dataList, $config);
	}

}
