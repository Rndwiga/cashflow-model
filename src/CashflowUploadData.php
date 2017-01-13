<?php namespace Rndwiga\Cashflow;
/**
*  CashflowStatementsLibrary class
*
*  This is the core class used in fetchinig loan history data from the system.
*
*  @author Raphael Ndwiga
*/


use Rndwiga\Cashflow\CashflowLibrary;


class CashflowUploadData {
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
        $this->cashflowlibrary = new CashflowLibrary;
      }
/**
  * uploadData() 
  *
  * This method is responsible for running the summary posting and cashflow file upload
  *
  * @param array $cashflowSummaryData. This contains processed data
  * data,
  *
  * @return object
  */
  public function uploadData($cashflowSummaryData)
  {
        $data['summary'] = $this->postFinancialSummary($cashflowSummaryData);
        $data['file'] = $this->uploadCashflowModel($cashflowSummaryData);
      return $data;
  }
/**
  * postFinancialSummary() 
  *
  * This method is responsible for uploading financial summary data
  *
  * @param array $cashflowSummaryData. This contains processed data
  * data,
  *
  * @return object
  */
  public function postFinancialSummary($cashflowSummaryData)
            {
                          $data['urlExtention'] = "/datatables/cct_CashFlowFinancialSummary/" . $cashflowSummaryData['loanId'] ;
                          $data['postData'] = json_encode($cashflowSummaryData['summary']);
                          $data['httpRequestMethod'] = "POST"; //default is post
                          $feedback =	$this->cashflowlibrary->curlPostData($data); //uploading data

                              $msg = json_decode($feedback); //decoding the feedback
                            if(($msg->httpStatusCode) == 403){
                              //if the post failed try PUT
                                  $data['urlExtention'] = "/datatables/cct_CashFlowFinancialSummary/" . $cashflowSummaryData['loanId'] ;
                                  $data['postData'] = json_encode($cashflowSummaryData['summary']);
                                  $data['httpRequestMethod'] = "PUT"; //default is post
                              $feedback =	$this->cashflowlibrary->curlPostData($data); //uploading data
                            }
                            //If the posting/updating is a success
                              $msg = json_decode($feedback); //decoding the feedback
                            if(isset($msg->resourceId)){
                                $feedback = array('status' => "success", 'code' => http_response_code(200));
                              //	return json_encode($feedback);
                                return $feedback;
                            }
            }
  /**
  * uploadCashflowModel() 
  *
  * This method is responsible for uploading cashflow model file
  *
  * @param array $cashflowSummaryData. This contains processed data
  * data,
  *
  * @return object
  */
    public function uploadCashflowModel($cashflowSummaryData)
              {
                            $data['urlExtention'] = "/cct_CashFlowFinancialSummary/". $cashflowSummaryData['loanId'] ."/documents/?tenantIdentifier=kenya";
                                $filePath = $cashflowSummaryData['realFilePath'];
                                  //getting the file name
                                      $info = new \SplFileInfo($filePath);
                                        $filename = $info->getFilename();
                                $data['postData'] =	array(
                                                        "file" => new \CurlFile($filePath, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', $filename),
                                                        "name" => "image_CashflowModel",
                                                        "locale" => "en",
                                                        "appTableId" => $cashflowSummaryData['loanId'],
                                                      );
                                $feedback =	$this->cashflowlibrary->curlUploadFile($data); //sending the file
                                $msg = json_decode($feedback); //decoding the feedback
                                  if(isset($msg->resourceId)){ //if success
                                      $feedback = array('status' => "success", 'code' => http_response_code(200));
                                      return $feedback;
                                  }else {
                                    //return the error message
                                    return $msg;
                                  }
              }

}
