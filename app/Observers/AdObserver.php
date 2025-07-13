<?php

namespace App\Observers;

use App\Models\Ad;
use App\Notifications\Ad\AdCreatedNotification;
use App\Notifications\Ad\AdStatusUpdatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AdObserver
{
    /**
     * Handle the Ad "created" event.
     */
    public function created(Ad $ad): void
    {
        // Generate and assign lot number if it doesn't have one
        if (empty($ad->lot_number)) {
            $ad->lot_number = $this->generateLotNumber($ad);
            $ad->save();
        }
        
        // if($ad->user->exists) {
        //     $ad->user?->notify(new AdCreatedNotification($ad));
        // } else {
        //     Notification::route('mail', $ad->seller_email)->notify(new AdCreatedNotification($ad));
        // }
    }
    
    /**
     * Generate a unique lot number based on category symbol and sequential number.
     *
     * @param Ad $ad
     * @return string
     */
    protected function generateLotNumber(Ad $ad): string
    {
        // Get category
        $category = $ad->category;
        
        // Get or generate symbol for the category
        if (empty($category->symbol)) {
            // If category has no symbol, create one based on first 2 letters of name
            $symbol = strtoupper(substr(trim($category->name), 0, 2));
            // Save the symbol to the category
            $category->symbol = $symbol;
            $category->save();
        } else {
            $symbol = $category->symbol;
        }
        
        // Find the highest lot number with this symbol
        $latestAd = Ad::where('lot_number', 'LIKE', $symbol . '%')
                      ->orderByRaw('LENGTH(lot_number) DESC, lot_number DESC')
                      ->first();
                      
        if ($latestAd && $latestAd->lot_number) {
            // Extract numeric part and increment
            $numericPart = (int) substr($latestAd->lot_number, 2);
            $nextNum = $numericPart + 1;
        } else {
            // Start from 1 if no previous lot numbers
            $nextNum = 1;
        }
        
        // Format number with leading zeros (e.g., EL001)
        return $symbol . str_pad($nextNum, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Handle the Ad "updated" event.
     */
    public function updated(Ad $ad): void
    {
        // Log::info('Updated');
        // if($ad->isDirty('status') && $ad->user->exists) {
        //     $ad->user?->notify(new AdStatusUpdatedNotification($ad));
        // } elseif($ad->isDirty('status') && !$ad->user->exists) {
        //     Notification::route('mail', $ad->seller_email)->notify(new AdStatusUpdatedNotification($ad));
        // }
    }

    /**
     * Handle the Ad "deleted" event.
     */
    public function deleted(Ad $ad): void
    {
        // $ad->media()->delete();
    }

    /**
     * Handle the Ad "restored" event.
     */
    public function restored(Ad $ad): void
    {
        //
    }

    /**
     * Handle the Ad "force deleted" event.
     */
    public function forceDeleted(Ad $ad): void
    {
        //
    }
}
