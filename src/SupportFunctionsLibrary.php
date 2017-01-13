<?php  namespace Rndwiga\Cashflow;
/**
*  SupportFunctionsLibrary class
*
*  This is a support class that contains methods used in generating unique random ids and storage for storing generated files
*
*  @author Raphael Ndwiga
*/

class SupportFunctionsLibrary {

  /**
  * generateRandomId() method 
  *
  * Generating unique random ID
  *
  * @param none
  *
  * @return string
  */

  public function generateRandomId()
          {
            $time = time();
            $currentTime = $time;
            $random1= rand(0,99999);
            $random2 = mt_rand();
            $random = $random1 * $random2;
            $a= ($currentTime + $random);
            $un=  uniqid();
            $conct = $a . $un  . md5($a);
            $cashflowRandomId = sha1($conct.$un);
                return $cashflowRandomId;
          }
 /**
  * createStorage() method 
  *
  * Creating storage folders based on the date
  *
  * @param none
  *
  * @return string
  */
  public function createStorage()
      {
        /*
        * This function is for creating folders organized by date for the storage of files
        call this function before any file created to set the dependencies
        */
        $today = date('Y-m-d'); //setting the date
        if (!is_dir('docs'))
          {
            mkdir('./docs', 0777, true); //creating the folder docs if it does not already exist
          }
        if (!is_dir('docs/' . $today))
          {
            //creating folder based on day if it does not exist. If it does, it is not created
            if (!mkdir('./docs/' . $today, 0777, true)) {
                  die('Failed to create folders...'); // Die if the function mkdir cannot run
              }
            return $today;
          } elseif (is_dir('docs/' . $today)){ //check if the folder is created and return it
            return $today;
          } else {
            return $today; 				// Return the folder if its already created in the file system
          }
      }
}
