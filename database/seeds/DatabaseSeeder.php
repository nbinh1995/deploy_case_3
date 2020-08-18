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

        factory(User::class, 10)->create(['role' => 1]);
        factory(User::class, 10)->create(['role' => 0]);

        User::where('role', 1)->each(function ($user, $key) {
            factory(Company::class)->create([
                'user_id' => $user->id
            ]);
        });

        User::where('role', 0)->each(function ($user, $key) {
            factory(Profile::class)->create([
                'user_id' => $user->id,
                'name' => $user->name
            ]);
        });
        factory(Work::class, 20)->create();

        factory(Applicant::class, 20)->create();

        User::create([
            'name' => 'ntqb',
            'email' => 'ntqb@gmail.com',
            'role' => 2,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);


        factory(Company::class)->create([
            'user_id' => User::create([
                'name' => 'ntqb1',
                'email' => 'ntqb1@gmail.com',
                'role' => 1,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ])->id
        ]);

        factory(Profile::class)->create([
            'user_id' =>  User::create([
                'name' => 'ntqb0',
                'email' => 'ntqb0@gmail.com',
                'role' => 0,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ])->id,
            'name' => 'ntqb0'
        ]);

        $com1 = Company::create([
            'user_id' => factory(User::class)->create(['role' => 1])->id,
            'c_name' => $title = 'Chi nhánh Công ty CP CodeGym Việt Nam tại Huế',
            'slug' => Str::slug($title),
            'address' => 'Tầng 4, Toà nhà 28 Nguyễn Tri Phương, Thừa Thiên Huế, Việt Nam',
            'phone' => '02346291888',
            'website' => 'https://hue.codegym.vn/',
            'logo' => '/avatars/logo_codegym.jpeg',
            'cover_photo' => '/covers/cover_codegym.jpg',
            'slogan' => 'Không xong việc không về',
            'description' => 'CodeGym là hệ thống đào tạo lập trình viên hiện đại hàng đầu tại Việt Nam. Chúng tôi phát triển các giải pháp học tập hiện đại và hiệu quả thông qua các mô hình đạo tạo tiên tiến trên nền tảng công nghệ giáo dục và sự cộng tác sâu rộng giữa các bên liên quan, đặc biệt là doanh nghiệp. Qua đó, CodeGym giúp người học phát triển tay nghề vững vàng, sẵn sàng làm việc và có khả năng tự học suốt đời hiệu quả, thích ứng với cuộc Cách mạng Công nghiệp 4.0',
            'active' =>  'ACTIVE',
            'hot' => 1
        ]);

        $com2 = Company::create([
            'user_id' => factory(User::class)->create(['role' => 1])->id,
            'c_name' => $title = 'Deha Software',
            'slug' => Str::slug($title),
            'address' => 'Tầng 2, Toà nhà 28 Nguyễn Tri Phương, Thừa Thiên Huế, Việt Nam',
            'phone' => '024432004183',
            'website' => 'https://www.deha-soft.com/',
            'logo' => '/avatars/logo_deha.jpg',
            'cover_photo' => '/covers/cover_deha.jpg',
            'slogan' => 'Sứ mệnh chuyển giao hạnh phúc',
            'description' => 'DEHA là công ty công nghệ hoạt động trong lĩnh vực gia công phần mềm, được tạo dựng bởi bốn thành viên đầy đam mê, tài năng và giàu kinh nghiệm. Với gần 30 năm tổng kinh nghiệm tích lũy khi làm việc cho các khách hàng đa dạng từ Nhật Bản, Hoa Kì và Việt Nam, chúng tôi nhận thức rõ vai trò vô cùng quan trọng của mình trong chuỗi giá trị sản xuất kinh doanh trên toàn thế giới. Vai trò đó, cho phép chúng tôi biến các kỳ vọng của khách hàng thành hiện thực và hỗ trợ chuyển giao chúng cho những người dùng cuối cùng.
                Trên tất cả, giá trị kinh doanh cao nhất của hoạt động sản xuất kinh doanh là Hạnh phúc. Với DEHA, Hạnh phúc, chính là giá trị cao nhất mà con người tích lũy được thông qua Nhân viên, cộng tác, chuyển giao bằng một thái độ tích cực cùng với một cuộc sống xứng đáng. Hạnh phúc không phải là một kết quả, mà là một tổng hòa các trải nghiệm, được tích lũy lâu dài và bền vững.',
            'active' =>  'ACTIVE',
            'hot' => 1
        ]);

        $com3 = Company::create([
            'user_id' => factory(User::class)->create(['role' => 1])->id,
            'c_name' => $title = '3S HUE INTERSOFT',
            'slug' => Str::slug($title),
            'address' => 'Tầng 2,3, Toà nhà 28 Nguyễn Tri Phương, Thừa Thiên Huế, Việt Nam',
            'phone' => '0965207599',
            'website' => 'http://3si.vn',
            'logo' => '/avatars/logo_3s.jpg',
            'cover_photo' => '/covers/cover_3s.jpg',
            'slogan' => 'SUCCESS IS DOING ORDINARY THINGS EXTRAORDINARILY WELL!',
            'description' => 'Thành lập ngày 20 tháng 6 năm 2012 sau hơn 6 năm phát triển và lớn mạnh không ngừng, 3S hôm nay đã và đang khẳng định Thương hiệu cùng vị thế trong ngành Công nghệ Thông tin tại Việt Nam và trên trường quốc tế.
        3S mong muốn đóng góp giá trị khác biệt của mình vào ngành công nghiệp gia công phần mềm xuất khẩu của Việt Nam, tạo ra nhiều sự lựa chọn cho khách hàng, và trở thành một đối tác tại Việt Nam tin cậy để phát triển và bảo trì các giải pháp công nghệ thông tin hàng đầu. Những kinh nghiệm chắt lọc được trong cả hai lĩnh vực mã nguồn mở hay các giải pháp thương mại giúp 3S có khả năng đưa ra những giải pháp phù hợp với nhu cầu kinh doanh. Những kinh nghiệm quý báu, sự thành thạo chuyên môn, cơ sở vật chất được trang bị tốt nhất cùng với việc quản lý chuyên nghiệp, cam kết rõ ràng và thái độ nhiệt tình của mọi thành viên 3S sẽ tiếp tục mang tới sự hài lòng tối đa cho khách hàng.',
            'active' =>  'ACTIVE',
            'hot' => 1
        ]);

        $com4 = Company::create([
            'user_id' => factory(User::class)->create(['role' => 1])->id,
            'c_name' => $title = 'Công ty Kỹ thuật Phần mềm Pi',
            'slug' => Str::slug($title),
            'address' => 'Tầng 3, Số 6 Lê Lợi, Phường Vĩnh Ninh, Thừa Thiên Huế, Việt Nam',
            'phone' => '0905137895',
            'website' => 'http://wearepisoftware.com/',
            'logo' => '/avatars/logo_pi.png',
            'cover_photo' => '/covers/cover_pi.jpg',
            'slogan' => 'Chúng tôi là chất lượng',
            'description' => 'Pi Software là đơn vị hoạt động lĩnh vực phần mềm với hệ sinh thái của eCoPiSoftware, Khách hàng và đối tác của Chúng tôi đến từ những tập đoàn doanh nghiệp của Singapore, Nhật Bản, Hàn Quốc, USA...
        Chúng tôi có nguồn nhân lực chất lượng, đáp ứng nhu cầu phát triển của những hệ thống lớn như: ngân hàng, tài chính, bảo hiểm, ERP, ... Bên cạnh đó Chúng tôi đã xây dựng được thành công hệ sinh thái khởi nghiệp, quỹ đầu tư...',
            'active' =>  'ACTIVE',
            'hot' => 1
        ]);

        $com5 = Company::create([
            'user_id' => factory(User::class)->create(['role' => 1])->id,
            'c_name' => $title = 'Công ty TNHH Công Nghệ Thông Tin Aureole',
            'slug' => Str::slug($title),
            'address' => 'Tầng 3, Số 6 Lê Lợi, Phường Vĩnh Ninh, Thừa Thiên Huế, Việt Nam',
            'phone' => '02839110200',
            'website' => 'https://www.mitani.co.jp/aureole/vn/ait/',
            'logo' => '/avatars/logo_aureole.jpg',
            'cover_photo' => '/covers/cover_aureole.jpg',
            'slogan' => 'Đột Phá Cùng Phát Triển',
            'description' => 'Được thành lập vào tháng 3 năm 2001 tại Thành phố Hồ Chí Minh, công ty Aureole Information Technology Inc.(AIT) là công ty thành viên có 100% vốn đầu tư từ Công ty Mitani Sangyo. Công ty cung cấp các dịch vụ phát triển phần mềm và hỗ trợ triển khai gói phần mềm tại Việt Nam. Đối với triển phần mềm, công ty còn phái cử kỹ sư cầu nối để việc phát triển offshore diễn ra thuận lợi .
        Nhằm cải tiến chất lượng và đào tạo nguồn nhân lực có năng lực tiếng Nhật, công ty còn tổ chức các khoá đào tạo nhân viên tại Nhật Bản.',
            'active' =>  'ACTIVE',
            'hot' => 1
        ]);

        Work::create([
            'company_id' => $com1->id,
            'category_id' => 1,
            'title' => $name = 'Giảng viên JAVA Fulltime',
            'slug' => Str::slug($name),
            'description' => 'Tham gia giảng dạy các khoá đào tạo lập trình Java/PHP theo mô hình Coding Bootcamp.
        · Truyền lại kiến thức và kỹ năng lập trình viên cho các học viên mới bắt đầu học lập trình.
        · Tham gia các chương trình đào tạo lập trình viên khác theo năng lực, thế mạnh và định hướng nghề nghiệp của cá nhân.
        · Tham gia phát triển các chương trình đào tạo lập trình',
            'benefit' => '· Môi trường làm việc trẻ trung, thân thiện, chuyên nghiệp.
        · Được thường xuyên tham gia các khóa đào tạo chuyên nghiệp hàng đầu về lập trình và công nghệ tại Học viện Agile và Học viện công nghệ Sophia.
        · Được hỗ trợ đào tạo kỹ năng giảng dạy, các công nghệ mới và thi các chứng chỉ lập trình quốc tế
        · Cơ hội thăng tiến lên quản lý tại hệ thống các trung tâm đào tạo lập trình CodeGym.
        · Nâng tầm vị thế và thương hiệu cá nhân trong giới lập trình (CodeGym là hệ thống đầu tiên tại Việt Nam đào tạo theo mô hình Coding Bootcamp đang rất thịnh hành tại Mỹ).
        · Thường xuyên được được tư vấn và định hướng phát triển sự nghiệp lâu dài.
        · Nghỉ 12 ngày phép nguyên lương, BHXH, BHYT, BHTN và các chế độ theo Luật lao động hiện hành.
        · Các chế độ phúc lợi khác theo quy định của Công ty (Team Building hàng quý; Company trip hàng năm).
        · Chế độ làm việc 8 giờ/ngày (44 giờ/tuần). Nghỉ chiều Thứ 7, ngày Chủ Nhật và các ngày lễ theo quy định của nhà nước.',
            'require' =>  '· Tốt nghiệp đại học hoặc đã hoàn thành 1 chương trình đào tạo chính thức về công nghệ thông tin.
        · Lập trình viên JAVA kinh nghiệm 2 năm trở lên.
        · Ham học hỏi, yêu thích việc đào tạo, truyền lửa cho các bạn trẻ.
        · Không yêu cầu kinh nghiệm sư phạm, sẽ được đào tạo kỹ năng sư phạm khi đi làm.
        · Ưu tiên yêu thích giáo dục, có kiến thức về Agile, Scrum',
            'contact_name' => 'Ms. Thúy',
            'contact_phone' => '0374292412',
            'contact_email' => 'thuy.tran@codegym.vn',
            'position' => 'Nhân viên',
            'salary_min' => 10000000,
            'salary_max' => 25000000,
            'type' => 'FullTime',
            'status' => 0,
            'last_date' => date('Y/m/d', strtotime(now() . '+ 20days')),
            'hot' => 1
        ]);

        Work::create([
            'company_id' => $com2->id,
            'category_id' => 1,
            'title' => $name = 'Giám đốc điều hành làm việc tại Huế',
            'slug' => Str::slug($name),
            'description' => 'Quản trị và điều hành chung, Phát triển kinh doanh, Quản lý điều hành, đào tạo Nhân sự, Công tác ngoại giao cơ quan chính quyền, đối tác liên quan…',
            'benefit' =>  '- Mức lương: Thỏa thuận
        - Thưởng 4x-6x tháng lương khi đạt doanh thu cuối năm.
        - Công ty sẵn sàng tặng cổ phần với nhân sự làm việc hiệu quả và gắn bó lâu dài.
        - Hưởng đầy đủ chế độ BHXH, thưởng tháng 13++, thưởng Tết,...
        - Tham gia du lịch hàng năm, teambuliding hàng tháng, quý,... cùng công ty.',
            'require' =>  '- Tốt nghiệp đại học trở lên
        - Thành thạo tiếng Nhật (đã từng đi Nhật là một lợi thế).
        - Là người gốc Huế, sống ở Huế hoặc sẵn sàng chuyển đến Huế sinh sống
        - Có kinh nghiệm đảm nhận vị trí Giám đốc điều hành hoặc các vị trí quản lý khác
        - Có kinh nghiệm trong việc phát triển các chiến lược kinh doanh và triển khai tầm nhìn
        - Có hiểu biết sâu về các nguyên tắc quản lý tài chính và vận hành doanh nghiệp
        - Có kiến thức chuyên sâu về quản trị doanh nghiệp và các phương pháp quản lý chung
        - Thành thạo kĩ năng phân tích và giải quyết vấn đề
        - Kỹ năng đàm phán và làm việc với đối tác nước ngoài
        - Có kinh nghiệm về thị trường IT là một điểm cộng
        - Nhận CV tiếng Anh hoặc tiếng Nhật',
            'contact_name' => 'Nguyễn Thị Minh Tâm',
            'contact_phone' => '0963161246',
            'contact_email' => 'nhansu@deha-soft.com',
            'position' => 'Trưởng dự án',
            'type' => 'FullTime',
            'status' => 1,
            'last_date' => date('Y/m/d', strtotime(now() . '+ 20days')),
            'hot' => 1
        ]);

        Work::create([
            'company_id' => $com3->id,
            'category_id' => 1,
            'title' => $name = 'Help Desk Assistant',
            'slug' => Str::slug($name),
            'description' => 'Trực tổng đài tại Văn phòng
        Làm việc giờ hành chính từ Thứ Hai - Chủ nhật',
            'benefit' =>  'Được tham gia vào các hoạt động của công ty: Happy Hour, Team Building, Sum up...
        Được hưởng các chính sách dành cho nhân viên chính thức.',
            'require' =>  'Tiếng Anh tốt (các kĩ năng: nghe, nói, viết)
        Ưu tiên Receptionist ở các Khách sạn
        Sẽ được training về quy trình làm việc',
            'contact_name' => 'Minh Tâm',
            'contact_phone' => '0773456822',
            'contact_email' => 'hu.hr@3si.vn',
            'position' => 'Nhân viên',
            'type' => 'FullTime',
            'status' => 1,
            'last_date' => date('Y/m/d', strtotime(now() . '+ 20days')),
            'hot' => 1
        ]);

        Work::create([
            'company_id' => $com1->id,
            'category_id' => 1,
            'title' => $name = 'Digital Marketing',
            'slug' => Str::slug($name),
            'description' => 'Xây dựng các chương trình truyền thông, promotion theo định hướng công ty.
        Phối hợp lập kế hoạch, triển khai và theo dõi quảng cáo sản phẩm của Công ty trên các kênh Online:
        Google, Facebook,…
        Lập kế hoạch, điều phối, phối hợp với Content Marketing để phát triển các kênh Marketing Online đảm bảo
        các kết quả đã đặt ra.
        Triển khai các chiến dịch quảng bá và xây dựng thương hiệu qua các công cụ Digital Marketing (SEO, Online
        Advertising, Email Marketing, Social Media…), bao gồm cả triển khai thử nghiệm và đánh giá kết quả.
        Phát triển các kênh quảng cáo mới trên nền tảng digital
         Phối hợp với các phòng ban liên quan và bộ phận marketing tại các chi nhánh trên toàn quốc để đảm bảo
        tiến độ công việc và kết quả đề ra
         Thực hiện các công việc khác theo yêu cầu của Trưởng bộ phận.',
            'benefit' => 'Mức thu nhập từ 10-15 triệu tùy thỏa thuận theo năng lực.
         Môi trường làm việc trẻ trung, thân thiện, chuyên nghiệp, đề cao tinh thần học tập và phát triển
        Được tham gia BHYT, BHXH, BHTN và các chế độ phúc lợi theo quy định của Công ty
        Được tham gia seminar công ty 1 lần/tuần
        Được học/training on job 4h/tuần
        Du lịch công ty/team building 2 lần/năm
        Chế độ làm việc 8 giờ/ngày (không quá 44 giờ/tuần). Nghỉ Thứ 7, và Chủ Nhật và các ngày lễ theo quy định
        của nhà nước.',
            'require' =>  'Tốt nghiệp Đại học trở lên các chuyên ngành Marketing, Truyền thông, Quản trị kinh doanh, công nghệ thông tin, hoặc các ngành liên quan…
         Có kiến thức về SEO, Google Analytic và webmaster Tool là một lợi thế.
         Có kinh nghiệm về Google Ads hoặc/và Facebook ad là một lợi thế
         Có khả năng nắm bắt nhanh về các sản phẩm Công nghệ , kỹ thuật
        Yêu thích viết lách, chia sẻ &amp; mạng xã hội Kỹ năng làm việc độc lập, làm việc nhóm tốt',
            'contact_name' => 'Ms. Thúy',
            'contact_phone' => '0374292412',
            'contact_email' => 'thuy.tran@codegym.vn',
            'position' => 'Nhân viên',
            'type' => 'FullTime',
            'status' => 1,
            'last_date' => date('Y/m/d', strtotime(now() . '+ 20days')),
            'hot' => 1
        ]);
    }
}
