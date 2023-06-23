<?php

namespace App\Http\Repository\Settings;

use App\Models\Setting;
use Prettus\Repository\Eloquent\BaseRepository;

class SettingRepository extends BaseRepository {

    public function model()
    {
        return Setting::class;
    }

    /*** Change System Type */
    public function changeSystem($type,$value)
    {
        return $this->where('option',$type)->update(['value' => $value]);
    }
}