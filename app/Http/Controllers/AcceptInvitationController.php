<?php

namespace App\Http\Controllers;

use App\Mail\GroupInvitationMail;
use App\Models\Group;
use App\Models\GroupInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AcceptInvitationController extends Controller
{

    public function __invoke($token){
        $invitation = GroupInvitation::where('token', $token)->firstOrFail();

        if ($invitation->accepted_at) {
            return response()->json(['message' => 'Invitation already accepted.']);
        }

        auth()->user()->groups()->attach($invitation->group_id);

        $invitation->update(['accepted_at' => now()]);

        return redirect()->route('groups.index')->with('success', 'You have joined the group!');
    }
}
