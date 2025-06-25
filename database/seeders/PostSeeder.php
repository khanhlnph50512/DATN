<?php

namespace Database\Seeders;

use App\Models\Admin\Blog;
use App\Models\Admin\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
   public function run(): void
{
    Blog::create([
        'title' => 'Bài viết đầu tiên',
        'slug' => 'bai-viet-dau-tien',
        'content' => '<p>Đây là nội dung của bài viết đầu tiên.</p>',
    ]);
}
};
