<?php
/**
 * A simple extension to add a sort field to an object.
 *
 * @package silverstripe-orderable
 */
class Orderable extends DataExtension {

	private static $db = array(
		'Sort' => 'Int'
	);

	public function augmentSQL(SQLQuery &$query) {
		if (!$query->orderby && !$query->delete) $query->orderby('"Sort"');
	}

	public function onBeforeWrite() {
		if (!$this->owner->Sort) {
			$max = DB::query(sprintf(
				'SELECT MAX("Sort") + 1 FROM "%s"', $this->ownerBaseClass
			));
			$this->owner->Sort = $max->value();
		}
	}

	public function updateCMSFields(FieldList $fields) {
		$fields->removeByName('Sort');
	}

	public function updateFrontEndFields(FieldList $fields) {
		$fields->removeByName('Sort');
	}

}
