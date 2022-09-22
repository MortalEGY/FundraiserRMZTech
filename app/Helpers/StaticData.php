<?php

namespace App\Helpers;

use App\Models\Campaign;
use App\Models\Donor;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StaticData
{
    public static function myTotalDonation() {
        return Donor::where('user_id', Auth::user()['id'])
            ->where('paid', true)
            ->whereYear('paid_at', date('Y'))
            ->count() ?? 0;
    }

    public static function myTotalCampaign() {
        return Campaign::where('user_id', Auth::user()['id'])
            ->where('status', 'ACTIVE')
            ->count() ?? 0;
    }

    public static function userProfilePicture($path) {
        return asset('storage/profile/'.$path);
    }

    public static function campaignThumbnail($path) {
        return asset('storage/thumbnail/'.$path);
    }

    public static function campaignShortDescription($description) {
        return Str::limit(strip_tags(htmlspecialchars_decode(Markdown::convertToHtml($description))), 150);
    }
}
