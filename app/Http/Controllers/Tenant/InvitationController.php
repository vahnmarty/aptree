<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Team;
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

            return 'nice!';

            # Attach to Team

            if($invitation->team_id)
            {
                //$team = Team::find($invitation->team_id);
                //$team->attach()
            }
        }
    }
}
