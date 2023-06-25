<?php

namespace App\Http\Repository\Customers;

use App\Models\CustomerAttribute;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerAttributeRepository extends BaseRepository {

    public function model()
    {
        return CustomerAttribute::class;
    }

    /*** Upsert Customer Attributes */
    public function upsertCustomerAttributes($request)
    {
        return $this->updateOrCreate([
            'id'  => $request->id
        ],[
            'attribute' => $request->attribute
        ]);
    }

    /*** Get Customer Attributes List */
    public function attributesList()
    {
        return $this->all();
    }


    /*** Delete Customer Attributes */
    public function deleteCustomerAttributes($attribute_id)
    {
        // Get Attribute Under Action
        $attribute = $this->find($attribute_id);

        // Detach Attribute 
        $attribute->customers()->detach();

        // Delete Attribute
        $attribute->delete();
    }

}