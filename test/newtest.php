<?php

if(isset($_POST['nested_post']))
{

	// $extension = pathinfo($_FILES['profilee_pic']['name'], PATHINFO_EXTENSION);

	// $new_name = time() . '.' . $extension;

	// move_uploaded_file($_FILES['profilee_pic']['tmp_name'], 'images/' . $new_name);

	// // $data = array(
	// // 	'image_source'		=>	'images/' . $new_name
	// // );
    $data = array(
       'item'=> $_POST['nested_post']
    );

	echo json_encode($data);

}
?>