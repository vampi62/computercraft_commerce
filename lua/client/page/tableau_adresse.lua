function page_tableau_adresse()
	local liste = "adresse"
	resync_liste(liste)
	chargement_filtre(liste)
	table.insert(global_term_objet_write,{x = 42, y = 3, text = "new adr", back_color = 128, text_color = 1})
	table.insert(global_term_objet_select,{xmin = 42, xmax = 49, ymin = 3, ymax = 3, parametre={action="page",id=91}, back_color = 128})
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "                  |          |          |     |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="nom              ",champ="nom",type="string"},{text="type     ",champ="type",type="string"},{text="coo      ",champ="coo",type="string"},{text="util",champ="nbr_offre",type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			if global_session["defautadresse"]["id"] == global_filtre_liste[liste][j]["id"] then
				table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j]["nom"], back_color = 32768, text_color = 8192})
				table.insert(global_term_objet_write,{x = 20, y = y, text = global_http_error_message["type_adresse"][tonumber(global_filtre_liste[liste][j]["type"])], back_color = 32768, text_color = 8192})
				table.insert(global_term_objet_write,{x = 31, y = y, text = string.sub(global_filtre_liste[liste][j]["coo"],1,14), back_color = 32768, text_color = 8192})
				table.insert(global_term_objet_write,{x = 42, y = y, text = global_filtre_liste[liste][j]["nbr_offre"], back_color = 128, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j]["nom"], back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 20, y = y, text = global_http_error_message["type_adresse"][tonumber(global_filtre_liste[liste][j]["type"])], back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 31, y = y, text = string.sub(global_filtre_liste[liste][j]["coo"],1,14), back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = y, text = bouche_trou(global_filtre_liste[liste][j]["nbr_offre"],4), back_color = 128, text_color = 1})
			end
			table.insert(global_term_objet_select,{xmin = 42, xmax = 46, ymin = y, ymax = y, parametre={action="page",id=130,filtre={proprio={valeur=global_session["pseudo"],type="egal"},id_adresse={valeur=global_filtre_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
			table.insert(global_term_objet_write,{x = 48, y = y, text = " + ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=93,filtre={id={valeur=global_filtre_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end