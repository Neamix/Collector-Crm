<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Students\StudentRepository;
use App\Http\Requests\AttributesSchemaRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Services\ResponseService;
use App\Models\AttributeSchema;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ResponseService;

    public $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
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
        $this->studentRepository->delete($student_id);

        return $this->response(200,[
            'status' => SUCCESS
        ]);
    }

    /*** Get Specific Student */
    public function getStudent($student_id)
    {
        $student = $this->studentRepository->findOne($student_id);
        
        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'name'  => $student->name,
                'email' => $student->email,
            ]
        ]);
    }

    /*** Add Custom Field */
    public function addCustomFields(AttributesSchemaRequest $request)
    {
        $field = $this->studentRepository->addCustomField($request);

        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'field' => $field,
                'model' => 'Student'
            ]
        ]);
    }
}
