<?php namespace Rndwiga\Cashflow;
/**
*  CashflowLibrary class
*
*  This is the core class used in making API calls to the core system.
*
*  @author Raphael Ndwiga
*/
class CashflowLibrary {

  /**
  * __construct() 
  *
  * This method is for initialization f imported classes if any
  *
  * @param none
  *
  * @return none
  */

public function __construct() {
      }
  /**
  * curlOption() 
  *
  * This method is responsible for pulling all data from the system
  *
  * @param string $urlOption A string containing a combination of url option and loan id. This is what will be used in fetching data from the system,
  *
  * @return array $obj. An array object containing accessed data
  */
public function curlOption($urlOption)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "8443",
      CURLOPT_URL => "https://live.musonisystem.com:8443/api/v1" . $urlOption ,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live.
      CURLOPT_HTTPHEADER => array(
  				"authorization: Basic QVBJQ29uc3VtZXI6Z2M1TWNqYnZQczdUckRIOTZURTRX",
  				"cache-control: no-cache",
  				"content-type: application/json",
  				"x-mifos-platform-tenantid: kenya"
  			),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err; //build a function that notifies the admin of the failure
        } else {
          $obj = json_decode($response, true);
          return $obj;
        }
  }

  /**
  * curlPostData() 
  *
  * This method is responsible for posting data to system
  *
  * @param array $data. An array containing request method used $data['httpRequestMethod'] and the data to be uploaded $data['postData']

  * @return string $response. Action response from the system
  */
  public function curlPostData($data)
  {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_PORT => "8443",
              CURLOPT_URL => "https://live.musonisystem.com:8443/api/v1" . $data['urlExtention'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //  CURLOPT_CUSTOMREQUEST => "DELETE",
            //  CURLOPT_CUSTOMREQUEST => "PUT",
            //  CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_CUSTOMREQUEST => $data['httpRequestMethod'],
              CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
              CURLOPT_POSTFIELDS => $data['postData'],
              CURLOPT_HTTPHEADER => array(
                "authorization: Basic QVBJQ29uc3VtZXI6Z2M1TWNqYnZQczdUckRIOTZURTRX",
                "cache-control: no-cache",
                "content-type: application/json",
                "x-mifos-platform-tenantid: kenya"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
              $response = "cURL Error #:" . $err;
              return $response;
            } else {
              return $response;
            }
  }
  /**
  * curlUploadFile() 
  *
  * This method is responsible for uploading data into the system
  *
  * @param array $data. An array containing request file to be uploaded $data['postData']

  * @return string $response. Action response from the system
  */
  public function curlUploadFile($data)
  {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://live.musonisystem.com:8443/api/v1" . $data['urlExtention'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_POST => true,
              CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
              CURLOPT_POSTFIELDS => $data['postData'],
              CURLOPT_HTTPHEADER => array(
                    "authorization: Basic QVBJQ29uc3VtZXI6Z2M1TWNqYnZQczdUckRIOTZURTRX",
                    "cache-control: no-cache",
                    "content-type: multipart/form-data",
                    "x-mifos-platform-tenantid: kenya"
                  ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
              $response = "cURL Error #:" . $err;
              return $response;
            } else {
              return $response;
            }
  }

}
