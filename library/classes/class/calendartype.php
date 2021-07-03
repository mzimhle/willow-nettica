<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_calendartype extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'calendartype';
	protected $_primary = 'pk_calendarType_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['calendarType_added'])) {
            $data['calendarType_added'] = date('Y-m-d H:i:s');
        }
		        
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
        // add a timestamp
        if (empty($data['calendarType_updated'])) {
            $data['calendarType_updated'] = date('Y-m-d H:i:s');
        }
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
	public function getById($id) {
	
		$select = $this->_db->select() 
				->from(array('calendartype' => 'calendartype'))					   
				->where('pk_calendarType_id = ?', $id);
						
		return $this->_db->fetchRow($select);
	}
	
	public function getAll() {
	
		$select = $this->select() 
					   ->from(array('calendartype' => 'calendartype'));

					   return $this->fetchAll($select);
	}
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('calendartype' => 'calendartype'), array('pk_calendarType_id', 'calendarType_name'))
					   ->where('calendarType_active = 1 AND calendarType_deleted = 0')
					   ->order('calendarType_name ASC');

		return $this->_db->fetchPairs($select);
	}
	
}
?>