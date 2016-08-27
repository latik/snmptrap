<?php

namespace App\Observers;

use App\Point;

class PointObserver
{
    /**
     * Listen to the Point updated event.
     *
     * @param Point $point
     */
    public function updated(Point $point)
    {
        \Event::fire('point.updated', $point);
        \Log::debug("point {$point->ip} status changed {$point->status}", ['point_id' => $point->id]);
    }
}