<?php

namespace Database\Seeders;

use App\Models\Volunteer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ceciel = new Volunteer();
        $ceciel->name = "Ceciel Connemans";
        $ceciel->email = "keiennieuws@hotmail.com";
        $ceciel->phoneNumber = "0640569161";
        $ceciel->information = 'Hoofd van de redactie en grafische vormgever van het Keiennieuws.';
        $ceciel->top = true;
        $ceciel->path = "public/volunteers/Ceciel.jpg";
        $ceciel->save();

        $rozenn = new Volunteer();
        $rozenn->name = "Rozenn van Rijen";
        $rozenn->email = "rosedelachaussee@hotmail.com";
        $rozenn->phoneNumber = "0613768239";
        $rozenn->information = 'Verzorgd de lay-out van de vaste rubriek en is website beheerder.';
        $rozenn->top = true;
        $rozenn->path = "public/volunteers/Rozenn.jpg";
        $rozenn->save();

        $diana = new Volunteer();
        $diana->name = "Diana Ulijn";
        $diana->email = "administratie.kn@hotmail.com";
        $diana->phoneNumber = "0631327771";
        $diana->information = 'Penningsmeeste van het Keiennieuws en regelt de abonnementen.';
        $diana->path = "public/volunteers/Diana.jpg";
        $diana->top = true;
        $diana->save();

        $pieter = new Volunteer();
        $pieter->name = "Pieter van Bernebeek";
        $pieter->email = "pietervanbernebeek@gmail.com";
        $pieter->phoneNumber = "0637417864";
        $pieter->information = "Fantastische tekst schrijver en goede interviewer.";
        $pieter->top = true;
        $pieter->path = "public/volunteers/Pieter.jpg";
        $pieter->save();
    }
}
