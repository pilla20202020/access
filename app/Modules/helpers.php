<?php

use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Campaign\Campaign;
use App\Modules\Models\College\College;
use App\Modules\Models\Country\Country;
use App\Modules\Models\District\District;
use App\Modules\Models\Location\Location;
use App\Modules\Models\Province\Province;
use App\Modules\Models\Setting\Setting;
use App\Modules\Models\State\State;
use App\Modules\Models\User;
use Illuminate\Support\Facades\Storage;

function getTableHtml($object, $type, $editRoute = null, $deleteRoute = null, $printRoute = null, $viewRoute = null,$checklist = null,$billRoute = null, $invoiceRoute = null)
{
    switch ($type) {
        case 'actions':
            return view('general.table-actions', compact('editRoute','deleteRoute','viewRoute','printRoute','checklist','billRoute','invoiceRoute'));
            break;

        case 'availability':
            return '<span class="badge-boxed' . getLabel($object->availability) . '">' . $object->availability_text . '</span>';
            break;
        case 'visibility':
            return '<span class="badge-boxed' . getLabel($object->visibility) . '">' . $object->visibility_text . '</span>';
            break;
        case 'status':
            return '<span class="badge-boxed' . getLabel($object->status) . '">' . $object->status_text . '</span>';
            break;
        case 'is_main':
            return '<span class="badge-boxed' . getLabel($object->is_main) . '">' . $object->main_text . '</span>';
            break;
        case 'is_default':
            return '<span class="badge-boxed' . getLabel($object->is_default) . '">' . $object->main_text . '</span>';
            break;
        case 'image':
            return view('general.lightbox', compact('object'));
            break;
    }
}


function getLabel($status)
{
    $badge = '';
    switch ($status) {
        case 'yes':
            $badge = 'badge-primary';
            break;

        case 'no':
            $badge = 'badge-danger';
            break;
        case 'available':
            $badge = 'badge-success';
            break;

        case 'not_available':
            $badge = 'badge-danger';
            break;
        case 'visible':
            $badge = 'badge-success';
            break;
        case 'in-visible':
            $badge = 'badge-success';
            break;

        case 'active':
            $badge = 'badge-primary';
            break;
        case 'inactive':
            $badge = 'badge-danger';
            break;
    }

    return $badge;
}

/**
 * ---------------------------------------------
 * |            Country                         |
 * ----------------------------------------------
 */
function getCountries()
{
    return Country::getCountries();
}

/**
 * ---------------------------------------------
 * |            State                         |
 * ----------------------------------------------
 */
function getStates()
{
    return State::getStates();
}

function getStatesByCountryId($country_id)
{
    return State::getStatesByCountryId($country_id);
}

/**
 * ---------------------------------------------
 * |            Colleges                        |
 * ----------------------------------------------
 */
function getColleges()
{
    return College::getColleges();
}

function getCollegesByStateId($state_id)
{
    return College::getCollegesByStateId($state_id);
}
/**
 * ---------------------------------------------
 * |            District                        |
 * ----------------------------------------------
 */
function getDistricts()
{
    return District::getDistricts();
}

function getDistrictsByProvinceId($state_id)
{
    return District::getDistrictsByProvinceId($state_id);
}
/**
 * ---------------------------------------------
 * |            Commenced                        |
 * ----------------------------------------------
 */
function getCommencedByStudent($student_id)
{
    $admission = Admission::where('student_id', $student_id)->whereNotNull('commenced_date')->where('commenced_status','applied')->get();
    if(!$admission->isEmpty()) {
        return false;
    }
    return true;
}

function uploadCommonFile($file, $path,$existingPath=null)
{
    // dd($file->getClientOriginalExtension());
    if ($file) {
        if($existingPath){
            if (Storage::exists($existingPath)) {
                Storage::delete($existingPath);
            }
        }
        // generate a new filename. getClientOriginalExtension() for the file extension
        $filename = $path . time() .rand(1,999) .'.' . $file->getClientOriginalExtension();
        // save to storage/app/photos as the new $filename
        $path = $file->storeAs('student', $filename,'public');
        return $path;
    }
}

function resizeAndUploadImage($image, $dir, $quality=100, $thumb="" ){
    try{
        // parameters of resizeAndUploadImage function are image_source, path you want to save image, compression level(0 to 9), resolution("widthxhight")

                if(!File::exists($dir)){
                    File::makeDirectory($dir, 0777, true, true);
                }

            $getGUID = md5(rand(945976,1232345)."-".time()."-".rand(3456676,3423762)).time();
           if($image){
                list($width,$height)=getimagesize($image); // get the dimensions of image and assign it to the variables

                if($thumb != ""){   //if $thumb is not null
                    if(strpos($thumb, 'x') !== false){ //if $thumb contains x
                        list($w,$h) = explode('x', $thumb); //explode x from $thumb and assign the values to $w and $h
                    } else{
                        $w = $thumb;    // if $thumb doesnot contains x then it must contain width only so assign it to $w variable
                    }
                    // list($w,$h) = explode('x', $thumb);
                    // $w = $thumb;
                    $ratio = $w/$width; // calculate the ratio of new width to original width
                    $nwidth = $w;       // assign $w to $nwidth
                    $nheight = $height*$ratio;  // calculate new height as constraint proportion and assign it to $nheight
                }else{
                    list($nwidth,$nheight)=getimagesize($image);
                }

                $newimage=imagecreatetruecolor($nwidth,$nheight);  // creates a new blank black colored image with provided width and height
                $file_extension = strtolower($image->getClientOriginalExtension()); //get file extension of the given image

                if($file_extension == 'jpeg' || $file_extension == 'jpg'){  // if the image is jpeg

                    $source=imagecreatefromjpeg($image);        // assign the image to source image

                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height); // this function will resize the image to new width and height
                    $image_name = $getGUID.".".$file_extension;

                    // echo $newimage;
                    // echo $dir.$image_name;
                    // echo $quality;
                    // exit;
                    $status = imagejpeg($newimage,$dir.$image_name,$quality);    // this function will save a jpeg image & return true to status and takes (resized image, destination path to store that image and the quality in range 0-9) as function parameters
                }elseif($file_extension == 'png'){
                    $source=imagecreatefrompng($image);
                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                    $image_name = $getGUID.".".$file_extension;
                    $qualityBasedOnPNG = ($quality*9)/100;
                    $status = imagepng($newimage,$dir.$image_name,$qualityBasedOnPNG);
                }elseif($file_extension == 'gif'){
                    $source=imagecreatefromgif($image);
                    imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
                    $image_name = $getGUID.".".$file_extension;
                    $status = imagegif($newimage,$dir.$image_name,$quality);
                }else{
                    $status= false; // the status is false if the image is not saved anyway
                }
                if($status){
                    return $image_name;  // after successful transaction this will return a image name.
                }else{
                    return 'null'; // otherwise it will return null
                }

           }else{
               return null;  // if the request doesnot contain image file it will return null
           }
    }catch(Exception $e){
        return $e->getMessage();
    }
}

function removeOldImage($imageName,$folderName){
    if (is_file(public_path() . '/uploads/employee/'.$folderName.'/'.$imageName)) {
        $imageFile = public_path() . '/uploads/employee/'.$folderName.'/'.$imageName;
        unlink($imageFile);
    }
}

function removeOldImageByDir($imageName,$dir){
if (is_file(public_path().'/'. $dir.$imageName)) {
        $imageFile = public_path().'/'. $dir.$imageName;
        unlink($imageFile);
    }
}

function getPrimaryNotifiableUsers()
{
    $users = User::role('SuperAdmin')->get();
    return $users;
}

// SMS CURL
function smsPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Setting Fetch
function setting($query)
{
    $setting = Setting::fetch($query)->first();

    return $setting ? $setting->value : null;
}

// Campaign List
function getCampaign()
{
    return Campaign::all();
}

// Location List
function getLocation()
{
    return Location::all();
}


