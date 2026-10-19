<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        // Nội dung tiếng Việt
        'title',
        'company',
        'description',

        // Nội dung tiếng Anh
        'title_en',
        'company_en',
        'description_en',

        // Thời gian làm việc
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Lấy nội dung theo ngôn ngữ hiện tại.
     * Nếu chưa có tiếng Anh thì hiển thị tiếng Việt.
     */
    public function translated(string $field): ?string
    {
        if (!in_array($field, [
            'title',
            'company',
            'description',
        ], true)) {
            return null;
        }

        $vietnamese = $this->getAttribute($field);

        if (app()->getLocale() === 'en') {
            $english = $this->getAttribute($field . '_en');

            if (
                is_string($english) &&
                trim($english) !== ''
            ) {
                return $english;
            }
        }

        return $vietnamese;
    }
}
