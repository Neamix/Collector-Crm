<?php

namespace App\Http\Controllers;

use App\Http\Repository\Settings\SettingRepository;
use App\Http\Requests\SettingRequest;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

class SettingContoller extends Controller
{
    use  ResponseService;

    public $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /*** Change System Setting */
    public function changeSystem(SettingRequest $request)
    {
        $this->settingRepository->changeSystem($request->option,$request->value);

        return  $this->response(200,[
            'setting' => [
                'option' => $request->option,
                'value'  => $request->value
            ]
        ]);
    }
}
