<?php 

// csv date converter read one files


$input = fopen('./csv/1.csv', 'r');  //open for reading
$output = fopen('output.csv', 'w'); //open for writing
$avoidval = "Bill_Date"; //value yg nk avoid contohnya first column
fgetcsv($input);
while( false !== ( $data = fgetcsv($input) ) ){  //read each line as an array
    if ($data[6] != $avoidval){
        
        $d = substr($data[6], 0,2);
        $m = substr($data[6], 3,2); 
        $y = substr($data[6], 6,4);
        $val = $m.'/'.$d.'/'.$y;
        $data[6] = date("Y-m-d", strtotime($val));
        echo 'date after converting to str : '.$val . ' <<</br>';
       
        echo 'after conversion = '.$data[6].'</br>';

    }
    
   //write modified data to new file
   fputcsv( $output, $data);
}
echo 'conversion complete </br>output: '.$output;
//close both files
fclose( $input );
fclose( $output );