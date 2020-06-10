<?php


use PHPUnit\Framework\TestCase;


final class CoinDispatcherTest extends TestCase
{

    public function test_Call_Class(): void
    {
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);

        $this->assertSame($cd->toString(),"Coin dispatcher Class");
    }
    public function test_Euros_To_Cents(): void
    {
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->EuroToCents(0.5),50);
        $this->assertEquals($cd->EuroToCents(10),1000);
        $this->assertEquals($cd->EuroToCents(100),10000);
        $this->assertEquals($cd->EuroToCents(1.13),113);
    }
    public function test_Euros_To_Cents_String_Params_Return_Null(): void
    {
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);

        $this->assertEquals($cd->EuroToCents('StrInput'),null);

    }
    public function test_Euros_To_Cents_Negative_Number_Params_Return_Null(): void
    {
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);

        $this->assertEquals($cd->EuroToCents(-1.01),null);

    }
    public function test_bounding_situation(){
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange($cd->getMaxBankRoll() + 0.01), "no way !");
    }
    public function test_Euros_To_Cents_Rounded_thousandth(): void
    {
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->EuroToCents(0.221),22);
        $this->assertEquals($cd->EuroToCents(0.229),23);

    }
    public function test_Asked_for_initial_value() :void{

        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(500 ),  array(10000 => 2, 5000 => 5, 2000 => 2, 1000 => 1));
        $this->assertEquals($cd->getAvailableChange(200 ),  array(10000 => 2));
        $this->assertEquals($cd->getAvailableChange(100 ),  array(10000=>1));
        $this->assertEquals($cd->getAvailableChange(50 ),   array(5000=>1));
        $this->assertEquals($cd->getAvailableChange(20 ),   array(2000=>1));
        $this->assertEquals($cd->getAvailableChange(10 ),   array(1000=>1));
        $this->assertEquals($cd->getAvailableChange(5 ),    array(500=>1));
        $this->assertEquals($cd->getAvailableChange(2 ),    array(200=>1));
        $this->assertEquals($cd->getAvailableChange(1 ),    array(100=>1));
        $this->assertEquals($cd->getAvailableChange(0.50 ), array(50=>1));
        $this->assertEquals($cd->getAvailableChange(0.20 ), array(10=>2));
        $this->assertEquals($cd->getAvailableChange(0.10 ), array(10=>1));
        $this->assertEquals($cd->getAvailableChange(0.05 ), array(5=>1));
        $this->assertEquals($cd->getAvailableChange(0.02 ), array(2=>1));
        $this->assertEquals($cd->getAvailableChange(0.01 ), array(1=>1));

    }
    public function test_get_Available_Change(): void
    {
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(0.13), array(10 => 1 ,2 => 1, 1 => 1));
        $this->assertEquals($cd->getAvailableChange(1.13), array(100 => 1, 10 => 1 ,2 => 1, 1 => 1));
        $this->assertEquals($cd->getAvailableChange(1.14), array(100 => 1, 10 => 1 ,2 => 2));
        $this->assertEquals($cd->getAvailableChange(11.13), array(1000=>1, 100 => 1, 10 => 1 ,2 => 1, 1 => 1));
        $this->assertEquals($cd->getAvailableChange(15.13), array(1000=>1,500 => 1, 10 => 1 ,2 => 1, 1 => 1));
        $this->assertEquals($cd->getAvailableChange(115.13), array(10000=>1,1000=>1,500 => 1, 10 => 1 ,2 => 1, 1 => 1));

    }
    public function test_Not_Enouth_Stacked_Coin_On_Pile_Move_To_Next(): void{
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(300), array(10000=>2,5000=>2));
        $this->assertEquals($cd->getAvailableChange(400), array(10000=>2,5000=>4));
        $this->assertEquals($cd->getAvailableChange(800), array(10000 => 2, 5000 => 5, 2000 => 8, 1000 => 11, 500 => 8, 200 => 15, 100 => 10));
        $this->assertEquals($cd->getAvailableChange(826), array( 10000 => 2, 5000 => 5, 2000 => 8, 1000 => 11, 500 => 8, 200 => 15, 100 => 30, 50 => 5, 10 => 18, 5 => 14, 2 => 50));
    }
    public function test_lot_more(): void{
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(79.79), array(5000=>1,2000=>1,500=>1,200=>2, 50=>1,10=>2,5=>1,2=>2));
        $this->assertEquals($cd->getAvailableChange(79), array(5000=>1,2000=>1,500=>1,200=>2));

    }
    public function test_lot_more2(): void{
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
       $this->assertEquals($cd->getAvailableChange(79.10), array(5000=>1,2000=>1,500=>1,200=>2,10=>1));
       $this->assertEquals($cd->getAvailableChange(79.20), array(5000=>1,2000=>1,500=>1,200=>2,10=>2));
       $this->assertEquals($cd->getAvailableChange(79.30), array(5000=>1,2000=>1,500=>1,200=>2,10=>3));
       $this->assertEquals($cd->getAvailableChange(79.40), array(5000=>1,2000=>1,500=>1,200=>2,10=>4));
       $this->assertEquals($cd->getAvailableChange(79.50), array(5000=>1,2000=>1,500=>1,200=>2,50=>1));
       $this->assertEquals($cd->getAvailableChange(79.60), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>1));
       $this->assertEquals($cd->getAvailableChange(79.70), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>2));
       $this->assertEquals($cd->getAvailableChange(79.80), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>3));
       $this->assertEquals($cd->getAvailableChange(79.90), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4));
       $this->assertEquals($cd->getAvailableChange(79.91), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,1=>1));
       $this->assertEquals($cd->getAvailableChange(79.92), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,2=>1));
       $this->assertEquals($cd->getAvailableChange(79.93), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,2=>1,1=>1));
       $this->assertEquals($cd->getAvailableChange(79.94), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,2=>2));
       $this->assertEquals($cd->getAvailableChange(79.95), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,5=>1));

    }
    public function test_buggy_int_casting_situation(){
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(79.96), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,5=>1,1=>1));
        $this->assertEquals($cd->getAvailableChange(79.97), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,5=>1,2=>1));
        $this->assertEquals($cd->getAvailableChange(79.98), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,5=>1,2=>1,1=>1));
        $this->assertEquals($cd->getAvailableChange(79.99), array(5000=>1,2000=>1,500=>1,200=>2,50=>1,10=>4,5=>1,2=>2));
    }
    public function test_Possible_side_Effect() :void{
        $bankroll = [ 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(1.00 ), array(100=>1));
    }
    public function test_Not_Enough_change() :void{
        $bankroll = [ 1 => 0, 2 => 0, 5 => 0, 10 => 0, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 => 8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0];
        $cd = new \CoinDispatcher($bankroll);
        $this->assertEquals($cd->getAvailableChange(12.12 ), 'Not Enough change');
    }

}
