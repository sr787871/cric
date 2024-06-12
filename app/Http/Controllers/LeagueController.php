<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    //
    public function store(){
        $api_url = 'https://apiv2.allsportsapi.com/cricket/?met=Leagues&APIkey=ae5ff9e1929993120c67b886e607f63f5f6745b433e6f6814bf00d7222f76a00';
        $response = Http::get($api_url);

        $data = $response->json();
        echo "<pre>";
        $leagues = $data['result'];
        foreach($leagues as $league){
            League::updateOrCreate(
                ["league_key" => $league["league_key"]],
                [
                    'league_key' => $league['league_key'],
                    'league_name' => $league['league_name'],
                    'league_year' => $league['league_year'],
                ]
            );
        }
        dd("data stored");

    }
}
