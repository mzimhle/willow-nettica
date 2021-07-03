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
class class_subscriber extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'subscriber';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['subscriber_added'])) {
            $data['subscriber_added'] = date('Y-m-d H:i:s');
        }
        
        if (empty($data['subscriber_active'])) {
            $data['subscriber_active'] = 1;
        }

        if (empty($data['subscriber_deleted'])) {
            $data['subscriber_deleted'] = 0;
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
        if (empty($data['subscriber_updated'])) {
            $data['subscriber_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($id) {
		return $this->delete('subscriber_code = '.$id);		
	}
	
	/**
	 * get by jobSeeker reference
 	 * @param int jobSeeker reference
     * @return array
	 */
	public function checkEmail($email)
	{
		$select = $this->_db->select()
						->from(array('subscriber' => 'subscriber'))
					   ->where('subscriber_email = ?', $email)
					   ->where('subscriber_deleted = 0')
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
						->from(array('subscriber' => 'subscriber'))
					   ->where('subscriber_code = ?', $reference)
					   ->where('subscriber_deleted = 0')
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
		if($where == '') $where = 'subscriber_code != ""';
		
		$select = $this->_db->select()
						->from(array('subscriber' => 'subscriber'))
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