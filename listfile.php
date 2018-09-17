<?php
    //csv date converter parser convert whole directory
    // this convert any date with format of dd/mm/yyyy to Y-m-d

    $files = glob("./csv/*.csv");
    $output = fopen('output.csv', 'a'); //open for writing
    
    foreach($files as $file) {

        if (($handle = fopen($file, "r")) !== FALSE) {
            echo "<br>reading <b>Filename: " . basename($file) . "</b>";
             fgetcsv($handle);  //for skipping first row of each files
            while( false !== ( $data = fgetcsv($handle) ) ){  //read each line as an array
                
                // $data[6] = str_replace("-","",$data[6]); //remove any dash in dates (Optional)
                $d = substr($data[6], 0,2);
                $m = substr($data[6], 3,2); 
                $y = substr($data[6], 6,4);
                $val = $m.'/'.$d.'/'.$y;
                $data[6] = date("Y-m-d", strtotime($val));
                
                $data[0] = '';
               //write modified data to new file
               fputcsv( $output, $data);
            }
            fclose($handle);
            echo '</br>conversion complete </br>output: '.basename($file) .'</br>';
        } else {
            echo "Could not open file: " .basename($file);
        }

    }
    fclose( $output );
?>