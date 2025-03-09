<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Str;
use App\Models\User;
use App\Models\ScheduleBooking;

class APIController extends Controller
{
    public function generate_token(Request $request) {
        try{
            $frontendSecret = env('FRONTEND_SECRET');
            $localSecret = env('FRONTEND_SECRET_LOCAL');

            $allowedSecrets = [$frontendSecret, $localSecret];

            if (!in_array($request->header('X-Frontend-Secret'), $allowedSecrets)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $user = User::whereIn('id', [1, 2, 3])->first();

            if (!$user) {
                return response()->json(['error' => 'No user found'], 404);
            }

            // Generate and return token
            $plainTextToken = $user->createToken('Manual Token')->plainTextToken;

            return response()->json(['token' => $plainTextToken]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function book_schedule(Request $request) {
        try{
            $frontendSecret = env('FRONTEND_SECRET');
            $localSecret = env('FRONTEND_SECRET_LOCAL');

            $allowedSecrets = [$frontendSecret, $localSecret];

            if (!in_array($request->header('X-Frontend-Secret'), $allowedSecrets)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $scheduleBooking = ScheduleBooking::create([
                'frequency' => $request->frequency === 'Recurring' ? 1 : 2,
                'start_date' => $request->start_date,
                'days' => json_encode($request->days),
                'times' => json_encode($request->times),
                'notes' => $request->notes
            ]);

            return response()->json([
                'success' => true,
                'schedule_booking' => $scheduleBooking
                ]
            );
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
