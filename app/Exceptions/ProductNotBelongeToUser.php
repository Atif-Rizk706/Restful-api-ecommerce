<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongeToUser extends Exception
{
    public function render(){
        return ['data'=>'Product Not Belong To User'];
    }
}
