<?php namespace Rndwiga\Cashflow;
/**
*  CashflowDropdownsLibrary class
*
*  This is the core class used in pulling dropdown values from the core system
*
*  @author Raphael Ndwiga
*/

use Rndwiga\Cashflow\CashflowLibrary;

class CashflowDropdownsLibrary {

/**  @var string $cashflowlibrary will be used to access the CashflowLibrary class instance*/
protected $cashflowlibrary; 

 /**
  * __construct() 
  *
  * This method is for initialization of imported classes
  *
  * @param none
  *
  * @return none
  */

      public function __construct() {
            $this->cashflowlibrary = new Cashflowlibrary;
          }
 /**
  * receiveCashFlowYesNoAlternateDropdownData() 
  *
  * This method is responsible for pulling Yes or No alternate dropdown values
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
      public function receiveCashFlowYesNoAlternateDropdownData($option = NULL)
       {
         $urlExtention = "/codes/146/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
 /**
  * receiveCashFlowPercentageDropdownData() 
  *
  * This method is responsible for pulling percentage value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowPercentageDropdownData($option = NULL)
       {
         $urlExtention = "/codes/147/codevalues/" . $option; //get the loan ID from the webhook post
           return $this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowSourceSeedsDropdownData() 
  *
  * This method is responsible for pulling seed source value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowSourceSeedsDropdownData($option = NULL)
       {
         $urlExtention = "/codes/154/codevalues/" . $option; //get the loan ID from the webhook post
           return $this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowMonthDropdownData() 
  *
  * This method is responsible for pulling calender Months value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowMonthDropdownData($option = NULL)
       {
         $urlExtention = "/codes/149/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowHarvestMonthDropdownData() 
  *
  * This method is responsible for pulling harvest month value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowHarvestMonthDropdownData($option = NULL)
       {
         $urlExtention = "/codes/161/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowPlantingMonthDropdownData() 
  *
  * This method is responsible for pulling planding month value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowPlantingMonthDropdownData($option = NULL)
       {
         $urlExtention = "/codes/155/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowLandLocationDropdownData() 
  *
  * This method is responsible for pulling land location value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowLandLocationDropdownData($option = NULL)
       {
         $urlExtention = "/codes/152/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowYesNoDropdownData() 
  *
  * This method is responsible for pulling yes & no value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowYesNoDropdownData($option = NULL)
       {
         $urlExtention = "/codes/5/codevalues/" . $option ; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowFertilizersYesNoDropdownData() 
  *
  * This method is responsible for pulling percentage value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowFertilizersYesNoDropdownData($option = NULL)
       {
         $urlExtention = "/codes/150/codevalues/" . $option; //get the loan ID from the webhook post
           return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowIrrigationYesNoDropdownData() 
  *
  * This method is responsible for pulling irrigation data value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowIrrigationYesNoDropdownData($option = NULL)
       {
         $urlExtention = "/codes/151/codevalues/" . $option; //get the loan ID from the webhook post
         return	$this->cashflowlibrary->curlOption($urlExtention);
       }
        /**
  * receiveCashFlowAnimalDropdownData() 
  *
  * This method is responsible for pulling animal options value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowAnimalDropdownData($option = NULL)
         {
           $urlExtention = "/codes/145/codevalues/" . $option; //get the loan ID from the webhook post
             return	$this->cashflowlibrary->curlOption($urlExtention);
         }
          /**
  * receiveCashFlowCropDropdownData() 
  *
  * This method is responsible for pulling crops options value dropdown
  *
  * @param integer $option. A integer containing the value of dropdown information to be pulled
  *
  * @return array $obj. An array object containing accessed data
  */
     public function receiveCashFlowCropDropdownData($option = NULL)
         {
           $urlExtention = "/codes/144/codevalues/" . $option; //get the loan ID from the webhook post
             return	$this->cashflowlibrary->curlOption($urlExtention);
         }

}
