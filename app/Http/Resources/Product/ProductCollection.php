<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            "Total price"=>round((1-$this->discount/100)*$this->price),
            "rating"=>$this->rewiers->count() ? round( $this->rewiers->sum('star')/$this->rewiers->count(),2) : "No rating",
            'href'=>[
                'link'=>route('product.show',$this->id)
            ]
        ];
    }
}

