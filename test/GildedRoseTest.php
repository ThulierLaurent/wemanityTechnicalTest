<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {

    public function testFoo() {
        $items      = [new Item("foo", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("foo", $items[0]->name);
    }

    //it must be a positive value for every quality item
    public function testNegativeValue(){
    	$items      = [new Item("foo", 0, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertGreaterThanOrEqual(0, $items[0]->quality);
    }

    public function testBrieVieilliQuality(){
    	$items      = [new Item("Aged Brie", 2, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertGreaterThanOrEqual(2, $items[0]->quality);
    }

    //Limited to 50
    public function testMaxValue(){
    	$items      = [new Item("Elixir of the Mongoose", 5, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertLessThanOrEqual(50, $items[0]->quality);
    }

    //Sulfuras - Legendary Product - Static Value 80
    public function testLegendaryProduct(){
    	$items      = [new Item("Sulfuras, Hand of Ragnaros", 10, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(80, $items[0]->quality);
    }

    //Tests - Passes en coulisses
    public function testBackstagePassesProduct(){
    	//10 days or less
    	$valueQuality = 30;
    	$items      = [new Item("Backstage passes", 10, $valueQuality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($valueQuality+2, $items[0]->quality);

		//5 days or less
        $valueQuality2 = 30;
        $items2      = [new Item("Backstage passes", 5, $valueQuality2)];
        $gildedRose2 = new GildedRose($items2);
        $gildedRose2->updateQuality();
        $this->assertEquals($valueQuality2+3, $items2[0]->quality);
    }

    //Conjured
    public function testConjuredProduct(){
    	$items      = [new Item("Conjured Mana Cake", 8, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(18, $items[0]->quality);
    }
}
