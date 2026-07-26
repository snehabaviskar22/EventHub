<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@eventhub.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '0000000000',
            'academic_program' => 'Administration',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'student@eventhub.com',
            'password' => bcrypt('student123'),
            'role' => 'student',
            'phone' => '9876543210',
            'academic_program' => 'MCA',
        ]);

        $events = [
            [
                'title' => 'Annual Tech Fest 2025',
                'description' => 'Join us for the biggest technology festival of the year! Featuring coding competitions, robotics showcases, tech talks from industry leaders, and an exciting hackathon with prizes worth ₹1,00,000.',
                'event_date' => now()->addDays(15)->format('Y-m-d'),
                'start_time' => '09:00',
                'end_time' => '18:00',
                'venue' => 'Main Auditorium',
                'price' => 250.00,
                'available_seats' => 200,
                'booking_deadline' => now()->addDays(10)->format('Y-m-d'),
                'eligible_programs' => 'BCA, MCA, B.Tech, M.Tech',
                'open_to_all' => false,
                'is_published' => true,
            ],
            [
                'title' => 'Cultural Night - Rhythm 2025',
                'description' => 'An evening of music, dance, and drama performances by our talented students. Experience the vibrant cultural diversity of our college with live performances, food stalls, and more.',
                'event_date' => now()->addDays(7)->format('Y-m-d'),
                'start_time' => '18:00',
                'end_time' => '21:00',
                'venue' => 'Open Air Theatre',
                'price' => 0,
                'available_seats' => 500,
                'booking_deadline' => now()->addDays(5)->format('Y-m-d'),
                'eligible_programs' => null,
                'open_to_all' => true,
                'is_published' => true,
            ],
            [
                'title' => 'AI & Machine Learning Workshop',
                'description' => 'A hands-on workshop covering the fundamentals of Artificial Intelligence and Machine Learning. Learn about neural networks, deep learning, and build your first ML model. No prior experience required.',
                'event_date' => now()->addDays(20)->format('Y-m-d'),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'venue' => 'Computer Lab 3',
                'price' => 100.00,
                'available_seats' => 50,
                'booking_deadline' => now()->addDays(18)->format('Y-m-d'),
                'eligible_programs' => 'BCA, MCA, B.Sc, M.Sc',
                'open_to_all' => false,
                'is_published' => true,
            ],
            [
                'title' => 'Entrepreneurship Summit',
                'description' => 'Connect with successful entrepreneurs, investors, and startup founders. Learn how to pitch your ideas, secure funding, and build a successful startup from scratch.',
                'event_date' => now()->addDays(30)->format('Y-m-d'),
                'start_time' => '09:30',
                'end_time' => '17:00',
                'venue' => 'Conference Hall B',
                'price' => 0,
                'available_seats' => 150,
                'booking_deadline' => now()->addDays(25)->format('Y-m-d'),
                'eligible_programs' => null,
                'open_to_all' => true,
                'is_published' => true,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
