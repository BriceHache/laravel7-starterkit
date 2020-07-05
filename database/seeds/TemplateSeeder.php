<?php


use Illuminate\Support\Facades\DB;

class TemplateSeeder extends DatabaseSeeder {

	public function run()
	{

        DB::table('template_settings')->truncate();


        DB::table('template_settings')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'color',
                    'value' => 'lake',
                    'created_at' => '2019-04-27 00:00:00',
                    'updated_at' => '2020-05-01 06:58:53',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'preloader',
                    'value' => 'false',
                    'created_at' => '2019-04-27 00:00:00',
                    'updated_at' => '2020-05-01 06:58:53',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'image_login',
                    'value' => 'resources/assets/images/login_page/1579993255.Winter_Snow_Trees_Sun_577073_2560x1440.jpg',
                    'created_at' => '2019-04-27 00:00:00',
                    'updated_at' => '2020-05-01 06:58:53',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'welcome_message',
                    'value' => 'Admin Panel',
                    'created_at' => '2019-04-27 00:00:00',
                    'updated_at' => '2020-05-21 07:36:53',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => '_token',
                    'value' => 'Od10Wd72FQgLvMzLsWSOeFf3rUWW6yz9mCSeRsXj',
                    'created_at' => '2019-04-27 00:00:00',
                    'updated_at' => '2020-05-21 07:36:53',
                ),

        ));

        /*$statement = "INSERT INTO ".env('DB_PREFIX')."
      `template_settings` (`id`, `name`, `value`,`created_at`,`updated_at`) VALUES
          (1, 'color', 'lake','2019-04-27 00:00:00','2020-05-01 06:58:53'),
          (2, 'preloader', 'false','2019-04-27 00:00:00','2020-05-01 06:58:53'),
          (3, 'image_login', 'resources/assets/images/login_page/1579993255.Winter_Snow_Trees_Sun_577073_2560x1440.jpg','2019-04-27 00:00:00','2020-05-01 06:58:53'),
          (4, 'welcome_message', 'Admin Panel','2019-04-27 00:00:00','2020-05-01 06:58:53'),
          (5, '_token', 'Od10Wd72FQgLvMzLsWSOeFf3rUWW6yz9mCSeRsXj','2019-04-27 00:00:00','2020-05-01 06:58:53');
          ";

      DB::unprepared($statement);*/

	}

}
