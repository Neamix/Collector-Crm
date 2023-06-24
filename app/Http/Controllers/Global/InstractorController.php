<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Repository\Instractors\InstractorAttributeRepository;
use App\Http\Repository\Instractors\InstractorRepository;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

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

    /*** List Instractor Attributes */
    public function attributesList()
    {
        $result = $this->instractorAttributeRepository->attributesList();

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
            ]
        ]);
    }

    /*** Filter All Instractor */
    public function filter(Request $request)
    {
        $result = $this->instractorRepository->filter($request->all())->with(['attributes'])->paginate(10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result->items(),
                'total_pages'  => $result->lastPage(),
                'current_page' => $result->currentPage()
            ]
        ]);
    }

    /*** Get Instractor */
    public function getInstractor($instractor_id)
    {
        $instractor = $this->instractorRepository->find($instractor_id);

        return $this->response(200,[
            'status'   => SUCCESS,
            'payload'  => [
                'name' => $instractor->name,
                'birthday' => $instractor->birthday,
                'year_of_experience' => $instractor->year_of_experience,
                'attributes' => $instractor->attributes
            ]
        ]);
    }

    /*** Fill Instractor Attributes */
    public function fillInstractorAttributes(Request $request)
    {
        $instractor = $this->instractorRepository->fillInstractorAttributes($request->instractor_id,$request->values);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attributes' => $instractor->attributes,
            ]
        ]);
    }
}
