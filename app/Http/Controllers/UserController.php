<?php

namespace App\Http\Controllers;

use App\Http\Repository\Users\UserRepository;
use App\Http\Requests\OperatorRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseService;

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /*** Authunticate User */
    public function login(UserLoginRequest $request) 
    {
        $token = $this->userRepository->login($request);
    
        if ( $token ) {
            // Success Login 
            return $this->response(200,[
                'status'    => SUCCESS,
                'payload'   => [
                    'name'  => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'token' => $token,
                ]
            ]);
        }

        // Failed Authuntication
        return $this->response(419,[
            'status'  => FAIL,
        ],__('validation.failed_to_authunticate_this_user'));
    }

    /*** Create Operator */
    public function upsertOperator(OperatorRequest $request) 
    {
        $operator = $this->userRepository->upsertOperator($request);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'name'  => $operator->name,
                'email' => $operator->email,
            ]
        ]);
    }

    /*** Get Operator */
    public function getOperator($operator_id)
    {
        $operator = $this->userRepository->findOne($operator_id);
        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'name'  => $operator->name,
                'email' => $operator->email,
            ]
        ]);
    }

    /*** Delete Operator */
    public function deleteOperator($operator_id)
    {
        $this->userRepository->deleteOperator($operator_id);
        return $this->response(200,[
            'status'  => SUCCESS,
        ]);
    }

    /*** Filter Operators */
    public function filter(Request $request)
    {
        $result = $this->userRepository->filter($request)->paginate($request->item_per_page ?? 10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result->data,
                'total_pages'  => $result->total_pages,
                'current_page' => $result->current_page
            ]
            ]);
    }
}
