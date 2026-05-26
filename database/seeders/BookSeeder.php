<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'My Identity: Becoming Who I Say I Am',
            'author' => 'Dr. Susan O. Bamidele',
            'description' => 'A transformative guide on self-worth, healing, and inner peace. Through the journey of Akello, this book explores the power of words, the science of self-talk, and the beauty of becoming who you were always meant to be.',
            'price' => 15.00,
            'currency' => 'USD',
            'cover_image' => 'assets/img/book.jpeg',
            'product_type' => 'both',
            'stock' => 50,
            'is_advertisement' => true,
            'status' => 'active',
        ]);

        Book::create([
            'title' => 'Healing the Wounded Soul',
            'author' => 'Dr. Susan O. Bamidele',
            'description' => 'A practical guide to overcoming emotional trauma and finding peace through faith-based counseling principles.',
            'price' => 12.99,
            'currency' => 'USD',
            'product_type' => 'physical',
            'stock' => 30,
            'is_advertisement' => false,
            'status' => 'active',
        ]);

        Book::create([
            'title' => 'Mindful Moments: Daily Devotional',
            'author' => 'Dr. Susan O. Bamidele',
            'description' => 'A 30-day devotional combining mindfulness practices with spiritual reflection for daily emotional wellness.',
            'price' => 9.99,
            'currency' => 'USD',
            'product_type' => 'digital',
            'digital_file' => null,
            'stock' => null,
            'is_advertisement' => false,
            'status' => 'active',
        ]);

        Book::create([
            'title' => 'Building Strong Families',
            'author' => 'Dr. Susan O. Bamidele',
            'description' => 'Essential principles for creating healthy family dynamics and nurturing strong relationships across generations.',
            'price' => 18.50,
            'currency' => 'USD',
            'product_type' => 'physical',
            'stock' => 20,
            'is_advertisement' => false,
            'status' => 'active',
        ]);

        Book::create([
            'title' => 'The Purpose Driven Mind',
            'author' => 'Dr. Susan O. Bamidele',
            'description' => 'Discover your God-given purpose and learn to align your thoughts, actions, and goals with your true calling.',
            'price' => 14.99,
            'currency' => 'USD',
            'product_type' => 'digital',
            'stock' => null,
            'is_advertisement' => false,
            'status' => 'active',
        ]);

        Book::create([
            'title' => 'Stress Less, Live More',
            'author' => 'Olu',
            'description' => 'A comprehensive guide to managing stress through nutrition, exercise, and mindfulness techniques.',
            'price' => 11.99,
            'currency' => 'USD',
            'product_type' => 'physical',
            'stock' => 25,
            'is_advertisement' => false,
            'status' => 'active',
        ]);
    }
}
