<?php
class resize_img
{
  var $image_path = '';
  //holds the image path
  var $sizelimit_x = 250;
  //the limit of the image width
  var $sizelimit_y = 250;
  //the limit of the image height
  var $image_resource = '';
  //holds the image resource
  var $keep_proportions = true;
  //if true it keeps the image proportions when resized
  var $resized_resource = '';
  //holds the resized image resource
  var $hasGD = false;
  var $output = 'SAME';
  //can be JPG, GIF, PNG, or SAME (same will save as old type)
  
  function resize_img()
  {
    if( function_exists('gd_info') ){ $this->hasGD = true; }  
  }
  
  function resize_image( $image_path )
  {
    if( $this->hasGD === false ){ return false; }
    //no GD installed on the server!
    
    list($img_width, $img_height, $img_type, $img_attr) = @getimagesize( $image_path );
    //this is going to get the image width, height, and format
    
    if( ( $img_width != 0 ) || ( $img_width != 0 ) )
    //make sure it was loaded correctly
    {
      switch( $img_type )
      {
        case 1:
          //GIF
          $this->image_resource = @imagecreatefromgif( $image_path );
          if( $this->output == 'SAME' ){ $this->output = 'GIF'; }
          break;
        case 2:
          //JPG
          $this->image_resource = @imagecreatefromjpeg( $image_path );
          if( $this->output == 'SAME' ){ $this->output = 'JPG'; }
          break;  
        case 3:
          //PNG
          $this->image_resource = @imagecreatefrompng( $image_path );
          if( $this->output == 'SAME' ){ $this->output = 'PNG'; }
      }
      if( $this->image_resource === '' ){ return false; }
      //it wasn't able to load the image
    }
    else{ return false; }
    //something happened!
    
    if( $this->keep_proportions === true )
    {
      if( ($img_width-$this->sizelimit_x) > ($img_height-$this->sizelimit_y) )
      {
      //if the width of the img is greater than the size limit we scale by width
        $scalex = ( $this->sizelimit_x / $img_width );
        $scaley = $scalex;
      }
      else
      //if the height of the img is greater than the size limit we scale by height
      {
        $scalex = ( $this->sizelimit_y / $img_height );
        $scaley = $scalex;
      }

    }
    else 
    {
      $scalex = ( $this->sizelimit_x / $img_width );
      $scaley = ( $this->sizelimit_y / $img_height );
      //just make the image fit the image size limit
      
      if( $scalex > 1 ){ $scalex = 1; }
      if( $scaley > 1 ){ $scaley = 1; }
      //don't make it so it streches the image
    }
    
    $new_width = $img_width * $scalex;
    $new_height = $img_height * $scaley;
    
    $this->resized_resource = @imagecreatetruecolor( $new_width, $new_height );
    //creates an image resource, with the width and height of the size limits (or new resized proportion )
    
    if( function_exists( 'imageantialias' )){ @imageantialias( $this->resized_resource, true ); }
    //helps in the quality of the image being resized
    
    @imagecopyresampled( $this->resized_resource, $this->image_resource, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height );
    //resize the iamge onto the resized resource
    
    @imagedestroy( $this->image_resource );
    //destory old image resource
    
    return true;
  }
  
  function save_resizedimage( $path, $name )
  {
    switch( strtoupper($this->output) )
    {
      case 'GIF':
        //GIF
        @imagegif( $this->resized_resource, $path . $name . '.gif' );
        break;
      case 'JPG':
        //JPG
        @imagejpeg( $this->resized_resource, $path . $name . '.jpg' );
        break;  
      case 'PNG':
        //PNG
        @imagepng( $this->resized_resource, $path . $name . '.png' );
    }
  }
  
  function output_resizedimage()
  {
    $the_time = time();
    header('Last-Modified: ' . date( 'D, d M Y H:i:s', $the_time ) . ' GMT'); 
    header('Cache-Control: public');
    
    switch( strtoupper($this->output) )
    {
      case 'GIF':
        //GIF
        header('Content-type: image/gif');
        @imagegif( $this->resized_resource );
        break;
      case 'JPG':
        //JPG
        header('Content-type: image/jpg');
        @imagejpeg( $this->resized_resource );
        break;  
      case 'PNG':
        //PNG
        header('Content-type: image/png');
        @imagepng( $this->resized_resource );
    }
  }
  
  function destroy_resizedimage()
  {
    @imagedestroy( $this->resized_resource );
    @imagedestroy( $this->image_resource );
  }

}

?>

