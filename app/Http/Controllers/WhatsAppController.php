<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;


class WhatsAppController extends Controller
{
    // public function sendMessage()
    // {
    //     $response = Http::withHeaders([
    //         'Authorization' => '5wIi0vv1X3cCzXt6pscmZSZr9d91ieAwNvAyU1rQTsQAF840NIccQHG'
    //     ])->post('https://bdg.wablas.com/api/v2/send-message', [
    //         'data' => [[
    //             'phone' => '6281913842931',
    //             'message' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    //         ]],
    //         'secret' => true,
    //         'priority' => false,
    //     ]);

    //     $responseData = $response->json();

    //     if ($responseData['status'] === true) {
    //         return 'Pesan berhasil dikirim: ' . $responseData['message'];
    //     } else {
    //         return 'Gagal mengirim pesan: ' . $responseData['message'];
    //     }
        
    // }

    ///////////////////////////////////////////////////////
    // public function sendMessage(Request $request)
    // {
    //     $user = User::find($request->user_id);

    //     if (!$user || !$user->phone_number) {
    //         return 'Nomor telepon tidak ditemukan.';
    //     }
        
    //     $originalPhone = $user->phone_number;
    //     // Konversi format dari 081999... ke 6281999...
    //     $formattedPhone = preg_replace('/^0/', '62', $originalPhone);

    //     $message = $request->input('reply_content');

    //     $response = Http::withHeaders([
    //         'Authorization' => '5wIi0vv1X3cCzXt6pscmZSZr9d91ieAwNvAyU1rQTsQAF840NIccQHG'
    //     ])->post('https://bdg.wablas.com/api/v2/send-message', [
    //         'data' => [[
    //             'phone' => $formattedPhone,
    //             'message' => $message,
    //         ]],
    //         'secret' => true,
    //         'priority' => false,
    //     ]);

    //     $responseData = $response->json();

    //     if ($responseData['status'] === true) {
    //         return 'Pesan berhasil dikirim: ' . $responseData['message'];
    //     } else {
    //         return 'Gagal mengirim pesan: ' . $responseData['message'];
    //     }
    // }

    // public function sendMessage(Request $request)
    // {
    //     Log::info('Send WA dipanggil', $request->all());
    //     // Validasi input
    //     $request->validate([
    //         'phone' => 'required',
    //         'message' => 'required',
    //     ]);

    //     // Format nomor telepon
    //     // $phone = preg_replace('/^0/', '62', $request->input('phone'));

    //     // Kirim ke Wablas
    //     $response = Http::withHeaders([
    //         'Authorization' => '5wIi0vv1X3cCzXt6pscmZSZr9d91ieAwNvAyU1rQTsQAF840NIccQHG'
    //     ])->post('https://bdg.wablas.com/api/v2/send-message', [
    //         'data' => [[
    //             'phone' => $phone,
    //             'message' => $request->input('message'),
    //         ]],
    //         'secret' => true,
    //         'priority' => false,
    //     ]);

    //     // Cek hasil
    //     $responseData = $response->json();
    //     if ($responseData['status'] === true) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Pesan berhasil dikirim!',
    //             'wa_response' => $responseData
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengirim pesan!',
    //             'wa_response' => $responseData
    //         ], 500);
    //     }
    // }

    public function sendMessage(Request $request)
{
    $phone = $request->input('phone');
    $message = $request->input('message');

    // Format nomor telepon ke 628xxx
    $formattedPhone = preg_replace('/^0/', '62', $phone);

    $response = Http::withHeaders([
        'Authorization' => '5wIi0vv1X3cCzXt6pscmZSZr9d91ieAwNvAyU1rQTsQAF840NIccQHG'
    ])->post('https://bdg.wablas.com/api/v2/send-message', [
        'data' => [[
            'phone' => $formattedPhone,
            'message' => $message,
        ]],
        'secret' => true,
        'priority' => false,
    ]);

    $responseData = $response->json();

    if ($responseData['status'] === true) {
        return response()->json(['success' => true, 'message' => 'WA terkirim']);
    } else {
        return response()->json(['success' => false, 'message' => 'WA gagal: ' . $responseData['message']]);
    }
}
}




