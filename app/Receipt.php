<?php
/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/19/2017
 * Time: 5:27 PM
 */

namespace App;
use App\Exception\BadMethodException;

class Receipt {

    public function total(array $items = [], $coupon) {
        $sum = array_sum($items);
        if($coupon>1.0) {
            throw new BadMethodException('Coupon must be <=1.0', 5);
        }
        if(!is_null($coupon)) {
            return $sum - ($sum * $coupon);
        }
        return $sum;
    }

    public function tax($amount, $tax) {
        return $amount * $tax;
    }

    public function postTaxTotal($items, $tax, $coupon) {
        $subtotal = $this->total($items, $coupon);
        return $subtotal + $this->tax($subtotal, $tax);
    }
}