<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\Imagick;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    public function showTwoFactorForm()
    {
        $user = auth()->user();
        
        if (!$user->two_factor_secret) {
            // Generate new secret
            $secret = $this->google2fa->generateSecretKey();
            
            // Store secret in session temporarily
            session(['2fa_secret' => $secret]);
            
            // Generate QR code
            $renderer = new ImageRenderer(
                new Imagick()
            );
            
            $writer = new Writer($renderer);
            $qrCode = 'data:image/png;base64,' . base64_encode($writer->writeString(
                $this->google2fa->getQRCodeUrl(
                    config('app.name'),
                    $user->email,
                    $secret
                )
            ));
            
            return view('auth.two-factor', compact('qrCode', 'secret'));
        }
        
        return view('auth.two-factor-verify');
    }

    public function enableTwoFactor(Request $request)
    {
        $request->validate([
            'secret' => 'required|string',
            'one_time_password' => 'required|numeric'
        ]);
        
        $user = auth()->user();
        
        if ($this->google2fa->verifyKey($request->secret, $request->one_time_password)) {
            $user->update([
                'two_factor_secret' => $request->secret,
                'two_factor_enabled' => true
            ]);
            
            return redirect()->route('dashboard')->with('success', 'Two-factor authentication enabled successfully');
        }
        
        return back()->withErrors(['one_time_password' => 'Invalid verification code']);
    }
}
