<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.index');
    }

    public function redirecToSubscription(string $slug)
    {
        $config = config('stripe.subscriptions.'.$slug, null);
        abort_if($config === null, 404);

        /** @var \App\Models\Team $team */
        $team = Auth::user()->currentTeam;
        // dd($team->owner->email);

        return $team->owner
            ->newSubscription('default', $config['price_month_id'])
            ->checkout([
                'success_url' => route('dashboard.settings.index'),
                'cancel_url' => route('dashboard.settings.index'),
                'metadata' => [
                    'team_id' => $team->id,
                    'team_name' => $team->name,
                ],
            ]);
    }

    public function redirectToBilling()
    {
        /** @var \App\Models\Team $team */
        $team = Auth::user()->currentTeam;

        return $team->owner->redirectToBillingPortal(
            route('dashboard')
        );
    }
}
