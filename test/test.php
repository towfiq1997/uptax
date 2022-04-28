<?php
if(isset($_POST['owner_name']))
{

	$extension = pathinfo($_FILES['profilee_pic']['name'], PATHINFO_EXTENSION);

	$new_name = time() . '.' . $extension;

	move_uploaded_file($_FILES['profilee_pic']['tmp_name'], 'images/' . $new_name);

	// $data = array(
	// 	'image_source'		=>	'images/' . $new_name
	// );
    $data = array(
        'image_source'		=>	'images/' . $new_name,
       'item'=> $_POST['owner_name']
    );

	echo json_encode($data);

}
if(isset($_POST['nested_posts']))
{

	// $extension = pathinfo($_FILES['profilee_pic']['name'], PATHINFO_EXTENSION);

	// $new_name = time() . '.' . $extension;

	// move_uploaded_file($_FILES['profilee_pic']['tmp_name'], 'images/' . $new_name);

	// // $data = array(
	// // 	'image_source'		=>	'images/' . $new_name
	// // );
    $dataa = array(
       'itemm'=> $_POST['nested_posts']
    );

	echo json_encode($dataa);

}
?>