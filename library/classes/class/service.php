<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_service extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'service';
	protected $_primary = 'pk_service_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['service_added'])) {
            $data['service_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['service_updated'])) {
            $data['service_updated'] = date('Y-m-d H:i:s');
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
	public function getById($idList) {
	
		return $this->find($idList);
	}
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('service' => 'service'), array('pk_service_id', 'service_username'))
					   ->where('service_active = 1 AND service_deleted = 0')
					   ->order('service_username ASC');

		return $this->_db->fetchPairs($select);
	}
	
	/**
	 * get service by service service Id
 	 * @param string service id
     * @return object
	 */
	public function getByserviceId( $id )
	{
		$select = $this->select() 
					   ->where('pk_service_id = '.$id)
					   ->limit(1);
					   
		return $this->fetchRow($select)->toArray();

	}
	
	public function getAll($where, $order) {
	
			$select = $this->_db->select() 
					   ->from(array('service' => 'service'))
					   ->where($where)
					   ->order($order);
	
			return $this->_db->fetchAll($select);
	}
	
	/**
	 * get domain by domain service Id
 	 * @param string domain id
     * @return object
	 */
	public function getByReference($reference)
	{
		$select = $this->select() 
					   ->where('service_reference = ?', $reference)
					   ->where('service_deleted = 0')
					   ->limit(1);
					   
		return $this->fetchRow($select);

	}	
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<9;$i++){
			if($i == 5) {
				$reference .= '-';
			} else {
				$reference .= $codeAlphabet[rand(0,$count)];
			}
		}

		$reference = substr($reference, 1, 7);
		
		/* First check if it exists or not. */
		$itemCheck = $this->getByReference($reference);
		
		if(count($itemCheck) > 0) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
	
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_recruiter_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
		$select = $this->_db->select() 
					   ->from(array('service' => 'service'))
					   ->where($where)
					   ->order($order);
					   
		///$sql = $selectedrecruiters->__toString();
		//echo $sql; 
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