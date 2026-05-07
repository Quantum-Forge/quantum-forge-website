<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AiService
{
    /**
     * Generate Artikel menggunakan Gemini 1.5 Flash
     */
    public function generateArticle($topic)
    {
        $prompt = "Tuliskan artikel blog SEO dalam bahasa Indonesia tentang: $topic. 
                   PENTING: Hanya berikan output berupa kode HTML murni tanpa tag pembuka/penutup ```html atau markdown lainnya.
                   Gunakan struktur HTML yang persis dengan template berikut ini untuk memformat artikel (buat isinya panjang dan informatif, minimal 5 paragraf). 
                   Pastikan kamu menggunakan elemen HTML sesuai struktur ini:

                   <p>Paragraf pembuka yang memikat perhatian pembaca tentang $topic. Jelaskan latar belakang dan mengapa topik ini penting.</p>
                   
                   <div class=\"middle-image\">
                       <!-- Tempat untuk menyisipkan gambar tambahan nantinya, biarkan elemen div dan img ini apa adanya tapi kamu boleh ubah atribut alt-nya -->
                       <img src=\"https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg\" alt=\"Ilustrasi $topic\" />
                   </div>

                   <h4>Subjudul pertama yang relevan dan menarik</h4>
                   <p>Paragraf isi yang menjelaskan subjudul di atas secara komprehensif dan mendalam.</p>
                   
                   <blockquote>
                       <div class=\"blockquote-text\"><span class=\"quote icofont-quote-left\"></span>Kutipan menarik, fakta penting, atau insight kunci yang relevan dengan topik ini.</div>
                   </blockquote>
                   
                   <h4>Subjudul kedua yang lebih spesifik</h4>
                   <p>Paragraf isi tambahan yang memberikan wawasan lebih dalam, contoh kasus, atau penjelasan lanjutan.</p>
                   <p>Paragraf penutup yang merangkum keseluruhan poin-poin artikel dan memberikan kesimpulan yang kuat.</p>

                   Jangan tambahkan tag <html>, <head>, <body>, atau <style>. Fokus HANYA pada isi konten dengan elemen <p>, <h4>, <blockquote>, dan <div class=\"middle-image\"> persis seperti contoh di atas.";

        $result = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
        
        // Membersihkan markdown block jika AI tetap mengirimkannya
        $html = $result->text();
        $html = preg_replace('/```html\s*/i', '', $html);
        $html = preg_replace('/```\s*/i', '', $html);
        
        return trim($html);
    }

    /**
     * Generate Gambar menggunakan Stable Diffusion (Hugging Face)
     */
    public function generateImage($prompt)
    {
        // Try the new API endpoint structure
        $response = Http::withToken(env('HUGGING_FACE_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'image/png'
            ])
            ->post('https://api-inference.huggingface.co/models/black-forest-labs/FLUX.1-dev', [
                'inputs' => $prompt,
            ]);

        if ($response->successful()) {
            $imageName = 'ai-gen-' . uniqid() . '.png';
            Storage::disk('public')->put("images/$imageName", $response->body());
            return "images/$imageName";
        }

        // Fallback to Stable Diffusion if the first fails
        $response2 = Http::withToken(env('HUGGING_FACE_TOKEN'))
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'image/png'
            ])
            ->post('https://api-inference.huggingface.co/models/stabilityai/stable-diffusion-3.5-large', [
                'inputs' => $prompt,
            ]);
            
        if ($response2->successful()) {
            $imageName = 'ai-gen-' . uniqid() . '.png';
            Storage::disk('public')->put("images/$imageName", $response2->body());
            return "images/$imageName";
        }

        return null;
    }
}
