<?php

namespace App\Services;

use App\Models\User;
use App\Models\BusinessInfo;
use App\Models\CoopUserInfo;
use App\Models\PersonalInfo;


class GetPersonalRecordService
{
    public function getCooperatorPersonalInfo($userid)
    {
        return User::where('id', $userid)->with('coopUserInfo.businessInfo.addressInfo', 'addressInfo')->first();
    }
}
