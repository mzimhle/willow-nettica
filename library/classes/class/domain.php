<?php

// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_domain extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'domain';
	protected $_primary = 'pk_domain_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['domain_added'])) {
            $data['domain_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['domain_updated'])) {
            $data['domain_updated'] = date('Y-m-d H:i:s');
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
	 * find by id function
	 * example: $rowset = $table->getById('5, 4, 10, 12');
	 * @param string $id 
	 * OR 
	 * @param array $idList
     * @return object
	 */
	public function getByDomainId($id) {
	
		$select = $this->_db->select() 
				->from(array('domain' => 'domain'))			
				->where('domain_deleted = 0')									
				->where('pk_domain_id = ?', $id);
						
		return $this->_db->fetchRow($select);
	}
	
	public function getAll($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('domain' => 'domain'))
					   ->joinLeft('account', 'account.pk_account_id = domain.fk_account_id')	
					   ->joinLeft('client', 'client.client_reference = domain.fk_client_reference')						   
						->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')	
						->where('domain_deleted = 0')											
					   ->where($where)
					   ->order($order);	
					   
					   return $this->_db->fetchAll($select);
	}
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('domain' => 'domain'), array('pk_domain_id', 'domain_link'))
					   ->where('domain_active = 1 AND domain_deleted = 0')
					   ->order('domain_name ASC');

		return $this->_db->fetchPairs($select);
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
						->from(array('domain' => 'domain'))
						->joinLeft('account', 'account.pk_account_id = domain.fk_account_id')	
						->joinLeft('client', 'client.client_reference = domain.fk_client_reference')						   
						->joinLeft('areamap', 'areamap.fkAreaId = client.fk_area_id')		
						->where('domain_deleted = 0')						
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