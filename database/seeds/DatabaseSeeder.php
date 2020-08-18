<?php

use App\Applicant;
use App\Category;
use App\Company;
use App\Favorite;
use App\Profile;
use App\User;
use App\Work;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Web Developer', 'Mobile Developer'];
        foreach ($categories as $item) {
            Category::create(['name' => $item]);
        }

        factory(User::class, 20)->create();

        User::where('role', 1)->each(function ($user, $key) {
            factory(Company::class, 1)->create([
                'user_id' => $user->id
            ]);
        });


        //         factory(Company::class, 1)->create([
        //             'user_id' => factory(User::class, 1)->create(['role' => 1])->id,
        //             'c_name' => $title = 'Chi nhánh Công ty CP CodeGym Việt Nam tại Huế',
        //             'slug' => Str::slug($title),
        //             'address' => 'Tầng 4, Toà nhà 28 Nguyễn Tri Phương, Thừa Thiên Huế, Việt Nam',
        //             'phone' => '0234 629 1888',
        //             'website' => 'https://hue.codegym.vn/',
        //             'logo' => '/images/log_codegym.png',
        //             'cover_photo' => '/images/cover_codegym.jpg',
        //             'slogan' => 'Không xong việc không về',
        //             'description' => 'CodeGym là hệ thống đào tạo lập trình viên hiện đại hàng đầu tại Việt Nam. Chúng tôi phát triển các giải pháp học tập hiện đại và hiệu quả thông qua các mô hình đạo tạo tiên tiến trên nền tảng công nghệ giáo dục và sự cộng tác sâu rộng giữa các bên liên quan, đặc biệt là doanh nghiệp. Qua đó, CodeGym giúp người học phát triển tay nghề vững vàng, sẵn sàng làm việc và có khả năng tự học suốt đời hiệu quả, thích ứng với cuộc Cách mạng Công nghiệp 4.0',
        //             'active' =>  'ACTIVE',
        //             'hot' => 1
        //         ]);

        //         factory(Company::class, 1)->create([
        //             'user_id' => factory(User::class, 1)->create(['role' => 1])->id,
        //             'c_name' => $title = 'Deha Software',
        //             'slug' => Str::slug($title),
        //             'address' => 'Tầng 4, Toà nhà 28 Nguyễn Tri Phương, Thừa Thiên Huế, Việt Nam',
        //             'phone' => '024432004183',
        //             'website' => 'https://www.deha-soft.com/',
        //             'logo' => '/images/log_codegym.png',
        //             'cover_photo' => '/images/cover_codegym.jpg',
        //             'slogan' => 'Sứ mệnh chuyển giao hạnh phúc',
        //             'description' => 'DEHA là công ty công nghệ hoạt động trong lĩnh vực gia công phần mềm, được tạo dựng bởi bốn thành viên đầy đam mê, tài năng và giàu kinh nghiệm. Với gần 30 năm tổng kinh nghiệm tích lũy khi làm việc cho các khách hàng đa dạng từ Nhật Bản, Hoa Kì và Việt Nam, chúng tôi nhận thức rõ vai trò vô cùng quan trọng của mình trong chuỗi giá trị sản xuất kinh doanh trên toàn thế giới. Vai trò đó, cho phép chúng tôi biến các kỳ vọng của khách hàng thành hiện thực và hỗ trợ chuyển giao chúng cho những người dùng cuối cùng.
        // Trên tất cả, giá trị kinh doanh cao nhất của hoạt động sản xuất kinh doanh là Hạnh phúc. Với DEHA, Hạnh phúc, chính là giá trị cao nhất mà con người tích lũy được thông qua Nhân viên, cộng tác, chuyển giao bằng một thái độ tích cực cùng với một cuộc sống xứng đáng. Hạnh phúc không phải là một kết quả, mà là một tổng hòa các trải nghiệm, được tích lũy lâu dài và bền vững.',
        //             'active' =>  'ACTIVE',
        //             'hot' => 1
        //         ]);

        User::where('role', 0)->each(function ($user, $key) {
            factory(Profile::class, 1)->create([
                'user_id' => $user->id,
                'name' => $user->name
            ]);
        });
        factory(Work::class, 20)->create();


        // factory(Favorite::class, 20)->create();

        factory(Applicant::class, 20)->create();
        User::create([
            'name' => 'ntqb',
            'email' => 'ntqb@gmail.com',
            'role' => 2,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
