<?php

$fileLoction = './scripts';
$filesArray = scandir($fileLoction);

foreach($filesArray as $currentFile){
   /** If the file is not system generted */
   if (substr($currentFile, 0, 1) !== ".") {
      
      $scriptOutput = getFileOutput($currentFile);
      $scriptStatus = compareOutputs($scriptOutput);
      echo $scriptStatus;
      /** 
      if(){
         parseJson()
      }
      else{
         parseHtml()
      }
      */
   }
}

function compareOutputs ($userScriptOutput){;
   $mainString = 'Hello World, this is [fullname] with HNGi7 ID [ID] using [language] for stage 2 task';
   $mainStringArray = explode(' ', $mainString);
   
   $userScriptOutputArray = explode(' ', $userScriptOutput);
   $userScriptOutputArray;
   if(count($mainStringArray) === count($userScriptOutputArray)){
      $out1 = array_splice($userScriptOutputArray, 0, 4) === array_splice($mainStringArray, 0, 4);
      $out2 = array_splice($userScriptOutputArray, 1, 3) === array_splice($mainStringArray, 1, 3);
      $out3 = array_splice($userScriptOutputArray, 2, 1) === array_splice($mainStringArray, 2, 1); 
      $out4 = array_splice($userScriptOutputArray, 3, 6) === array_splice($mainStringArray, 3, 6);
      if ($out1 && $out2 && $out3 && $out4){
         return 'pass';
      }
      else{
         return 'fail';
      }
      
   }
   else{
      return 'fail';
   }

}

function getFileOutput($currentFile) {
   $fileExtension = pathinfo($currentFile, PATHINFO_EXTENSION);
   
   /** TODO  pearl fortran TypeScript */
   $out = "";
   $pathtToScripts = ' ./scripts/';
   if ($fileExtension === "py") {
      $prefix = 'python3';
      $out = exec($prefix .$pathtToScripts. $currentFile);
   }
   elseif  ($fileExtension === 'js'){
      $prefix = 'node';
      $out = exec($prefix .$pathtToScripts. $currentFile);
   }
   elseif ($fileExtension === 'php'){
      $prefix = 'php';
      $out = exec($prefix .$pathtToScripts . $currentFile);
   }
   elseif($fileExtension === 'java'){
      // exec('cd ./scripts');
      // echo exec('ls');
      // exec('javac '.$pathtToScripts . $currentFile);
      // $fileName = pathinfo($currentFile, PATHINFO_FILENAME);
      // exec('cd ./scripts');
      // echo 'dir contins   '.   exec('ls');
      // $out = exec('java ' . $fileName);
      // exec('rm -f '.$fileName . '.class');
      $out = 'failed';

   }
   else{
      $out = 'fail';
   }
   return $out;
}

function parseHtml(){

}

function parseJson($input){
   $out = explode(' ', $input);
   if(isset($out)){
   //   $output = array("name" => $out[4], "id"=> $out[8], "language"=>$out[11]);
      $outJson = json_encode($output);
      echo $outJson;
   }   
}

?>