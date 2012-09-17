<?php
	require_once dirname(__FILE__) ."/includes/common.php";

	// internationalisation
	l10n::init();
	l10n::set(dirname(__FILE__).'/locales/'.$GLOBALS['lang'].'/messages');

	try {
		$re		= new HttpRequest();
		$fc		= new DefaultFC($re);
		$fc->loadModule();
	} catch (Exception $e) {
		$message	= $e->getMessage();
		require_once DIR_VIEWS . "templates/error404.tpl";
	}

?>