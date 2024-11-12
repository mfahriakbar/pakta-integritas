<?php

namespace App\Http\Controllers;

use App\Models\VisitorStat;
use App\Models\VisitorSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function record(): JsonResponse
    {
        \Log::info('Mencoba merekam pengunjung');

        try {
            $sessionId = session()->getId();
            $today = today();
            
            return DB::transaction(function () use ($sessionId, $today) {
                // Check if session already recorded today
                $existingSession = VisitorSession::where('session_id', $sessionId)
                    ->whereDate('visit_date', $today)
                    ->exists();

                if (!$existingSession) {
                    // Record new session
                    VisitorSession::create([
                        'session_id' => $sessionId,
                        'visit_date' => $today,
                    ]);

                    // Update or create visitor stats
                    VisitorStat::updateOrCreate(
                        ['visit_date' => $today],
                        ['visit_count' => DB::raw('visit_count + 1')]
                    );
                }

                // Get stats
                $stats = [
                    'today' => VisitorStat::whereDate('visit_date', $today)->value('visit_count') ?? 0,
                    'yesterday' => VisitorStat::whereDate('visit_date', $today->copy()->subDay())->value('visit_count') ?? 0,
                    'total' => VisitorStat::sum('visit_count') ?? 0,
                ];

                return response()->json([
                    'success' => true,
                    'stats' => $stats
                ]);
            });
        } catch (\Exception $e) {
            \Log::error('Error recording visitor: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error recording visitor'
            ], 500);
        }
    }
}