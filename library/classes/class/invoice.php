<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_invoice extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'invoice';
	protected $_primary = 'pk_invoice_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['invoice_added'])) {
            $data['invoice_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['invoice_updated'])) {
            $data['invoice_updated'] = date('Y-m-d H:i:s');
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
	 * get invoice by invoice Account Id
 	 * @param string invoice id
     * @return object
	 */
	public function getByReference($reference)
	{
		$select = $this->_db->select() 
					   ->from(array('invoice' => 'invoice'))
					   ->joinLeft('client', 'client.client_reference = invoice.fk_client_reference')	
					   ->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')		
					   ->where('invoice.invoice_reference = ?', $reference)
					   ->limit(1);
					   
		return $this->_db->fetchRow($select);

	}
	
	public function getCurrentMonthInvoice($clientReference, $date) {
		$select = $this->_db->select() 
					   ->from(array('invoice' => 'invoice'))
					   ->where('fk_client_reference = ?', $clientReference)
					   ->where('DATE_FORMAT(invoice_added, "%Y-%m") = ?', $date)
					   ->limit(1);
					   
		return $this->_db->fetchRow($select);		
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 10; $i++) {
			$reference .= $codeAlphabet[rand(1,$count)];
		}

		$reference = substr($reference, 1, 9);
		
		/* First check if it exists or not. */
		$itemCheck = $this->getByReference($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
	
	public function getAll($where = NULL, $order = NULL)
	{
		$select = $this->_db->select() 
					   ->from(array('invoice' => 'invoice'))
					   ->joinLeft('client', 'client.client_reference = invoice.fk_client_reference')		
						->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')							   
					   ->where($where)
					   ->order($order);
		return $this->_db->fetchAll($select);		
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
					   ->from(array('invoice' => 'invoice'))
					   ->joinLeft('client', 'client.client_reference = invoice.fk_client_reference')		
						->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')							   
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