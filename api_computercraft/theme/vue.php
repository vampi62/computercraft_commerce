<?php
if (isset($printmessage))
{
	if (is_array($printmessage))
	{
		if (!isset($pagelectureconfig))
		{
			$pagelectureconfig = false;
		}
		print_array($printmessage,$pagelectureconfig);
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

function print_array($list,$pagelectureconfig)
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
			if ($pagelectureconfig)
			{
				echo "[" . strval($element) . "]=";
			}
		}
		else
		{
			echo $element . "=";
		}
		if (is_array($value))
		{
			print_array($value,$pagelectureconfig);
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