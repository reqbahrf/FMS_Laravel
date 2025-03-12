<?php

namespace App\Repositories;

use App\Models\ProjectFileLink;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectFileLinkRepository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param ProjectFileLink $model
     */
    public function __construct(ProjectFileLink $model)
    {
        $this->model = $model;
    }

    /**
     * Find a record by ID or fail.
     *
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get records by project ID.
     *
     * @param string $projectId
     * @return Collection
     */
    public function getByProjectId(string $projectId): Collection
    {
        return $this->model
            ->where('Project_id', $projectId)
            ->select('id', 'file_name', 'file_link', 'created_at', 'is_external')
            ->get();
    }

    /**
     * Update a project link.
     *
     * @param string $linkName
     * @param string $projectId
     * @param string $newName
     * @param string $newLink
     * @return bool
     */
    public function updateLink(string $linkName, string $projectId, string $newName, string $newLink): bool
    {

        return $this->model
            ->where('file_name', $linkName)
            ->where('Project_id', $projectId)
            ->update([
                'file_name' => $newName,
                'file_link' => $newLink,
            ]) > 0;
    }

    /**
     * Delete a record.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete() > 0;
    }

    /**
     * Insert multiple records.
     *
     * @param array $records
     * @return bool
     */
    public function insertMultiple(array $records): bool
    {
        return $this->model->insert($records);
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        return $this->model->create($data) !== null;
    }
}
