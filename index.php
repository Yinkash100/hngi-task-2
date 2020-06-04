<?php

$outputJsonFile = 'script_output.json';
exec('rm -f '.$outputJsonFile);


$fileLoction = './scripts';
$filesArray = scandir($fileLoction);
$finalJsonObjectArray = array('[');


foreach($filesArray as $currentFile){
   /** If the file is not system generted */
   if (substr($currentFile, 0, 1) !== ".") {
      
      $scriptOutput = getFileOutput($currentFile);
      
      $scriptOutputArray = explode(' ', $scriptOutput);
      $scriptOutputArray = allowMultipleNames($scriptOutputArray);
      $scriptStatus = compareOutputs($scriptOutputArray);
      $scriptJsonObject = parseJson($currentFile, $scriptOutput, $scriptOutputArray, $scriptStatus);
      
      
   }
}
array_pop($finalJsonObjectArray);    // removes the final comma from the objects
$finalJsonObjectArray[] = ']';
file_put_contents($outputJsonFile, $finalJsonObjectArray);

function allowMultipleNames($scriptOutputArray){

   $continuation = 0;   //gets the next value after name(s)

   for($i = 0; $i<count($scriptOutputArray); $i++){
      if($scriptOutputArray[$i] === 'with'){
         $continuation = $i;
      break;
      }
   }
   if($continuation < 5 && $continuation > 7){
      return 'fail';
   }elseif($continuation === 6){
      $scriptOutputArray[4] = $scriptOutputArray[4]. ' '. $scriptOutputArray[5];
      array_splice($scriptOutputArray, 5, 1);
   }
   elseif($continuation === 7){
      $scriptOutputArray[4] = $scriptOutputArray[4]. ' '. $scriptOutputArray[5].' '.$scriptOutputArray[6];
      array_splice($scriptOutputArray, 5, 2);
   }

   return $scriptOutputArray;
}

function compareOutputs ($scriptOutputArray){
   $mainString = 'Hello World, this is [fullname] with HNGi7 ID [ID] using [language] for stage 2 task email';
   $mainStringArray = explode(' ', $mainString);
      
   

   if(count($mainStringArray) === count($scriptOutputArray)){
      $out1 = array_splice($scriptOutputArray, 0, 4) === array_splice($mainStringArray, 0, 4);
      $out2 = array_splice($scriptOutputArray, 1, 3) === array_splice($mainStringArray, 1, 3);
      $out3 = array_splice($scriptOutputArray, 2, 1) === array_splice($mainStringArray, 2, 1);
      $out4 = array_splice($scriptOutputArray, 3, 4) === array_splice($mainStringArray, 3, 4);
                
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
      chdir('scripts');
      exec('javac ' . $currentFile);
      $fileName = pathinfo($currentFile, PATHINFO_FILENAME);
      $out = exec('java ' . $fileName);
      exec('rm -f '.$fileName . '.class');
      chdir('../');
   }
   else{
      $out = 'fail';
   }
   return $out;
}

function parseHtml(){

}

function parseJson($currentFile, $scriptOutput, $scriptOutputArray, $scriptStatus){
  global $finalJsonObjectArray;

  $jsonOutput = array("file"=> $currentFile,
    "output"=> $scriptOutput,
    "name"=> $scriptOutputArray[4],
    "id"=> $scriptOutputArray[8],
    "email"=> $scriptOutputArray[15],
    "language"=> $scriptOutputArray[10],
    "status"=> $scriptStatus
   );
   $jsonOutput = json_encode($jsonOutput);
   $finalJsonObjectArray[] =  $jsonOutput; 
   $finalJsonObjectArray[] = ',';
}

?>