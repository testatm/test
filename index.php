<?php

 include_once 'src/CoinDispatcher.php';
 $cd = new CoinDispatcher();
 echo $cd->moneyBackToStr($cd->getAvailableChange(114.01));

 
