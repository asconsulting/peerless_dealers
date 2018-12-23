<?php

/**
 * Peerless Dealers
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    asconsulting/peerless_dealers
 * @link       https://andrewstevens.consulting
 */


/**
* Back end modules
*/
if (!array_key_exists('peerless', $GLOBALS['BE_MOD'])) {
	$GLOBALS['BE_MOD'] = array_merge(array('peerless' => array()), $GLOBALS['BE_MOD']);
}
$GLOBALS['BE_MOD']['peerless']['peerless_dealers'] = array(
	'tables' => array('tl_peerless_dealers'),
	'icon'   => 'system/modules/peerless_dealers/assets/icons/dealer.png'
);


/**
* Front end modules
*/
$GLOBALS['FE_MOD']['peerless']['peerless_dealer_list'] 		= 'Peerless\Module\DealerList';
$GLOBALS['FE_MOD']['peerless']['peerless_dealer_reader'] 	= 'Peerless\Module\DealerReader';


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getPageIdFromUrl'][] = array('Peerless\Frontend\Products', 'loadReaderPageFromUrl');


/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_peerless_products'] = 'Peerless\Model\Product';
