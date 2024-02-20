<?php

// Get fields from request headers
$fields = getallheaders();

// include the file
define('BMI_ROOT_DIR', $fields['content-dir']);
define('BMI_INCLUDES', BMI_ROOT_DIR . 'includes');

// Start output for server    
ob_start();    

// Catch anything if possible    
try {      

  // Load bypasser      
  require_once BMI_INCLUDES . '/bypasser.php';
  $request = new BMI_Backup_Heart(true,    
    $fields['content-configdir'],    
    $fields['content-content'],    
    $fields['content-dir'],    
    $fields['content-url'],    
    [    
      'manifest' => $fields['content-manifest'],    
      'safelimit' => $fields['content-safelimit'],    
      'rev' => $fields['content-rev'],    
      'backupname' => $fields['content-name'],    
      'bmitmp' => $fields['content-bmitmp']        
    ],    
    $fields['content-it'],    
    $fields['content-dbit'],    
    $fields['content-dblast']    
  );    

  // Handle request    
  $request->handle_batch();    

} catch (\Exception $e) {    

  error_log('There was an error: ' . $e->getMessage());
  error_log(strval($e));
}
?>
