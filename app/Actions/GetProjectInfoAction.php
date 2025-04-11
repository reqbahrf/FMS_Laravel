<?php

namespace App\Actions;

use App\Models\ProjectInfo;

class GetProjectInfoAction
{
    public function execute($projectId)
    {
        return ProjectInfo::find($projectId);
    }
}
