<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResouece extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            "description"=>$this->detales,
            "price"=>$this->price,
            "stock"=>$this->stock,
            "discount"=>$this->discount,
            "Total price"=>round((1-$this->discount/100)*$this->price),
            "rating"=>$this->rewiers->count() ? round( $this->rewiers->sum('star')/$this->rewiers->count(),2) : "No rating",

            "href"=>[
                "reviwers"=>route('reviews.index',$this->id)
            ]
        ];
    }
}
