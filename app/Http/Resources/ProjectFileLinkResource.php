<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectFileLinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'file_name' => $this->file_name,
            'file_link' => $this->file_link,
            'access_url' => !$this->is_external ? $this->generateSecureFileUrl($this->id) : null,
            'is_external' => (bool) $this->is_external,
            'created_at' => $this->created_at ? $this->created_at->toIso8601String() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toIso8601String() : null,
        ];
    }

    /**
     * Generate a secure URL for accessing a file.
     *
     * @param int $fileId
     * @return string
     */
    protected function generateSecureFileUrl(int $fileId): string
    {

        return URL::signedRoute('view.project.file', [
            'id' => $fileId
        ]);
    }
}
