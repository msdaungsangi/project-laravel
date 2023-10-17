<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::select('title', 'description', 'public_flag', 'created_by', 'updated_by')
            ->get();
    }
    
    /**
     * headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Public Flag',
            'Created By',
            'Updated By',
        ];
    }
}
