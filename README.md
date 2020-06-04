







# hngi-task-2

The index.php file reads all scripts from the scripts folder and execute them according to their filepl type,
It also get their outputs, compare it to the expected output and return a pass or fail. 
Working perfectly for python, javascript and php scripts. I'm almost done with java. I want us to add support for pearl, and other popular languages too.

The compare function is a bit messy. It converts the expected output to array, remove the dynamic ones (I.e the user  specific strings) and do the same for the user script output. Then compare the two array

### TODO 
 - Write output to JSON file
 - Write outputs to html
 - flush and stream. Donno what it means.

### USAGE INSTRUCTIONS
The index.php script can run on any system that has the following installed
NodeJs
Python3
PHP
JRE

Run the index.php using
```
php inxed.php
```
