<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class TranslationService
{
    private const MYMEMORY_URL =
        'https://api.mymemory.translated.net/get';

    // Endpoint Google Translate không chính thức.
    private const GOOGLE_URL =
        'https://translate.googleapis.com/translate_a/single';

    private const MAX_CHARS = 400;

    public function translate(string $text): string
    {
        $text = trim($text);

        if ($text === '') {
            return '';
        }
        
        // Tự động bổ sung dấu chấm cho câu tiếng Việt
// có nhiều từ và chưa có dấu kết thúc.
if (
    preg_match('/\s/u', $text) &&
    !preg_match('/[.!?…]$/u', $text)
) {
    $text .= '.';
}

        $chunks = $this->splitText($text);
        $results = [];

        foreach ($chunks as $index => $chunk) {
            try {
                $results[] = $this->translateChunk($chunk);
            } catch (Throwable $e) {
                Log::error('Translation failed', [
                    'chunk' => $index + 1,
                    'total_chunks' => count($chunks),
                    'error' => $e->getMessage(),
                ]);

                throw new RuntimeException(
                    'Không thể dịch đoạn ' .
                    ($index + 1) . '/' . count($chunks) .
                    ': ' . $e->getMessage(),
                    0,
                    $e
                );
            }
        }

        return implode("\n", $results);
    }

    private function translateChunk(string $text): string
    {
        // Ưu tiên MyMemory.
        try {
            $translated = $this->translateWithMyMemory($text);

            if (!$this->isUntranslated($text, $translated)) {
                return $translated;
            }

            Log::warning(
                'MyMemory returned untranslated text'
            );
        } catch (Throwable $e) {
            Log::warning('MyMemory failed', [
                'error' => $e->getMessage(),
            ]);
        }

        // Nếu MyMemory thất bại, chuyển sang Google.
        try {
            $translated = $this->translateWithGoogle($text);

            if (!$this->isUntranslated($text, $translated)) {
                return $translated;
            }

            throw new RuntimeException(
                'Google trả về nội dung chưa dịch.'
            );
        } catch (Throwable $e) {
            Log::error('Google fallback failed', [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException(
                'Cả MyMemory và Google đều không dịch được.',
                0,
                $e
            );
        }
    }

    private function translateWithMyMemory(
        string $text
    ): string {
        $response = Http::acceptJson()
            ->timeout(15)
            ->get(self::MYMEMORY_URL, [
                'q' => $text,
                'langpair' => 'vi|en',
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'MyMemory HTTP ' . $response->status()
            );
        }

        $data = $response->json();

        if ((int) ($data['responseStatus'] ?? 0) !== 200) {
            throw new RuntimeException(
                (string) ($data['responseDetails']
                    ?? 'MyMemory API error')
            );
        }

        $translated =
            $data['responseData']['translatedText'] ?? null;

        if (!is_string($translated) || trim($translated) === '') {
            throw new RuntimeException(
                'MyMemory không trả về bản dịch.'
            );
        }

        return trim(html_entity_decode(
            $translated,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        ));
    }

    private function translateWithGoogle(
        string $text
    ): string {
        $response = Http::acceptJson()
            ->timeout(15)
            ->get(self::GOOGLE_URL, [
                'client' => 'gtx',
                'sl' => 'vi',
                'tl' => 'en',
                'dt' => 't',
                'q' => $text,
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'Google HTTP ' . $response->status()
            );
        }

        $data = $response->json();

        if (!is_array($data) || !isset($data[0])) {
            throw new RuntimeException(
                'Google trả về dữ liệu không hợp lệ.'
            );
        }

        $translated = '';

        foreach ($data[0] as $segment) {
            if (
                is_array($segment) &&
                isset($segment[0]) &&
                is_string($segment[0])
            ) {
                $translated .= $segment[0];
            }
        }

        $translated = trim($translated);

        if ($translated === '') {
            throw new RuntimeException(
                'Google không trả về bản dịch.'
            );
        }

        return $translated;
    }

    private function isUntranslated(
        string $original,
        string $translated
    ): bool {
        // Không tự coi tên công nghệ hoặc từ không dấu
        // là lỗi dịch chỉ vì chúng được giữ nguyên.
        if (!$this->hasVietnameseCharacters($original)) {
            return false;
        }

        $normalize = function (string $value): string {
            $value = mb_strtolower(trim($value));

            $value = preg_replace(
                '/[^\p{L}\p{N}\s]/u',
                '',
                $value
            );

            return trim(
                preg_replace('/\s+/u', ' ', $value)
            );
        };

        return $normalize($original) ===
            $normalize($translated);
    }

    private function hasVietnameseCharacters(
        string $text
    ): bool {
        return preg_match(
            '/[àáạảãâầấậẩẫăằắặẳẵ'
            . 'èéẹẻẽêềếệểễ'
            . 'ìíịỉĩ'
            . 'òóọỏõôồốộổỗơờớợởỡ'
            . 'ùúụủũưừứựửữ'
            . 'ỳýỵỷỹđ'
            . 'ÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴ'
            . 'ÈÉẸẺẼÊỀẾỆỂỄ'
            . 'ÌÍỊỈĨ'
            . 'ÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠ'
            . 'ÙÚỤỦŨƯỪỨỰỬỮ'
            . 'ỲÝỴỶỸĐ]/u',
            $text
        ) === 1;
    }

    private function splitText(string $text): array
    {
        $lines = preg_split('/\R/u', $text);
        $chunks = [];

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            $words = preg_split('/\s+/u', $line);
            $current = '';

            foreach ($words as $word) {
                if (mb_strlen($word) > self::MAX_CHARS) {
                    if ($current !== '') {
                        $chunks[] = $current;
                        $current = '';
                    }

                    foreach (
                        mb_str_split($word, self::MAX_CHARS)
                        as $part
                    ) {
                        $chunks[] = $part;
                    }

                    continue;
                }

                $candidate = $current === ''
                    ? $word
                    : $current . ' ' . $word;

                if (mb_strlen($candidate) > self::MAX_CHARS) {
                    if ($current !== '') {
                        $chunks[] = $current;
                    }

                    $current = $word;
                } else {
                    $current = $candidate;
                }
            }

            if ($current !== '') {
                $chunks[] = $current;
            }
        }

        return $chunks;
    }
}
