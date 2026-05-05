<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QurbanItem;

class QurbanCampaignController extends Controller
{
    public function index()
    {
        // Ambil hewan yang di-set sebagai campaign
        $hewanCampaign = QurbanItem::where('is_campaign', true)
                                    ->where('is_available', true)
                                    ->first();

        // Fallback: jika tidak ada hewan campaign, ambil hewan pertama yang tersedia
        if (!$hewanCampaign) {
            $hewanCampaign = QurbanItem::where('is_available', true)
                                        ->orderBy('sort_order')
                                        ->first();
        }

        return view('qurban-campaign.campaign', compact('hewanCampaign'));
    }
}
