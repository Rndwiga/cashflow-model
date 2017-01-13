<?php namespace Rndwiga\Cashflow;
/**
*  CashflowloanHistoryLibrary class
*
*  This is the core class used in fetchinig loan history data from the system.
*
*  @author Raphael Ndwiga
*/


use Rndwiga\Cashflow\CashflowLibrary;
use Rndwiga\Cashflow\CashflowDropdownsLibrary;

class CashflowloanHistoryLibrary {
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
  * receiveCashFlowLoanHistoryData() 
  *
  * This method is responsible for processing loan history data
  *
  * @param string $loanId A string containing the loan id. This is what will be used in fetching the loan history data,
  *
  * @return string
  */
  public function receiveCashFlowLoanHistoryData($loanId = NULL)
    		{
    			/*
    				Processing loan history data
    			*/
    			$urlExtention = "/datatables/cct_Loanhistory/" . $loanId; //get the loan ID from the webhook post
    				$cashflowLoanHistory =	$this->cashflowlibrary->curlOption($urlExtention);
    								$clientLoanHistory = array();
  //Loan 1
    					//Checking if the first loan option is selected
    				if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_loan'] == 243 ) {
    						$timelyRepayment1 =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_1']); //dropdown yesno
    									$loan1History = array(
    									'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_1'],
    									'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_1'],
    									'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_1']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_1']['0'],
    									'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_1'],
    									'timelyPayments' => $timelyRepayment1['name'],
    									'loanComment' => $cashflowLoanHistory['0']['Comments_loan_1'],
    								);
  //row 2
    													//Checking if the second loan option is selected
    										if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_second_loan'] == 243) {
    												$timelyRepayment2 =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_2']); //dropdown yesno
    												$loan2History = array(
    																	'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_2'],
    																	'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_2'],
    																	'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_2']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_2']['0'],
    																	'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_2'],
    																	'timelyPayments' => $timelyRepayment2['name'],
    																	'loanComment' => $cashflowLoanHistory['0']['Comments_loan_2'],
    																);
   //row 3
    																//Checking if the third loan option is selected
    																if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_third_loan'] == 243) {
    																	$timelyRepayment3 =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_3']); //dropdown yesno
    																				$loan3History = array(
    																						'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_3'],
    																						'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_3'],
    																						'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_3']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_3']['0'],
    																						'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_3'],
    																						'timelyPayments' => $timelyRepayment3['name'],
    																						'loanComment' => $cashflowLoanHistory['0']['Comments_loan_3'],
    																					);
  //row 4
    																						//Checking if the fourth loan option is selected
    																							if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_fourth_loan'] == 243) {
    																									$timelyRepayment4 =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_4']); //dropdown yesno
    																									$loan4History = array(
    																													'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_4'],
    																													'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_4'],
    																													'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_4']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_4']['0'],
    																													'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_4'],
    																													'timelyPayments' => $timelyRepayment4['name'],
    																													'loanComment' => $cashflowLoanHistory['0']['Comments_loan_4'],
    																												);
 //row 5
    																												//Checking if the fifth loan option is selected
    																														if ($cashflowLoanHistory['0']['YesNo_cd_Add_a_fifth_loan'] == 243) {
    																																	$timelyRepayment5 =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowLoanHistory['0']['YesNo_cd_All_installments_paid_in_time_loan_5']); //dropdown yesno
    																																	$loan5History = array(
    																																					'loanTaken' => $cashflowLoanHistory['0']['Loan_amount_loan_5'],
    																																					'loanBalance' => $cashflowLoanHistory['0']['Current_balance_loan_5'],
    																																					'dateDisbursed' => $cashflowLoanHistory['0']['Date_disbursed_loan_5']['1'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['2'].'/' .$cashflowLoanHistory['0']['Date_disbursed_loan_5']['0'],
    																																					'loanInstitution' => $cashflowLoanHistory['0']['Institution_loan_5'],
    																																					'timelyPayments' => $timelyRepayment5['name'],
    																																					'loanComment' => $cashflowLoanHistory['0']['Comments_loan_5'],
    																																				);
    																																				/*
                                                                              return all loans if captured
                                                                            */
    																																						$clientLoanHistory = array($loan1History, $loan2History, $loan3History, $loan4History, $loan5History );
    																																						return $clientLoanHistory;

    																														} else {
    																															//if the fourth loan has also been entered
    																															//return both loan1, loan 2, loan 3 and loan 4
    																																	$clientLoanHistory = array($loan1History, $loan2History, $loan3History, $loan4History );
    																																	return $clientLoanHistory;
    																														}
    																							} else {
    																								//if the third loan has also been entered
    																								//return both loan1, loan 2 and loan 3
    																									$clientLoanHistory = array($loan1History, $loan2History, $loan3History );
    																									return $clientLoanHistory;
    																							}

    																} else {
    																	//if the second loan has also been entered
    																	//return both loan1 and loan 2
    																		$clientLoanHistory = array($loan1History, $loan2History );
    																		return $clientLoanHistory;
    																}

    										} else {
    													//only the first loan is entered return the feedback
    												$clientLoanHistory = array($loan1History);
    												return $clientLoanHistory;
    										}

    				}else {
    					//write code here that stops processing of information if there is no data to be processed
    								$clientLoanHistory = array();
    								return $clientLoanHistory;
    				}
    		}
}
