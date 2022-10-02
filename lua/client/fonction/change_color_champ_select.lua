function change_color_champ_select(champ)
	if champ == global_edit_variable["nom"] then
		return 128
	else
		return 0
	end
end
function change_color_select(champ)
	if champ == global_variable[global_edit_variable["nom"]] then
		return -1536
	else
		return 0
	end
end