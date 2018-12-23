<?php
 
/**
 * Peerless Dealers
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    asconsulting/peerless_dealers
 * @link       https://andrewstevens.consulting
 */
 
 
namespace Contao;
 
/**
 * Class ModulePeerlessDealersSearch
 *
 * Front end module "Peerless Dealers List".
 */
 
class ModulePeerlessDealersSearch extends \Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_peerless_dealers_list';
 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['peerless_dealer_list'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;
 
            return $objTemplate->parse();
        }
 
        return parent::generate();
    }
 
 
    /**
     * Generate the module
     */
    protected function compile()
    {

		$objDealer = Dealer::findPublished();
	 
		// Return if no pending items were found
		if (!$objDealer)
		{
			$this->Template->empty = 'No Records Found';
			return;
		}

		$arrDealers = array();
		
		while ($objDealer->next())
		{
			$arrDealer = $objDealer->row();
			$arrDealer['timestamp'] = \Date::parse(\Config::get('datimFormat'), $objDealer->tstamp);
			
			if ($this->jumpTo) {
				$objTarget = $this->objModel->getRelated('jumpTo');
				$arrDealer['link'] = $this->generateFrontendUrl($objTarget->row()) .'?alias=' .$objDealer->alias;
			}

			$strItemTemplate = ($this->customDealerTpl != '' ? $this->customDealerTpl : 'peerless_dealer_list');
			$objTemplate = new \FrontendTemplate($strItemTemplate);
			$objTemplate->setData($arrDealer);
			$arrDealers[] = $objTemplate->parse();
		}
		
		$this->Template->dealers = $arrDealers;
	}

} 
