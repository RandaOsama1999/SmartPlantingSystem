<?php  
require_once 'classLandownerView.php';
require_once 'classLandownerModel.php';
require_once 'LandownerController.php';
require_once 'classLandView.php';
require_once 'classLandModel.php';
require_once 'LandController.php';

class Strategy { 

   private $strategy = NULL; 
   
   public function __construct($strategy_ind_id) {
      switch ($strategy_ind_id) {
         case "LOC": 
               $this->strategy = new LandownerController();
         break;
         case "LC": 
               $this->strategy = new LandController();
         break;
      }
   }
   public function showReport($landid) {
      return $this->strategy->viewReport($landid);
   }
   
}  
  
?> 