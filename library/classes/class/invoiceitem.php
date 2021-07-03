<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_invoiceitem extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'invoiceitem';
	protected $_primary = 'pk_invoiceitem_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['invoiceitem_added'])) {
            $data['invoiceitem_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['invoiceitem_updated'])) {
            $data['invoiceitem_updated'] = date('Y-m-d H:i:s');
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
					   ->from(array('invoiceitem' => 'invoiceitem'))
					   ->joinLeft('invoice', 'invoice.invoice_reference = invoiceitem.fk_invoice_reference')	
					   ->where('invoiceitem.fk_invoice_reference = ?', $reference)
					   ->where('invoice.invoice_active = 1 and invoice.invoice_deleted = 0');
					   
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
					   ->from(array('invoiceitem' => 'invoiceitem'))
					   ->joinLeft('client', 'client.client_reference = invoiceitem.fk_client_reference')		
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