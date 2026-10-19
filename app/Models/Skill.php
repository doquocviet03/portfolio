<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        // Nội dung tiếng Việt
        'name',
        'description',

        // Nội dung tiếng Anh
        'name_en',
        'description_en',

        // Thông tin kỹ năng
        'level',
        'type',
        'icon',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Lấy nội dung theo ngôn ngữ VI / EN.
     * Nếu chưa có bản dịch tiếng Anh, dùng tiếng Việt.
     */
    public function translated(string $field): ?string
    {
        if (!in_array($field, ['name', 'description'], true)) {
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

    public function scopeProgramming($query)
    {
        return $query->where('type', 'programming');
    }

    public function scopePersonal($query)
    {
        return $query->where('type', 'personal');
    }
}
