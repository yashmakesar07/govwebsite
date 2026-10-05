<?php

namespace App\Services;

class PdfGenerator
{
    /**
     * Generate a valid standard PDF 1.4 binary string
     */
    public static function create(string $title, string $refNumber, array $paragraphs): string
    {
        $date = date('d-m-Y H:i:s');
        $dept = "DEPARTMENT OF PUBLIC INFRASTRUCTURE";
        $state = "GOVERNMENT OF EXAMPLE STATE";

        // Build text stream
        $textOps = [];
        $textOps[] = "BT";
        $textOps[] = "/F1 18 Tf";
        $textOps[] = "50 730 Td";
        $textOps[] = "(" . self::escapePdf($dept) . ") Tj";
        
        $textOps[] = "0 -22 Td";
        $textOps[] = "/F1 12 Tf";
        $textOps[] = "(" . self::escapePdf($state) . ") Tj";

        $textOps[] = "0 -28 Td";
        $textOps[] = "/F1 15 Tf";
        $textOps[] = "(" . self::escapePdf($title) . ") Tj";

        $textOps[] = "0 -20 Td";
        $textOps[] = "/F1 10 Tf";
        $textOps[] = "(Document Reference: " . self::escapePdf($refNumber) . "  |  Date: {$date}) Tj";

        $textOps[] = "0 -20 Td";
        $textOps[] = "(Classification: OFFICIAL PUBLIC DISCLOSURE  |  Status: APPROVED) Tj";

        $textOps[] = "0 -35 Td";
        $textOps[] = "/F1 11 Tf";

        foreach ($paragraphs as $p) {
            $words = explode(' ', $p);
            $line = '';
            foreach ($words as $word) {
                if (strlen($line . ' ' . $word) > 75) {
                    $textOps[] = "(" . self::escapePdf(trim($line)) . ") Tj";
                    $textOps[] = "0 -16 Td";
                    $line = $word;
                } else {
                    $line .= ' ' . $word;
                }
            }
            if (!empty($line)) {
                $textOps[] = "(" . self::escapePdf(trim($line)) . ") Tj";
                $textOps[] = "0 -24 Td";
            }
        }

        $textOps[] = "0 -40 Td";
        $textOps[] = "/F1 9 Tf";
        $textOps[] = "(Notice: This is a verified institutional electronic record issued by the Department of Public Infrastructure.) Tj";
        $textOps[] = "0 -14 Td";
        $textOps[] = "(Digitally authenticated under Section 4 of Public Disclosure Framework.) Tj";
        $textOps[] = "ET";

        // Decorative horizontal rules (PDF drawing operators)
        $drawing = "0.024 0.169 0.322 RG\n"; // Navy color
        $drawing .= "2 w\n";
        $drawing .= "50 670 m 562 670 l S\n";
        $drawing .= "0.5 w\n";
        $drawing .= "50 100 m 562 100 l S\n";

        $contentStream = $drawing . implode("\n", $textOps);
        $streamLength = strlen($contentStream);

        // Assemble PDF objects
        $objects = [];
        $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[2] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objects[3] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>";
        $objects[4] = "<< /Length {$streamLength} >>\nstream\n{$contentStream}\nendstream";
        $objects[5] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>";

        // Calculate byte offsets
        $pdf = "%PDF-1.4\n";
        $xref = ["0000000000 65535 f \n"];

        for ($i = 1; $i <= 5; $i++) {
            $xref[$i] = sprintf("%010d 00000 n \n", strlen($pdf));
            $pdf .= "{$i} 0 obj\n" . $objects[$i] . "\nendobj\n";
        }

        $xrefPos = strlen($pdf);
        $pdf .= "xref\n0 6\n" . implode('', $xref);
        $pdf .= "trailer\n<< /Size 6 /Root 1 0 R >>\n";
        $pdf .= "startxref\n{$xrefPos}\n%%EOF";

        return $pdf;
    }

    private static function escapePdf(string $str): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $str);
    }
}
