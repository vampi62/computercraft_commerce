function genere_select_frame()
	if global_edit_variable["type"] ~= nil then
		if global_edit_variable["type"] == "select" then
			lenstring = 0
			if global_edit_variable["nom"] == "adresse" then
				resync_liste("adresse")
				local localfiltre = {type={valeur="2",type="egal"}}
				global_reapliquer_filtre = true
				chargement_filtre("adresse",localfiltre)
			end
			resync_select()
			lenstring = len_string_tab(global_select_section[global_edit_variable["nom"]])
			if lenstring + global_edit_variable["xmin"] < 51 then
				--genere_scroll_barre(#global_select_section[global_edit_variable["nom"]],global_edit_variable["xmin"]-1,tonumber(global_variable[global_edit_variable["nom"]]),global_edit_variable["ymin"],global_edit_variable["ymax"]+5,"select",true)
				print_select_module(global_edit_variable["xmin"],global_edit_variable["ymin"],lenstring)
			else
				print_select_module(global_edit_variable["xmax"]-lenstring,global_edit_variable["ymin"],lenstring)
				--genere_scroll_barre(#global_select_section[global_edit_variable["nom"]],global_edit_variable["xmax"]+1,tonumber(global_variable[global_edit_variable["nom"]]),global_edit_variable["ymin"],global_edit_variable["ymax"]+5,"select",true)
			end
		end
	end
end
function len_string_tab(section)
	lenstring = 0
	for k,v in pairs(section) do
		if section[k] ~= nil then
			if string.len(section[k]) > lenstring then
				lenstring = string.len(section[k])
			end
		end
	end
	return lenstring
end
function print_select_module(x,y,lenstring)
	local yincr = 1
	if y + 3 < 18 then
		global_edit_variable["select_sens"] = false
		for k,v in pairs(global_select_section[global_edit_variable["nom"]]) do
			if global_select_section[global_edit_variable["nom"]][k] ~= nil then
				table.insert(global_term_objet_write,{x = x, y = y+yincr, text = bouche_trou(global_select_section[global_edit_variable["nom"]][k],lenstring), back_color = 2048 + change_color_select(k), text_color = 1})
				table.insert(global_term_objet_select,{xmin = x, xmax = x + lenstring, ymin = y+yincr, ymax = y+yincr, parametre={action="select",valeur=k}, back_color = 2048 + change_color_select(k)})
				yincr = yincr + 1
			end
		end
	else
		global_edit_variable["select_sens"] = true
		for k,v in pairs(global_select_section[global_edit_variable["nom"]]) do
			if global_select_section[global_edit_variable["nom"]][k] ~= nil then
				table.insert(global_term_objet_write,{x = x, y = y-yincr, text = bouche_trou(global_select_section[global_edit_variable["nom"]][k],lenstring), back_color = 2048 + change_color_select(k), text_color = 1})
				table.insert(global_term_objet_select,{xmin = x, xmax = x + lenstring, ymin = y-yincr, ymax = y-yincr, parametre={action="select",valeur=k}, back_color = 2048 + change_color_select(k)})
				yincr = yincr + 1
			end
		end
	end
end