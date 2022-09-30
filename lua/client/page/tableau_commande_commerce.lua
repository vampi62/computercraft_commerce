function page_tableau_commande_commerce()
	local liste = "commande_commerce"
	resync_liste(liste)
	chargement_filtre(liste)
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "             |              |         |       |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="acheteur    ",champ=0,type="string"},{text="nom          ",champ=4,type="string"},{text="statut  ",champ=16,type="int"},{text="somme ",champ=10,type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j][6], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 15, y = y, text = global_filtre_liste[liste][j][4], back_color = 32768, text_color = 1})
			local text = split(global_http_error_message["statut_echange"][tonumber(global_filtre_liste[liste][j][16])], "-")
			table.insert(global_term_objet_write,{x = 30, y = y, text = text[1], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 40, y = y, text = convert_grand_nombre(global_filtre_liste[liste][j][10]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 48, y = y, text = " X ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=153,filtre={id={valeur=global_filtre_liste[liste][j][1],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end