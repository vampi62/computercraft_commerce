function page_plus_info_adresse()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	local liste = "adresse"
	resync_liste(liste)
	local page_new = 91
	if global_page_visible == page_new then
		remplir_variable({"id"},{""})

		table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info adresse", back_color = 32768, text_color = 1})
		-- section a droite de la barre de scroll (section fixe)
		remplir_variable({"nom","type_adresse"},{"",""})
		table.insert(global_term_objet_write,{x = 35, y = 5, text = "nom :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 35, y = 7, text = "type :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 42, y = 5, text = global_variable["nom"], back_color = 128 + change_color_champ_select("nom"), text_color = 1})
		table.insert(global_term_objet_write,{x = 42, y = 7, text = global_http_error_message["type_adresse"][tonumber(global_variable["type_adresse"])], back_color = 128 + change_color_champ_select("type_adresse"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 5, ymax = 5, value={action="variable",id="nom",value="text"}, back_color = 128 + change_color_champ_select("nom")})
		table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 7, ymax = 7, value={action="variable",id="type_adresse",value="select"}, back_color = 128 + change_color_champ_select("type_adresse")})

		table.insert(global_term_objet_write,{x = 43, y = 13, text = "ajouter", back_color = 128, text_color = 1})
		table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, value={action="action",id="http_add_adr"}, back_color = 128})
		
		-- variable pour la section a gauche de la barre de scroll (section mobile)
		local texte_info = {
			"coo        :",
			"description:"
		}
		local texte_variable = {
			"",
			""
		}
		local variable_nom = {
			"coo",
			"description"
		}
		local variable_type = {
			"text",
			"text"
		}
		remplir_variable(variable_nom,texte_variable)
		print_tableau_plus_info_scroll(31,0,texte_variable,texte_info,variable_nom,variable_type)
	else
		for j=1, #global_liste[liste] do
			if global_filtre["id"] == global_liste[liste][j][1] then
				remplir_variable({"id"},{global_liste[liste][j][1]})

				table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info adresse", back_color = 32768, text_color = 1})
				-- section a droite de la barre de scroll (section fixe)
				remplir_variable({"nom","type_adresse"},{global_liste[liste][j][1],global_liste[liste][j][2]})
				table.insert(global_term_objet_write,{x = 35, y = 5, text = "nom :", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 35, y = 7, text = "type :", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 5, text = global_variable["nom"], back_color = 128 + change_color_champ_select("nom"), text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 7, text = global_http_error_message["type_adresse"][tonumber(global_variable["type_adresse"])], back_color = 128 + change_color_champ_select("type_adresse"), text_color = 1})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 5, ymax = 5, value={action="variable",id="nom",value="text"}, back_color = 128 + change_color_champ_select("nom")})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 7, ymax = 7, value={action="variable",id="type_adresse",value="select"}, back_color = 128 + change_color_champ_select("type_adresse")})

				table.insert(global_term_objet_write,{x = 33, y = 13, text = "update", back_color = 128, text_color = 1})
				table.insert(global_term_objet_select,{xmin = 33, xmax = 38, ymin = 13, ymax = 13, value={action="action",id="http_update_adr"}, back_color = 128})
				table.insert(global_term_objet_write,{x = 41, y = 13, text = "supprimer", back_color = 128, text_color = 1})
				table.insert(global_term_objet_select,{xmin = 41, xmax = 49, ymin = 13, ymax = 13, value={action="action",id="http_suppr_adr"}, back_color = 128})

				table.insert(global_term_objet_write,{x = 33, y = 15, text = " select adresse ", back_color = 128, text_color = 1})
				table.insert(global_term_objet_select,{xmin = 33, xmax = 50, ymin = 15, ymax = 15, value={action="action",id="http_defaut_adr"}, back_color = 128})

				-- variable pour la section a gauche de la barre de scroll (section mobile)
				local texte_info = {
					"coo        :",
					"description:"
				}
				local texte_variable = {
					global_liste[liste][j][3],
					global_liste[liste][j][4]
				}
				local variable_nom = {
					"coo",
					"description"
				}
				local variable_type = {
					"text",
					"text"
				}
				remplir_variable(variable_nom,texte_variable)
				print_tableau_plus_info_scroll(31,0,texte_variable,texte_info,variable_nom,variable_type)
				break
			end
		end
	end
end