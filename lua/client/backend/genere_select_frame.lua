function genere_select_frame()
	if global_edit_variable["type"] ~= nil then
		if global_edit_variable["type"] == "select" then
			lenstring = 0
			if global_edit_variable["nom"] == "adresse" then
				resync_liste("adresse")
			end
			resync_select()
			lenstring = len_string_tab(global_select_section[global_edit_variable["nom"]])
			if lenstring + global_edit_variable["xmin"] < 51 then
				--genere_scroll_barre(#global_select_section[global_edit_variable["nom"]],global_edit_variable["xmin"]-1,tonumber(global_variable[global_edit_variable["nom"]]),global_edit_variable["ymin"],global_edit_variable["ymax"]+5)
				print_select_module(global_edit_variable["xmin"],global_edit_variable["ymin"],lenstring)
			else
				print_select_module(global_edit_variable["xmax"]-lenstring,global_edit_variable["ymin"],lenstring)
				--genere_scroll_barre(#global_select_section[global_edit_variable["nom"]],global_edit_variable["xmax"]+1,tonumber(global_variable[global_edit_variable["nom"]]),global_edit_variable["ymin"],global_edit_variable["ymax"]+5)
			end
		end
	end
end
function len_string_tab(section)
	lenstring = 0
	for j=0, #section do
		if section[j] ~= nil then
			if string.len(section[j]) > lenstring then
				lenstring = string.len(section[j])
			end
		end
	end
	return lenstring
end
function print_select_module(x,y,lenstring)
	local yincr = 1
	if y + 3 < 18 then
		for j=0, #global_select_section[global_edit_variable["nom"]] do
			if global_select_section[global_edit_variable["nom"]][j] ~= nil then
				table.insert(global_term_objet_write,{x = x, y = y+yincr, text = bouche_trou(global_select_section[global_edit_variable["nom"]][j],lenstring), back_color = 2048 + change_color_select(j), text_color = 1})
				table.insert(global_term_objet_select,{xmin = x, xmax = x + lenstring, ymin = y+yincr, ymax = y+yincr, value={action="select",value=j}, back_color = 2048 + change_color_select(j)})
				yincr = yincr + 1
			end
		end
	else
		for j=#global_select_section[global_edit_variable["nom"]], 0, -1 do
			if global_select_section[global_edit_variable["nom"]][j] ~= nil then
				table.insert(global_term_objet_write,{x = x, y = y-yincr, text = bouche_trou(global_select_section[global_edit_variable["nom"]][j],lenstring), back_color = 2048 + change_color_select(j), text_color = 1})
				table.insert(global_term_objet_select,{xmin = x, xmax = x + lenstring, ymin = y+yincr, ymax = y+yincr, value={action="select",value=j}, back_color = 2048 + change_color_select(j)})
				yincr = yincr + 1
			end
		end
	end
end
function bouche_trou(text,lenstring)
	return_text = ""
	for j=string.len(text), lenstring do
		return_text = return_text.." "
	end
	return text..return_text
end