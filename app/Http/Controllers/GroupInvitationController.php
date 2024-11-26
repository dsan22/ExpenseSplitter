<?php

namespace App\Http\Controllers;

use App\Mail\GroupInvitationMail;
use App\Models\Group;
use App\Models\GroupInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GroupInvitationController extends Controller
{
    public function sendInvitation(Request $request, Group $group)
{
    
    $request->validate(['email' => 'required|email']);
    $token = Str::random(32);
    $invitation = GroupInvitation::create([
        'group_id' => $group->id,
        'email' => $request->email,
        'token' => $token,
    ]);
    $url = route('groups.accept-invitation', $token);

    Mail::to($request->email)->send(new GroupInvitationMail($group, $url));

    return response()->json(['message' => 'Invitation sent successfully!']);
}

public function acceptInvitation($token)
{
    $invitation = GroupInvitation::where('token', $token)->firstOrFail();

    if ($invitation->accepted_at) {
        return response()->json(['message' => 'Invitation already accepted.']);
    }

    auth()->user()->groups()->attach($invitation->group_id);

    $invitation->update(['accepted_at' => now()]);

    return redirect()->route('groups.index')->with('success', 'You have joined the group!');
}
}
