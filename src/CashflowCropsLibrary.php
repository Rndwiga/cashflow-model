<?php namespace Rndwiga\Cashflow;
/**
*  CashflowCropsLibrary class
*
*  This class pulls crops information from the system and returns the data as an array
*
*  @author Raphael Ndwiga
*/

use Rndwiga\Cashflow\CashflowLibrary;
use Rndwiga\Cashflow\CashflowDropdownsLibrary;

class CashflowCropsLibrary {
    /**  @var string $cashflowlibrary will be used to access the CashflowLibrary class instance*/
        protected $cashflowlibrary;
        /**  @var string $cashflowdropdownslibrary will be used to access the CashflowDropdownsLibrary class instance*/
        protected $cashflowdropdownslibrary;
    /**
  * __construct method 
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
  * receiveCashFlowCropsData() 
  *
  * This method is responsible for processing crops data
  *
  * @param string $loanId A string containing the loan id. Thi is what will be used in fetching the crops data,
  *
  * @return string
  */
  public function receiveCashFlowCropsData($loanId = NULL)
      {
        	/*
        			retrieve crops data
        	*/
        	$urlExtention = "/datatables/cct_CashFlowCrops/" . $loanId; //get the loan ID from the webhook post
        		$cashflowCrops =	$this->cashflowlibrary->curlOption($urlExtention);

            //checking if add crop one is selected
  //row 1
        		if ($cashflowCrops['0']['YesNo_cd_Add_a_crop'] == 243) {
        								$crop =		$this->cashflowdropdownslibrary->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_1']); //dropdown animal
        								$seedSource =		$this->cashflowdropdownslibrary->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_1']); //dropdown seed source
  								  if(is_null($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_11'])){
  										$harvestMonth['name'] = null;
  									} else{
  										 $harvestMonth =		$this->cashflowdropdownslibrary->receiveCashFlowHarvestMonthDropdownData($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_11']); //month
  									}
                        $fertilizer =		$this->cashflowdropdownslibrary->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Use_fertilizers_crop_1']); //dropdown fertilizer
        								$pesticides =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Use_pesticides_crop_1']); //dropdown yesno
        								$irrigation =		$this->cashflowdropdownslibrary->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Irrigation_crop_1']); //dropdown irrigationyesno
  						if(is_null($cashflowCrops['0']['Cashflow_Month_Crops_cd_Next_month_of_planting_crop_11'])){
  								$month['name'] = null;
  							} else{
  								$month = $this->cashflowdropdownslibrary->receiveCashFlowPlantingMonthDropdownData($cashflowCrops['0']['Cashflow_Month_Crops_cd_Next_month_of_planting_crop_11']); //dropdown month
  							}
                      	$percentage =		$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Home_consumption_crop_1']); //dropdown month
        											$row1Crops = array(
        																'cropName' => $crop['name'] ,
        																'cropType' => $cashflowCrops['0']['Specify_crop_1'],
        																'acersUnderProduction' => $cashflowCrops['0']['Acres_under_production_crop_11'],
        																'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amo'],
        																'seedSource' => $seedSource['name'], //dropdwon seed source
        																'useFertilizer' => $fertilizer['name'],
        																'fertilizerAmountUsed' => $cashflowCrops['0']['Number_50_Kg_bags_fe'],
        																'usePesticides' => $pesticides['name'],
        																'useIrrigation' => $irrigation['name'],
        																'plantingMonth' => $month['name'] ,
        																'harvestMonth' => $harvestMonth['name'], //dropdown month
        																'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_1'],
        																'homeConsumption' => $percentage['name'],
        																'storageDuration' => $cashflowCrops['0']['Months_storage_crop_1'],
        											);

  //row 2
        									if ($cashflowCrops['0']['YesNo_cd_Add_a_second_crop'] == 243) {
        															$crop =		$this->cashflowdropdownslibrary->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_2']); //dropdown animal
        															$seedSource =		$this->cashflowdropdownslibrary->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_2']); //dropdown seed source
            														if(is_null($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_21'])){
      																		$harvestMonth['name'] = null;
      																	} else{
      																		$harvestMonth =		$this->cashflowdropdownslibrary->receiveCashFlowHarvestMonthDropdownData($cashflowCrops['0']['Cashflow_Month_cd_Month_of_harvest_crop_21']); //month
      																	}
        															$fertilizer =		$this->cashflowdropdownslibrary->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_2Use_fertilizers_crop_2']); //dropdown fertilizer
        															$pesticides =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_2Use_pesticides_crop_2']); //dropdown yesno
        															$irrigation =		$this->cashflowdropdownslibrary->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_2Irrigation']); //dropdown irrigationyesno
        															if(is_null($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_2Month_planting_2'])){
  																		$month['name'] = null;
  																	} else{
  																		$month =		$this->cashflowdropdownslibrary->receiveCashFlowPlantingMonthDropdownData($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_2Month_planting_2']); //dropdown month
  																	}
        															$percentage =		$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_2Home_consumption']); //dropdown month
        																		$row2Crops = array(
        																							'cropName' => $crop['name'] ,
        																							'cropType' => $cashflowCrops['0']['Specify_crop_2'],
        																							'acersUnderProduction' => $cashflowCrops['0']['Crop_2Acres_under_production_1'],
        																							'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_2'],
        																							'seedSource' => $seedSource['name'], //dropdwon
        																							'useFertilizer' => $fertilizer['name'],
        																							'fertilizerAmountUsed' => $cashflowCrops['0']['Crop_2Number_50_Kg_b'],
        																							'usePesticides' => $pesticides['name'],
        																							'useIrrigation' => $irrigation['name'],
        																							'plantingMonth' => $month['name'] ,
        																							'harvestMonth' => $harvestMonth['name'], //dropdown month
        																							'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_2'],
        																							'homeConsumption' => $percentage['name'],
        																							'storageDuration' => $cashflowCrops['0']['Crop_2Months_storage'],
        																		);

        													//Checking if the 3rd crop is selected
      //row 3
        															if ($cashflowCrops['0']['YesNo_cd_Add_a_third_crop'] == 243) {
        																					$crop =		$this->cashflowdropdownslibrary->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_3']); //dropdown animal
        																					$seedSource =		$this->cashflowdropdownslibrary->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_3']); //dropdown seed source
        																					if(is_null($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_31'])){
  																								$harvestMonth['name'] = null;
  																							} else{
  																								$harvestMonth =		$this->cashflowdropdownslibrary->receiveCashFlowHarvestMonthDropdownData($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_31']); //month
  																							}
        																					$fertilizer =		$this->cashflowdropdownslibrary->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_3Use_fertilizers_crop_3']); //dropdown fertilizer
        																					$pesticides =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_3Use_pesticides_crop_3']); //dropdown yesno
        																					$irrigation =		$this->cashflowdropdownslibrary->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_3Irrigation_crop_3']); //dropdown irrigationyesno
        																					if(is_null($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_3Month_planting_2'])){
  																								$landRateMonth['name'] = null;
  																							} else{
  																								$month = $this->cashflowdropdownslibrary->receiveCashFlowPlantingMonthDropdownData($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_3Month_planting_2']); //dropdown month
  																							}

        																					$percentage =		$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_3Home_consumption_crop_3']); //dropdown month
        																								$row3Crops = array(
        																													'cropName' => $crop['name'] ,
        																													'cropType' => $cashflowCrops['0']['Specify_crop_3'],
        																													'acersUnderProduction' => $cashflowCrops['0']['Crop_3Acres_under_production_1'],
        																													'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_3'],
        																													'seedSource' => $seedSource['name'], //dropdwon
        																													'useFertilizer' => $fertilizer['name'],
        																													'fertilizerAmountUsed' => $cashflowCrops['0']['Crop_3Number_50_Kg_b'],
        																													'usePesticides' => $pesticides['name'],
        																													'useIrrigation' => $irrigation['name'],
        																													'plantingMonth' => $month['name'] ,
        																													'harvestMonth' => $harvestMonth['name'], //dropdown month
        																													'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_3'],
        																													'homeConsumption' => $percentage['name'],
        																													'storageDuration' => $cashflowCrops['0']['Crop_3Months_storage_crop_3'],
        																								);
        //row 4
        																				//Checking if 4th crop has been added
        																					if ($cashflowCrops['0']['YesNo_cd_Add_a_fourth_crop'] == 243) {
        																											$crop =		$this->cashflowdropdownslibrary->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_4']); //dropdown animal
        																											$seedSource =		$this->cashflowdropdownslibrary->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_4']); //dropdown seed source
        																											if(is_null($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_41'])){
  																														$harvestMonth['name'] = null;
  																													} else{
  																														$harvestMonth =		$this->cashflowdropdownslibrary->receiveCashFlowHarvestMonthDropdownData($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_41']); //month
  																													}
        																											$fertilizer =		$this->cashflowdropdownslibrary->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_4Use_fertilizers_crop_4']); //dropdown fertilizer
        																											$pesticides =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_4Use_pesticides_crop_4']); //dropdown yesno
        																											$irrigation =		$this->cashflowdropdownslibrary->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_4Irrigation_crop_4']); //dropdown irrigationyesno
  																													if(is_null($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_4Month_planting_2'])){
  																															$month['name'] = null;
  																														} else{
  																															$month =	$this->cashflowdropdownslibrary->receiveCashFlowPlantingMonthDropdownData($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_4Month_planting_2']); //dropdown month
  																														}

        																											$percentage =		$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_4Home_consumption_crop_4']); //dropdown month
        																														$row4Crops = array(
        																																			'cropName' => $crop['name'] ,
        																																			'cropType' => $cashflowCrops['0']['Specify_crop_4'],
        																																			'acersUnderProduction' => $cashflowCrops['0']['Crop_4Acres_under_production_1'],
        																																			'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_4'],
        																																			'seedSource' => $seedSource['name'], //dropdwon
        																																			'useFertilizer' => $fertilizer['name'],
        																																			'fertilizerAmountUsed' => $cashflowCrops['0']['Crop_4Number_50_Kg_b'],
        																																			'usePesticides' => $pesticides['name'],
        																																			'useIrrigation' => $irrigation['name'],
        																																			'plantingMonth' => $month['name'] ,
        																																			'harvestMonth' => $harvestMonth['name'], //dropdown month
        																																			'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_4'],
        																																			'homeConsumption' => $percentage['name'],
        																																			'storageDuration' => $cashflowCrops['0']['Crop_4Months_storage_crop_4'],
        																														);
     //row 5
        																									//checking if the 5th crop is added
        																										if ($cashflowCrops['0']['YesNo_cd_Add_a_fifth_crop'] == 243) {
        																																$crop =		$this->cashflowdropdownslibrary->receiveCashFlowCropDropdownData($cashflowCrops['0']['Cashflow_Crops_cd_Crop_51']); //dropdown animal
        																																$seedSource =		$this->cashflowdropdownslibrary->receiveCashFlowSourceSeedsDropdownData($cashflowCrops['0']['Cashflow_SourceSeeds_cd_Main_source_of_seeds_cuttings_crop_5']); //dropdown seed source
        																																if(is_null($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_51'])){
  																																			$harvestMonth['name'] = null;
  																																		} else{
  																																			$harvestMonth =		$this->cashflowdropdownslibrary->receiveCashFlowHarvestMonthDropdownData($cashflowCrops['0']['Cashflow_Harvest_month_cd_Month_of_harvest_crop_51']); //month
  																																		}
        																																$fertilizer =		$this->cashflowdropdownslibrary->receiveCashFlowFertilizersYesNoDropdownData($cashflowCrops['0']['Cashflow_FertizersYesNo_cd_Crop_5Use_fertilizers_crop_5']); //dropdown fertilizer
        																																$pesticides =		$this->cashflowdropdownslibrary->receiveCashFlowYesNoDropdownData($cashflowCrops['0']['YesNo_cd_Crop_5Use_pesticides_crop_5']); //dropdown yesno
        																																$irrigation =		$this->cashflowdropdownslibrary->receiveCashFlowIrrigationYesNoDropdownData($cashflowCrops['0']['Cashflow_IrrigationYesNo_cd_Crop_5Irrigation_crop_5']); //dropdown irrigationyesno
        																																if(is_null($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_5Month_planting_2'])){
  																																			$month['name'] = null;
  																																		} else{
  																																			$month =		$this->cashflowdropdownslibrary->receiveCashFlowPlantingMonthDropdownData($cashflowCrops['0']['Cashflow_Month_Crops_cd_Crop_5Month_planting_2']); //dropdown month
  																																		}
  																																	$percentage =		$this->cashflowdropdownslibrary->receiveCashFlowPercentageDropdownData($cashflowCrops['0']['Cashflow_Percentage_cd_Crop_5Home_consumption_crop_5']); //dropdown month
        																																			$row5Crops = array(
        																																								'cropName' => $crop['name'] ,
        																																								'cropType' => $cashflowCrops['0']['Specify_crop_5'],
        																																								'acersUnderProduction' => $cashflowCrops['0']['Crop_5Acres_under_production_1'],
        																																								'expectedHarvestAmount' => $cashflowCrops['0']['Expected_harvest_amount_cycle_crop_5'],
        																																								'seedSource' => $seedSource['name'], //dropdwon
        																																								'useFertilizer' => $fertilizer['name'],
        																																								'fertilizerAmountUsed' => $cashflowCrops['0']['Number_50_Kg_bags_fe'],
        																																								'usePesticides' => $pesticides['name'],
        																																								'useIrrigation' => $irrigation['name'],
        																																								'plantingMonth' => $month['name'] ,
        																																								'harvestMonth' => $harvestMonth['name'] , //dropdown month
        																																								'priceCropSold' => $cashflowCrops['0']['Sale_price_unit_crop_5'],
        																																								'homeConsumption' => $percentage['name'],
        																																								'storageDuration' => $cashflowCrops['0']['Crop_5Months_storage_crop_5'],
        																																			);

        																														//if all the 5 crops selected, return all of them.
        																														$crops = array($row1Crops, $row2Crops, $row3Crops, $row4Crops, $row5Crops);
        																														return $crops;
        																										} else {
        																											//if only 4 crops selected, return them.
        																											$crops = array($row1Crops, $row2Crops, $row3Crops, $row4Crops);
        																											return $crops;
        																										}
        																					} else {
        																						//if only 1st, 2nd and 3rd crops selected. return the 3 of them.
        																						$crops = array($row1Crops, $row2Crops, $row3Crops);
        																						return $crops;

        																					}
        															} else {
        																//if only 1st and 2nd crop selected
        																//return the 2 of them.
        																$crops = array($row1Crops, $row2Crops);
        																return $crops;
        															}
        									} else {
        										//if only the 1st crop is selected, return it
        										$crops = array($row1Crops);
        										return $crops;
        									}
        		} else {
        			$crops = array();
        			return $crops; //if there is no crop selected return an empy accessArray
        		}

      }

}
