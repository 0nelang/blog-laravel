<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\user;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'elang',
        //     'email' => 'elangppranoto@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        User::factory(5)->create();

        // User::create([
        //     'name' => 'THE GUY',
        //     'email' => 'THEGUY@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        Category::create([
            'category' => 'Horror',
            'slug' => 'horror',
            'gambar' => 'Frankenstain.jfif'
        ]);

        Category::create([
            'category' => 'Monster',
            'slug' => 'monster',
            'gambar' => 'monsterPicture.jpeg'
        ]);

        Category::create([
            'category' => 'Drama',
            'slug' => 'drama',
            'gambar' => 'dramaPhoto.jpg'
        ]);

        Post::factory(40)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.'
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.'
        // ]);
        
        // Post::create([
        //     'title' => 'Judul Keiga',
        //     'category_id' => 2,
        //     'user_id' => 1,
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.'
        // ]);

        // Post::create([
        //     'title' => 'Judul Keempat',
        //     'category_id' => 3,
        //     'user_id' => 1,
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae necessitatibus accusamus commodi excepturi similique qui, voluptatem vero. Enim fugit aliquam eveniet aliquid ipsa unde tenetur doloremque cum ex veniam est dolor consequatur sit sequi, voluptatibus necessitatibus odit repellendus debitis culpa animi commodi doloribus optio cumque. Amet omnis alias iusto ducimus.'
        // ]);

    }
}
