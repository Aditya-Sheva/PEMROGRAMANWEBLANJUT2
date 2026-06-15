<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

$pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('proposals.template-pdf')
    ->setPaper('a4', 'portrait')
    ->setOptions([
        'defaultFont' => 'serif',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => false,
    ]);

$output = $pdf->output();
$path = __DIR__ . '/storage/app/test-ske1.pdf';
file_put_contents($path, $output);
echo 'OK: ' . filesize($path) . ' bytes' . PHP_EOL;
