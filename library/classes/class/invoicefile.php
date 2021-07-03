<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_invoicefile extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'invoicefile';
	protected $_primary = 'pk_invoiceFile_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['invoiceFile_added'])) {
            $data['invoiceFile_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['invoiceFile_updated'])) {
            $data['invoiceFile_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function delete($where)
    {
        return parent::delete($where);
    }
	
	/**
	 * get invoice by invoice Account Id
 	 * @param string invoice id
     * @return object
	 */
	public function getByInvoiceReference($reference)
	{
		$select = $this->_db->select() 
					   ->from(array('invoicefile' => 'invoicefile'))
					   ->joinLeft('invoice', 'invoice.invoice_reference = invoicefile.fk_invoice_reference')	
					   ->where('fk_invoice_reference = ?', $reference);
					   
		return $this->_db->fetchAll($select);

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
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getByReference($reference)
	{
		$select = $this->select() 
					   ->where('invoiceFile_filename = ?', $reference)
					   ->where('invoiceFile_deleted = 0 and invoiceFile_active = 1')
					   ->limit(1);
					   
		return $this->fetchRow($select);

	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<9;$i++){
			if($i == 5) {
				$reference .= '-';
			} else {
				$reference .= $codeAlphabet[rand(0,$count)];
			}
		}
		
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
					   ->from(array('invoicefile' => 'invoicefile'))
					   ->joinLeft('client', 'client.client_reference = invoicefile.fk_client_reference')		
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