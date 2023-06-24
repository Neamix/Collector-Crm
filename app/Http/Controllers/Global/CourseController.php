<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Repository\Courses\CourseAttributeRepository;
use App\Http\Repository\Courses\CourseRepository;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

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

    /*** List Course Attributes */
    public function attributesList()
    {
        $result = $this->courseAttributeRepository->attributesList();

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
            ]
        ]);
    }

    /*** Filter All Course */
    public function filter(Request $request)
    {
        $result = $this->courseRepository->filter($request->all())->with(['attributes','instractor'])->paginate(10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result->items(),
                'total_pages'  => $result->lastPage(),
                'current_page' => $result->currentPage()
            ]
        ]);
    }

    /*** Get Course */
    public function getCourse($course_id)
    {
        $course = $this->courseRepository->find($course_id);

        return $this->response(200,[
            'status'   => SUCCESS,
            'payload'  => [
                'name' => $course->name,
                'subject' => $course->subject,
                'instractor' => $course->instractor,
                'start_date' => $course->start_date,
                'end_date'   => $course->end_date,
                'attributes' => $course->attributes
            ]
        ]);
    }

    /*** Fill Course Attributes */
    public function fillCourseAttributes(Request $request)
    {
        $course = $this->courseRepository->fillCourseAttributes($request->course_id,$request->values);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attributes' => $course->attributes,
            ]
        ]);
    }
}
