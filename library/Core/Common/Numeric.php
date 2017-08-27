<?php

class Numeric{
    /**
     * @author Trần Công Tuệ <chanhduypq@gmail.com>
     * @param string $VNNumber
     * @return string
     */
    public static function convertToUSNumber($VNNumber){
        if($VNNumber==NULL||$VNNumber==""||trim($VNNumber)==""){
                return $VNNumber;
        }
        $VNNumber=str_replace('.','', $VNNumber);
        $VNNumber=str_replace(',','.', $VNNumber);
        return $VNNumber;
    }
    /**
     * @author Trần Công Tuệ <chanhduypq@gmail.com>
     * @param string $dbNumber
     * @return string
     */
    public static function convertToVnNumberFromDBNumber($dbNumber){
            $temp=explode(".",$dbNumber);

            if(count($temp)>1&&$temp[1]==0){
                    $dbNumber=$temp[0];
            }
            else{
                    $dbNumber=str_replace('.',',',$dbNumber);
            }
            $temp='';
            $n=strlen($dbNumber);
            $le=$n%3;
            $chan=floor($n/3);
            $start=0;
            for($i=0;$i<$le;$i++,$start++){
                    $temp.=$dbNumber[$i];
            }
            if($chan>0&&$le!=0){
                    $temp.='.';
            }

            for($j=0;$j<$chan;$j++){
                    $k=0;
                    while ($k<3){
                            $temp.=$dbNumber[$start+$k];
                            $k++;
                    }
                    if($j<$chan-1){
                            $temp.='.';
                    }
                    $start+=3;
            }
            $dbNumber=$temp;
            return $dbNumber;
    }	
    
    /**
     * function này kiểm tra một chuỗi hay một số có phải là số nguyên hay không
     * @author Trần Công Tuệ <chanhduypq@gmail.com>
     * @param mixed $value
     * @return bool
     */
    public static function isInteger($value){        
        if (!is_numeric($value)) {
            return FALSE;
        }
        if (is_string($value)) {
            if($value[0]=='-'){
                if (!ctype_digit(substr($value,1))) {
                    return FALSE;
                }
            }
            else{
                if (!ctype_digit($value)) {
                    return FALSE;
                }
            }
            
        } else {
            if (!is_int($value)) {

                return false;
            }
        }
        return true;
    }
}

