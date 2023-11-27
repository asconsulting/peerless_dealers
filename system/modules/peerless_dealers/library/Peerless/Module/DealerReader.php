<?php
 
/**
 * Peerless Dealers
 *
 * Copyright (C) 2018-2023 Andrew Stevens Consulting
 *
 * @package    asconsulting/peerless_dealers
 * @link       https://andrewstevens.consulting
 */

 
namespace Peerless\Module;

use Contao\BackendTemplate;
use Contao\Config;
use Contao\Date;
use Contao\FrontendTemplate;
use Contao\Module as ContaoModule;


use Peerless\Model\Dealer;
 
 
/**
 * Class Peerless\Module\DealerReader
 *
 * Front end module "Peerless Dealers Reader".
 */
 
class DealerReader extends ContaoModule
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_peerless_dealer_list';
 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . mb_strtoupper($GLOBALS['TL_LANG']['FMD']['peerless_dealer_reader'][0]) . ' ###';
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
		
		$objDealer = Dealer::findByIdOrAlias(\Input::get('alias'));
	 
		// Return if no pending items were found
		if (!$objDealer)
		{
			$this->Template->empty = 'No Records Found';
			return;
		}

		$arrDealer = $objDealer->row();
		$arrDealer['timestamp'] = Date::parse(Config::get('datimFormat'), $objDealer->tstamp);
		
		if ($this->jumpTo) {
			$objTarget = $this->objModel->getRelated('jumpTo');
			$arrDealer['link'] = $this->generateFrontendUrl($objTarget->row()) .'?alias=' .$objDealer->alias;
		}

		$strItemTemplate = ($this->customDealerTpl != '' ? $this->customDealerTpl : 'peerless_dealer_reader');
		$objTemplate = new FrontendTemplate($strItemTemplate);
		$objTemplate->setData($arrDealer);
		$arrItems[] = $objTemplate->parse();

		$this->Template->dealers = array($arrDealer);

	}

}
