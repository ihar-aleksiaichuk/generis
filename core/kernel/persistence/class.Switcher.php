<?php

error_reporting(E_ALL);

/**
 * Generis Object Oriented API - core/kernel/persistence/class.Switcher.php
 *
 * $Id$
 *
 * This file is part of Generis Object Oriented API.
 *
 * Automatically generated on 20.04.2011, 13:05:54 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 * @package core
 * @subpackage kernel_persistence
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/* user defined includes */
// section 127-0-1-1--5a63b0fb:12f72879be9:-8000:0000000000001588-includes begin
// section 127-0-1-1--5a63b0fb:12f72879be9:-8000:0000000000001588-includes end

/* user defined constants */
// section 127-0-1-1--5a63b0fb:12f72879be9:-8000:0000000000001588-constants begin
// section 127-0-1-1--5a63b0fb:12f72879be9:-8000:0000000000001588-constants end

/**
 * Short description of class core_kernel_persistence_Switcher
 *
 * @access public
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 * @package core
 * @subpackage kernel_persistence
 */
class core_kernel_persistence_Switcher
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---
    
	/**
	 * The list of classes that should never been compiled
	 * @var array
	 */
	private static $blackList = array();
	

    // --- OPERATIONS ---
    
	public function __construct($blackList = array()){
		//force the API to get it's data in the triple store
		core_kernel_persistence_PersistenceProxy::forceMode(PERSISTENCE_SMOOTH);
		
		if(count(self::$blackList) == 0 || count($blackList) > 0){
			self::$blackList = array_merge(
				array(
					CLASS_GENERIS_USER,
					CLASS_ROLE_TAOMANAGER,
					CLASS_ROLE_BACKOFFICE,
					CLASS_ROLE_FRONTOFFICE,
					RDF_CLASS
				),
				$blackList
			);
		}
	}
	
	public function __destruct(){
		core_kernel_persistence_PersistenceProxy::resetMode();
		core_kernel_persistence_ClassProxy::$ressourcesDelegatedTo = array();
		core_kernel_persistence_ResourceProxy::$ressourcesDelegatedTo = array();
		core_kernel_persistence_PropertyProxy::$ressourcesDelegatedTo = array();
	}

    /**
     * Short description of method hardifier
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  Class class
     * @param  array options
     * @return boolean
     */
    public function hardify( core_kernel_classes_Class $class, $options = array())
    {
        $returnValue = (bool) false;
        
        // section 127-0-1-1--5a63b0fb:12f72879be9:-8000:0000000000001589 begin
        
        if(in_array($class->uriResource, self::$blackList)){
        	return $returnValue;
        }
        
        //recursive will hardify the class and it's subclasses in the same table!
		(isset($options['recursive'])) ? $recursive = $options['recursive'] : $recursive = false;
        
		//createForeigns will hardify the class that are range of the properties
		(isset($options['createForeigns'])) ? $createForeigns = $options['createForeigns'] : $createForeigns = false;
		
		//check if we append the data in case the hard table exists or truncate the table and add the new rows
		(isset($options['append'])) ? $append = $options['append'] : $append = false;
		
		//If the option is true, we check if the table has alreayd been created, if yes, it's finished. If no, we can continue.
		(isset($options['allOrNothing'])) ? $allOrNothing = $options['allOrNothing'] : $allOrNothing = false;
		
		//if true, the instances of the class will  be removed!
		(isset($options['rmSources'])) ? $rmSources = (bool) $options['rmSources'] : $rmSources = false;
		
		//if defined, we took all the properties of the class and it's parents till the topclass
		(isset($options['topClass'])) ? $topClass = $options['topClass'] : $topClass = new core_kernel_classes_Class(CLASS_GENERIS_RESOURCE);
		
		//if defined, compile the additional properties
		(isset($options['additionalProperties'])) ? $additionalProperties = $options['additionalProperties'] : $additionalProperties = array();
		
		//if defined, reference the additional class to the table
		(isset($options['referencesAllTypes'])) ? $referencesAllTypes = $options['referencesAllTypes'] : $referencesAllTypes = false;
		
		$tableName = '_'.core_kernel_persistence_hardapi_Utils::getShortName($class);
		$myTableMgr = new core_kernel_persistence_hardapi_TableManager($tableName);
		
		if($allOrNothing && $myTableMgr->exists()){
			return $returnValue;
		}
		
		if($recursive){
			foreach($class->getSubClasses(true) as $subClass){
				$this->hardify($subClass, array_merge($options, array(
					'recursive' 	=> false,
					'append' 		=> true,
					'allOrNothing'	=> true
				)));
			}
		}
			
		$referencer = core_kernel_persistence_hardapi_ResourceReferencer::singleton();
		
		//get the table columns from the class properties
		$columns = array();
		$ps = new core_kernel_persistence_switcher_PropertySwitcher($class, $topClass);
		$properties = $ps->getProperties($additionalProperties);
		$columns = $ps->getTableColumns($additionalProperties);
		
		foreach($columns as $i => $column){

			//create the foreign tables recursively
			if(isset($column['foreign']) && !empty($column['foreign'])){
				if($createForeigns){
					$foreignClassUri = core_kernel_persistence_hardapi_Utils::getLongName($column['foreign']);
					$foreignTableMgr = new core_kernel_persistence_hardapi_TableManager($column['foreign']);
					if(!$foreignTableMgr->exists() && $foreignClassUri != $class->uriResource){
						$range = new core_kernel_classes_Class($foreignClassUri);
						$this->hardify($range, array_merge($options, array(
							'topClass'		=> new core_kernel_classes_Class(CLASS_GENERIS_RESOURCE),
							'recursive' 	=> false,
							'append' 		=> true,
							'allOrNothing'	=> true
						)));
					}
				}
				else{
					unset($columns[$i]['foreign']);
				}
			}
		}
			
		if(!$append || ($append && !$myTableMgr->exists())){
			
			//create the table
			if($myTableMgr->exists()){
				$myTableMgr->remove();
			}
			$myTableMgr->create($columns);
			
			//reference the class
			$referencer->referenceClass($class);

			if($referencesAllTypes){
				$referencer->referenceInstanceTypes($class);
			}
		}
		
		//insert the resources
		$startIndex = 0;
		$instancePackSize = 100;
		$instances = $class->getInstances(false, array('offset'=>$startIndex, 'limit'=> $instancePackSize));
		do{
			$rows = array();
			
			foreach($instances as $index =>  $resource){
				if($referencer->isResourceReferenced($resource)){
					unset($instances[$index]);
					continue;
				}
				$row = array('uri' => $resource->uriResource);
				foreach($properties as $property){
					$propValue = $resource->getOnePropertyValue($property);
					$row[core_kernel_persistence_hardapi_Utils::getShortName($property)] = $propValue;
				}
				
				$rows[] = $row;
			}
			
			$rowMgr = new core_kernel_persistence_hardapi_RowManager($tableName, $columns);
			$rowMgr->insertRows($rows);
		
			foreach($instances as $resource){
				$referencer->referenceResource($resource, $tableName, null, true);
				
				if($rmSources){
					//remove exported resources in smooth sql, if required:
					$resource->delete();
				}
			}
			
			if(!$rmSources){
				//increment start index only if not removed
				$startIndex += $instancePackSize;
			}
			
			$instances = $class->getInstances(false, array('offset'=>$startIndex, 'limit'=> $instancePackSize));
		} while(count($instances) > 0);
		
		//reset cache:
		$referencer->resetCache();
		
        // section 127-0-1-1--5a63b0fb:12f72879be9:-8000:0000000000001589 end

        return (bool) $returnValue;
    }
    
} /* end of class core_kernel_persistence_Switcher */

?>