<?php
if (isset($printmessage) AND !empty($printmessage))
{
	if (is_array($printmessage))
	{
		print_array($printmessage,$_Serveur_);
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

function print_array($list,$_Serveur_)
{
	echo "{";
	$value_next = false;
	foreach($list as $element => $value)
	{
		if ($value_next)
		{
			echo ",";
		}
		if (is_int($element))
		{
			echo "[" . strval($element) . "]=";
		}
		else
		{
			echo $element . "=";
		}
		if (is_array($value))
		{
			print_array($value,$_Serveur_);
			$value_next = true;
		}
		else
		{
			echo "'" . $value . "'";
			$value_next = true;
		}
	}
	echo "}";
}
?>