<?php
/**
 * Generis Object Oriented API - common\constants.php
 *
 * This file is part of Generis Object Oriented API.
 *
 * @author CRP Henri Tudor - TAO Team - {@link http://www.tao.lu}
 * @package common
 * @license GPLv2  http://www.opensource.org/licenses/gpl-2.0.php
 */

#RDF
define('RDF_TYPE',								'http://www.w3.org/1999/02/22-rdf-syntax-ns#type',true);	
define('RDF_CLASS',								'http://www.w3.org/2000/01/rdf-schema#Class',true);
define('RDF_PROPERTY',							'http://www.w3.org/1999/02/22-rdf-syntax-ns#Property',true);
define('RDF_SUBCLASSOF',						'http://www.w3.org/2000/01/rdf-schema#subClassOf',true);		
define('RDF_DOMAIN',							'http://www.w3.org/2000/01/rdf-schema#domain',true);
define('RDF_VALUE',								'http://www.w3.org/1999/02/22-rdf-syntax-ns#value',true);
define('RDFS_RANGE',							'http://www.w3.org/2000/01/rdf-schema#range',true);
define('RDF_RESOURCE',							'http://www.w3.org/2000/01/rdf-schema#Resource',true);	

define('RDF_FIRST',								'http://www.w3.org/1999/02/22-rdf-syntax-ns#first', true);
define('RDF_REST',								'http://www.w3.org/1999/02/22-rdf-syntax-ns#rest', true);
define('RDF_LIST',								'http://www.w3.org/1999/02/22-rdf-syntax-ns#List', true);
define('RDF_NIL',								'http://www.w3.org/1999/02/22-rdf-syntax-ns#nil', true);

#RDFS
define('RDFS_COMMENT',							'http://www.w3.org/2000/01/rdf-schema#comment',true);
define('RDFS_LABEL',							'http://www.w3.org/2000/01/rdf-schema#label', true);
define('RDFS_LITERAL',							'http://www.w3.org/2000/01/rdf-schema#Literal', true);
define('RDFS_SEEALSO', 							'http://www.w3.org/2000/01/rdf-schema#seeAlso', true);
define('RDFS_DATATYPE', 						'http://www.w3.org/2000/01/rdf-schema#Datatype', true);
define('RDFS_STATEMENT', 						'http://www.w3.org/1999/02/22-rdf-syntax-ns#Statement', true);

#generis
define('GENERIS_NS',							'http://www.tao.lu/Ontologies/generis.rdf', true ) ;
define('GENERIS_BOOLEAN',				 		GENERIS_NS . '#Boolean', true);
define('GENERIS_TRUE',							GENERIS_NS . '#True' , true);
define('GENERIS_FALSE',							GENERIS_NS . '#False' , true);
define('PROPERTY_IS_LG_DEPENDENT',				GENERIS_NS . '#is_language_dependent' , true);
define('CLASS_GENERIS_USER' , 					GENERIS_NS . '#User' , true) ;
define('CLASS_GENERIS_RESOURCE' , 				GENERIS_NS . '#generis_Ressource' , true) ;
define('CLASS_GENERIS_FILE' , 				    GENERIS_NS . '#File' , true) ;
define('PROPERTY_FILE_FILENAME' , 				GENERIS_NS . '#FileName' , true) ;
define('PROPERTY_FILE_FILEPATH' , 				GENERIS_NS . '#FilePath' , true) ;
define('PROPERTY_MULTIPLE',						GENERIS_NS . '#Multiple' , true) ;

#user
define('CLASS_ROLE', 							'http://www.tao.lu/middleware/wfEngine.rdf#ClassRole',true);
define('PROPERTY_USER_LOGIN' , 					GENERIS_NS . '#login' , true) ;
define('PROPERTY_USER_PASSWORD' , 				GENERIS_NS . '#password' , true) ;
define('PROPERTY_USER_UILG' , 					GENERIS_NS . '#userUILg' , true) ;
define('PROPERTY_USER_DEFLG' , 					GENERIS_NS . '#userDefLg' , true) ;
define('PROPERTY_USER_MAIL' , 					GENERIS_NS . '#userMail' , true) ;
define('PROPERTY_USER_FIRTNAME' , 				GENERIS_NS . '#userFirstName' , true) ;
define('PROPERTY_USER_LASTNAME' , 				GENERIS_NS . '#userLastName' , true) ;

define('CLASS_ROLE_TAOMANAGER',					'http://www.tao.lu/Ontologies/TAO.rdf#TaoManagerRole', true) ;
define('CLASS_ROLE_BACKOFFICE',					'http://www.tao.lu/Ontologies/TAO.rdf#BackOffice', true) ;
define('CLASS_ROLE_FRONTOFFICE',				'http://www.tao.lu/Ontologies/TAO.rdf#FrontOffice', true) ;

define('CLASS_SUBCRIPTION', 					GENERIS_NS . '#Subscription' , true) ;
define('PROPERTY_SUBCRIPTION_URL', 				GENERIS_NS . '#SubscriptionUrl' , true) ;
define('PROPERTY_SUBCRIPTION_MASK', 			GENERIS_NS . '#SubscriptionMask' , true) ;

define('CLASS_MASK', 					        GENERIS_NS . '#Mask' , true) ;
define('PROPERTY_MASK_SUBJECT', 				GENERIS_NS . '#MaskSubject' , true) ;
define('PROPERTY_MASK_PREDICATE', 				GENERIS_NS . '#MaskPredicate' , true) ;
define('PROPERTY_MASK_OBJECT', 				    GENERIS_NS . '#MaskObject' , true) ;


#widget
define('CLASS_WIDGET',							'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#WidgetClass',true);
define('PROPERTY_WIDGET',						'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#widget',true);
define('WIDGET_RADIO',							'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#RadioBox',true);
define('WIDGET_COMBO',							'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#ComboBox',true);
define('WIDGET_CHECK',							'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#CheckBox',true);
define('WIDGET_FTE',							'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#TextBox',true);
define('WIDGET_TIMER',							'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#Timer',true);
define('WIDGET_TREEVIEW',						'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#TreeView',true);
define('WIDGET_CONSTRAINT_TYPE',				'http://www.tao.lu/datatypes/WidgetDefinitions.rdf#rangeConstraintTypes',true);

#Rules
define('RULES_NS', 								'http://www.tao.lu/middleware/Rules.rdf',true);

define('PROPERTY_OPERATION_FIRST_OP',			RULES_NS.'#FirstOperand',true);
define('PROPERTY_OPERATION_SECND_OP',			RULES_NS.'#SecondOperand',true);
define('PROPERTY_OPERATION_OPERATOR',			RULES_NS.'#HasOperator',true);
define('PROPERTY_RULE_IF' , 					RULES_NS.'#If', true);

define('CLASS_TERM_X_PREDICATE_OBJECT',			RULES_NS.'#XPredicateObject',true);
define('PROPERTY_TERM_XPO_OBJECT',				RULES_NS.'#Object', true);
define('PROPERTY_TERM_XPO_PREDICATE',			RULES_NS.'#Predicate',true);

define('INSTANCE_OPERATOR_ADD',					RULES_NS.'#Plus',true);
define('INSTANCE_OPERATOR_MINUS',				RULES_NS.'#Minus', true);
define('INSTANCE_OPERATOR_DIVISION',			RULES_NS.'#Division',true);
define('INSTANCE_OPERATOR_MULTIPLY',			RULES_NS.'#Multiply',true);
define('INSTANCE_OPERATOR_CONCAT',				RULES_NS.'#Concat', true);
define('INSTANCE_OPERATOR_UNION',				RULES_NS.'#Union',true);
define('INSTANCE_OPERATOR_INTERSECT',			RULES_NS.'#Intersect',true);

define('CLASS_CONSTRUCTED_SET',					RULES_NS.'#ConstrcuctedSet',true);
define('PROPERTY_SET_OPERATOR',					RULES_NS.'#HasSetOperator',true);
define('PROPERTY_SUBSET',						RULES_NS.'#SubSets',true);

define('PROPERTY_ASSIGNMENT_VARIABLE', 			RULES_NS.'#Variable',true);
define('PROPERTY_ASSIGNMENT_VALUE', 			RULES_NS.'#Value',true);
define('CLASS_ASSIGNMENT',						RULES_NS.'#Assignment',true);

define('CLASS_EXPRESSION',						RULES_NS.'#Expression',true);	
define('PROPERTY_FIRST_EXPRESSION',				RULES_NS.'#FirstExpression',true);
define('PROPERTY_SECOND_EXPRESSION',			RULES_NS.'#SecondExpression',true);
define('PROPERTY_HASLOGICALOPERATOR',			RULES_NS.'#HasLogicalOperator',true);
define('INSTANCE_OR_OPERATOR' , 				RULES_NS.'#Or', true);
define('INSTANCE_AND_OPERATOR' , 				RULES_NS.'#And', true);

define('INSTANCE_EXPRESSION_TRUE' , 			RULES_NS.'#i12339287061376', true);
define('INSTANCE_EXPRESSION_FALSE' , 			RULES_NS.'#i12339287061376', true);

define('PROPERTY_TERMINAL_EXPRESSION' , 		RULES_NS.'#TerminalExpression', true);
define('CLASS_DYNAMICTEXT',						RULES_NS.'#DynamicText',true);
define('CLASS_RULE',							RULES_NS.'#Rule',true);
define('CLASS_TERM',							RULES_NS.'#Term',true);
define('CLASS_TERM_CONST',						RULES_NS.'#Const',true);
define('CLASS_OPERATION',						RULES_NS.'#Operation',true);
define('CLASS_TERM_SUJET_PREDICATE_X',			RULES_NS.'#SubjectPredicateX',true);
define('PROPERTY_TERM_SPX_SUBJET',				RULES_NS.'#Subject',true);
define('PROPERTY_TERM_SPX_PREDICATE',			RULES_NS.'#Predicate',true);
define('PROPERTY_TERM_VALUE',					RULES_NS.'#TermValue',true);
define('INSTANCE_EXISTS_OPERATOR_URI' , 		RULES_NS.'#Exists', true);
define('INSTANCE_EQUALS_OPERATOR_URI' , 		RULES_NS.'#Equal', true);
define('INSTANCE_DIFFERENT_OPERATOR_URI' , 		RULES_NS.'#NotEqual', true);
define('INSTANCE_SUP_EQ_OPERATOR_URI' , 		RULES_NS.'#GreaterThanOrEqual', true);
define('INSTANCE_INF_EQ_OPERATOR_URI' , 		RULES_NS.'#LessThanOrEqual', true);
define('INSTANCE_SUP_OPERATOR_URI' , 			RULES_NS.'#GreaterThan', true);
define('INSTANCE_INF_OPERATOR_URI' , 			RULES_NS.'#LessThan', true);
define('INSTANCE_EMPTY_TERM_URI' , 				RULES_NS.'#Empty', true);
define('INSTANCE_TERM_IS_NULL' ,	 			RULES_NS.'#IsNull', true);

define('PERSISTENCE_SMOOTH' ,					"smoothsql");
define('PERSISTENCE_HARD' ,						"hardsql");
define('PERSISTENCE_VIRTUOZO' ,					"virtuozo");
define('PERSISTENCE_SUBSCRIPTION' ,				"subscription");

?>