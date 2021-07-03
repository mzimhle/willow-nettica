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
class class_calendar extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'calendar';
	protected $_primary = 'pk_calendar_id';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['calendar_added'])) {
            $data['calendar_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['calendar_active'])) {
            $data['calendar_active'] = 1;
        }

        if (empty($data['calendar_deleted'])) {
            $data['calendar_deleted'] = 0;
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
        if (empty($data['calendar_updated'])) {
            $data['calendar_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_calendar_id = '.$id);		
	}
	
	/**
	 * get calendar by calendar Account Id
 	 * @param string calendar id
     * @return object
	 */
	public function getById($id)
	{		   				
			$select = $this->_db->select()	
							->from(array('calendar' => 'calendar'))
							->where('pk_calendar_id = ?', $id)
							->where('calendar_deleted = 0')
							->limit(1);								
		return $this->_db->fetchRow($select);
	}
	
	public function getAll($where = NULL, $order = NULL)
	{
			if($where == '') $where = 'pk_calendar_id != ""';
			
			$select = $this->_db->select()	
							->from(array('calendar' => 'calendar'))
							->joinLeft('calendartype', 'calendar.fk_calendarType_id = calendartype.pk_calendarType_id')	
							->joinLeft('client', 'calendar.fk_client_reference = client.client_reference')	
							->joinLeft('invoice', 'calendar.fk_invoice_reference = invoice.invoice_reference')	
							->joinLeft('domain', 'calendar.fk_domain_id = domain.pk_domain_id')	
							->where($where)
							->order($order);
		return $this->_db->fetchAll($select);	    
	}	
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_calendar_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginated($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			if($where == '') $where = 'calendar_reference != ""';
			
			$select = $this->_db->select()	
							->from(array('calendar' => 'calendar'))
							->where($where)
							->order($order);
	    
		///$sql = $selectedcalendars->__toString();
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