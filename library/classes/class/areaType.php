<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard areaTypes functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_areaType extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'areatype';
	protected $_primary = 'areaTypeId';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
		return parent::insert($data);
		
    }

	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where)
    {
        return parent::update($data, $where);
    }
	
	
	 /**
	 * find by id function
	 * example: $rowset = $table->getById('5, 4, 10, 12');
	 * @param string $id 
	 * OR 
	 * @param array $idList
     * @return object
	 */
	public function getById($idList) {
		return $this->find($idList);
	}
	
	
	/**
	 * get all areaTypes ordered by column name
	 * example: $collection->getAllareaTypes('areaType_title');
	 * @param string $order
     * @return object
	 */
	public function getAllareaTypes($where = "areaTypeName !=''")
	{
		$select = $this->select()
					   ->where($where);
					   
		return $this->fetchAll($select)->toArray();

	}

	 public function areaTypePairs() {
		$select = $this->select()
					   ->from(array('a' => 'areatype'), array('a.areaTypeId', 'a.areaTypeName'))
					   ->order('areaTypeId ASC');

		return $this->_db->fetchPairs($select);
	}	 		
}
?>