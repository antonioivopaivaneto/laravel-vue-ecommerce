<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $customer = $this->user->customer;
        $shipping = $customer->shippingAddress;
        $billing = $customer->billingAddress;

        return[
            'id' =>$this->id,
            'status' =>$this->status,
            'total_price' =>$this->total_price,
            'items' =>$this->items->map(fn($item) => [
                'id' => $item->id,
                'unit_price' => $item->id,
                'quantity' => $item->quantity,
                'product'=> [
                    'id' => $item->product->id,
                    'slug' => $item->product->slug,
                    'title' => $item->product->title,
                    'image' => $item->product->image,
                ]
            ]),
            'customer' => [
                'id' => $this->user->id,
                'first_name' => $this->user->customer->first_name,
                'last_name' => $this->user->customer->last_name,
                'email' => $this->user->email,
                'phone' => $this->user->customer->phone ?? null,
                'shippingAddress' =>[
                    'id' => $this->user->customer->shippingAddress->id,
                    'address1' => $this->user->customer->shippingAddress->address1,
                    'address2' => $this->user->customer->shippingAddress->address2,
                    'city' => $this->user->customer->shippingAddress->city,
                    'state' => $this->user->customer->shippingAddress->state,
                    'zipcode' => $this->user->customer->shippingAddress->zipcode,
                    'country' => $this->user->customer->shippingAddress->country->name,
                ],
                'billingAddress' => [
                    'id' => $this->user->customer->billingAddress->id,
                    'address1' => $this->user->customer->billingAddress->address1,
                    'address2' => $this->user->customer->billingAddress->address2,
                    'city' => $this->user->customer->billingAddress->city,
                    'state' => $this->user->customer->billingAddress->state,
                    'zipcode' => $this->user->customer->billingAddress->zipcode,
                    'country' => $this->user->customer->billingAddress->country->name,

                ],


            ],
            'created_at' =>(new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' =>(new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
        ];
    }
}
