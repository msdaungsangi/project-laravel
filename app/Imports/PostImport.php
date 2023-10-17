<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class PostImport implements ToCollection, WithValidation
{
    /**
     * @param Collection $row
     */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            $skipFirstRow = true;

            foreach ($rows as $row) {
                if ($skipFirstRow) {
                    $skipFirstRow = false;
                    continue;
                }

                $title = $row[0];
                $description = $row[1];
                $publicFlag = $row[2];

                $publicFlagValidate = filter_var($publicFlag, FILTER_VALIDATE_BOOLEAN);

                if ($publicFlagValidate || !$publicFlag) {
                    Post::create([
                        'title' => $title,
                        'description' => $description,
                        'public_flag' => $publicFlagValidate,
                        'created_by' => Auth::user()->id,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function rules(): array
    {
        return [
            '0' => 'required|max:255',
            '1' => 'nullable',
            '2' => 'required|',
        ];
    }
}
