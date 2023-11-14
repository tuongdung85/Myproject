<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use App\Http\Controllers\Controller;
use App\Models\OCR;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Imagick;
use PDF;
use Spatie\PdfToImage\Pdf as PdfToImagePdf;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storage = public_path("files/");
        $name ='text';

        $img = $storage.$name.".png";
        $ocr = new TesseractOCR($img);
        $ocr->pdf()->run();
    }

    public function getTextFromImage(){
        $storage = public_path("files/");
        $name ='handwritten2';
        $file = $storage.$name.".jpg";
        $ocr  = new TesseractOCR($file);
        echo  $ocr->lang("eng")->run();
    }

    public function getTextFromPdf()
    {
        $storage = public_path("files/");
        $name ='sample-pdf-download-10-mb';
        $file = $storage.$name.".pdf";
        $images = $this->convertPdfToImage($file, $name);
        foreach($images as $key => $image) {
            $ocr  = new TesseractOCR($image);
            echo "page ".$key .'-----'.$ocr->run()."<br>";
        }
    }

    public function convertImageToPdf()
    {
        $pdf = OCR::loadView('sample-with-image', [
    		'title' => 'codesolutionstuff.com Laravel Pdf with Image Example',
    		'description' => 'This is an example Laravel pdf with Image tutorial.',
    		'footer' => 'by <a href="https://www.codesolutionstuff.com/">codesolutionstuff.com</a>'
    	]);
        return $pdf->download('sample-with-image.pdf');
    }

    public function convertPdfToImage($pdf, $name){
        $image = new imagick();
        $image->setResolution(300,300);
        $image->readImage($pdf);
        $image->setImageFormat('jpg');

        // Set all other properties

        $pages = $image->getNumberImages();

        if ($pages) {
            $storage = public_path("files/". $name);
            if(!is_dir($storage)){
                mkdir($storage);
              }
            foreach($image as $index => $pdf_image) {
                $pdf_image->writeImage($storage .'/'. $index . '.jpg');
                $images[] = $storage .'/'. $index . '.jpg';
            }
        } else {
            echo 'PDF doesn\'t have any pages';
        }
        return $images;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     */
    public function show(OCR $ocr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OCR $ocr)
    {
        //
    }


   
}
