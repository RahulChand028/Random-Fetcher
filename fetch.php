<?php

 $variables = isset($_GET['variable']) ? $_GET['variable'] : '';

 $type = isset($_GET['type']) ? $_GET['type'] : ''; 

 $repeat = isset($_GET['repeat']) ? $_GET['repeat'] : 1;

 $root = [];

 $node = [];

 $global_uniqe_list = [];

 main(); 

function main() {

     global $variables , $type , $repeat , $root , $node , $global_uniqe_list;
  
     $return_file_type = ['json','JSON','xml' ,'XML','text','TEXT'];

     if(empty($variables)) {
    
        echo"variable is not provided";
    
        exit();
    
     }

     if(!in_array($type, $return_file_type)) {
    
        echo"type is not provided";
    
        exit();
     } 

        for($repeat_number = 0; $repeat_number < repeat_value($repeat); $repeat_number++) {
 
           $root[] = parse($variables);

        }

     if($type == 'json' || $type == 'JSON') {

        header('Content-type: application/json');
    
        echo json_encode($root);

     } else if($type == 'xml' || $type == 'XML') {

        header('Content-type: application/xml');
     
        $root = json_encode($root);
     
        echo json2xml($root);

     } else if($type == 'text' || $type == 'TEXT') {
   
        $text = "";

        foreach($root[0] as $line) {
           $text = $text.$line;
        }
        
        echo $text; 
    } else {
    
      echo "Please Provide Valid Document Type (support type is ----->>  json/text/xml   <<------)";
    
    }

 }


 function str_maker($str_exp) {

    $code = str_split($str_exp);
    
    $str = "";
    
    foreach($code as $value) {
        if($value == 'm') {
        	break;
        }
        $str = $str.$value;
    }

    $str_length = repeat_value($str);
 
    $str = "";
    $sub_str = "";

    $min_length = "";
    $max_length = "";

    for($i = 0; $i < count($code) ; $i++) {
        if($code[$i] == 'm' && $code[$i+1] == 'n') {
           
              for($j = $i+2 ; $j < count($code) ; $j++) {
                    if($code[$j] == 'm') {
                    	break;
                    }
                    $min_length = $min_length.$code[$j];
              }

        }
    }
    for($i = 0; $i < count($code) ; $i++) {
        if($code[$i] == 'm' && $code[$i+1] == 'x') {
           
              for($j = $i+2 ; $j < count($code) ; $j++) {
                    if($code[$j] == 'm') {
                    	break;
                    }
                    $max_length = $max_length.$code[$j];
              }

        }
    }

    $max_length = (int)$max_length;

    $min_length = (int)$min_length;

    for($i = 0; $i < $str_length; $i++) {
    
    	for($j = 0; $j < rand($min_length,$max_length) ;$j++) {
    
           $sub_str = chr(rand(97,122)).$sub_str;
    
    	}

    	$str = $str." ".$sub_str;
    	$sub_str = "";
    }

    return trim($str);
 }


 function repeat_value($repeat) {

    $repeat_array = str_split($repeat);

    $repeat_smallest = "";

    $repeat_largest = "";

    if($underscore = array_search('_', $repeat_array)) {
 
       for($i = 0; $i < $underscore; $i++) {

           $repeat_smallest = $repeat_smallest.$repeat_array[$i];
        }

       $repeat_smallest = (int)$repeat_smallest;
    
       for($i = $underscore+1; $i < count($repeat_array); $i++) {

         $repeat_largest = $repeat_largest.$repeat_array[$i];

       }
    
       $repeat_largest = (int)$repeat_largest;     
    
       return  rand($repeat_smallest,$repeat_largest);

    } else {
    
       return (int)$repeat;
    }
}
 
function number_maker($value,$variable) {
       
        global $repeat , $global_uniqe_list;

	    if(count($value) == 1) {
         
           return rand(0,(int)$repeat*100);
        
        } else {
	    
	    	array_shift($value);

		    foreach ($value as $val) {

			      if($val == 's') {

                      if(!isset($global_uniqe_list[$variable])) {
                           $global_uniqe_list[$variable] = [];
                      }

			      	  if(count($global_uniqe_list[$variable]) > 0) {
                            
                           $last_index = count($global_uniqe_list[$variable]);

                           $last_value = $global_uniqe_list[$variable][$last_index-1];
                           
                           $global_uniqe_list[$variable][] = $last_value+1;

                           return $last_value+1;
			      	
			      	  } else {

                           $random_value = rand(0,(int)$repeat*5);

                           $global_uniqe_list[$variable][] = $random_value;

                           return $random_value;

			      	  }
			      }
			       if($val == 'u') {

                      if(!isset($global_uniqe_list[$variable])) {
                           
                           $global_uniqe_list[$variable] = [];
                      }

			      	  if(count($global_uniqe_list[$variable]) > 0) {
                           
                           do {
                            
                              $random_value = rand(0,(int)$repeat*5);                            
                           
                           } while(in_array($random_value, $global_uniqe_list[$variable]));

                           $global_uniqe_list[$variable][] = $random_value;

                           return $random_value;
			      	
			      	  } else {

                           $random_value = rand(0,(int)$repeat*10);

                           $global_uniqe_list[$variable][] = $random_value;

                           return $random_value;

			      	  }
			      }
			      if($val != 'u' && $val != 's') {
                  
                  return " s for serise and u for unique";
			      }
		    }
		}
}

function parse($variables_string) {
     
     $node = [];

     $variables_array = explode('_',$variables_string);

     foreach($variables_array as $variable) {
          
          if(isset($_GET['variable'])) {
          
          	 $node[$variable] = node_value($_GET[$variable],$variable);
          
          } else {

             $node[$variable] = 'Value type not defined';

          }

     }

     return $node;

}




function node_value($value,$variable) {

  $value = str_split($value);
	
	if($value[0] == 'n') {

        return number_maker($value,$variable);

	} else if($value[0] == 's') {

        array_shift($value);
        
        $variable_type = implode("",$value);

        return str_maker($variable_type);         

	} else if($value[0] == 'i') {
           
         array_shift($value);

         array_shift($value);

         $variable_type = implode("",$value);
		
		 return parse($variable_type);

	} else if($value[0] == 'a') {
         
         $no = '';

         $new_array = [];

         $index = 0;

         $str = '';

         array_shift($value);

         foreach($value as $val) {
         
              if($val == 'n' || $val == 's' || $value == 'i') {
                   break;
              }

              $no = $no.$val;

              $index++;

         }

         for($i = $index; $i < count($value); $i++) {
            $str = $str.$value[$i];
         }

         $no = $no;

         $no = repeat_value($no);

         for($i = 0; $i < $no; $i++) {
            $new_array[] =  node_value($str,$variable);
         }

         return $new_array;

	} else {
		
		return "------------- >>>  Please provide proper type <<<---------";
	}

}



function json2xml($encoded_json) {
    
    $xml = '';

    $decoded_json = json_decode($encoded_json);

    foreach ($decoded_json as $key => $value) {
 
        if(gettype($value) == 'object') {
 
             $xml = $xml."<node>".parse_object($value)."</node>";

        } else {

            echo' not an object ';
        }
    }
   
    return "<root>".$xml."</root>";

}

function parse_object($obj) {

    $properties = get_object_vars($obj);

    $tag = '';

    foreach($properties as $name => $value) {

          if(gettype($obj->$name) == 'object') {

              $tag = $tag."<".$name.">".parse_object($value)."</".$name.">";

          } else if(gettype($obj->$name) == 'array') {

              $tag = $tag."<".$name.">".parse_array($value)."</".$name.">";

          } else {

              $tag = $tag."<".$name.">".$value."</".$name.">";
            
          }

    }

    return $tag;
}
 function parse_array($arr) {

      $tag = '';

      foreach ($arr as $key => $value) {
          
          if(gettype($value) == 'object') {

              $tag = $tag."<node>".parse_object($value)."</node>";

          } else if(gettype($value) == 'array') {

              $tag = $tag."<node>".parse_array($value)."</node>";

          } else {

              $tag = $tag."<node>".$value."</node>";
            
          }

      }

      return $tag;

 }



?>