<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_clientproduct extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'clientproduct';
	protected $_primary = 'pk_clientproduct_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['clientproduct_added'])) {
            $data['clientproduct_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['clientproduct_updated'])) {
            $data['clientproduct_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * get product by product Account Id
 	 * @param string product id
     * @return object
	 */
	public function getOnceOff()
	{
		$select = $this->_db->select() 
					   ->from(array('clientproduct' => 'clientproduct'))
					   ->joinLeft('product', 'product.product_reference = clientproduct.fk_product_reference')	
					   ->where("product_payment_type = 'onceoff'")
					   ->where('product_deleted = 0 and product_active = 1')
					   ->where('clientproduct_deleted = 0 and clientproduct_active = 1');			   
					   
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * get product by product Account Id
 	 * @param string product id
     * @return object
	 */
	public function getMonthly($clientreference)
	{
		$select = $this->_db->select() 
					   ->from(array('clientproduct' => 'clientproduct'))
					   ->joinLeft('product', 'product.product_reference = clientproduct.fk_product_reference')	
					   ->where("product_payment_type = 'month'")
					   ->where('product_deleted = 0 and product_active = 1')
					   ->where('clientproduct_deleted = 0 and clientproduct_active = 1')
					   ->where('fk_client_reference = ?', $clientreference);			   
					   
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function getByClientReference($reference) {
		$select = $this->_db->select()
						->from(array('clientproduct' => 'clientproduct'))
						->joinLeft('client', 'client.client_reference = clientproduct.fk_client_reference')						   				  				   				  
						->joinLeft('product', 'product.product_reference = clientproduct.fk_product_reference')							
						->where('fk_client_reference = ?', $reference)
						->where('product_deleted = 0')
						->order('product_name ASC');

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
							->from(array('clientproduct' => 'clientproduct'))
							->joinLeft('client', 'client.client_reference = clientproduct.fk_client_reference')						   				  				   				  
							->joinLeft('product', 'product.product_reference = clientproduct.fk_product_reference')	
						   ->where("clientproduct_deleted = 0")
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