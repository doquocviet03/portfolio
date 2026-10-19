<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        // Nội dung tiếng Việt
        'title',
        'description',
        'image',
        'technologies',
        'github_url',
        'demo_url',
        'features',
        'challenges',
        'results',

        // Nội dung tiếng Anh
        'title_en',
        'description_en',
        'features_en',
        'challenges_en',
        'results_en',
    ];

    /**
     * Lấy nội dung dự án theo ngôn ngữ hiện tại.
     *
     * VI: Hiển thị tiếng Việt.
     * EN: Ưu tiên tiếng Anh, nếu chưa dịch thì dùng tiếng Việt.
     */
    public function translated(string $field): ?string
    {
        $allowedFields = [
            'title',
            'description',
            'features',
            'challenges',
            'results',
        ];

        if (!in_array($field, $allowedFields, true)) {
            return null;
        }

        $vietnamese = $this->getAttribute($field);

        if (app()->getLocale() === 'en') {
            $english = $this->getAttribute($field . '_en');

            if (is_string($english) && trim($english) !== '') {
                return $english;
            }
        }

        return $vietnamese;
    }
}
