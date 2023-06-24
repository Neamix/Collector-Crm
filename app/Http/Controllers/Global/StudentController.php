<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Repository\Students\StudentRepository;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ResponseService;

    public $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /*** Fill Entity Attributes */
    public function fillAttributes(Request $request)
    {
        $student = $this->studentRepository->fillStudentAttributes($request);

        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'name' => $student->name,
                'attributes' => $student->loadAttributes()
            ]
        ]);
    } 

    /*** Filter All Student */
    public function filter(Request $request)
    {
        $result = $this->studentRepository->filter($request->all())->with(['attributesValues'])->paginate(10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
                'total_pages'  => $result->lastPage(),
                'current_page' => $result->currentPage()
            ]
        ]);
    }
}
