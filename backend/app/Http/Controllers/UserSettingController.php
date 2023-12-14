<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSetting;

class UserSettingController extends Controller
{
    /**
     * Store user settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find( $user_id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $request->validate([
        ]);
        $user->settings()->delete();
        $userSettings = $user->settings()->create($request->all());
    
        return response()->json(['message' => 'User settings inserted successfully.', 'data' => $userSettings]);
    }
    public function findSettings(Request $request)
    {
        $user_id = $request->input('id');
    
        try {
            $userSetting = UserSetting::where('user_id', $user_id)->firstOrFail();
            return response()->json($userSetting, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User settings not found'], 404);
        }
    }
}

