<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard clients functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */


//custom enquiry item class as enquiry table abstraction
class class_social extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'social';
	protected $_primary = 'social_code';	
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['social_added'] 	= date('Y-m-d H:i:s');
        $data['social_code'] 		= $this->createReference();
		$data['social_hascode']	= md5(date('Y-m-d H:i:s'));
		
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
        $data['social_updated'] = date('Y-m-d H:i:s');
        
        return parent::update($data, $where);
    }
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByCode($code)
	{
		$select = $this->_db->select()
						->from(array('social' => 'social'))
					   ->where('social_code = ?', $code)
					     ->where('social_deleted = 0')
					   ->limit(1);
					   
		$result = $this->_db->fetchRow($select);
		return ($result === false) ? false : $result;		

	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getBySocial($id, $type)
	{
		$select = $this->_db->select()
						->from(array('social' => 'social'))
					   ->where('social_id = ?', $id)
					   ->where('social_type = ?', $type)
					     ->where('social_deleted = 0')
					   ->limit(1);
					   
		$result = $this->_db->fetchRow($select);
		return ($result === false) ? false : $result;		

	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($code)
	{
		$select = $this->_db->select()
						->from(array('social' => 'social'))
					   ->where('social_code = ?', $code)
					   ->limit(1);
					   
		$result = $this->_db->fetchRow($select);
		return ($result === false) ? false : $result;		

	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "123456789";

		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 10; $i++) {
			$reference .= $codeAlphabet[rand(1,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}
	
	public function getAll() {
			
			$select = $this->_db->select()
								->from(array('social' => 'social'))					   				  				   				  
								->where("social_deleted = 0");
			
		$result = $this->_db->fetchAll($select);
		return ($result === false) ? false : $result;
	}	
}
?>