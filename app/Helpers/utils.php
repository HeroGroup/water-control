<?php

function saveFile($file, $directory)
{
    $fileName = time() . '.' . $file->getClientOriginalName();
    $file->move(public_path("$directory/"), $fileName);
    return "/$directory/".$fileName;
}

function makeDirectory($path) {
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

function logAction($action, $device=null)
{
    if (auth()->user()->user_type == 'client' && $action) {
        $log = new \App\UserLog([
            'device_id' => $device,
            'user_id' => auth()->user()->id,
            'action' => $action
        ]);

        $log->save();
    }
}

function logPostData($content)
{
    $body = json_decode($content);
    $deviceUniqueNumber = $body->device_id;
    $today = date('Y-m-d');
    makeDirectory("logs/$today");
    $myFile = fopen("logs/$today/$deviceUniqueNumber-POST-REQUEST.txt", "a") or die("Unable to open file!");
    $date = PHP_EOL.'['.jdate('Y/m/j H:i', strtotime('now')).'] ';
    fwrite($myFile, $date.'[request body='.$content.']');
    fclose($myFile);
}

function logException(Exception $exception)
{
    $today = date('Y-m-d');
    makeDirectory("logs/$today");
    $myFile = fopen("logs/$today/POST-EXCEPTIONS.txt", "a") or die("Unable to open file!");
    $date = PHP_EOL.'['.jdate('Y/m/j H:i', strtotime('now')).'] ';
    $line = $exception->getLine();
    $file = $exception->getFile();
    $message = $exception->getMessage();
    fwrite($myFile, $date."[exception message= $file: line $line - $message]");
    fclose($myFile);
}

function logPostDeviceData(\App\DeviceLog $deviceLog)
{
    $deviceUniqueNumber = $deviceLog->device->unique_number;
    $today = date('Y-m-d');
    makeDirectory("logs/$today");
    $myFile = fopen("logs/$today/$deviceUniqueNumber-POST.txt", "a") or die("Unable to open file!");
    $date = PHP_EOL.'['.jdate('Y/m/j H:i', strtotime('now')).'] ';
    $device = " [device=$deviceUniqueNumber] ";
    $data = " [data=".$deviceLog->input_data."] ";
    fwrite($myFile, $date.$device.$data);
    fclose($myFile);
}

function logGetDeviceData(\App\DeviceLog $deviceLog)
{
    $deviceUniqueNumber = $deviceLog->device->unique_number;
    $today = date('Y-m-d');
    makeDirectory("logs/$today");
    $myFile = fopen("logs/$today/$deviceUniqueNumber-GET.txt", "a") or die("Unable to open file!");
    $date = PHP_EOL.'['.jdate('Y/m/j H:i', strtotime('now')).'] ';
    $device = " [device=$deviceUniqueNumber] ";
    $data = " [data=".$deviceLog->input_data."] ";
    fwrite($myFile, $date.$device.$data);
    fclose($myFile);
}
