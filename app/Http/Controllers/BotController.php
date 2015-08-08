<?php namespace App\Http\Controllers;

use App\Controller\Controllers;
use Irazasyed\Telegram\Telegram;
use Session;

class BotController extends Controller{

	public function getUpdates()
	{
			$telegram = new Telegram('112595027:AAHGhHF4_Bj5JiDYHEA-txtUaqe5JZXKnoY');
	    	$updates = $telegram->getUpdates();    	
	    	$last = $updates[count($updates) - 1]["message"]["text"];
    	return var_dump($last);
	}
}