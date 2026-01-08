<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\{Background,FileSent, Invoice,LayananFoto, Paket, Pemesanan, ServisTambahan};
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function mainIndex() {
        $datas = [
            "layanan_foto" => LayananFoto::all()
        ];

        return view("content.Main.index")->with("datas", $datas);
    }

    public function servisIndex($slug) {
        $datas = [
            "layanan_foto" => LayananFoto::where("slug", $slug)->first()
        ];

        return view("content.Main.servis")->with("datas", $datas);
    }

    public function kalenderIndex() {
        return view("content.Main.kalender");
    }

    public function formPemesananIndex($slug, Request $request) {
        $persen = 0;
        $desk = null;
        $nama_paket = $request->nama_paket;
        $background_paket = Background::all()->map(function ($data) use ($nama_paket) {
            $paket = Paket::where("nama_paket", $nama_paket)->first();
            $desk = []; // Initialize the desk array

            // Ensure the Paket exists and has a valid deskripsi
            if ($paket && $paket->deskripsi) {
                foreach (explode(",", $paket->deskripsi) as $deskripsi) {
                    // Calculate similarity percentage
                    similar_text(strtolower(trim($deskripsi)), strtolower(trim($data->nama_background)), $persen);

                    // Add to $desk if similarity is greater than 80%
                    if ($persen > 80) {
                        $desk[] = $data->id_background;
                    }
                }
            }

            // Only return the background data if there's a match
            if (!empty($desk)) {
                return [
                    'background_id' => $data->id_background,
                    "background_url"=> $data->gambar_bg,
                    'background_name' => $data->nama_background,
                    'matching_descriptions' => $desk,
                ];
            }

            return null; // Return null if no matching descriptions
        })->filter(); // Use `filter` to remove null values


        if(LayananFoto::where("slug", $slug)->get()->isEmpty()) {
            return redirect()->route('mainIndex');
        } else if(empty($nama_paket)) {
            return redirect()->route("servis", $slug);
        }else {
            $datas = [
                "file_sent" => FileSent::all(),
                "additional_service" => ServisTambahan::all(),
                "layanan_foto" => LayananFoto::where("slug", $slug)->first(),
                "paket" => Paket::where("nama_paket", $nama_paket)->first(),
                    "background" => Background::all(),
                    "background_paket" => $background_paket,
                    "slug" => $slug
            ];

            return view("content.Main.form-pemesanan")
            ->with("datas", $datas);
        }
    }

    public function successIndex() {
        return view("content.Main.success");
    }
    public function invoiceIndex($uuid, PDF $pdf) {
        $data = [
          'title' => "Invoice",
          "pemesanan" => Pemesanan::where("id_pemesanan", Invoice::where("uuid", $uuid)->first()->id_pemesanan)->with("pelanggan")->with("paket")->first()
        ];
        $pdf = $pdf->loadView("content.document.invoice", $data);
        return $pdf->download('contoh.pdf');
      }

    public function chatbotAPI(Request $request)
{
    // Ambil data dari database
    $servis = LayananFoto::pluck('nama_layanan_foto')->implode(', ');
    $paket = Paket::pluck('nama_paket')->implode(', ');

    // Instruksi sistem disisipkan langsung di awal percakapan
    $systemPrompt = "Kamu adalah chatbot yang menjawab pertanyaan seputar foto studio 'unlock studio', harus menjawab secara detail. " .
                    "Layanan yang tersedia: {$servis}. " .
                    "Paket yang tersedia: {$paket}. " .
                    "Alamat unlock studio: 'Perum Bumi Palapa, Jl. Saxophone No. blok E27, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur'. " .
                    "Alur pemesanan di web unlockis: pertama, user memilih layanan foto (misalnya graduation, prewed, dll), lalu memilih paket (basic sampai luxury), kemudian mengisi formulir berisi biodata, nomor telepon, dll. " .
                    "Setelah itu, invoice akan dikirim via WhatsApp ke nomor yang dimasukkan, dan di dalam invoice dijelaskan cara pembayarannya.";

    // Susun percakapan: instruksi + input user
    $contents = [
        [
            "role" => "user",
            "parts" => [
                ["text" => $systemPrompt]
            ]
        ],
        [
            "role" => "model",
            "parts" => [
                ["text" => "Siap membantu! Silakan ajukan pertanyaan Anda."]
            ]
        ],
        [
            "role" => "user",
            "parts" => [
                ["text" => $request->userInput]
            ]
        ]
    ];

    $requestBody = [
        "contents" => $contents
    ];

    // URL endpoint model (tanpa API key di sini)
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";

    $apiKey = env('API_KEY_GEMINI'); // Ambil dari .env

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'x-goog-api-key: AIzaSyCgu2ARH50BhEHu1_YsdWn29kDwWhspF8s'  // <-- Header API key sesuai contoh curl
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return response()->json([
            "status" => false,
            "data" => ["text" => "Error saat menghubungi API: " . curl_error($ch)]
        ], 500);
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        $botResponse = $data['candidates'][0]['content']['parts'][0]['text'];
        return response()->json([
            "status" => true,
            "data" => ["text" => $botResponse]
        ], 200);
    } else {
        $errorMessage = $data['error']['message'] ?? 'Respons tidak sesuai format';
        return response()->json([
            "status" => false,
            "data" => ["text" => "Gagal mendapatkan respons: " . $errorMessage]
        ], 200);
    }
}}
