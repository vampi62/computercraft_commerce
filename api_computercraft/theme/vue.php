<?php
if (isset($printmessage) AND !empty($printmessage))
{
	if (is_array($printmessage))
	{
		print_array($printmessage,false,$_Serveur_);
	}
	elseif (is_int($printmessage))
	{
		echo $printmessage;
	}
	else
	{
		echo '403';
	}
}
else
{
	echo '404';
}


function print_array($list,$boolarray,$_Serveur_)
{
	foreach($list as $element)
	{
		if ($boolarray)
		{
			echo $element . $_Serveur_['balise']['tableau_colonne_suite'];
		}
		else
		{
			if (is_array($element))
			{
				print_array($element,true,$_Serveur_);
			}
			else
			{
				echo "" . $element . "";
				echo $_Serveur_['balise']['tableau_ligne_suite'];
			}
		}
	}
	if ($boolarray)
	{
		echo $_Serveur_['balise']['tableau_ligne_suite'];
	}
}
?>