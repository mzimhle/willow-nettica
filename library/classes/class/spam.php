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
class class_spam extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'spam';
	protected $_primary = 'pk_spam_id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['spam_added'])) {
            $data['spam_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['spam_updated'])) {
            $data['spam_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getById( $id )
	{
		$select = $this->_db->select() 
						->from(array('spam' => 'spam'))		
					   ->where('pk_spam_id = '.$id)
					   ->where('spam_deleted = 0')
					   ->limit(1);
					   
		return $this->_db->fetchRow($select);

	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByEmail($email)
	{
		$select = $this->_db->select() 
						->from(array('spam' => 'spam'))		
					   ->where('spam_email = ?', $email)
					   ->where('spam_deleted = 0')
					   ->limit(1);

		return $this->_db->fetchRow($select);

	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByName($name)
	{
		$select = $this->_db->select() 
						->from(array('spam' => 'spam'))		
					   ->where('LOWER(spam_name) = LOWER(?)', $name)
					   ->where('spam_deleted = 0')
					   ->limit(1);

		return $this->_db->fetchRow($select);
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByFax($fax)
	{
		$select = $this->_db->select() 
						->from(array('spam' => 'spam'))
					   ->where('spam_fax = ?', $fax)
					   ->where('spam_deleted = 0')
					   ->limit(1);

		return $this->_db->fetchRow($select);
	}
	
	public function getAll($where, $order) {
	
			$select = $this->_db->select() 
					   ->from(array('spam' => 'spam'))
					   ->joinLeft('spamtype', 'spamtype.pk_spamType_id = spam.fk_spamType_id')	
					   ->where($where)
					   ->order($order);
	
			return $this->_db->fetchAll($select);
	}
}
?>