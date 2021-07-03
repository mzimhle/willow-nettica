<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard areas functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */
 
// ensure dependent class is available
require_once "Zend/Paginator.php";  

//custom enquiry item class as enquiry table abstraction
class class_areaMap extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'areamap';
	protected $_primary = 'pk_areaMap_Id';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
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
	 * Get area by areaId
	 * example: $collection->getByfkAreaId(2);
	 * @param string $order
     * @return object
	 */
	public function getByFullPath($path)
	{
		$select = $this->select()
					   ->where('areaMap_path = ?', $path);

		return $this->fetchAll($select)->toArray();

	}	
	/**
	 * Get area by areaId
	 * example: $collection->getByfkAreaId(2);
	 * @param string $order
     * @return object
	 */
	public function getByfkAreaId($areaId)
	{
		$select = $this->_db->select()
						->from(array('areamap' => 'areamap'))
						->from(array('p' => 'areamap'), array('p_fkAreaId' => 'fkAreaId', 'p_areaMap_name' => 'areaMap_name', 'p_fkAreaParentId' => 'fkAreaParentId'))						
						->where('areamap.fkAreaId = ?', $areaId)
						->where('p.fkAreaId = areamap.fkAreaParentId');

		return $this->_db->fetchRow($select);

	}
		/**
	 * Get area by mapped areas.
	 * example: $collection->getMappedAreas(2);
	 * @param string $order
     * @return object
	 */
	public function getMappedSubProvinceAreas($parentAreaId)
	{
	
			//fetch all areas from AreaMap
		return $this->_db->fetchAll("SELECT * FROM areamap WHERE areaMap_sPath LIKE '%|".$parentAreaId."|%' AND polygon_filename != '' AND areaMap_active = 1 AND areaMap_deleted = 0 AND fkAreaTypeId != 2");
		
		/*
		$select = $this->select()
		               ->where("fkAreaParentId in (?)",$subAreas)
		               ->order(array("areaMap_name"));		   

        return $this->fetchAll($subAreas);
		*/
	}
	
	/**
	 * get all areas ordered by column name
	 * example: $collection->getAllareas('areaMap_title');
	 * @param string $order
     * @return object
	 */
	public function getAllareas($where = "areaMap_name !=''")
	{
		$select = $this->select()
					   ->where($where);

		return $this->fetchAll($select)->toArray();

	}

	
	/**
	 * get all areas ordered by column name
	 * example: $collection->getAllareas('areaMap_title');
	 * @param string $order
     * @return object
	 */
	public function searchAreas($search = "")
	{
		$select = $this->select()
					   ->where("areaMap_shortPath like '%$search%'", $search)
						->order('areaMap_shortPath')
						->limit(50);
		return $this->fetchAll($select)->toArray();

	}	
		/**
	 * get all areas ordered by column name
	 * example: $collection->listAreas('areaMap_title');
	 * @param string $order
     * @return object
	 */
	public function listAreas($where = "areaMap_name !=''")
	{
		$select = $this->_db->select()
						->from(array('areamap' => 'areamap'), array('fkAreaId', 'areaMap_name'))
					   ->where($where);
		return $this->_db->fetchAll($select);

	}
	 public function areaMapPairs($where = 'areaMap_name != ""') {
		$select = $this->select()
					   ->from(array('a' => 'areamap'), array('a.fkAreaId', 'a.areaMap_name'))
					   ->where($where)
					   ->order('areaMap_name DESC');

		return $this->_db->fetchPairs($select);
	}	 		
	
	 public function areaMapPairsByType($areaType = 4) {
	 
		$select = $this->select()
					   ->from(array('a' => 'areamap'), array('a.fkAreaId', 'a.areaMap_name'))
					   ->where('fkAreaTypeId = ?', $areaType)
					   ->where('areaMap_active = 1 AND areaMap_deleted = 0')
					   ->order('areaMap_name DESC');

		return $this->_db->fetchPairs($select);
	}		
    /**
     * get all areas within a specific area ( NB not limited to 1 level direct children, use getDirectSubAreas for this)
     * example: $obj->getSubAreas();
     * @param integer $parentAreaId
     * @return array of area objects
     */
    public function getSubAreas($parentAreaId = -1){
        
		//check $parentAreaId is numeric
        if (!is_numeric($parentAreaId) || ($parentAreaId == -1) ){
				echo 'Only numeric parameters.';
				exit;
        }
		
		//fetch all areas from AreaMap
		$subAreas = $this->_db->fetchCol("SELECT fkAreaId FROM areamap WHERE areaMap_sPath LIKE '%|".$parentAreaId."|%'");
		
		$select = $this->select()
		               ->where("fkAreaParentId in (?)",$subAreas)
		               ->order(array("areaMap_name"));		   

        return $this->fetchAll($select);
		
    }
	/**
	 * Get job count by area
	 * example: $table->jobCoutByArea();
	 * @param string city
	 * @return array
	 */
	 
	public function getAllProvinceAreaPairs() {
		
		$select = $this->_db->select()
						->from(array('areamap' => 'areamap'), array('fkAreaId'))
						->joinLeft('job', 'areamap.fkAreaId = job.fk_areaMap_id', 'CONCAT(CONCAT(areamap.areaMap_name, CONCAT(" (", COUNT(pk_job_id))), ")") AS areaMap_count')						
						->where('job.job_active = 1 AND job.job_deleted = 0')
						->group('fkAreaId')
						->order('areamap.areaMap_name ASC');						
		return $this->_db->fetchPairs($select);
	}	
	
	
	/**
	 * Get areas by type.
	 * example: $table->getByType(5);
	 * @param integer
	 * @return array
	 */
	 
	public function getByType($areaTypeId) {
		
		$select = $this->_db->select()
						->from(array('areamap' => 'areamap'), array('fkAreaId', 'areaMap_name'))
						->joinLeft('areaType', 'areamap.fkAreaTypeId = areaType.areaTypeId', 'areaTypeName')						
						->where('areaTypeId = ?', $areaTypeId)
						->where('areamap.areaMap_active = 1 AND areamap.areaMap_deleted = 0')
						->order('areamap.areaMap_name ASC');						
		return $this->_db->fetchAll($select);
	}	

		public function getAllByType($areaTypeArray) {
		
		$select = $this->_db->select()
						->from(array('areamap' => 'areamap'), array('areaMap_path', 'fkAreaId', 'areaMap_name'))
						->joinLeft('areaType', 'areamap.fkAreaTypeId = areaType.areaTypeId', 'areaTypeName')						
						->where('areaTypeId IN (?)', $areaTypeArray)
						->where('areamap.areaMap_active = 1 AND areamap.areaMap_deleted = 0')
						->order('areamap.areaMap_name ASC');	
						
		return $this->_db->fetchAll($select);
	}	
	/**
     * get a specific area
     * example: $obj->getArea();
     * @param int $areaId
     * @return an area object
     */
    public function getArea($areaId = -1) {
		
       //check $areaId is numeric
        if (!is_numeric($areaId) || ($areaId == -1) ){
				echo 'Only numeric parameters.';
				exit;
        }
		
        $select = $this->select()
                       ->where("fkAreaId = ?",$areaId);

        return $this->fetchRow($select);
    }
	
   	/**
     * get path to root area vain.
     * example: $obj->getPathToRoot();
     * @param string $areaId
     * @return array of areas
     */
     public function getPathToRoot($areaId = -1){
		
       //check $areaId is numeric
        if (!is_numeric($areaId) || ($areaId == -1) ){
				echo 'Only numeric parameters.';
				exit;
        }		
		
		//fetch the path from AreaMap
		$map = $this->_db->fetchOne("Select areaMap_sPath from areamap where fkAreaId = ?",$areaId);
	
		//check we have data to split & remove empty top and tail nulls
		if (strlen($map) > 0) {
		    $nodes = array_filter(explode("|",$map));
		}
		 
		//return and array of area objects  
		$areaPathArray = array();
		
		if (isset($nodes) && !is_null($nodes) && is_array($nodes) && count($nodes) > 0) { // prevent "undefined variable" PHP Notice
			foreach ($nodes as $node){
				$nodeData = $this->getArea((int)$node);
				$areaPathArray[] = $nodeData;  // only one element is returned
			}
		}
		//return array of areas 
		return $areaPathArray;

	}	
	
	public function fetchAreaName($areaId) {
		return $this->_db->fetchOne("Select areaMap_name from areamap where fkAreaId = ?",$areaId);
		
	}
	
	public function fetchByLink($areaLink) {
		return $this->_db->fetchRow("Select fkAreaId, areaMap_shortPath from areamap where TRIM(REPLACE(REPLACE(LOWER(areaMap_shortPath), ', ', '_'), ' ', '_')) = ?", $areaLink);
		
	}
	
	public function fetchByShortPath($pathName) {
        $select = $this->select()
                       ->where("REPLACE(LOWER(areaMap_shortPath), ' ', '') = ?",$pathName);
					   
        $output =  $this->fetchAll($select)->toArray();				
		if(count($output) > 0) return $output[0];
		return NULL;
		
	}
	
	public function fetchByShortPath_removeCharacters($pathName) {
        $select = $this->select()
                       ->where("REPLACE(REPLACE(REPLACE(LOWER(areaMap_shortPath), ' ', ''), ',', ''), '-', '') = ?",$pathName);
					   
        $output =  $this->fetchAll($select)->toArray();				
		if(count($output) > 0) return $output[0];
		return NULL;
		
	}	
	public function getShortPath($rowArray) {
	
		/* Provinces array. */
		$provinces = array(2, 11, 12, 13, 14, 15, 16, 17, 18);	
		/* Separate the IDS. */
		$mapIds = explode("|", $rowArray['areaMap_sPath']);
			
		/* Get province first. */
		for($z = 0; $z < count($mapIds); $z++) {
			/* Output the province. */
			if(in_array($mapIds[$z], $provinces)) {		
				$provinceName = $this->fetchAreaName($mapIds[$z]);
				if(trim(strtolower($rowArray['areaMap_name'])) == trim(strtolower($provinceName)))				
					return $rowArray['areaMap_name'].', '.$this->fetchAreaName($rowArray['fkAreaParentId']);			
				else {
					return $rowArray['areaMap_name'].', '.$provinceName;
				}
			}
		}		
	}
	
	function getPath($areaId,$currentAreaName) {
		
		$maxDepth = 3;
		
		//check if the $areaId is valid
		if ( !isset($areaId) || !is_numeric($areaId)) return '-';
		
		// get data
		$areaObj = $this->getPathToRoot($areaId);

		//convert to standard array
		$areas = array();
		if ( is_array($areaObj)) {
			foreach ($areaObj as $area) {
				
				//exclude duplicate first area
				if ($area->areaMap_name != $currentAreaName) $areas[] = $area->areaMap_name;
			}
		}
		
		//check for reverse
		$areas = array_reverse($areas);
		
		$pathString = '';
		$totalAreas = count($areas);
		for ($currentArea = 0; $currentArea < $totalAreas; $currentArea++) {
			if ($currentArea > $maxDepth-1) break;

			//check how deep and skip one level if too deep
			//if ( ($totalAreas > 2)) { 
			//	if ($currentArea > 1) $pathString .= ', ';
			//	if ($currentArea > 0) $pathString .= $areas[$currentArea];
			//}else{
				if ($currentArea > 0) $pathString .= ', ';
				$pathString .= $areas[$currentArea];
			//}
		}
			
		return $currentAreaName.', '.$pathString;
	}
	
	/**
	 * get careers ordered by column name as pagination object
	 * example: $careersData = $careers->getPaginatedNews('career_areaMap_active = 1 AND career_deleted = 0','career.career_closing_date DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

	 * @param string $order
	 * @param int    $page
	 * @param int    $perPpage
	 * @param int    $listedPages
	 * @param string $scrollingStyle
     * @return Zend pagination object
	 */
	public function getPaginatedarea($where = NULL, $order = NULL, $page = 1, $perPage = 10, $listedPages = 10, $scrollingStyle = 'Sliding')
	{
			$select = $this->select()
					       ->order($order)
					       ->where($where);
					   
		///$sql = $selectedareas->__toString();
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