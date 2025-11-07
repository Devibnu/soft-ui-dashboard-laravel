<?php

namespace App\View\Composers;

use App\Models\HeaderInfo;
use Illuminate\View\View;

class HeaderInfoComposer
{
    /**
     * Bind data ke view
     * Memberikan data Header Info yang aktif ke semua view
     */
    public function compose(View $view)
    {
        // Get active header info
        $headerInfo = HeaderInfo::where('status', true)->first();
        
        // Share data ke view
        $view->with('headerInfo', $headerInfo);
    }
}
