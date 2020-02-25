<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'transaction_type' => $this->transaction_type,
            'amount' => $this->amount,
            'date_performed' => date('d-m-Y h:ia', strtotime($this->created_at))
        ];
    }
}
