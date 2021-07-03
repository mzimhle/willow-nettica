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
class class_account extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'account';
	protected $_primary = 'pk_account_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['account_added'])) {
            $data['account_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['account_updated'])) {
            $data['account_updated'] = date('Y-m-d H:i:s');
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
						->from(array('account' => 'account'), array('pk_account_id', 'account_username'))
					   ->where('account_active = 1 AND account_deleted = 0')
					   ->order('account_username ASC');

		return $this->_db->fetchPairs($select);
	}
	
	/**
	 * get account by account Account Id
 	 * @param string account id
     * @return object
	 */
	public function getByaccountId( $id )
	{
		$select = $this->select() 
					   ->where('pk_account_id = '.$id)
					   ->limit(1);
					   
		return $this->fetchRow($select)->toArray();

	}
	
	public function getAll($where, $order) {
	
			$select = $this->_db->select() 
					   ->from(array('account' => 'account'))
					   ->joinLeft('client', 'client.client_reference = account.fk_client_reference')	
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
					   ->from(array('account' => 'account'))
					   ->joinLeft('client', 'client.client_reference = account.fk_client_reference')	
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