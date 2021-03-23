<?php

use Illuminate\Database\Seeder;
use App\Models\{Role,Licence,Field,Avatar,User};
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
        Role::insert([
            ['name'=>'administrator'],
            ['name'=>'customer'],
            ['name'=>'patient'],
        ]);

        Licence::insert([
            ['name'=>'try','description'=>'licence d\'essai','periodicity'=>'free','price'=>0],
            ['name'=>'premium','description'=>'licence pour un usage non pro','periodicity'=>'monthly','price'=>10],
            ['name'=>'premium','description'=>'licence pour un usage non pro','periodicity'=>'annual','price'=>100],
            ['name'=>'pro','description'=>'licence pour un usage pro','periodicity'=>'monthly','price'=>15],
            ['name'=>'pro','description'=>'licence pour un usage pro','periodicity'=>'annual','price'=>150],
        ]);

        Field::insert([
            ['name'=>'Activités pour adultes (difficultés cognitives)','description'=>'Activités pour personnes ayant des difficultés cognitives (mémoire,...)'],
            ['name'=>'Activités pour adultes (stimulation cérébrales)','description'=>'Activités de "stimulations" cérébrales '],
            ['name'=>'Activités pour adultes (activités relaxantes)','description'=>'Activités de relaxantes en cas de stress, de manifestations anxieuses'],
            ['name'=>'Activités pour enfants et adolescents','description'=>'Activités pour enfants et adoslescents : Découvrir le monde'],
            ['name'=>'Professionnels des fonctions cognitives','description'=>'Professionnels des fonctions cognitives (Orthophoniste, Neuropsychologue,...'],
            ['name'=>'Professionnels de l\'animation','description'=>'Professionnels de l\'animation'],
            ['name'=>'Professionnels intervenants auprés de personnes anxieuses ou en situation de stress','description'=>'Professionnels intervenants auprés de personnes anxieuses ou en situation de stress'],
            ['name'=>'Professionnels de l\'enseignement','description'=>'Professionnels de l\'enseignement'],
        ]);

        Avatar::insert([
            ['name'=>'default','file'=>'images/avatar/user_default.png'],
        ]);

        User::insert([
            ['name'=>'jeanne','first_name'=>'xavier','address'=>'4 impasse varignon','postal_code'=>14000,'country'=>'france','telephone'=>'0609356653','dateofbirth'=>date("1981-10-08"),'email'=>'xavier.jeanne@gmail.com','password'=>bcrypt('08101981'),'licence_active_id'=>1,'avatar_id'=>1,'parent_id'=>0,'role_id'=>1],
        ]);
    }
}
