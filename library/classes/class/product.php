<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_product extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'product';
	protected $_primary = 'pk_product_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['product_added'])) {
            $data['product_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['product_updated'])) {
            $data['product_updated'] = date('Y-m-d H:i:s');
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
	 * get product by product Account Id
 	 * @param string product id
     * @return object
	 */
	public function getByReference($reference)
	{
	
	
		$select = $this->select() 
					   ->from(array('product' => 'product'))
					   ->where('product_reference = ?', $reference)
					   ->limit(1);
					   
		return $this->fetchRow($select);

	}
	
	public function getByMultipleReference($references) {
		$select = $this->select() 
					   ->from(array('product' => 'product'))
					   ->where('product_reference in (?)', $references);
		return $this->fetchAll($select);					   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "0123456789";
		
		for($i=0;$i<7;$i++){
			$reference .= $codeAlphabet[rand(0,strlen($codeAlphabet))];
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
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('product' => 'product'), array('product_reference', 'product_name as product_description'))
					   ->where('product_active = 1 AND product_deleted = 0')
					   ->order('product_name ASC');

		return $this->_db->fetchPairs($select);
	}	
	
	public function getAll($where = NULL, $order = NULL) {
		$select = $this->select() 				   
				   ->where($where)
				   ->order($order);
	
		return $this->fetchAll($select)->toArray();
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
		$select = $this->select() 				   
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