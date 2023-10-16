<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PostImport implements ToCollection
{
    /**
     * @param Collection $row
     */
    public function collection(Collection $rows)
    {
        $skipFirstRow = true;

        foreach ($rows as $row) {
            if ($skipFirstRow) {
                $skipFirstRow = false;
                continue;
            }

            $title = $row[0];
            $description = $row[1];
            $publicFlag = $row[2];
            $createdBy = $row[3];
            $updatedBy = $row[4];

            $publicFlagVlidate = filter_var($publicFlag, FILTER_VALIDATE_BOOLEAN);

            if (!empty($title) && ($publicFlagVlidate || !$publicFlagVlidate) && is_numeric($createdBy) && is_numeric($updatedBy)) {
                Post::create([
                    'title' => $title,
                    'description' => $description,
                    'public_flag' => $publicFlag,
                    'created_by' => $createdBy,
                    'updated_by' => $updatedBy,
                ]);
            }
        }
    }
}
