function page_plus_info_client()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	for j=0, #global_liste_offre[0] do
		if global_variable["num_champ"] == global_liste_offre[0][j] then
			local offset_text = 0
			local texte_info = {
				"vendeur    :",
				"nom        :",
				"prix       :",
				"dispo      :",
				"type       :",
				"livraison  :",
				"adresse    :",
				"coordonnee :",
				"description:",
				"description:",
				"dateupdate :"
			}
			local texte_variable = {
--				global_liste_offre[0][j], id
				global_liste_offre[2][j],
				global_liste_offre[7][j],
				global_liste_offre[3][j],
				global_liste_offre[4][j],
				global_http_error_message["type"][tonumber(global_liste_offre[5][j])],
				global_http_error_message["livraison"][tonumber(global_liste_offre[6][j])],
				global_liste_offre[1][j]["nom"],
				global_liste_offre[1][j]["coo"],
				global_liste_offre[1][j]["description"],
				global_liste_offre[8][j],
				global_liste_offre[9][j],
			}
			genere_scroll_barre(texte_variable,31)
			table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info offre", back_color = 32768, text_color = 1})
			for g=1, #texte_info do
				local y = global_scroll + offset_text + global_min_y_page + g
				if y <= global_max_y_page and y > global_min_y_page then
					table.insert(global_term_objet_write,{x = 1, y = y, text = texte_info[g], back_color = 32768, text_color = 1})
					if string.len(texte_variable[g]) > 30 then
						offset_text = offset_text + 1
						y = global_scroll + offset_text + global_min_y_page + g
						for i=0, string.len(texte_variable[g]), 30 do
							if y <= global_max_y_page and y >= global_min_y_page then
								table.insert(global_term_objet_write,{x = 1, y = y, text = string.sub(texte_variable[g],i,i+29), back_color = 32768, text_color = 1})
							elseif y > global_max_y_page then
								global_limite_scroll_bas = false
								break
							end
							offset_text = offset_text + 1
							y = global_scroll + offset_text + global_min_y_page + g
						end
					else
						table.insert(global_term_objet_write,{x = 14, y = y, text = texte_variable[g], back_color = 32768, text_color = 1})
					end
					offset_text = offset_text + 1
				elseif y > global_max_y_page then
					break
				end
			end
			break
		end
	end
end