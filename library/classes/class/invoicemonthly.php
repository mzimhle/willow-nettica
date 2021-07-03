<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_invoicemonthly extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'invoicemonthly';
	protected $_primary = 'pk_invoiceMonthly_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['invoiceMonthly_added'])) {
            $data['invoiceMonthly_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['invoiceMonthly_updated'])) {
            $data['invoiceMonthly_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * get invoice by invoice Account Id
 	 * @param string invoice id
     * @return object
	 */
	public function getByInvoiceReference($reference)
	{
		$select = $this->_db->select() 
					   ->from(array('invoicemonthly' => 'invoicemonthly'))
					   ->joinLeft('invoice', 'invoice.invoice_reference = invoicemonthly.fk_invoice_reference')	
					   ->joinLeft('client', 'client.client_reference = invoicemonthly.fk_client_reference')
					   ->where('invoicemonthly.fk_invoice_reference = ?', $reference)
					   ->where('invoice.invoice_deleted = 0');
					   
		return $this->_db->fetchRow($select);
	}
	
	/**
	 * get invoice by invoice Account Id
 	 * @param string invoice id
     * @return object
	 */
	public function getById($id)
	{
		$select = $this->_db->select() 
					   ->from(array('invoicemonthly' => 'invoicemonthly'))
					   ->joinLeft('invoice', 'invoice.invoice_reference = invoicemonthly.fk_invoice_reference')	
					   ->joinLeft('client', 'client.client_reference = invoicemonthly.fk_client_reference')
					   ->where('invoicemonthly.pk_invoiceMonthly_id = ?', $id)
					   ->where('invoice.invoice_deleted = 0');
					   
		return $this->_db->fetchRow($select);
	}
	
	/**
	 * get invoice by invoice Account Id
 	 * @param string invoice id
     * @return object
	 */
	public function getAll() {
	
		$select = $this->_db->select() 
					   ->from(array('invoicemonthly' => 'invoicemonthly'))
					   ->joinLeft('invoice', 'invoice.invoice_reference = invoicemonthly.fk_invoice_reference')	
					   ->joinLeft('client', 'client.client_reference = invoicemonthly.fk_client_reference')
					   ->where('invoice.invoice_deleted = 0');					   
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
					   ->from(array('invoicemonthly' => 'invoicemonthly'))
					   ->joinLeft('client', 'client.client_reference = invoicemonthly.fk_client_reference')		
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