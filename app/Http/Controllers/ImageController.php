<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index() {
        $images = image::where('id', 3)->first();
        printArray($images->posts);
    }
}
