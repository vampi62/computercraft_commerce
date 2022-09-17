function page_plus_info_offre()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if #global_liste["offre"] < 1 then
		global_liste["offre"] = http_commande("http_offre")
	end
	if global_page_visible == 33 then
		
	end
	if global_page_visible == 133 then

	end
	if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then

	end

	for j=1, #global_liste["offre"] do
		if global_fitre["id"] == global_liste["offre"][j][1] then
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
--				global_liste["offre"][j][0], id
				global_liste["offre"][j][3],
				global_liste["offre"][j][8],
				global_liste["offre"][j][4], -- prix
				global_liste["offre"][j][5],
				global_http_error_message["type"][tonumber(global_liste["offre"][j][6])],
				global_http_error_message["livraison"][tonumber(global_liste["offre"][j][7])],
				global_liste["offre"][j][2]["nom"],
				global_liste["offre"][j][2]["coo"],
				global_liste["offre"][j][2]["description"],
				global_liste["offre"][j][9],
				global_liste["offre"][j][10],
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