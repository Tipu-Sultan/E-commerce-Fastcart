<?php 
if (!empty($_POST['download'])) {
        $Darr = array();
        $filename = basename($_POST['download']);
        $filepath = 'images/' . $filename;
        if (!empty($filename) && file_exists($filepath)) {
                header("Cache-Control:public");
                header("Content-Description:File Transfer");
                header("Content-Disposition: attachment; filename={$filename}");
                header("Content-Type:application/image");
                header("Content-Transfer-Encoding: binary");
                readfile($filepath);
                $Darr = array('is_error'=>'no');

                
        }else{
                $Darr = array('is_error'=>'yes','msg'=>'File does not exist');

        }
        echo json_encode($Darr);
}
 ?>