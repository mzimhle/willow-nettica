<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_spamtype extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'spamtype';
	protected $_primary = 'pk_spamType_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['spamType_added'])) {
            $data['spamType_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['spamType_updated'])) {
            $data['spamType_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('spamtype' => 'spamtype'), array('pk_spamType_id', 'spamType_name'))
					   ->where('spamType_active = 1 AND spamType_deleted = 0')
					   ->order('spamType_name ASC');

		return $this->_db->fetchPairs($select);
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getById( $id )
	{
		$select = $this->select() 
					   ->where('pk_spamType_id = '.$id)
					   ->where('spamType_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchRow($select)->toArray();

	}
	
	public function getAll($where, $order) {
	
			$select = $this->_db->select() 
					   ->from(array('spamtype' => 'spamtype'))
					   ->where($where)
					   ->order($order);
	
			return $this->_db->fetchAll($select);
	}
}
?>