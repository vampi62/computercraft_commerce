<?php
class Changetext
{
	static public function retirebalise($text,$_Serveur_)
    {
		$text = str_replace($_Serveur_['balise'],"",$text);
		return $text;
    }
}
?>