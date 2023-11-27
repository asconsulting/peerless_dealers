<?php
 
/**
 * Peerless Dealers
 *
 * Copyright (C) 2018-2023 Andrew Stevens Consulting
 *
 * @package    asconsulting/peerless_dealers
 * @link       https://andrewstevens.consulting
 */


/**
 * Register the classes
 */
 /*
ClassLoader::addClasses(array
(
	'Peerless\Backend\Dealers' 		=> 'system/modules/peerless_dealers/library/Peerless/Backend/Dealers.php',
	'Peerless\Model\Dealer' 		=> 'system/modules/peerless_dealers/library/Peerless/Model/Dealer.php',
    'Peerless\Module\DealerList' 	=> 'system/modules/peerless_dealers/library/Peerless/Module/DealerList.php',
	'Peerless\Module\DealerReader' 	=> 'system/modules/peerless_dealers/library/Peerless/Module/DealerReader.php',
));
*/

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_peerless_dealer_list' 		=> 'system/modules/peerless_dealers/templates/modules',
	'peerless_dealer' 				=> 'system/modules/peerless_dealers/templates/items',
	'peerless_dealer_list' 			=> 'system/modules/peerless_dealers/templates/items',
	'peerless_dealer_reader' 		=> 'system/modules/peerless_dealers/templates/items',
));
