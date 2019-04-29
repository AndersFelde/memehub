<?php 
$file = $_FILES["bilde"];

$bilde_name = $file["name"];
$bilde_tmp_name = $file["tmp_name"];
$bilde_size = $file["size"];
$bilde_error = $file["error"];

$bilde_ext = explode('.', $bilde_name);

$bilde_type = strtolower(end($bilde_ext));

$allowed = array('jpg', 'jpeg', 'png');

if($bilde_error === 0) {
    
    if(in_array($bilde_type, $allowed)) {
    
        if ($bilde_size < 200000000) {
            
            $bilde_name_new = uniqid('', true).".".$bilde_type;
            
            $bilde_dest = 'images/user_images/'.$bilde_name_new;
            
            $lagre_bilde = true;
        
            } else {
            //size
                echo  "ikke så store bilder da plz";
            
                
    
                
            }
    
    } else {
        //filtype
        echo  "Filtypen du har valgt er ikke lov, SLUTT";
        
        
    
        
    }

} else {
    //eror
    echo  "Den er en error med bilde du har lastet opp";
    
    
    
    
}

?>