function page_plus_info_adresse()
	local liste = "adresse"
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"]["valeur"] == global_liste[liste][j]["id"] then
			creation_variable({"id","ancientype"},{global_liste[liste][j]["nom"],global_liste[liste][j]["type"]})

			table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info adresse", back_color = 32768, text_color = 1})
			-- section a droite de la barre de scroll (section fixe)
			creation_variable({"nom","type_adresse"},{global_liste[liste][j]["nom"],global_liste[liste][j]["type"]})
			table.insert(global_term_objet_write,{x = 35, y = 5, text = "nom :", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 7, text = "type :", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 5, text = global_variable["nom"], back_color = 128 + change_color_champ_select("nom"), text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 7, text = global_http_error_message["type_adresse"][tonumber(global_variable["type_adresse"])], back_color = 128 + change_color_champ_select("type_adresse"), text_color = 1})
			table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 5, ymax = 5, parametre={action="variable",nom="nom",type="text"}, back_color = 128 + change_color_champ_select("nom")})
			table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 7, ymax = 7, parametre={action="variable",nom="type_adresse",type="select"}, back_color = 128 + change_color_champ_select("type_adresse")})
			
			if global_liste[liste][j]["type"] == "2" then
				table.insert(global_term_objet_write,{x = 33, y = 11, text = "liste offres", back_color = 128, text_color = 1})
				table.insert(global_term_objet_select,{xmin = 34, xmax = 46, ymin = 11, ymax = 11, parametre={action="page",id=130,filtre={proprio={valeur=global_session["pseudo"],type="egal"},id_adresse={valeur=global_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
			end
			table.insert(global_term_objet_write,{x = 33, y = 13, text = "update", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 33, xmax = 38, ymin = 13, ymax = 13, parametre={action="action",id="http_update_adr"}, back_color = 128})
			table.insert(global_term_objet_write,{x = 41, y = 13, text = "supprimer", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 41, xmax = 49, ymin = 13, ymax = 13, parametre={action="action",id="http_suppr_adr"}, back_color = 128})

			table.insert(global_term_objet_write,{x = 33, y = 15, text = " select adresse ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 33, xmax = 50, ymin = 15, ymax = 15, parametre={action="action",id="http_defaut_adr"}, back_color = 128})

			-- variable pour la section a gauche de la barre de scroll (section mobile)
			local texte_info = {
				"coo        :",
				"description:"
			}
			local texte_variable = {
				global_liste[liste][j]["coo"],
				global_liste[liste][j]["description"]
			}
			local variable_nom = {
				"coo",
				"description"
			}
			local variable_type = {
				"text",
				"text"
			}
			creation_variable(variable_nom,texte_variable)
			print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
			texte_variable = import_variable(variable_nom,variable_type)
			genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page,"scroll")
			break
		end
	end
end