<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard clients functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_client extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'client';
	protected $_primary = 'pk_client_id';	
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['client_added'])) {
            $data['client_added'] = date('Y-m-d H:i:s');
        }

		if (empty($data['client_active'])) {
            $data['client_active'] = 1;
        }
        
		if (empty($data['client_deleted'])) {
            $data['client_deleted'] = 0;
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
        if (empty($data['client_updated'])) {
            $data['client_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getPayingClient()
	{
		$select = $this->select() 
					   ->where('client_deleted = 0 and client_active = 1 and client_paying = 1');
					   
		return $this->fetchAll($select)->toArray();

	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByAdminReference($reference)
	{
		$select = $this->select() 
					   ->where('client_reference = ?', $reference)
					   ->where('client_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchRow($select)->toArray();

	}	
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByReference($reference)
	{
		$select = $this->_db->select()
						->from(array('client' => 'client'))
						->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')		
					   ->where('client_reference = ?', $reference)
					   ->limit(1);
					   
		$result = $this->_db->fetchRow($select);
		return ($result === false) ? false : $result;		

	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 10; $i++) {
			$reference .= $codeAlphabet[rand(1,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getByReference($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
	
	public function getByclientId($id) {
		$select = $this->_db->select()
						->from(array('client' => 'client'))
						->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')		
					   ->where('pk_client_id = ?', $id)
					   ->limit(1);
					   
		return $this->_db->fetchRow($select);	
	}
	
	public function remove($id) {
		return $this->delete('pk_client_id = '.$id);		
	}
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('client' => 'client'), array('client_reference', 'client_company'))
					   ->where('client_active = 1 AND client_deleted = 0')
					   ->order('client_company ASC');

		return $this->_db->fetchPairs($select);
	}
	
	public function getAll($where, $order = NULL) {
			
			$select = $this->_db->select()
							->from(array('client' => 'client'))
							->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')						   				  				   				  
						   ->where("client_deleted = 0")
						   	->where($where)		
						   ->order($order);
			
		$result = $this->_db->fetchAll($select);
		return ($result === false) ? false : $result;
	}
	
	public function getPaginated($where = 'client_company != ""', $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{		
			if($where == '') $where = 'client_company != ""';
			
			$select = $this->_db->select()
							->from(array('client' => 'client'))
							->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')						   				  				   				  
						   ->where("client_deleted = 0")
						   	->where($where)		
						   ->order($order);

		$paginator = Zend_Paginator::factory($select);
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perPage);
		$paginator->setPageRange($listedPages);
		$paginator->setDefaultScrollingStyle($scrollingStyle); 
		$pages = $paginator;

		return $pages;
	}	
			
}
?>