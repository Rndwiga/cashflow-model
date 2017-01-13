<?php   namespace Rndwiga\Cashflow;
/**
*  CashflowStatementsLibrary class
*
*  This is the core class used in fetchinig loan history data from the system.
*
*  @author Raphael Ndwiga
*/


use Rndwiga\Cashflow\CashflowLibrary;
use Rndwiga\Cashflow\CashflowDropdownsLibrary;

class CashflowStatementsLibrary {
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
  * receiveCashFlowStatementsData() 
  *
  * This method is responsible for processing cashflow statements data
  *
  * @param string $loanId A string containing the loan id. This is what will be used in fetching the cashflow statements data
  * data,
  *
  * @return object
  */
      public function receiveCashFlowStatementsData($loanId = NULL)
      	{
      			/*
      				Processing statement data
      			*/
      			$urlExtention = "/datatables/cct_CashFlowStatements/" . $loanId; //get the loan ID from the webhook post
      				$CashFlowStatements =	$this->cashflowlibrary->curlOption($urlExtention);
      				//row 1
      						$month1 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_1']); //dropdown month
      						$row1Statements = array(
      										'month'=> $month1['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_1'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_1'],
      									);
      				//row 2
      						$month2 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_2']); //dropdown month
      						$row2Statements = array(
      										'month'=> $month2['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_2'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_2'],
      									);
      				//row 3
      								$month3 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_3']); //dropdown month
      					$row3Statements = array(
      									'month'=> $month3['name'],
      									'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_3'],
      									'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_3'],
      								);
      				//row 4
      									$month4 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_4']); //dropdown month
      						$row4Statements = array(
      										'month'=> $month4['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_4'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_4'],
      									);
      				//row 5
      							$month5 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_5']); //dropdown month

      						$row5Statements = array(
      										'month'=> $month5['name'],
      										'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_5'],
      										'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_5'],
      									);
      				//row 6
      								$month6 =		$this->cashflowdropdownslibrary->receiveCashFlowMonthDropdownData($CashFlowStatements['0']['Cashflow_Month_cd_Month_6']); //dropdown month
      					$row6Statements = array(
      									'month'=> $month6['name'],
      									'inflow'=> $CashFlowStatements['0']['Cash_inflows_month_6'],
      									'outflow'=> $CashFlowStatements['0']['Cash_outflows_month_6'],
      								);
      								$statements = array($row1Statements,$row2Statements,$row3Statements,$row4Statements,$row5Statements,$row6Statements);
      									return $statements;
      	}

}
