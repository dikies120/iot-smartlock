<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pin;
use App\Models\AccessLog;
use Illuminate\Support\Facades\Auth;

class SmartLockController extends Controller
{
    public function controlPanel()
    {
        $logs = AccessLog::orderBy('accessed_at', 'desc')->get();
        return view('smartlock.control', compact('logs'));
    }

    public function setPin(Request $request)
    {
        $request->validate([
            'newPin' => 'required|string|min:4'
        ]);

        $user = Auth::user();

Pin::updateOrCreate(
            ['user_id' => $user->id],
            ['pin_code' => $request->newPin]
        );

        AccessLog::create([
            'user_id' => $user->id,
            'action' => "Setel PIN baru",
        ]);

        return back()->with('success', 'PIN berhasil disimpan!');
    }

    public function openDoor(Request $request)
    {
        $request->validate([
            'doorPin' => 'required|string'
        ]);

        $user = Auth::user();
        $pin = Pin::where('user_id', $user->id)->first();

        if ($pin && $pin->pin_code === $request->doorPin) {
            try {
                
                Http::timeout(5)->get('http://192.168.57.195/open');
                
                AccessLog::create([
                    'user_id' => $user->id,
                    'action' => "Pintu dibuka",
                ]);

                return back()->with('success', 'Pintu berhasil dibuka!');
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal terhubung ke Smart Lock: ' . $e->getMessage());
            }
        }

        return back()->with('error', 'PIN salah!');
    }

    public function closeDoor(Request $request)
    {
        try {
            Http::timeout(5)->get('http://192.168.57.195/close');
            
            AccessLog::create([
                'user_id' => Auth::id(),
                'action' => "Pintu ditutup",
            ]);

            return back()->with('success', 'Pintu berhasil ditutup!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal terhubung ke Smart Lock: ' . $e->getMessage());
        }
    }
}
