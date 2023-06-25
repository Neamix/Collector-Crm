<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Customers\CustomerAttributeRepository;
use App\Http\Repository\Customers\CustomerRepository;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\CustomerAttributeRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Services\ResponseService;

class CustomerController extends Controller
{
    use ResponseService;

    public $customerRepository;
    public $customerAttributeRepository;

    public function __construct(CustomerRepository $customerRepository,CustomerAttributeRepository $customerAttributeRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->customerAttributeRepository = $customerAttributeRepository;
    }

    /*** Upsert Customer */
    public function upsertCustomer(CustomerRequest $request) 
    {
        $customer = $this->customerRepository->upsertCustomer($request);
        
        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'name'    => $customer->name,
                'birthday' => $customer->birthday,
                'attributes' => $customer->attributes
            ]
        ]);
    }

    /*** Delete Customer */
    public function deleteCustomer($customer_id)
    {
        $this->customerRepository->deleteCustomer($customer_id);

        return $this->response(200,[
            'status' => SUCCESS
        ]);
    }

    /** Borrow Book */
    public function borrowBook(BorrowBookRequest $request)
    {
        $customer  = $this->customerRepository->borrowBook($request);

        return $this->response(200,[
            'status' => SUCCESS,
            'name' => $customer->name,
            'books' => $customer->books
        ]);
    }

    /*** Upsert Custom Attributes To Customer */
    public function upsertCustomerAttributes(CustomerAttributeRequest $request)
    {
        $attributes = $this->customerAttributeRepository->upsertCustomerAttributes($request);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attribute' => $attributes->attribute
            ]
        ]);
    }

    /*** Delete Customer Attributes */
    public function deleteCustomerAttributes($attribute_id)
    {
        $this->customerAttributeRepository->deleteCustomerAttributes($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
        ]);
    }

    /*** Get Attribute */
    public function getAttribute($attribute_id)
    {
        $attribute = $this->customerAttributeRepository->find($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'id' => $attribute->id,
                'attribute' => $attribute->attribute
            ]
        ]);
    }
}
