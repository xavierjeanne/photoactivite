<?php

use Illuminate\Database\Seeder;
use App\Models\{Page,Content};

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Page::insert([
            ['title'=>'home','slug'=>'/'],
            ['title'=>'pro','slug'=>'/pro'],
            ['title'=>'perso','slug'=>'/perso'],
            ['title'=>'contact','slug'=>'/contact'],
            ['title'=>'mentions','slug'=>'/mentions'],
            ['title'=>'policy','slug'=>'/policy'],
        ]);

        Content::insert([
            ['page_id'=>'1','bloc_name'=>'slogan','content'=>'Photo et activités agréables adaptées à des usages professionnel et personnel'],
            ['page_id'=>'1','bloc_name'=>'primary_block','content'=>'Les activités qui vous proposées ont été crées par un un Neuropsychologue et un Développeur web.7000 photos permettent de vous proposer des activités agréables adaptées à vos besoins et à votre âge pour un usage privé ou professionnel.'],
        ]);
    }
}
