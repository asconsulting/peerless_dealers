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
 * Palettes
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['peerless_dealers_list'] 		= '{title_legend},name,headline,type;{redirect_legend},jumpTo;{template_legend:hide},customTpl,customDealerTpl;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['peerless_dealers_reader']		= '{title_legend},name,headline,type;{template_legend:hide},customDealerTpl;{expert_legend:hide},guests,cssID,space';


/**
 * Fields
 */
 
$GLOBALS['TL_DCA']['tl_module']['fields']['customDealerTpl'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['customDealerTpl'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('Peerless\Backend\Dealers', 'getDealerTemplates'),
	'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
