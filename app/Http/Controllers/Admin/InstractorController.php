<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Instractors\InstractorAttributeRepository;
use App\Http\Repository\Instractors\InstractorRepository;
use App\Http\Requests\InstractorAttributesRequest;
use App\Http\Requests\InstractorRequest;
use App\Http\Services\ResponseService;

class InstractorController extends Controller
{
    use ResponseService;

    public $instractorRepository;
    public $instractorAttributeRepository;

    public function __construct(InstractorRepository $instractorRepository,InstractorAttributeRepository $instractorAttributeRepository)
    {
        $this->instractorRepository = $instractorRepository;
        $this->instractorAttributeRepository = $instractorAttributeRepository;
    }

    /*** Upsert Instractor */
    public function upsertInstractor(InstractorRequest $request) 
    {
        $instractor = $this->instractorRepository->upsertInstractor($request);
        
        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'name'  => $instractor->name,
                'year_of_experience' => $instractor->year_of_experience,
                'birthday' => $instractor->birthday 
            ]
        ]);
    }

    /*** Delete Instractor */
    public function deleteInstractor($instractor_id)
    {
        $this->instractorRepository->deleteInstractor($instractor_id);

        return $this->response(200,[
            'status' => SUCCESS
        ]);
    }

    /*** Add Custom Attributes To Instractor */
    public function upsertInstractorAttributes(InstractorAttributesRequest $request)
    {
        $attributes = $this->instractorAttributeRepository->upsertInstractorAttributes($request);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attribute' => $attributes->attribute
            ]
        ]);
    }

    /*** Delete Instractor Attributes */
    public function deleteInstractorAttributes($attribute_id)
    {
        $this->instractorAttributeRepository->deleteInstractorAttributes($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
        ]);
    }

    /*** Get Attribute */
    public function getAttribute($attribute_id)
    {
        $attribute = $this->instractorAttributeRepository->find($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'id' => $attribute->id,
                'attribute' => $attribute->attribute
            ]
        ]);
    }
}
