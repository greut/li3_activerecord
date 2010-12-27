<?php

namespace li3_activerecord\extensions\data;

use ActiveRecord\Connection;

class Model extends \ActiveRecord\Model {

	public static function create($attributes = array(), $validate=true) {
		return parent::create($attributes, $validate);
	}
	
	public function data($name = null) {
		return empty($name) ? $this->attributes : $this->read_attribute($name);
	}
	
	public function schema($field = null) {
		$connection = Connection::instance();
		$columns = $connection->columns($this->table_name);
		$schema = array();
		if (key_exists($field, $columns)) {
			return array($field => $columns[$field]->raw_type);
		} else {
			foreach ($columns as $name => $column) {
				$schema[$name] = $column->raw_type;
			}
			return $schema;
		}
	}
	
	public function errors($field = null, $value = null) {
		if ($field === null) {
			$columns = $this->schema();
			$errors = array();
			foreach ($columns as $column => $type) {
				if ($this->errors->$column) {
					foreach($this->errors->$column as $error) {
						$errors[$column][] = $error;
					}
				}
			}
			return $errors;
		}

		if ($this->errors && $this->errors->on($field) != null) {
			$errors = $this->errors->$field;
			return $errors;
		}
		if ($value !== null) {
			return $this->errors->$field = $value;
		}
		return $value;
	}
	
}

?>
