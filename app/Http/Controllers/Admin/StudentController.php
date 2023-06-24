<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Students\StudentAttributeRepository;
use App\Http\Repository\Students\StudentRepository;
use App\Http\Requests\StudentAttributesRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Services\ResponseService;

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

    /*** Upsert Student */
    public function upsertStudent(StudentRequest $request) 
    {
        $student = $this->studentRepository->upsertStudent($request);
        
        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'name'  => $student->name,
                'grade' => $student->grade,
                'birthday' => $student->birthday 
            ]
        ]);
    }

    /*** Delete Student */
    public function deleteStudent($student_id)
    {
        $this->studentRepository->deleteStudent($student_id);

        return $this->response(200,[
            'status' => SUCCESS
        ]);
    }

    /*** Add Custom Attributes To Student */
    public function upsertStudentAttributes(StudentAttributesRequest $request)
    {
        $attributes = $this->studentAttributeRepository->upsertStudentAttributes($request);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attribute' => $attributes->attribute
            ]
        ]);
    }

    /*** Delete Student Attributes */
    public function deleteStudentAttributes($attribute_id)
    {
        $this->studentAttributeRepository->deleteStudentAttributes($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
        ]);
    }

    /*** Get Attribute */
    public function getAttribute($attribute_id)
    {
        $attribute = $this->studentAttributeRepository->find($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'id' => $attribute->id,
                'attribute' => $attribute->attribute
            ]
        ]);
    }
}
