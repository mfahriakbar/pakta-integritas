<?php

namespace App\Services;

use App\Models\VisitorStat;
use App\Models\VisitorSession;
use Illuminate\Support\Facades\DB;

class VisitorService
{
    public function recordVisit()
    {
        $sessionId = session()->getId();
        $today = today();
        $ipAddress = request()->ip();

        try {
            return DB::transaction(function () use ($sessionId, $today, $ipAddress) {
                // Check if session already recorded today
                $existingSession = VisitorSession::where('session_id', $sessionId)
                    ->whereDate('visit_date', $today)
                    ->exists();

                if (!$existingSession) {
                    // Record new session
                    VisitorSession::create([
                        'session_id' => $sessionId,
                        'ip_address' => $ipAddress,
                        'visit_date' => $today,
                    ]);

                    // Update or create visitor stats
                    VisitorStat::updateOrCreate(
                        ['visit_date' => $today],
                        ['visit_count' => DB::raw('visit_count + 1')]
                    );
                }

                return $this->getStats();
            });
        } catch (\Exception $e) {
            \Log::error('Error recording visitor: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getStats()
    {
        return [
            'today' => VisitorStat::today()->value('visit_count') ?? 0,
            'yesterday' => VisitorStat::yesterday()->value('visit_count') ?? 0,
            'total' => VisitorStat::sum('visit_count') ?? 0,
        ];
    }
}