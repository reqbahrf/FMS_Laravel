<?php

namespace App\Policies;

use App\Models\ProjectFileLink;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectFileLinkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProjectFileLink $projectFileLink): bool
    {
        return $this->userCanAccessFile($user, $projectFileLink);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProjectFileLink $projectFileLink): bool
    {
        return $this->userCanAccessFile($user, $projectFileLink);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProjectFileLink $projectFileLink): bool
    {
        return $this->userCanAccessFile($user, $projectFileLink);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProjectFileLink $projectFileLink): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProjectFileLink $projectFileLink): bool
    {
        return false;
    }

    protected function userCanAccessFile(User $user, ProjectFileLink $projectFileLink): bool
    {
        // Get the project ID associated with this file
        $projectId = $projectFileLink->Project_id;

        // If no project is associated, deny access
        if (!$projectId) {
            return false;
        }

        // Check if user is a staff member with access to this project
        if ($user->isStaff() && $user->orgUserInfo->isHandlingThisProject($projectId)) {
            return true;
        }

        return false;
    }
}
