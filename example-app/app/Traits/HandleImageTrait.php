<?php

namespace App\Traits;

use Image;

trait HandleImageTrait
{
    protected $path = 'upload/users/';

    public function verify($request)
    {
        return true;
    }

    public function saveImage($request)
    {
        $image = $request->file('image');

        if ($this->verify($request)) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save($this->path . $name);
            return $name;
        }
    }

    public function updateImage($request, $currentImage)
    {
        if ($this->verify($request)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
    }

    public function deleteImage($imageName)
    {
        if (file_exists($this->path . $imageName)) {
            unlink($this->path . $imageName);
        }
    }
}

?>
