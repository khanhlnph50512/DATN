<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
   public function run(): void
{
    Post::create([
        'title' => 'Bài viết đầu tiên',
        'slug' => 'bai-viet-dau-tien',
        'content' => '<p>Đây là nội dung của bài viết đầu tiên.</p>',
    ]);
}
};
