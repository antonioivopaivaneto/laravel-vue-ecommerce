<?php

namespace App\Http\Controllers;

use App\Enums\AddressType;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function view(Request $request){


        $user = $request->user();
        $customer = $user->customer;
        $shippingAddress = $customer->shippingAddress ?: new CustomerAddress(['type' => AddressType::Shipping]);
        $billingAddress = $customer->billingAddress ?: new CustomerAddress(['type' => AddressType::Billing]);
        //dd($customer,$shippingAddress->attributesToArray(),$billingAddress,$billingAddress->customer);;
        $countries = Country::query()->orderBy('name')->get();


        return view('profile.view',compact('user','shippingAddress','billingAddress','countries','customer'));

    }

    public function store(ProfileRequest $request)
    {
        $customerData = $request->validated();
        $shippingData = $customerData['shipping'];
        $billingData = $customerData['billing'];

        $user = $request->user();
        $$customer = $user->customer;

        $customer->update($customerData);


        if($customer->shippingAddress){
            $customer->shppingAddress->update($shippingData);
        }else{
            $shippingData['customer_id'] = $customer->user_id;
            $shippingData['type'] = AddressType::Shipping->value;
            CustomerAddress::create($shippingData);
        }
        if($customer->billingAddress){
            $customer->billingAddress->update($billingData);
        }else{
            $billingData['customer_id'] = $customer->user_id;
            $billingData['type'] = AddressType::Billing->value;
            CustomerAddress::create($billingData );

        }

        $shippingAddress = $customer->shippingAddress ?: new CustomerAddress(['type' => AddressType::Shipping]);
        $billingAddress = $customer->billingAddress ?: new CustomerAddress(['type' => AddressType::Billing]);


        $shippingAddress->save($shippingData);
        $billingAddress->save($billingData);

        $request->session()->flash('flash_message','Profile was successfully updated.');

        return redirect()->route('profile');



    }

    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $user = $request->user();

        $passwordData = $request->validete();

        $user->password = Hash::make($passwordData['new_password']);
        $user->save();

        $request->session()->flash('flash_message','password was successfully updated.');

        return redirect()->route('profile');



    }
}
