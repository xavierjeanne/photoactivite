<?php

use Illuminate\Database\Seeder;
use App\Models\{Role,Licence,Field,Avatar,User,Category};
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

        Category::insert([
            ['name'=>'campagne','code'=>'CCC'],
            ['name'=>'forêt','code'=>'WWW'],
            ['name'=>'bord de mer','code'=>'MMM'],
            ['name'=>'montagne','code'=>'MNM'],
            ['name'=>'petite ville','code'=>'PTV'],
            ['name'=>'grande ville','code'=>'GDV'],
            ['name'=>'tour du monde','code'=>'TDM'],
            ['name'=>'lieux célèbre','code'=>'LFC'],
            ['name'=>'nature','code'=>'NNN'],
            ['name'=>'campagne','code'=>'NNN CCC'],
            ['name'=>'montagne','code'=>'NNN MNM'],
            ['name'=>'mer','code'=>'NNN MMM'],
            ['name'=>'végétaux','code'=>'VGT'],
            ['name'=>'fleurs','code'=>'VGT FFF'],
            ['name'=>'plantes, arbres, fruitd et légumes','code'=>'VGT PPP'],
            ['name'=>'campagne','code'=>'VGT CGN'],
            ['name'=>'forêt','code'=>'VGT FTO'],
            ['name'=>'mer','code'=>'VGT BDM'],
            ['name'=>'montagne','code'=>'VGT MTG'],
            ['name'=>'autre','code'=>'VGT AAA'],
            ['name'=>'animaux sauvage','code'=>'ASV'],
            ['name'=>'campagnes, forêt et motagne','code'=>'ASV CFM'],
            ['name'=>'campagne','code'=>'ASV CCC'],
            ['name'=>'forêt','code'=>'ASV WWW'],
            ['name'=>'montagne','code'=>'ASV MNM'],
            ['name'=>'océan et rivière','code'=>'ASV OOO'],
            ['name'=>'savane, jungle et déserts','code'=>'ASV SJD'],
            ['name'=>'oiseaux','code'=>'ASV OIO'],
            ['name'=>'insectes','code'=>'ASV CTC'],
            ['name'=>'reptiles','code'=>'ASV AGY'],
            ['name'=>'animaux domestiques','code'=>'ADV'],
            ['name'=>'chat','code'=>'ADV CCT'],
            ['name'=>'chien','code'=>'ADV CDC'],
            ['name'=>'cheval','code'=>'CVC'],
            ['name'=>'animaux sauvages en général','code'=>'ASV'],
            ['name'=>'campagnes,forêts et montagne','code'=>'ASV CFM'],
            ['name'=>'campagne','code'=>'ASV CCC'],
            ['name'=>'forêt','code'=>'ASV WWW'],
            ['name'=>'montagne','code'=>'ASV MNM'],
            ['name'=>'océan et rivière','code'=>'ASV OOO'],
            ['name'=>'savane et jungle  et déserts','code'=>'ASV SJD'],
            ['name'=>'oiseaux','code'=>'ASV OIO'],
            ['name'=>'insectes','code'=>'ASV CTC'],
            ['name'=>'reptiles','code'=>'ASV AGY'],
            ['name'=>'animaux jeunes','code'=>'PTI'],
            ['name'=>'sport en général','code'=>'SPT'],
            ['name'=>'sport de plein air','code'=>'SPN'],
            ['name'=>'sport mécanique','code'=>'SPM'],
            ['name'=>'football','code'=>'FTT'],
            ['name'=>'cuisinier patissier','code'=>'CST'],
            ['name'=>'plaisirs gustatifs','code'=>'DGT'],
            ['name'=>'bricolage et travaux','code'=>'BCT'],
            ['name'=>'jardinage','code'=>'JDN'],
            ['name'=>'arts plastiques','code'=>'AAC'],
            ['name'=>'couture','code'=>'CTU'],
            ['name'=>'mode, bijoux et maquillage','code'=>'MBM'],
            ['name'=>'musique en général','code'=>'MUU'],
            ['name'=>'musique classique','code'=>'MCM'],
            ['name'=>'musique,rock et pop','code'=>'RCK'],
            ['name'=>'objets anciens, brocanteur et antiquaire','code'=>'OAB'],
            ['name'=>'histoire','code'=>'HST'],
            ['name'=>'alcool','code'=>'AAL'],
            ['name'=>'patrimoine, vistes et tradition','code'=>'PVT'],
            ['name'=>'art moderne et contemporain','code'=>'ACM'],
            ['name'=>'art ancien','code'=>'AAN'],
            ['name'=>'activité culturelles','code'=>'ACU'],
            ['name'=>'sciences','code'=>'STC'],
            ['name'=>'techniques,technologie et ingénierie','code'=>'TTI'],
            ['name'=>'architecture en général','code'=>'ACB'],
            ['name'=>'architecture contemporaine','code'=>'AHE'],
            ['name'=>'décoration','code'=>'DCO'],
            ['name'=>'automobile en général','code'=>'AUM'],
            ['name'=>'voitures et motos anciennes','code'=>'MUA'],
            ['name'=>'moto','code'=>'OOT'],
            ['name'=>'aviation','code'=>'AVT'],
            ['name'=>'bateaux en général','code'=>'BBA'],
            ['name'=>'voilier','code'=>'VVL'],
            ['name'=>'train','code'=>'TTR'],
            ['name'=>'rencontre en famille et entres amis,événements festifs','code'=>'FFA'],
            ['name'=>'enfants','code'=>'EFT'],
            ['name'=>'soirées festives','code'=>'SFF'],
            ['name'=>'tâches ménagères','code'=>'TSK'],
            ['name'=>'armée','code'=>'AEE'],
            ['name'=>'humour','code'=>'HUR'],
        ]);
    }
}
