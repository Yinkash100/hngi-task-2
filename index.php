<?php

$fileLoction = './scripts';
$filesArray = scandir($fileLoction);

foreach($filesArray as $currentFile){
   
   /** If the file is not system generted */
   if (substr($currentFile, 0, 1) !== ".") {
      $fileExtension = pathinfo($currentFile, PATHINFO_EXTENSION);
      $scriptOutput = getFileOutput($fileExtension, $currentFile);
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

function getFileOutput($ext, $currentFile) {
   /**  php Jv */
   $prefix = "";
   if ($ext === "py") {
      $prefix = 'python3';
   }
   elseif  ($ext === 'js'){
      $prefix = 'node';
   }
   elseif ($ext === 'php'){
      $prefix = php;
   }
   else{
      return 'fail';
   }
   return exec($prefix .' ./scripts/' . $currentFile);
      
 
}

function parseHtml(){

}

function parseJson(){
   $out = explode(' ', );
   if(isset($out)){
   //   $output = array("name" => $out[4], "id"=> $out[8], "language"=>$out[11]);
      $outJson = json_encode($output);
      echo $outJson;
   }   
}

?>