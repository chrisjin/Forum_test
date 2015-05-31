<?php
abstract class Model {
	protected $registry;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}
    
    public function Insert($data, $filter)
    {
        $trimmed_data = array_intersect_key($data, 
                    array_flip($filter));
        
        $namepart = join(',', array_keys($trimmed_data));
        $valuepart ='\'' . join('\',\'', array_values($trimmed_data)) . '\'';
        
        echo 'INSERT INTO table ' . '(' . $namepart . ') VALUES (' .  $valuepart . ')';
        
    }
}
