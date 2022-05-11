<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Team;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function index()
    {
        $team_members = Team::all();
        return view('admin.team.index', [
            'team_members' => $team_members,
        ]);
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'photo' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,bmp',
         ]);
        $team_member_id = Team::insertGetId([
            'name' => $request->name,
            'designation' => $request->designation,
            'created_at' => Carbon::now(),
        ]);
        $team_member_photo = $request->photo;
        $extension = $team_member_photo->getClientOriginalExtension();
        $file_name = $team_member_id.'.'.$extension;
        Image::make($team_member_photo)->resize(540, 540)->save(public_path('/dashboard_assets/images/team/'.$file_name));
        Team::find($team_member_id)->update([
            'photo' => $file_name,
        ]);
        return redirect()->back();
    }
    // destroy
    public function destroy(Request $request)
    {
        $team_member_id = $request->deletedId;
        $team_info = Team::find($team_member_id);
        $image = $team_info->photo;
        $delete_form = public_path('/dashboard_assets/images/team/'.$image);
        unlink($delete_form);
        Team::find($team_member_id)->delete();
        return redirect()->back()->with('status', 'Team member deleted successfully!');
    }
}
