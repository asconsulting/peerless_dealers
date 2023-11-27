<?php
 
/**
 * Peerless Dealers
 *
 * Copyright (C) 2018-2023 Andrew Stevens Consulting
 *
 * @package    asconsulting/peerless_dealers
 * @link       https://andrewstevens.consulting
 */
 
 
namespace Peerless\Model;

use Contao\Model as ContaoModel;


class Dealer extends ContaoModel 
{
	
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_peerless_dealers';

	
	/**
     * Find all published products
     *
     * @param array $arrOptions
     *
     * @return \Model\Collection
     */
    public static function findPublished(array $arrOptions = array())
    {
        return static::findPublishedBy(array(), array(), $arrOptions);
    }
	
	
    /**
     * Find published products
     *
     * @param mixed $arrColumns
     * @param mixed $arrValues
     * @param array $arrOptions
     *
     * @return \Model\Collection
     */
    public static function findPublishedBy($arrColumns, $arrValues, array $arrOptions = array())
    {
        $t = static::$strTable;

        $arrValues = (array) $arrValues;

        if (!is_array($arrColumns)) {
            $arrColumns = array(static::$strTable . '.' . $arrColumns . '=?');
        }

        // Add publish check to $arrColumns as the first item to enable SQL keys
        if (BE_USER_LOGGED_IN !== true) {
            array_unshift(
                $arrColumns,
                "$t.published='1'"
            );
        }
		
        return static::findBy($arrColumns, $arrValues, $arrOptions);
    }
}
