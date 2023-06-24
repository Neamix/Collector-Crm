<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Courses\CourseAttributeRepository;
use App\Http\Repository\Courses\CourseRepository;
use App\Http\Requests\CourseAttendingRequest;
use App\Http\Requests\CourseAttributeRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Services\ResponseService;
use GuzzleHttp\Psr7\Request;

class CourseController extends Controller
{
    use ResponseService;

    public $courseRepository;
    public $courseAttributeRepository;

    public function __construct(CourseRepository $courseRepository,CourseAttributeRepository $courseAttributeRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->courseAttributeRepository = $courseAttributeRepository;
    }

    /*** Upsert Course */
    public function upsertCourse(CourseRequest $request) 
    {
        $course = $this->courseRepository->upsertCourse($request);
        
        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'name'    => $course->name,
                'subject' => $course->subject,
                'start_date' => $course->start_date,
                'end_date'   => $course->end_date,
                'instractor' => $course->instractor->only('id','name'),
                'attributes' => $course->attributes
            ]
        ]);
    }

    /*** Delete Course */
    public function deleteCourse($course_id)
    {
        $this->courseRepository->deleteCourse($course_id);

        return $this->response(200,[
            'status' => SUCCESS
        ]);
    }

    /*** Upsert Custom Attributes To Course */
    public function upsertCourseAttributes(CourseAttributeRequest $request)
    {
        $attributes = $this->courseAttributeRepository->upsertCourseAttributes($request);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attribute' => $attributes->attribute
            ]
        ]);
    }

    /*** Delete Course Attributes */
    public function deleteCourseAttributes($attribute_id)
    {
        $this->courseAttributeRepository->deleteCourseAttributes($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
        ]);
    }

    /*** Get Attribute */
    public function getAttribute($attribute_id)
    {
        $attribute = $this->courseAttributeRepository->find($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'id' => $attribute->id,
                'attribute' => $attribute->attribute
            ]
        ]);
    }

    /*** Add Student To The Course */
    public function addStudent(CourseAttendingRequest $request)
    {
        $this->courseRepository->addStudent($request);

        return $this->response(200,[
            'status' => SUCCESS,
        ]);
    }
}
