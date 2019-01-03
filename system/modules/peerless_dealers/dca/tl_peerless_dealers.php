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
 * Table tl_peerless_dealers
 */
$GLOBALS['TL_DCA']['tl_peerless_dealers'] = array
(
 
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'alias' => 'index'
            )
        )
    ),
 
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'fields'                  => array('name'),
            'flag'                    => 1,
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('name', 'address'),
            'format'                  => '%s (%s)'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('Peerless\Backend\Dealers', 'toggleIcon')
			),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
 
    // Palettes
    'palettes' => array
    (
        'default'                     => '{dealer_legend},name,alias,address,phone,phone_2,fax,email,url,description;{location_legend},latitude,longitude;{publish_legend},published;'
    ),
 
    // Fields
    'fields' => array
    (
	
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('unique'=>true, 'rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('Peerless\Backend\Dealers', 'generateAlias')
			),
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"

		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['name'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'address' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['address'],
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'clr long'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'phone' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['phone'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'phone_2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['phone_2'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['fax'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['email'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['url'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['description'],
			'inputType'               => 'textarea',
			'eval'                    => array('rows'=>4, 'cols'=>40, 'tl_class'=>'clr long'),
			'sql'                     => "mediumtext NULL"
		),
		'latitude' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['latitude'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'longitude' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['longitude'],
			'inputType'               => 'text',
			'default'				  => '',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_peerless_dealers']['published'],
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true,'tl_class'=>'clr m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		)		
    )
);
