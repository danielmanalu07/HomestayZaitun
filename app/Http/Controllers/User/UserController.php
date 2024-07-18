<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Verify_Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function Register(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_lengkap' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'phone' => 'required|unique:users,phone',
                'alamat' => 'required',
                'photo' => 'nullable|mimes:jpg,png,jpeg',
            ]);
            try {
                $user = new User();
                $user->nama_lengkap = $request->input('nama_lengkap');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                $user->phone = $request->input('phone');
                $user->alamat = $request->input('alamat');

                $profile = null;
                if ($request->hasFile('photo')) {
                    $profile = $request->nama_lengkap . '.' . $request->file('photo')->extension();
                    $request->file('photo')->move(public_path('Customer/Profile'), $profile);
                }
                $user->photo = $profile ?? '';
                $user->save();
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Terjadi Kesalahan Pada Saat Penyimpanan Data.');
            }

            $token = Str::random(64);
            $code = rand(100000, 999999);

            try {
                Verify_Users::create([
                    'user_id' => $user->id,
                    'token' => $token,
                    'code' => $code,
                    'expires_at' => Carbon::now()->addMinutes(1),
                    'verification_date' => Carbon::now(),
                ]);

                session(['user' => $user, 'code' => $code, 'token' => $token]);

                $mailData = [
                    'recipient' => $request->email,
                    'fromEmail' => env('MAIL_FROM_ADDRESS'),
                    'fromName' => env('MAIL_FROM_NAME'),
                    'subject' => 'Code Verification Email',
                    'body' => view('Mail.RegistrationCode', ['user' => $user, 'code' => $code])->render(),
                ];

                Mail::send('Mail.RegistrationCode', ['user' => $user, 'code' => $code], function ($message) use ($mailData) {
                    $message->to($mailData['recipient'])
                        ->from($mailData['fromEmail'], $mailData['fromName'])
                        ->subject($mailData['subject']);
                });

                return redirect('/user/verification-code-email')->with('success', 'Berhasil Melakukan Registrasi. Check Email Untuk Melihat Kode Verifikasi Anda');
            } catch (\Throwable $th) {
                $user->delete();
                return redirect()->back()->with('error', 'Terjadi Kesalahan Verifikasi Email. Silahkan Coba Lagi');
            }
        }
        return view('User.Auth.Register');
    }

    public function verificationCodeEmail(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'code' => 'required|numeric',
            ]);

            try {
                $code = $request->input('code');
                $code_verification = Verify_Users::where('code', $code)->first();

                if (!$code_verification) {
                    return redirect()->back()->with('error', 'Invalid Verification Code');
                }

                $verification_expired = Carbon::parse($code_verification->expires_at);
                if ($verification_expired->isPast()) {
                    return redirect()->back()->with('error', 'Verification Code Expired. Please Resend Code again');
                }

                $user = User::find($code_verification->user_id);
                $user->email_verified_at = Carbon::now();
                $user->is_verified = 1;
                $user->remember_token = session('token');
                $user->save();

                return redirect()->route('login.user')->with('success', 'Email Verified Successfully');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Terjadi Kesalahan Pada Code Verifikasi');
            }
        }
        return view('User.Auth.Email_Verification');
    }

    public function ResendCode(Request $request)
    {
        try {
            $user = session('user');

            if (!$user || !$user->email) {
                return redirect()->back()->with('error', 'User or email not found in session.');
            }

            $token = Str::random(64);
            $code = rand(100000, 999999);

            $verify_user = Verify_Users::where('user_id', $user->id)->first();

            if (!$verify_user) {
                return redirect()->back()->with('error', 'Verification record not found.');
            }

            $verify_user->token = $token;
            $verify_user->code = $code;
            $verify_user->verification_date = Carbon::now();
            $verify_user->expires_at = Carbon::now()->addMinutes(1);
            $verify_user->save();

            session(['code' => $code]);

            $mailData = [
                'recipient' => $user->email,
                'fromEmail' => env('MAIL_FROM_ADDRESS'),
                'fromName' => env('MAIL_FROM_NAME'),
                'subject' => 'Code Verification Email',
                'body' => view('Mail.RegistrationCode', ['user' => $user, 'code' => $code])->render(),
            ];

            Mail::send('Mail.RegistrationCode', ['user' => $user, 'code' => $code], function ($message) use ($mailData) {
                $message->to($mailData['recipient'])
                    ->from($mailData['fromEmail'], $mailData['fromName'])
                    ->subject($mailData['subject']);
            });

            return redirect()->back()->with('success', 'Code Verifikasi Sudah Dikirim Kembali ke email Anda');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Code Verifikasi Tidak Dapat Dikirim');
        }
    }

    public function Login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6',
            ]);

            try {
                if (Auth::guard('user')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                    return redirect()->route('user.home');
                } else {
                    return redirect()->back()->with('error', 'Email atau Password Salah');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Terjadi Kesalahan Pada Saat Login');
            }
        }
        return view('User.Auth.Login');
    }

    public function Logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }

    public function Home()
    {
        return view('Guest.Home');
    }

    public function LupaPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'phone' => 'required|numeric',
            ]);

            $user = User::where('email', $request->input('email'))->first();

            try {
                if ($user->is_verified == 1) {
                    if ($user->phone !== $request->input('phone')) {
                        return redirect()->back()->with('error', 'Number Phone is does not match the email');
                    }

                    $token = Str::random(64);
                    $code = rand(100000, 999999);

                    $passwordReset = PasswordReset::where('email', $request->input('email'))->first();

                    if ($passwordReset) {
                        $passwordReset->update([
                            'user_id' => $user->id,
                            'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                            'token' => $token,
                            'verification_code' => $code,
                            'verification_date' => Carbon::now(),
                            'expires_at' => Carbon::now()->addMinutes(2),
                        ]);
                    } else {
                        PasswordReset::create([
                            'user_id' => $user->id,
                            'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                            'token' => $token,
                            'verification_code' => $code,
                            'verification_date' => Carbon::now(),
                            'expires_at' => Carbon::now()->addMinutes(2),
                        ]);
                    }

                    session(['user_reset' => $user, 'code_reset' => $code, 'token_reset' => $token]);

                    $mailData = [
                        'recipient' => $request->email,
                        'fromEmail' => env('MAIL_FROM_ADDRESS'),
                        'fromName' => env('MAIL_FROM_NAME'),
                        'subject' => 'Code Verification Email',
                        'body' => view('Mail.ResetPassword', ['user' => $user, 'code' => $code])->render(),
                    ];

                    Mail::send('Mail.ResetPassword', ['user' => $user, 'code' => $code], function ($message) use ($mailData) {
                        $message->to($mailData['recipient'])
                            ->from($mailData['fromEmail'], $mailData['fromName'])
                            ->subject($mailData['subject']);
                    });

                    return redirect()->route('code.resetpassword')->with('success', 'Kode Verifikasi Telah dikirim Ke Email Anda. Silahkan Masukkan kode Verifikasinya');
                } else {
                    return redirect()->back()->with('error', 'Akun ini belum melakukan verifikasi email');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Terjadi Kesalahan Melakukan Validasi Akun');
            }

        }
        return view('User.LupaPassword');
    }

    public function CodeResetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'verification_code' => 'required|numeric',
            ]);

            $passwordReset = PasswordReset::where('verification_code', $request->verification_code)->first();

            try {
                if (!$passwordReset) {
                    return redirect()->back()->with('error', 'Incorrect Verification Code');
                }

                $verification_expired = Carbon::parse($passwordReset->expires_at);
                if ($verification_expired->isPast()) {
                    return redirect()->back()->with('error', 'Verification Code has expired. Please resend the code again');
                }

                return redirect()->route('user.newPassword')->with('success', 'Verification code is valid. Please create a new password');
            } catch (\Throwable $th) {
                return redirect()->route('user.newPassword')->with('error', 'An error occurred while verifying the code');
            }
        }
        return view('User.ResetPasswordCode');
    }

    public function ResendCodeResetPassword(Request $request)
    {
        try {
            $user = session('user_reset');

            if (!$user || !$user->email) {
                return redirect()->back()->with('error', 'User atau email tidak ditemukan di sesi.');
            }

            $token = Str::random(64);
            $code = rand(100000, 999999);

            $reset_password = PasswordReset::where('user_id', $user->id)->first();

            if (!$reset_password) {
                return redirect()->back()->with('error', 'Record verifikasi tidak ditemukan.');
            }

            $reset_password->update([
                'token' => $token,
                'verification_code' => $code,
                'verification_date' => Carbon::now(),
                'expires_at' => Carbon::now()->addMinutes(2),
            ]);

            session(['code_reset' => $code]);

            $mailData = [
                'recipient' => $user->email,
                'fromEmail' => env('MAIL_FROM_ADDRESS'),
                'fromName' => env('MAIL_FROM_NAME'),
                'subject' => 'Code Verification Email',
                'body' => view('Mail.ResetPassword', ['user' => $user, 'code' => $code])->render(),
            ];

            Mail::send('Mail.ResetPassword', ['user' => $user, 'code' => $code], function ($message) use ($mailData) {
                $message->to($mailData['recipient'])
                    ->from($mailData['fromEmail'], $mailData['fromName'])
                    ->subject($mailData['subject']);
            });

            return redirect()->back()->with('success', 'Kode Verifikasi telah dikirim ulang ke email Anda');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kode Verifikasi tidak dapat dikirim');
        }
    }

    public function NewPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);

            $passwordReset = PasswordReset::first();
            if (!$passwordReset) {
                return redirect()->back()->with('error', 'Invalid  Reset Request');
            }

            $user = $passwordReset->user;
            if ($user->is_verified == 1) {
                $user->password = Hash::make($request->input('password'));
                $user->save();

                return redirect()->route('login.user')->with('success', 'Password Berhasil Diganti');
            } else {
                return redirect()->back()->with('error', 'Akun Belum Diverifikasi');
            }
        }
        return view('User.NewPassword');
    }
}
