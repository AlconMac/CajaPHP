<?php
/*******************************************************
*CLASE QUE SIRVE PARA ENCRIPTAR Y DESENCRIPTAR VALORES
 Fuente : http://mycyberacademy.com/php-funcion-para-encriptar-desencriptar-una-cadena-sin-una-clave-conocida/
 ********************************************************/
class _Crifrado {
    public static function setKey($index){
        $key=rand(1111, 9999);        
        return $_SESSION['key'][$index]=$key; 
    }
    //
    public static function getKey($index){              
        return $_SESSION['key'][$index]; 
    }
    //Encriptar
    public static function encriptar($Str_Message,$index) {
        $Len_Str_Message=STRLEN($Str_Message); 
        $Str_Encrypted_Message=""; 
        for($Position = 0;$Position<$Len_Str_Message;$Position++){ 
            // long code of the function to explain the algoritm 
            //this function can be tailored by the programmer modifyng the formula 
            //to calculate the key to use for every character in the string. 
            $Key_To_Use = (($Len_Str_Message+$Position)+1); // (+5 or *3 or ^2) 
            //after that we need a module division because can´t be greater than 255 
            $Key_To_Use = (255+$Key_To_Use) % 255; 
            $Byte_To_Be_Encrypted = SUBSTR($Str_Message, $Position, 1); 
            $Ascii_Num_Byte_To_Encrypt = ORD($Byte_To_Be_Encrypted); 
            $Xored_Byte = $Ascii_Num_Byte_To_Encrypt ^ $Key_To_Use;  //xor operation 
            $Encrypted_Byte = CHR($Xored_Byte); 
            $Str_Encrypted_Message .= $Encrypted_Byte;
        }
        $key=self::setKey($index);
        $en1=sha1($key);
        $en2=sha1($key/2);
        return substr($en1,0,10).$Str_Encrypted_Message.substr($en2,10,  strlen($en2));
    }
    
    //Desencriptar
    public static function desencriptar($Str_Message,$index) {        
        $en1=substr(sha1(self::getKey($index)),0,10);        
        $en2=sha1(self::getKey($index)/2);        
        $en2=substr($en2,10,  strlen($en2));     
        
        $Str_Message=  explode($en2, $Str_Message);        
        
        $Str_Message=explode($en1,$Str_Message[0]);
        $Str_Message=$Str_Message[1];
        
        $Len_Str_Message=STRLEN($Str_Message); 
        $Str_Encrypted_Message=""; 
        for($Position = 0;$Position<$Len_Str_Message;$Position++){ 
            // long code of the function to explain the algoritm 
            //this function can be tailored by the programmer modifyng the formula 
            //to calculate the key to use for every character in the string. 
            $Key_To_Use = (($Len_Str_Message+$Position)+1); // (+5 or *3 or ^2) 
            //after that we need a module division because can´t be greater than 255 
            $Key_To_Use = (255+$Key_To_Use) % 255; 
            $Byte_To_Be_Encrypted = SUBSTR($Str_Message, $Position, 1); 
            $Ascii_Num_Byte_To_Encrypt = ORD($Byte_To_Be_Encrypted); 
            $Xored_Byte = $Ascii_Num_Byte_To_Encrypt ^ $Key_To_Use;  //xor operation 
            $Encrypted_Byte = CHR($Xored_Byte); 
            $Str_Encrypted_Message .= $Encrypted_Byte;
        } 
        return $Str_Encrypted_Message;        
        
    } 
    
    //Encriptar sql para exportar
    public static function sqlEncriptar($Str_Message) {
        $Len_Str_Message=STRLEN($Str_Message); 
        $Str_Encrypted_Message=""; 
        for($Position = 0;$Position<$Len_Str_Message;$Position++){ 
            // long code of the function to explain the algoritm 
            //this function can be tailored by the programmer modifyng the formula 
            //to calculate the key to use for every character in the string. 
            $Key_To_Use = (($Len_Str_Message+$Position)+1); // (+5 or *3 or ^2) 
            //after that we need a module division because can´t be greater than 255 
            $Key_To_Use = (255+$Key_To_Use) % 255; 
            $Byte_To_Be_Encrypted = SUBSTR($Str_Message, $Position, 1); 
            $Ascii_Num_Byte_To_Encrypt = ORD($Byte_To_Be_Encrypted); 
            $Xored_Byte = $Ascii_Num_Byte_To_Encrypt ^ $Key_To_Use;  //xor operation 
            $Encrypted_Byte = CHR($Xored_Byte); 
            $Str_Encrypted_Message .= $Encrypted_Byte;
        }
        return $Str_Encrypted_Message;        
    }
   
    
}

?>
