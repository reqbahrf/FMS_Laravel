<?php

namespace App\Services;

use Exception;
use App\Models\CoopUserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class getCooperatorInfoService
{
    private $coopUserInfo;

    public function __construct(CoopUserInfo $coopUserInfo)
    {
        $this->coopUserInfo = $coopUserInfo;
    }

    public function getCooperatorInfo($Coop_Username = null)
    {
        try {
            $userName = $Coop_Username ?? Auth::user()->user_name;
            return $this->coopUserInfo
                ->where('user_name', $userName)
                ->with('BusinessInfo.applicationInfo.projectInfo')
                ->get()
                ->flatMap
                ->BusinessInfo;
        }catch (Exception $e) {
           Log::error($e->getMessage());
        }
    }
}
