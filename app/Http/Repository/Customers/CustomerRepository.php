<?php 

namespace App\Http\Repository\Customers;

use App\Models\Customer;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerRepository extends BaseRepository {
    /*** Attach Repo To Model */
    public function model()
    {
        return Customer::class;
    }

    /*** Upsert Customer */
    public function upsertCustomer($request)
    {
        return $this->updateOrCreate(
        [
            'id' => $request->id
        ],    
        [
            'name' => $request->name,
            'birthday'    => $request->birthday,
            'phone'    => $request->phone,
        ]);
    }

    /*** Delete Customer */
    public function deleteCustomer($customer_id)
    {
        // Get Customer Under Action
        $customer = $this->find($customer_id);

        // Delete Relations
        $customer->attributes()->detach();
        
        // Delete Customer
        return $this->where('id',$customer_id)->delete();
    }


    /*** Filter Customer Data */
    public function filter($request)
    {
        return Customer::filter($request);
    }

    /*** Fill Customer Attributes */
    public function fillCustomerAttributes($customer_id,$values)
    {   
        // Get Customer Under Action
        $customer = $this->find($customer_id);

        // Sync Attributes
        $customer->attributes()->sync($values);

        return $customer;
    }

    /*** Borrow Book */
    public function borrowBook($request)
    {
        // Get Customer Under Action
        $customer = $this->find($request->customer_id);

        // Sync Attributes
        $customer->books()->attach([
            $request->book_id => [
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date
            ]
        ]);

        return $customer;
    }
}