<?php namespace Rndwiga\Cashflow;
/**
*  GenerateFinancialSummary class
*
*  This is the core class used in fetchinig loan history data from the system.
*
*  @author Raphael Ndwiga
*/

use PHPExcel;
use PHPExcel_IOFactory;

class GenerateFinancialSummary {

/**
  * generateFinancialSummary() 
  *
  * This method is responsible for running the summary posting and cashflow file upload
  *
  * @param array $cashflowFile. This contains file that should be processed
  * 
  *
  * @return array
  */
  public function generateFinancialSummary($cashflowFile)
    	{
    		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    																				//Financial Summary Data
    		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    		ini_set('date.timezone', 'UTC'); //setting the default timezone
    	 $time = date('H:i:s');  //set the time  for document
    		 $inputFile = $cashflowFile['path'];
    		 /**  Identify the type of $inputFileName  **/
    			 $inputFileType = PHPExcel_IOFactory::identify($inputFile);
    		 /**  Create a new Reader of the type defined in $inputFileType  **/
    			 $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    		 /**  Advise the Reader to load all Worksheets  **/
    				 $objReader->setLoadAllSheets();

    			 $objPHPExcel = $objReader->load($inputFile);
    						 $sheet = $objPHPExcel->setActiveSheetIndex(0);
    						 $cashflowResultData['loanId']= $cashflowFile['loanId'];
    						 $cashflowResultData['realFilePath']= realpath($inputFile);
    						 $cashflowResultData['savedFilePath']= $cashflowFile['savedFilePath']; //redundunt
    						 $cashflowResultData['path']= $cashflowFile['path']; //redundunt
    								$cashflowResultData['summary']=	 array(
    																				"locale" => "en_GB",
    																		    "dateFormat" => "YYYY-mm-dd",
    																		    "loan_id" => $cashflowFile['loanId'],
                                            //approval
                                            "Approval_recommendations" => $sheet->getCell('C2')->getCalculatedValue(),
                                              //client activities
                                            "Crops_planted" => $sheet->getCell('C6')->getCalculatedValue(),
    																		    "Animals_farmed" => $sheet->getCell('C7')->getCalculatedValue(),
    																		    "Other_income" => $sheet->getCell('C8')->getCalculatedValue(),
                                            //financial ratios
                                              "Loan_size_ratio2" => round((($sheet->getCell('C11')->getCalculatedValue()) * 100)),
                                              "Month_by_when_installment_size_ratio_60" => $sheet->getCell('C12')->getCalculatedValue(),
                                              "Indebtness_ratio_2" => round((($sheet->getCell('C13')->getCalculatedValue()) * 100)),
                                            //cashflows
                                            "Installment_amount_after_grace_periods" => round($sheet->getCell('C16')->getCalculatedValue()),
                                            "Total_yearly_cash_flow_2" => round($sheet->getCell('C17')->getCalculatedValue()),
                                            "Minimum_monthly_cash_flow_2" => round($sheet->getCell('C18')->getCalculatedValue()),
    																		    "Month_of_minimum_cashflow" => $sheet->getCell('C19')->getCalculatedValue(),
                                            "Maximum_monthly_cashflow_is_missing" => round($sheet->getCell('C20')->getCalculatedValue()),
    																		    "Month_of_maximum_cashflow" => $sheet->getCell('C21')->getCalculatedValue(),
    																	      //credit history
    																		    "Average_loan_borrowed_in_the_past_2" => round($sheet->getCell('C24')->getCalculatedValue()),
    																		    "Max_loan_borrowed_in_the_past_2" => $sheet->getCell('C25')->getCalculatedValue(),
    																		    "Has_always_repaid_in_time_2" => $sheet->getCell('C26')->getCalculatedValue(),
    																				//confirm
    																		  );

    												 return $cashflowResultData;
    	}
}
