function page_tableau_commande_client()
	local liste = "commande_client"
	resync_liste(liste)
	chargement_filtre(liste)
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "             |              |         |       |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="vendeur     ",champ="expediteur",type="string"},{text="nom          ",champ="nom_commande",type="string"},{text="statut  ",champ="statut",type="int"},{text="somme ",champ="somme",type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j]["expediteur"], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 15, y = y, text = global_filtre_liste[liste][j]["nom_commande"], back_color = 32768, text_color = 1})
			local text = split(global_http_error_message["statut_echange"][tonumber(global_filtre_liste[liste][j]["statut"])], "-")
			table.insert(global_term_objet_write,{x = 30, y = y, text = text[1], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 40, y = y, text = convert_grand_nombre(global_filtre_liste[liste][j]["somme"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 48, y = y, text = " X ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=53,filtre={id={valeur=global_filtre_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end