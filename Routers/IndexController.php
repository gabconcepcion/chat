<?php

// GET index route
$app->get('/', function () use ($app, $controller) {

    $app->render($controller.'header.phtml');
    $app->render($controller.'index.phtml');
    $app->render($controller.'footer.phtml');
});

$app->post('/ajax-send-message', function() use ($app, $controller){

	$oChat = new Chat_Model();

	$aMessage = array(
		'name' => $app->request()->post('name'),
		'message' => $app->request()->post('message'),
	);

	if(!empty($aMessage['name']) && !empty($aMessage['message']))
		$oChat->insertMessage($aMessage);

	$response = $oChat->getMessages();
	$app->contentType('application/json');
	echo json_encode($response);
});
