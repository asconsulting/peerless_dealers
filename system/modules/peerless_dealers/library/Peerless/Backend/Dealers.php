<?php
 
/**
 * Peerless Dealers
 *
 * Copyright (C) 2018-2023 Andrew Stevens Consulting
 *
 * @package    asconsulting/peerless_dealers
 * @link       https://andrewstevens.consulting
 */
 

namespace Peerless\Backend;

use Contao\Backend as ContaoBackend;
use Contao\StringUtil;
use Contao\CoreBundle\Exception;

use MapUtilities\Location;


/**
 * Class Peerless\Backend\Dealers
 */ 
class Dealers extends ContaoBackend
{

	/**
	 * Auto-generate an article alias if it has not been set yet
	 * @param mixed
	 * @param \DataContainer
	 * @return string
	 * @throws \Exception
	 */
	public function generateAlias($varValue, \DataContainer $dc)
	{
		$autoAlias = false;
		
		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = StringUtil::standardize(StringUtil::restoreBasicEntities($dc->activeRecord->name));
			
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_peerless_dealers WHERE id=? OR alias=?")
								   ->execute($dc->id, $varValue);

		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}

			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}

	
	/**
	 * Auto-generate an article alias if it has not been set yet
	 * @param mixed
	 * @param \DataContainer
	 * @return string
	 * @throws \Exception
	 */
	public function geocode(\DataContainer $dc)
	{
		if ($dc->activeRecord->address && (!$dc->activeRecord->latitude || !$dc->activeRecord->longitude))
		{
			$objLocation = new Location();
			$objLocation->setAddress($dc->activeRecord->address);
			if ($objLocation->geocode()) {
				$this->Database->prepare("UPDATE tl_peerless_dealers SET latitude=?, longitude=? WHERE id=?")
					   ->execute($objLocation->get('latitude'), $objLocation->get('longitude'), $dc->id);
				$dc->activeRecord->latitude = $objLocation->get('latitude');
				$dc->activeRecord->longitude = $objLocation->get('longitude');
			}
		}
	}

	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	 /*
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(\Input::get('tid')))
		{
			$this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.\Image::getHtml($icon, $label).'</a> ';
	}	
	*/
	
	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	 /*
	public function toggleVisibility($intId, $blnVisible, \DataContainer $dc=null)
	{
		$objVersions = new \Versions('tl_peerless_dealers', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_peerless_dealers']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_peerless_dealers']['fields']['published']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_peerless_dealers SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_peerless_dealers.id='.$intId.'" has been created'.$this->getParentEntries('tl_peerless_dealers', $intId), __METHOD__, TL_GENERAL);
	}		
	*/

	/**
	 * Return all item templates as array
	 *
	 * @return array
	 */
	public function getDealerTemplates()
	{
		return $this->getTemplateGroup('peerless_dealer');
	}
	
}
