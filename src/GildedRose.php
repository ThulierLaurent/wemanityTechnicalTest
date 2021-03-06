<?php

namespace App;

final class GildedRose {

    private $items = [];
    private $maxValue = 50;

    public function __construct($items) {
        $this->items = $items;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {

            //check quality to change or not
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        if ($item->name == 'Conjured Mana Cake') {
                            $item->quality = $item->quality - 2;
                        }else{
                            $item->quality = $item->quality - 1;
                        }
                    }
                }
            } 
            else {
                if ($item->quality < $this->maxValue) {
                    $item->quality += 1;
                    if ($item->name == 'Backstage passes') {
                        if ($item->sell_in < 11) {
                            if ($item->quality < $this->maxValue) {
                                $item->quality += 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < $this->maxValue) {
                                $item->quality +=  1;
                            }
                        }
                    }
                }
            }

            //one day in less
            $this->decreaseDays($item);

            //depending on days
            $this->checkSellIn($item);
        }
    }

    private function decreaseDays($item){
        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in = $item->sell_in - 1;
        }
    }

    private function checkSellIn($item){
        if ($item->sell_in < 0) {
            if ($item->name != 'Aged Brie') {
                if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->quality > 0) {
                        if ($item->name != 'Sulfuras, Hand of Ragnaros' or $item != 'Backstage passes') {
                            $item->quality = $item->quality - 1;
                        }
                    }
                } else {
                    //drop to 0 because of the concert
                    $item->quality = $item->quality - $item->quality;
                }
            }else {
                if ($item->quality < $this->maxValue) {
                    $item->quality = $item->quality + 1;
                }
            }
        }
    }
}

