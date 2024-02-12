<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Systemtip;
use App\Models\Systemimage;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tips = Systemtip::all();
        return response() -> json(array('tips' => $tips), 200);
    }

    /**
     * Store a newly created resource in storage.
     * https://stackoverflow.com/a/55418359 - 'php artisan storage:link'
     * https://laracasts.com/discuss/channels/laravel/show-images-from-storage-folder - display picture
     * https://stackoverflow.com/a/71623237 - upload image jQuery
     * https://www.tutsmake.com/laravel-8-ajax-image-upload-with-preview-tutorial/ - upload image laravel
     */
    public function store(Request $request)
    {
        $image = null;
        if ($request -> hasFile('tip_picture')) {
            // $path = $request -> tip_picture -> store('public/images');
            // $storedName = substr($path, strrpos($path, '/') + 1);
            $image = base64_encode(file_get_contents($request -> file('tip_picture') -> path()));
        }

        $createTip = Systemtip::create([
            'tip_id' => Str::uuid() -> toString(),
            'tip_title' => $request -> tip_title,
            'tip_category' => $request -> tip_category,
            'tip_sub_category' => $request -> tip_sub_category,
            'tip_content' => $request -> tip_content,
            'tip_video_url' => $request -> tip_video_url,
            'tip_image_name' => null,
            'tip_image_file' => $image,
            'admin_id' => $request -> admin_id
        ]);

        return response() -> json(array('tip' => $createTip), 200);
    }

    public function fetch(string $id) {
        $tip = Systemtip::find($id);
        $image = imagecreatefromstring(base64_decode($tip -> tip_image_file));
        header('Content-type: image/png');
        return imagejpeg($image);
    }

    public function fetch_image(string $id) {
        $image = Systemimage::find($id);
        $image_base64 = imagecreatefromstring(base64_decode($image -> image_file));
        header('Content-type: image/png');
        return imagejpeg($image_base64);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tip = Systemtip::find($id);
        // $tip -> tip_image_file = null;
        return response() -> json(array('tip' => $tip), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateTip = new Systemtip();
        // $storedName = '';
        $image = null;
        if ($request -> hasFile('tip_picture')) {
            // $path = $request -> tip_picture -> store('public/images');
            // $storedName = substr($path, strrpos($path, '/') + 1);
            $image = base64_encode(file_get_contents($request -> file('tip_picture') -> path()));
        }

        $existTip = Systemtip::find($request -> tip_id);
        if (!empty($existTip) && $request -> hasFile('tip_picture')) {
            $existTip -> tip_title = $request -> tip_title;
            $existTip -> tip_category = $request -> tip_category;
            $existTip -> tip_sub_category = $request -> tip_sub_category;
            $existTip -> tip_content = $request -> tip_content;
            $existTip -> tip_video_url = $request -> tip_video_url;
            $existTip -> tip_image_name = null;
            $existTip -> tip_image_file = $image;
            $existTip -> admin_id = $request -> admin_id;

            $updateTip = $existTip -> save();
        } else if (!empty($existTip) && !$request -> hasFile('tip_picture')) {
            $existTip -> tip_title = $request -> tip_title;
            $existTip -> tip_category = $request -> tip_category;
            $existTip -> tip_sub_category = $request -> tip_sub_category;
            $existTip -> tip_content = $request -> tip_content;
            $existTip -> tip_video_url = $request -> tip_video_url;
            $existTip -> admin_id = $request -> admin_id;

            $updateTip = $existTip -> save();
        }
        return response() -> json(array('tip' => $updateTip), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteStatus = false;
        $tip = Systemtip::find($id);

        if (!empty($tip)) {
            $deleteStatus = $tip -> delete();
        }
        return response() -> json(array('status' => $deleteStatus), 200);
    }
}
