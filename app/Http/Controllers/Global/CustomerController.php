<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Repository\Customers\CustomerAttributeRepository;
use App\Http\Repository\Customers\CustomerRepository;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

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

    /*** List Customer Attributes */
    public function attributesList()
    {
        $result = $this->customerAttributeRepository->attributesList();

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
            ]
        ]);
    }

    /*** Filter All Customer */
    public function filter(Request $request)
    {
        $result = $this->customerRepository->filter($request->all())->with(['attributes'])->paginate(10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result->items(),
                'total_pages'  => $result->lastPage(),
                'current_page' => $result->currentPage()
            ]
        ]);
    }

    /*** Get Customer */
    public function getCustomer($customer_id)
    {
        $customer = $this->customerRepository->find($customer_id);

        return $this->response(200,[
            'status'   => SUCCESS,
            'payload'  => [
                'name' => $customer->name,
                'birthday' => $customer->birthday,
                'phone' => $customer->phone
            ]
        ]);
    }

    /*** Fill Customer Attributes */
    public function fillCustomerAttributes(Request $request)
    {
        $customer = $this->customerRepository->fillCustomerAttributes($request->customer_id,$request->values);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attributes' => $customer->attributes,
            ]
        ]);
    }
}
