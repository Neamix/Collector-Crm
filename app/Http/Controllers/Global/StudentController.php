<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Repository\Students\StudentAttributeRepository;
use App\Http\Repository\Students\StudentRepository;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ResponseService;

    public $studentRepository;
    public $studentAttributeRepository;

    public function __construct(StudentRepository $studentRepository,StudentAttributeRepository $studentAttributeRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->studentAttributeRepository = $studentAttributeRepository;
    }

    /*** List Student Attributes */
    public function attributesList()
    {
        $result = $this->studentRepository->attributesList();

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
            ]
        ]);
    }

    /*** Filter All Student */
    public function filter(Request $request)
    {
        $result = $this->studentRepository->filter($request->all())->with(['attributes'])->paginate(10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
                'total_pages'  => $result->lastPage(),
                'current_page' => $result->currentPage()
            ]
        ]);
    }

    /*** Fill Student Attributes */
    public function fillStudentAttributes(Request $request)
    {
        $student = $this->studentAttributeRepository->fillStudentAttributes($request->student_id,$request->values);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attributes' => $student->attributes,
            ]
        ]);
    }
}
