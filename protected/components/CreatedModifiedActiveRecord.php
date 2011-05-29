<?php

abstract class CreatedModifiedActiveRecord extends CActiveRecord {
    
	public function beforeValidate() {
		if ($this->isNewRecord) {
			$this->created = gmdate('Y-m-d H:i:s');
			$this->modified = $this->created;
        }
		else {
			$this->modified = gmdate('Y-m-d H:i:s');
        }
		return parent::beforeValidate();
	}
}
