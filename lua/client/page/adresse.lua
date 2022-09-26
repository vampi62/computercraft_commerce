function page_adresse()
	local liste = "adresse"
	resync_liste(liste)
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if global_reapliquer_filtre then
		global_filtre_liste[liste] = chargement_filtre(liste)
		global_reapliquer_filtre = false
		global_scroll = 0
	end
	table.insert(global_term_objet_write,{x = 42, y = 3, text = "new adr", back_color = 128, text_color = 1})
	table.insert(global_term_objet_select,{xmin = 42, xmax = 49, ymin = 3, ymax = 3, value={action="page",id=91}, back_color = 128})
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page)
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "                    |          |              |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="nom                ",champ=1,type="string"},{text="type     ",champ=2,type="string"},{text="coo          ",champ=3,type="string"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			if global_session["defautadresse"]["nom"] == global_filtre_liste[liste][j][1] then
				table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j][1], back_color = 32768, text_color = 8192})
				table.insert(global_term_objet_write,{x = 22, y = y, text = global_http_error_message["type_adresse"][tonumber(global_filtre_liste[liste][j][2])], back_color = 32768, text_color = 8192})
				table.insert(global_term_objet_write,{x = 33, y = y, text = string.sub(global_filtre_liste[liste][j][3],1,14), back_color = 32768, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j][1], back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 22, y = y, text = global_http_error_message["type_adresse"][tonumber(global_filtre_liste[liste][j][2])], back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 33, y = y, text = string.sub(global_filtre_liste[liste][j][3],1,14), back_color = 32768, text_color = 1})
			end
			table.insert(global_term_objet_write,{x = 48, y = y, text = " + ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, value={action="page",id=93,value={id=global_filtre_liste[liste][j][1]}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end