<?php  namespace Rndwiga\Cashflow;
/**
*  CashflowloanHistoryLibrary class
*
*  This is the core class used in fetchinig loan history data from the system.
*
*  @author Raphael Ndwiga
*/


use Rndwiga\Cashflow\CashflowLibrary;
use Rndwiga\Cashflow\CashflowDropdownsLibrary;

class CashflowOtherInformationLibrary {
    /**  @var string $cashflowlibrary will be used to access the CashflowLibrary class instance*/
    protected $cashflowlibrary;
    /**  @var string $cashflowdropdownslibrary will be used to access the CashflowDropdownsLibrary class instance*/
    protected $cashflowdropdownslibrary;
  /**
  * Sample method 
  *
  * Initializing the imported classes
  *
  * @param string none
  *
  * @return string
  */
    public function __construct() {
            $this->cashflowlibrary = new CashflowLibrary;
            $this->cashflowdropdownslibrary = new CashflowDropdownsLibrary;
        }
            /**
  * receiveCashFlowOtherInformationData() 
  *
  * This method is responsible for processing client other information data
  *
  * @param string $loanId A string containing the loan id. This is what will be used in fetching the client other informationdata,
  *
  * @return object
  */
      public function receiveCashFlowOtherInformationData($loanId = NULL)
    	{
    			/*
    				Processing Other information data
    			*/
    			$urlExtention = "/datatables/cct_CashFlowOtherInfo/" . $loanId; //get the loan ID from the webhook post
    				$CashFlowOtherInformation =	$this->cashflowlibrary->curlOption($urlExtention);
    					$percentage =		$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($CashFlowOtherInformation['0']['Cashflow_Percentage_cd_Labor_carried_out_pe']); //dropdown month
    					$mandatoryOtherInfo = array(
    													'howMuchLabour' => $percentage['name'],
    													'activityDescription' => $CashFlowOtherInformation['0']['Non_farming_activities_description'],
    													'monthlyIncome' => $CashFlowOtherInformation['0']['Monthly_income_other_activities'],
    													'monthlyExpense' => $CashFlowOtherInformation['0']['Monthly_expenditures_other_activities'],
    												);
  //row 1
    											//checking if other investment option is set
    							if ($CashFlowOtherInformation['0']['YesNo_cd_Add_an_investment'] == 243) {
    												$month1 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment']); //dropdown month
    												$investment1 = array(
    																			'investmentType' => $CashFlowOtherInformation['0']['Type_of_investment'],
    																			'investmentAmount' => $CashFlowOtherInformation['0']['Investment_amount'],
    																			'investmentMonth' => $month1['name'],
    																		);
    											//checking if a second investment is selected
//row 2
    														if ($CashFlowOtherInformation['0']['YesNo_cd_Add_an_investment'] == 243) {
    																			$month2 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowOtherInformation['0']['Cashflow_Month_cd_Month_of_investment_2']); //dropdown month
    																			$investment2 = array(
    																										'investmentType' => $CashFlowOtherInformation['0']['investment_2_Type_of_Investment'],
    																										'investmentAmount' => $CashFlowOtherInformation['0']['Investment_2_amount'],
    																										'investmentMonth' => $month2['name'],
    																									);
    																									//if the second investment is set
    																									//return both the mandatory field and both investments
    																									$otherInformationData = array((object)$mandatoryOtherInfo, $investment1, $investment2);
    																									return  $otherInformationData;
    														} else {
    															//if optional investment is set
    															//return both the mandatory field and the first option
    																	$otherInformationData = array((object)$mandatoryOtherInfo, $investment1);
    																	return  $otherInformationData;
    														}
    							} else {
    								//if optional investment is not set just return the mandatory fields
    								//	$otherInformationData = (object)$mandatoryOtherInfo;
    									$otherInformationData = array((object)$mandatoryOtherInfo);
    									return  $otherInformationData;
    							}
    }
}
