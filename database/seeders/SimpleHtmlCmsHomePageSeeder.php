<?php

namespace Database\Seeders;

use App\Enums\HomePageCmsEnum;
use App\Enums\HomePageTypeCmsEnum;
use App\Models\SimpleHtmlCms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimpleHtmlCmsHomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $simpleOne = new SimpleHtmlCms();
        $simpleOne->title = "DE STUDENTEN VAN MEGEN";
        $simpleOne->information = "Download de pdf, hierin staan vragen die jouw mee zullen helpen een leuk verhaal te schrijven over jouw studententijd.";
        $simpleOne->link = "https://www.youtube.com/?gl=NL&hl=nl";
        $simpleOne->page = HomePageCmsEnum::homePage;
        $simpleOne->type = HomePageTypeCmsEnum::acticles;
        $simpleOne->save();

        $simpleTwo = new SimpleHtmlCms();
        $simpleTwo->title = "EVEN VOORSTELLEN";
        $simpleTwo->information = null;
        $simpleTwo->link = "https://www.youtube.com/?gl=NL&hl=nl";
        $simpleTwo->page = HomePageCmsEnum::homePage;
        $simpleTwo->type = HomePageTypeCmsEnum::acticles;
        $simpleTwo->save();

        $simpleThree = new SimpleHtmlCms();
        $simpleThree->title = "JOUW MEGENSE ONDERNEMING";
        $simpleThree->information = "Megen heeft stiekem toch best veel ondernemers. Laat Megen kennis maken met uw onderneming, en vertel wat deze precies voor staan en inhoud Download de pdf, hierin staan vragen die jouw mee zullen helpen een leuk verhaal te schrijven over jouw ondernemerschap.";
        $simpleThree->link = "https://www.youtube.com/?gl=NL&hl=nl";
        $simpleThree->page = HomePageCmsEnum::homePage;
        $simpleThree->type = HomePageTypeCmsEnum::acticles;
        $simpleThree->save();

        $simpleFour = new SimpleHtmlCms();
        $simpleFour->title = "KUNSTWERKEN";
        $simpleFour->information = "Het Keiennieuws is opzoek naar kunstwerken wat in het licht gezet mogen worden door deze prominent op de laatste pagina van het blad te plaatsen. Dus heb jij talent voor schilderen, beeldhouwen, fotografie, haken of iets anders, dan zien wij graag jouw kunstwerken terug in het Keiennieuws.";
        $simpleFour->link = null;
        $simpleFour->page = HomePageCmsEnum::homePage;
        $simpleFour->type = HomePageTypeCmsEnum::statement;
        $simpleFour->save();

        $simpleFive = new SimpleHtmlCms();
        $simpleFive->title = "MEDEDELINGEN";
        $simpleFive->information = "Het Keiennieuws heeft een aantal nieuwe rubrieken, waaronder ondernemerschap in Megen. Bent u geïnteresseerd om voor deze rubrieken uw verhaal te vertellen?";
        $simpleFive->link = null;
        $simpleFive->page = HomePageCmsEnum::homePage;
        $simpleFive->type = HomePageTypeCmsEnum::statement;
        $simpleFive->save();

        $simpleSix = new SimpleHtmlCms();
        $simpleSix->title = "MEDEDELINGEN";
        $simpleSix->information = "Het Keiennieuws heeft een aantal nieuwe rubrieken, waaronder ondernemerschap in Megen. Bent u geïnteresseerd om voor deze rubrieken uw verhaal te vertellen?";
        $simpleSix->link = null;
        $simpleSix->page = HomePageCmsEnum::homePage;
        $simpleSix->type = HomePageTypeCmsEnum::statement;
        $simpleSix->save();
    }
}
