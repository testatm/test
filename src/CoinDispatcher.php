<?php 

class CoinDispatcher {

    private $arrValQty = null;

    private $currencies ;
    private $qties ;
    private $maxBankRoll = 0 ;

   /**
     * CoinDispatcher constructor.
     */
   public function __construct($bankroll){
      $this->arrValQty = $bankroll;
       $this->currencies = explode(",",implode(",",array_reverse(array_keys($this->arrValQty))));
       $this->qties = explode(",",implode(",",array_reverse($this->arrValQty)));

       $this->setMaxBankRoll();
   }
   /**
     * Setter
     * maxBanckroll
     */
   private function setMaxBankRoll(){
        $temp =0;
        //return
        foreach ($this->currencies as $k => $curr){
            $temp += $curr * $this->qties[$k];
        }
        $this->maxBankRoll = $temp;
    }
   /**
     * @return string
     */
   public function toString(){
        return "Coin dispatcher Class" ;
    }
   /**
     * Getter
     * maxBankRoll
     * @return int
     */
   public function getMaxBankRoll(){
        return $this->maxBankRoll;
    }
   /**
     * Core function
     * @param $value
     */
   public function getAvailableChange($v){

        $remainder = $this->EuroToCents($v);
        if ($remainder > $this->maxBankRoll) return "no way !";

        $moneyBack = array();
        foreach ($this->currencies as $k => $current_currency){

            if ( $remainder >= $current_currency && $this->qties[$k] > 0  ){

                $xTime = (int)($remainder / $current_currency) ;
                // we afford funding or grabbing all current currency Pile
                $nTime = $xTime <= $this->qties[$k] ? $xTime : (int)$this->qties[$k];
                $moneyBack[$current_currency] = (int)$nTime;
                $remainder = round($remainder  -  ($current_currency * $nTime)) ;

            }
        }

        return $remainder == 0 ? $moneyBack: 'Not Enough change';
    }
   /**
     * Assuming Amount is in Euros ...
     *
     * @param $amount
     * @return float|int
     */
   public function EuroToCents($amount){
        return is_numeric($amount) && $amount > 0 ? round($amount,2) * 100 : null;
    }

    /**
     * @param $moneyBack
     * @return string
     */
   public function moneyBackToStr($moneyBack){
      return  implode(', ', array_map( function ($v, $k) {
                                              return sprintf("%s='%s'", $k, $v); },
                                              $moneyBack, array_keys($moneyBack)
                                          )
              );
   }
}
