<?php namespace Rndwiga\Cashflow;

/**
*  CashflowLoanLibrary class
*
*  This is the core class used in fetchinig loan history data from the system.
*
*  @author Raphael Ndwiga
*/


use Rndwiga\Cashflow\CashflowLibrary;


class CashflowLoanLibrary {
  /**  @var string $cashflowlibrary will be used to access the CashflowLibrary class instance*/
    protected $cashflowlibrary;
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
        $this->cashflowlibrary = new Cashflowlibrary;
      }
      /**
  * receiveCashFlowLoanData() 
  *
  * This method is responsible for processing loan data
  *
  * @param string $loanId A string containing the loan id. This is what will be used in fetching the loan data,
  *
  * @return string
  */
  public function receiveCashFlowLoanData($loanId = NULL)
    	{
    		/*
    					Processing data from loan call for cash flow
    					data not available is the branch
    					The details echoéd are the ones to be entered in the excel model
    		*/
    				$urlExtention = "/loans/" . $loanId; //get the loan ID from the webhook post
    				$CashFlowLoan =	$this->cashflowlibrary->curlOption($urlExtention);
							 $loan = array(
								 'submissionDate' => $CashFlowLoan['timeline']['submittedOnDate']['0'] .'/' . $CashFlowLoan['timeline']['submittedOnDate']['1'] .'/' . $CashFlowLoan['timeline']['submittedOnDate']['2'],
								 'disbursementDate' => $CashFlowLoan['timeline']['expectedDisbursementDate']['0'] .'/' . $CashFlowLoan['timeline']['expectedDisbursementDate']['1'] .'/' . $CashFlowLoan['timeline']['expectedDisbursementDate']['2'],
								 'repaymentDate' => $CashFlowLoan['expectedFirstRepaymentOnDate']['0'] .'/' . $CashFlowLoan['expectedFirstRepaymentOnDate']['1'] .'/' . $CashFlowLoan['expectedFirstRepaymentOnDate']['2'],
								 'principalApplied' => $CashFlowLoan['principal'],
								 'interestRate' => $CashFlowLoan['interestRatePerPeriod'],
								 'repaymentFrequency' => $CashFlowLoan['termPeriodFrequencyType']['value'],
								 'repaymentEvery'	=> $CashFlowLoan['repaymentEvery'],
								 'installmentsNumber' => $CashFlowLoan['termFrequency'],
								 'gracePrincipal' => $CashFlowLoan['graceOnPrincipalPayment'],
								 'graceInterest' => $CashFlowLoan['graceOnInterestPayment']
							 );
						 return (object)$loan;
    	}
}
