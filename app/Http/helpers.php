<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

if (!function_exists('delUserImg')) {
    function delUserImg(string $imgPath, array $validatedData)
    {
        File::exists($imgPath) ? File::delete($imgPath) : '';
        $validatedData['img_name'] = '';
        $validatedData['img_path'] = '';
        return $validatedData;
    }
}

if (!function_exists('setNewUserImg')) {
    function setNewUserImg($requestImg, array $validatedData)
    {
        $imageName = Str::random(15) . '.' . $requestImg->getClientOriginalExtension();
        $requestImg->move(public_path('images'), $imageName);
        $validatedData['img_name'] = $imageName;
        $validatedData['img_path'] = 'images/' . $imageName;
        return $validatedData;
    }
}
