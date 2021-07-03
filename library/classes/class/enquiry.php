<?php
/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard enquirys functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_enquiry extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'enquiry';
	protected $_primary = 'pk_enquiry_id';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['enquiry_added'])) {
            $data['enquiry_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['enquiry_active'])) {
            $data['enquiry_active'] = 1;
        }

        if (empty($data['enquiry_deleted'])) {
            $data['enquiry_deleted'] = 0;
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
        if (empty($data['enquiry_updated'])) {
            $data['enquiry_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_enquiry_id = '.$id);		
	}
	
	/**
	 * get enquiry by enquiry Account Id
 	 * @param string enquiry id
     * @return object
	 */
	public function getByEnquiryId($id)
	{		   				
			$select = $this->_db->select()	
							->from(array('enquiry' => 'enquiry'))
							->joinRight('areamap', 'areamap.fkAreaId = enquiry.fk_area_id')
							->where('pk_enquiry_id = ?', $id)
							->where('enquiry_deleted = 0')
							->limit(1);								
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<9;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}

		$reference = substr($reference, 1, 7);
		
		/* First check if it exists or not. */
		$itemCheck = $this->getByReference($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
	
	/**
	 * get by jobSeeker reference
 	 * @param int jobSeeker reference
     * @return array
	 */
	public function getByReference($reference)
	{
		$select = $this->_db->select()
						->from(array('enquiry' => 'enquiry'))
						->joinLeft('areamap', 'areamap.fkAreaId = enquiry.fk_area_id')	
					   ->where('enquiry_reference = ?', $reference)
					   ->where('enquiry_deleted = 0')
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	public function getAll($where = NULL, $order = NULL)
	{
			if($where == '') $where = 'enquiry_reference != ""';
			
			$select = $this->_db->select()
							->from(array('enquiry' => 'enquiry'))
							->joinLeft('areamap', 'areamap.fkAreaId = enquiry.fk_area_id')	
							->where($where)
							->order($order);
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_enquiry_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			if($where == '') $where = 'enquiry_reference != ""';
			
			$select = $this->_db->select()
							->from(array('enquiry' => 'enquiry'))
							->joinLeft('areamap', 'areamap.fkAreaId = enquiry.fk_area_id')	
							->where($where)
							->order($order);
	    
		///$sql = $selectedenquirys->__toString();
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