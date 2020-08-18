<?php 

/*
Plugin Name: Parsley's One Piece
Plugin URI: https://parsley-the-cat.ca
Description: An example plugin for the TECHCareers class. It provides an example of a WordPress shortcode. Type [onepieceapi] into a page or post to output
Author: Parsley the cat
Version: 1.0
Author URI: https://parsley-the-cat.ca
*/

/**
 * Original source code from PHP API Assignment completed by Jia
 */

define( 'ONEPIECE_API_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include_once plugin_dir_path( __FILE__ ).'/includes/enqueue.php';


add_shortcode(
    'onepieceapi', // The name between square brackets that our client can type into a post / page.
    'outputOnePieceApi' // The actual name of our function.
  );

  function outputOnePieceApi() {
       //Retrieve response string from API endpoint
       $responseString = file_get_contents("https://onepiececover.com/api/chapters");
       //var_dump($responseString); -- checked good.
   
       //Convert response JSON string into PHP array/oject. 
       if($responseString !==FALSE) {
   
           if(($responseObj = json_decode($responseString)) !==NULL) {
               //var_dump($responseString); - okay!

               //collect the array of results from the response object's 
               $items = $responseObj->items;
               //var_dump($items);  
               ob_start();?>
               <h2>The Start of One Piece Api</h2>
               <?php foreach($items as $item):?>
                
                <h3><?php echo $item->title?></h2>
                <p><?php echo $item->summary?></p>
                
                
               <?php endforeach;?>
               <?php return ob_get_clean();?>
               
           <?php }
           else
           {
               echo 'Could not interpret API response.';
           }
       }
         else{
        echo 'Could not receive API';
            }    

        }



