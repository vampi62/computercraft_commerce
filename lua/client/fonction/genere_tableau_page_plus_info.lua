function print_tableau_plus_info_scroll(position_scroll_barre,page_admin,texte_variable,texte_info,variable_nom,variable_type)
	local offset_text = 0
	if page_admin == 0 then
		page_admin = global_page_visible
	end
	if global_page_visible == page_admin then
		for j=1, #variable_nom do
			texte_variable[j] = global_variable[variable_nom[j]]
		end
	end
	genere_scroll_barre(texte_variable,position_scroll_barre)
	for g=1, #texte_info do
		local y = global_scroll + offset_text + global_min_y_page + g
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = texte_info[g], back_color = 32768, text_color = 1})
			if string.len(texte_variable[g]) > position_scroll_barre-1-(string.len(texte_info[g])+2) then
				offset_text = offset_text + 1
				y = global_scroll + offset_text + global_min_y_page + g
				for i=0, string.len(texte_variable[g]), position_scroll_barre-1 do
					if y <= global_max_y_page and y >= global_min_y_page then
						if global_page_visible == page_admin then
							print_line_scroll_tab_page_plus_info(1,position_scroll_barre-1,y,string.sub(texte_variable[g],i,i+position_scroll_barre-2),variable_type[g],variable_nom[g])
						else
							print_line_scroll_tab_page_plus_info(1,position_scroll_barre-1,y,string.sub(texte_variable[g],i,i+position_scroll_barre-2),"","")
						end
					elseif y > global_max_y_page then
						global_limite_scroll_bas = false
						break
					end
					offset_text = offset_text + 1
					y = global_scroll + offset_text + global_min_y_page + g
				end
			else
				if global_page_visible == page_admin then
					print_line_scroll_tab_page_plus_info(string.len(texte_info[g])+2,position_scroll_barre-1,y,texte_variable[g],variable_type[g],variable_nom[g])
				else
					print_line_scroll_tab_page_plus_info(string.len(texte_info[g])+2,position_scroll_barre-1,y,texte_variable[g],"","")
				end
			end
			offset_text = offset_text + 1
		elseif y > global_max_y_page then
			break
		end
	end
end
function print_line_scroll_tab_page_plus_info(x,xmax,y,text_ou_var,var_type,var_id)
	if var_type ~= "" then
		table.insert(global_term_objet_write,{x = x, y = y, text = text_ou_var, back_color = 128 + change_color_champ_select(var_id), text_color = 1})
		table.insert(global_term_objet_select,{xmin = x, xmax = xmax, ymin = y, ymax = y, value={action="variable",id=var_id,value=var_type}, back_color = 128 + change_color_champ_select(var_id)})
	else
		table.insert(global_term_objet_write,{x = x, y = y, text = text_ou_var, back_color = 32768, text_color = 1})
	end
end