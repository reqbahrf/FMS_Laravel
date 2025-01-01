<?php

namespace App\Services;

use Exception;
use App\Models\CoopUserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GetCooperatorInfoService
{
    private $coopUserInfo;

    public function __construct(CoopUserInfo $coopUserInfo)
    {
        $this->coopUserInfo = $coopUserInfo;
    }

    private function getCooperatorInfo(?string $Coop_Username, ?string $with): object
    {
        try {
            $userName = $Coop_Username ?? Auth::user()->user_name;
            return $this->coopUserInfo
                ->where('user_name', $userName)
                ->with($with)
                ->get()
                ->flatMap(fn($item) => $item->BusinessInfo);
        } catch (Exception $e) {
            Log::error('Error getting cooperator info: ' . $e->getMessage());
            throw new Exception("Error processing cooperator information request", 1, $e);
        }
    }

    public function getCoopBusinessInfo(?string $Coop_Username = null): object
    {
        try {
            $with_query = 'BusinessInfo';
            return $this->getCooperatorInfo($Coop_Username,  $with_query);
        } catch (Exception $e) {
            Log::error('Error getting business info: ' . $e->getMessage());
            throw new Exception("Error retrieving business information", 1, $e);
        }
    }

    public function getCoopBusinessApplicationInfo(?string $Coop_Username = null): object
    {
        try {
            $with_query = 'BusinessInfo.applicationInfo';
            return $this->getCooperatorInfo($Coop_Username,  $with_query);
        } catch (Exception $e) {
            Log::error('Error getting business and application info: ' . $e->getMessage());
            throw new Exception("Error retrieving business application information", 1, $e);
        }
    }

    public function getAllCoopInfo(?string $Coop_Username = null): object
    {
        try {
            $with_query = 'BusinessInfo.applicationInfo.projectInfo';
            return $this->getCooperatorInfo($Coop_Username,  $with_query);
        } catch (Exception $e) {
            Log::error('Error getting all cooperator info: ' . $e->getMessage());
            throw new Exception("Error Processing Request", 1, $e);
        }
    }
}
