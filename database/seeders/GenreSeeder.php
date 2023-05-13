<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->data() as $item) {
            Genre::query()
                ->updateOrCreate(
                    ['title' => $item['title']],
                    $item,
                );
        }
    }

    private function data(): array
    {
        return [
            [
                'title' => 'Action',
            ],
            [
                'title' => 'Animation',
            ],
            [
                'title' => 'Comedy',
            ],
            [
                'title' => 'Crime',
            ],
            [
                'title' => 'Drama',
            ],
            [
                'title' => 'Fantasy',
            ],
            [
                'title' => 'Historical',
            ],
            [
                'title' => 'Horror',
            ],
            [
                'title' => 'Romance',
            ],
            [
                'title' => 'Science Fiction',
            ],
            [
                'title' => 'Thriller',
            ],
            [
                'title' => 'Western',
            ],
        ];
    }
}
