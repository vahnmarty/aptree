<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Team;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvitationController extends Controller
{
    public function accept(Request $request, $token)
    {
        $invitation = Invitation::whereToken($token)->whereEmail($request->email)->firstOrFail();

        if($invitation)
        {
            # Accept
            $invitation->accepted_at = now();
            $invitation->save();

            
            # Create Account
            return redirect()->route('invitation.register', ['token' => $token, 'email' => $request->email]);
            
        }
    }

    public function register(Request $request, $token)
    {
        $invitation = Invitation::whereToken($token)->whereEmail($request->email)->firstOrFail();
        $email = $invitation->email;

        return view('theme::auth_tenant.invitation-registration', compact('invitation', 'email'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'name' => 'required|min:2|max:191',
            'password' => 'required|min:5|max:191|confirmed'
        ]);

        $invitation = Invitation::whereToken($request->token)->whereEmail($request->email)->firstOrFail();

        if($invitation)
        {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->avatar = 'users/default.png';
            $user->password = bcrypt($request->password);
            $user->role_id = 3; // Student
            $user->save();

            # Attach to Team

            if($invitation->team_id)
            {
                $team = Team::find($invitation->team_id);
                $team->users()->attach($user->id);
            }
        }

        return redirect('dashboard');
    }
}
