function print_tableau_plus_info_scroll(position_scroll_barre,texte_variable,texte_info,variable_nom,variable_type)
	function print_tableau()
		local offset_text = 0
		for j=1, #variable_nom do
			if variable_type[j] ~= nil and variable_type[j] ~= "" then
				texte_variable[j] = global_variable[variable_nom[j]]
			end
		end
		genere_scroll_barre(texte_variable,position_scroll_barre,global_scroll,global_min_y_page,global_max_y_page,"scroll")
		for g=1, #texte_info do
			local y = global_scroll + offset_text + global_min_y_page + g
			if y <= global_max_y_page and y > global_min_y_page then
				table.insert(global_term_objet_write,{x = 1, y = y, text = texte_info[g], back_color = 32768, text_color = 1})
				if string.len(texte_variable[g]) > position_scroll_barre-1-(string.len(texte_info[g])+2) then
					offset_text = offset_text + 1
					y = global_scroll + offset_text + global_min_y_page + g
					local split_texte_variable = split(texte_variable[g],global_http_error_message["General"]["case_ligne_suite"])
					for k=1, #split_texte_variable do
						for i=0, string.len(split_texte_variable[k]), position_scroll_barre-1 do
							if y <= global_max_y_page and y >= global_min_y_page then
								print_line_scroll_tab_page_plus_info(1,position_scroll_barre-1,y,string.sub(split_texte_variable[k],i,i+position_scroll_barre-2),variable_type[g],variable_nom[g])
							elseif y > global_max_y_page then
								global_limite_scroll_bas = false
								break
							end
							offset_text = offset_text + 1
							y = global_scroll + offset_text + global_min_y_page + g
						end
					end
					offset_text = offset_text - 1
				else
					print_line_scroll_tab_page_plus_info(string.len(texte_info[g])+2,position_scroll_barre-1,y,texte_variable[g],variable_type[g],variable_nom[g])
				end
				offset_text = offset_text + 1
			elseif y > global_max_y_page then
				break
			end
		end
	end
	function print_line_scroll_tab_page_plus_info(x,xmax,y,text_ou_var,var_type,var_id)
		if var_type ~= "" then
			table.insert(global_term_objet_select,{xmin = x, xmax = xmax, ymin = y, ymax = y, parametre={action="variable",nom=var_id,type=var_type}, back_color = 128 + change_color_champ_select(var_id)})
			if var_type == "select" then
				if text_ou_var == "" then
					text_ou_var = 0
				end
				if global_select_section[var_id][tostring(text_ou_var)] ~= nil then
					table.insert(global_term_objet_write,{x = x, y = y, text = global_select_section[var_id][tostring(text_ou_var)], back_color = 128 + change_color_champ_select(var_id), text_color = 1})
				elseif global_select_section[var_id][tonumber(text_ou_var)] ~= nil then
					table.insert(global_term_objet_write,{x = x, y = y, text = global_select_section[var_id][tonumber(text_ou_var)], back_color = 128 + change_color_champ_select(var_id), text_color = 1})
				end
			else
				table.insert(global_term_objet_write,{x = x, y = y, text = text_ou_var, back_color = 128 + change_color_champ_select(var_id), text_color = 1})
			end
		else
			table.insert(global_term_objet_write,{x = x, y = y, text = text_ou_var, back_color = 32768, text_color = 1})
		end
	end
	print_tableau()
end