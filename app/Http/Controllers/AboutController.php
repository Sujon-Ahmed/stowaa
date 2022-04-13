<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
class AboutController extends Controller
{
    public function index()
    {
        $team_members = Team::all()->take(4);
        return view('frontend.about_us', [
            'team_members' => $team_members,
        ]);
    }
}
