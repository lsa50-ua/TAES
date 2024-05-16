<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function getUsers()
    {
        $u = User::all();
        return $u;
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('profile', ['user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('editProfile', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $newName = $request->input('name');
        if (!empty($newName)) {
            $user->name = $newName;
        }
        $newEmail = $request->input('email');
        if (!empty($newEmail)) {
            $user->email = $newEmail;
        }
        $newPassword = $request->input('password');
        if (!empty($newPassword)) {
            $user->password = $newPassword;
        }
        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->storeAs('public/images/', $user->id . '.jpg');
        }
        $user->save();
        return view('profile', ['user' => $user]);
    }

    public function list()
    {
        $users = User::all();
        return view('listProfiles', ['users' => $users]);
    }

    public function listFriends(){
        $user = auth()->user();
        $friends = $user->myfriends;
        return view('/friends/myFriends', ['user'=>$user, 'friends'=>$friends]);
    }

    public function searchFriends(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            return redirect()->route('friends.list')->with('message', 'No results found');
        }
        $user = auth()->user();
        $friends = $user->myfriends->filter(function($friend) use ($search) {
            return stripos($friend->name, $search) !== false;
        });
            

        if ($friends->count() == 0) {
            return redirect()->route('friends.list')->with('message', 'No results found');
        }
        return view('/friends/myFriends', ['friends' => $friends]);
    }

    public function searchNewFriends(Request $request){
        $user = auth()->user();
        $searchTerm = $request->input('search');
        $friends = $user->myfriends;

        $friendIds = $friends->pluck('id')->toArray();

        
        if ($request) {
            $users = User::where('name', 'LIKE', '%'. $searchTerm. '%')->where('id', '!=', $user->id)->where('id', '!=', 1)->whereNotIn('id', $friendIds)->get();
        }


        return view('friends.add', compact(['users']));
    }

    public function addFriends(){
        $user = auth()->user();
        $friends = $user->myfriends;

        $friendIds = $friends->pluck('id')->toArray();

        $users = User::where('id', '!=', $user->id)
            ->where('id', '!=', 1)
            ->whereNotIn('id', $friendIds)
            ->get();

        return view('friends.add', compact(['users']));
    }

    public function storeFriend($id){
        $user = auth()->user();
        $friend = User::find($id);
        $user->myfriends()->attach($id);
        $friend->myfriends()->attach($user->id);

        return redirect()->route('friends.add')->with('message', 'Your friend has been added');    
    }

    public function show($id)
    {     
    $user = User::find($id);

    return view('friends.show', compact('user'));
    }


    public function destroyFriend($id)
    {
        $friend = User::find($id);
        $user = auth()->user();
        $user->myfriends()->detach($id);
        $friend->myfriends()->detach($user->id);

        return redirect()->route('friends.list')->with('message', 'Friend deleted successfully');    
    }



}
