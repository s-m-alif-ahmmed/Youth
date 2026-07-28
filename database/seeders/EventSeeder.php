<?php

namespace Database\Seeders;

use App\Models\Admin\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'name'         => 'Urban Fest Drop 2026',
                'event_slug'   => 'urban-fest-drop-2026',
                'image'        => SeederHelper::getExistingImage('event', 0, 'Urban Fest Drop 2026 Banner'),
                'alt'          => 'Urban Fest Drop 2026 Banner',
                'status'       => 'active',
                'first_status' => 'active',
            ],
            [
                'name'         => 'Winter Warmup Special',
                'event_slug'   => 'winter-warmup-special',
                'image'        => SeederHelper::getExistingImage('event', 0, 'Winter Warmup Special Banner'),
                'alt'          => 'Winter Warmup Special Banner',
                'status'       => 'active',
                'first_status' => 'off',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['event_slug' => $event['event_slug']], $event);
        }
    }
}
