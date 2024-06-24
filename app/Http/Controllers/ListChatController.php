<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Message;
use Illuminate\Http\Request;

class ListChatController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $user = $request->user();

        $followings = $user->followings()->get();

        $latestMessages = [];

        foreach ($followings as $following) {
            $latestMessage = Message::query()
                ->where(function ($query) use ($user, $following) {
                    $query->where('from_user_id', $user->id)
                        ->where('to_user_id', $following->id);
                })
                ->orWhere(function ($query) use ($user, $following) {
                    $query->where('from_user_id', $following->id)
                        ->where('to_user_id', $user->id);
                })
                ->latest()
                ->first();

            $latestMessages[$following->id] = $latestMessage;
        }

        $groups = Groups::query()
            ->with('currentUserGroup')
            ->select(['groups.*'])
            ->join('group_users as gu', 'gu.group_id', 'groups.id')
            ->where('gu.user_id', $userId)
            ->orderBy('gu.role')
            ->orderBy('name', 'desc')
            ->get();

        return view('dashboard', [
            'groups' => $groups,
            'users' => $followings,
            'latestMessages' => $latestMessages,
        ]);
    }
}
