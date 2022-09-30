function page_plus_info_adresse_new()
	local liste = "adresse"
	resync_liste(liste)
	creation_variable({"id"},{""})

	table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info adresse", back_color = 32768, text_color = 1})
	-- section a droite de la barre de scroll (section fixe)
	creation_variable({"nom","type_adresse"},{"",""})
	table.insert(global_term_objet_write,{x = 35, y = 5, text = "nom :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 35, y = 7, text = "type :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 42, y = 5, text = global_variable["nom"], back_color = 128 + change_color_champ_select("nom"), text_color = 1})
	table.insert(global_term_objet_write,{x = 42, y = 7, text = global_http_error_message["type_adresse"][tonumber(global_variable["type_adresse"])], back_color = 128 + change_color_champ_select("type_adresse"), text_color = 1})
	table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 5, ymax = 5, parametre={action="variable",nom="nom",type="text"}, back_color = 128 + change_color_champ_select("nom")})
	table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 7, ymax = 7, parametre={action="variable",nom="type_adresse",type="select"}, back_color = 128 + change_color_champ_select("type_adresse")})

	table.insert(global_term_objet_write,{x = 43, y = 13, text = "ajouter", back_color = 128, text_color = 1})
	table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, parametre={action="action",id="http_add_adr"}, back_color = 128})
	
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
	creation_variable(variable_nom,texte_variable)
	texte_variable = import_variable(variable_nom,variable_type)

	print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
	genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page,"scroll")
end