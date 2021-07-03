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
class class_newsletter extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'newsletter';
	protected $_primary = 'pk_newsletter_id';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['newsletter_added'])) {
            $data['newsletter_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['newsletter_active'])) {
            $data['newsletter_active'] = 1;
        }

        if (empty($data['newsletter_deleted'])) {
            $data['newsletter_deleted'] = 0;
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
        if (empty($data['newsletter_updated'])) {
            $data['newsletter_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('pk_newsletter_id = '.$id);		
	}
	
	/**
	 * get newsletter by newsletter Account Id
 	 * @param string newsletter id
     * @return object
	 */
	public function getByEnquiryId($id)
	{		   				
			$select = $this->_db->select()	
							->from(array('newsletter' => 'newsletter'))
							->joinRight('areamap', 'areamap.fkAreaId = newsletter.fk_area_id')
							->where('pk_newsletter_id = ?', $id)
							->where('newsletter_deleted = 0')
							->limit(1);								
		return $this->_db->fetchRow($select);
	}
	
	/**
	 * get by jobSeeker reference
 	 * @param int jobSeeker reference
     * @return array
	 */
	public function getByLink($link)
	{
		$select = $this->_db->select()
						->from(array('newsletter' => 'newsletter'))
					   ->where('newsletter_link = ?', $link)
					   ->where('newsletter_deleted = 0 and newsletter_active = 1')
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	/**
	 * get by jobSeeker reference
 	 * @param int jobSeeker reference
     * @return array
	 */
	public function getByReference($reference)
	{
		$select = $this->_db->select()
						->from(array('newsletter' => 'newsletter'))
					   ->where('newsletter_reference = ?', $reference)
					   ->where('newsletter_deleted = 0')
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
		
		for($i=0;$i<10;$i++){
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

	public function getAll($where = NULL, $order = NULL)
	{
			if($where == '') $where = 'newsletter_reference != ""';
			
			$select = $this->_db->select()
							->from(array('newsletter' => 'newsletter'))
							->where($where)
							->order($order);
		return $this->_db->fetchAll($select);	    
	}	
	
	public function toLink($string) {

		$string = strtolower($string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace("é", "e", $string);
		$string = str_replace("è", "e", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "_", $string);
		$string = str_replace("\\", "_", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "_", $string);
		$string = str_replace(".", "_", $string);
		$string = str_replace("ë", "e", $string);	
		$string = str_replace('___' , '_' , $string);
		$string = str_replace('__' , '_' , $string);	
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace("é", "e", $string);
		$string = str_replace("è", "e", $string);
		$string = str_replace("`", "", $string);
		$string = str_replace("/", "_", $string);
		$string = str_replace("\\", "_", $string);
		$string = str_replace("'", "", $string);
		$string = str_replace("(", "", $string);
		$string = str_replace(")", "", $string);
		$string = str_replace("-", "_", $string);
		$string = str_replace(".", "_", $string);
		$string = str_replace("ë", "e", $string);	
		$string = str_replace("â€“", "ae", $string);	
		$string = str_replace("â", "a", $string);	
		$string = str_replace("€", "e", $string);	
		$string = str_replace("“", "", $string);	
		$string = str_replace("#", "", $string);	
		$string = str_replace("$", "", $string);	
		$string = str_replace("@", "", $string);	
		$string = str_replace("!", "", $string);	
		$string = str_replace("&", "", $string);	
		$string = str_replace(';' , '_' , $string);		
		$string = str_replace(':' , '_' , $string);		
		$string = str_replace('[' , '_' , $string);		
		$string = str_replace(']' , '_' , $string);		
		$string = str_replace('|' , '_' , $string);		
		$string = str_replace('\\' , '_' , $string);		
		$string = str_replace('%' , '_' , $string);	
		$string = str_replace(';' , '' , $string);		
		$string = str_replace(' ' , '_' , $string);
		$string = str_replace('__' , '_' , $string);
		$string = str_replace(' ' , '' , $string);	
		return $string;
				
	}
	
}
?>