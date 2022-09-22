<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class HomeController extends Controller
{

    public function home() {
        $tops = Campaign::where('status', 'ACTIVE')
            ->orderBy('views', 'DESC')
            ->limit(3)
            ->get();
        return view('app.home', compact('tops'));
    }

    public function browse() {
        $campaigns = Campaign::where('status', 'ACTIVE')
            ->limit(30)
            ->orderBy('views', 'DESC')
            ->get();
        return view('app.browse', compact('campaigns'));
    }

    public function view($code) {
        $campaign = Campaign::where('code', $code)
            ->first();
        if (!$campaign) {
            abort(404);
        }
        $campaign->views = $campaign->views+1;
        $campaign->save();
        $latest = Donor::where('campaign_id', $campaign->id)
            ->whereNotNull('paid_at')
            ->orderBy('paid_at', 'DESC')
            ->limit(5)
            ->get();
        $donors = Donor::where('campaign_id', $campaign->id)
            ->whereNotNull('paid_at')
            ->count();
        return view('app.view', compact('campaign', 'latest', 'donors'));
    }

    public function donate($code, Request $request) {
        $campaign = Campaign::where('code', $code)
            ->first();
        if (!$campaign) {
            abort(404);
        }
        if (!Auth::check()) {
            abort(401);;
        }

        // requests
        $isAnonymous = $request->input('send-anonymous') == '1';
        $amount = (int)str_replace('.', '', $request->input('amount'));
        $paymentMethod = $request->input('payment_method');

        if ($amount < 10000) {
            // user miss the validation
            return redirect()
                ->back();
        }

        if (!$paymentMethod) {
            return redirect()
                ->back();
        }

        $user = Auth::user();
        $user = User::find($user['id']);
        if (!$user) {
            return redirect()
                ->back();
        }

        $donor = new Donor();
        $donor->user()->associate($user);
        $donor->campaign()->associate($campaign);
        $donor->anonymous = $isAnonymous;
        $donor->amount = $amount;
        $donor->uuid = Str::uuid()->toString();
        $donor->expired_at = Carbon::now()->addDay();
        $donor->payment_method = $paymentMethod;
    }

}
