@extends('layouts.app')
@section('content')

<?php

 // print_r($token);
 // return;

require_once  'plugin/Facebook/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => '1361360707308056',
  'app_secret' => '0d2dda56f37756784caf4f83e311bd24',
  'default_graph_version' => 'v2.10',
  'default_access_token' => $token, // optional
]);

try {
  $response = $fb->get('/me');
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
//echo 'Logged in as ' . $me->getName();


 //***.............. taggable_friends...........***//
     // List of All Facebook Friendlist

            $requestFriends = $fb->get('/me/taggable_friends?fields=name,picture,id,first_name,last_name&limit=100');
        		$friends = $requestFriends->getGraphEdge();

            if ($fb->next($friends)) {
            		$allFriends = array();
            		$friendsArray = $friends->asArray();
            		$allFriends = array_merge($friendsArray, $allFriends);
            		while ($friends = $fb->next($friends)) {
            			$friendsArray = $friends->asArray();
            			$allFriends = array_merge($friendsArray, $allFriends);
            		}
            		foreach ($allFriends as $key) {
                   echo '<img src="' . $key['picture']['url'] . '"/>';
                   echo "<br>";
                   echo "<p><b>full Name is : </b>".$key['name'] . "</p>";
                   echo "<p><b>First Name is : </b>".$key['first_name']."</p>";
                   echo "<p><b>Last Name is : </b>".$key['last_name'] . "</p>";
                   echo "<br>";
            		}
            		 echo count($allFriends);
            	} else {
            		$allFriends = $friends->asArray();
            		$totalFriends = count($allFriends);
            		foreach ($allFriends as $key) {
            			echo $key['name'] . "<br>";
            		}
            	}
   // ***...end taggable_friends.....***//


   //***...liked.....***//
     // get list of pages liked by user

           $requestLikes = $fb->get('/me/likes?limit=100');
           $likes = $requestLikes->getGraphEdge();
             //print_r($requestLikes);

               $totalLikes = array();
            	if ($fb->next($likes)) {
            		$likesArray = $likes->asArray();
            		$totalLikes = array_merge($totalLikes, $likesArray);
            		while ($likes = $fb->next($likes)) {
            			$likesArray = $likes->asArray();
            			$totalLikes = array_merge($totalLikes, $likesArray);
            		}
            	} else {
            		$likesArray = $likes->asArray();
            		$totalLikes = array_merge($totalLikes, $likesArray);
            	}
            	// printing data on screen

            	foreach ($totalLikes as $key) {
            		//echo $key['name'] . '<br>';
            	}
        //  echo count($totalLikes);
   // ***...end liked.....***//


// getting likes data of recent 100 posts by user


   $getPostsLikes = $fb->get('/me/posts?fields=likes.limit(1000){name,id}&limit=100');
   $getPostsLikes = $getPostsLikes->getGraphEdge()->asArray();
    // printing likes data as per requirements
    foreach ($getPostsLikes as $key) {
     if (isset($key['likes'])) {
       echo count($key['likes']) . '<br>';
       foreach ($key['likes'] as $key) {
         echo $key['name'] . '<br>';
       }
     }
    }
    // getting likes data of recent 100 photos by user
    $getPhotosLikes = $fb->get('/me/photos?fields=likes.limit(1000){name,id}&limit=100&type=uploaded');
    $getPhotosLikes = $getPhotosLikes->getGraphEdge()->asArray();
    // printing likes data as per requirements
    foreach ($getPhotosLikes as $key) {
     if (isset($key['likes'])) {
       echo count($key['likes']) . '<br>';
       foreach ($key['likes'] as $key) {
         echo $key['name'] . '<br>';
       }
       }
}




?>

@endsection
