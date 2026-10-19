<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        // Thông tin tiếng Việt
        'full_name',
        'job_title',
        'field',
        'location',
        'short_bio',
        'about_me',
        'career_goal',

        // Thông tin tiếng Anh
        'job_title_en',
        'field_en',
        'short_bio_en',
        'about_me_en',
        'career_goal_en',

        // Ảnh và thông tin liên hệ
        'avatar',
        'contact_email',
        'phone',
        'github_url',
        'facebook_url',
        'linkedin_url',
        'cv_path',
    ];

    /**
     * Lấy nội dung Profile theo ngôn ngữ hiện tại.
     * EN: ưu tiên bản dịch tiếng Anh.
     * Nếu chưa có bản dịch, dùng tiếng Việt.
     */
    public function translated(string $field): ?string
    {
        $allowedFields = [
            'job_title',
            'field',
            'short_bio',
            'about_me',
            'career_goal',
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
