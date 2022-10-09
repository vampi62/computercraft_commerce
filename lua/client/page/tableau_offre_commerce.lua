function page_tableau_offre_commerce()
	local liste = "offre"
	resync_liste(liste)
	chargement_filtre(liste)
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "                    |        |       |     |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="nom                ",champ="nom",type="string"},{text="prix   ",champ="prix",type="int"},{text="stock ",champ="nbr_dispo",type="int"},{text="util",champ="nbr_commande",type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j]["nom"], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 22, y = y, text = convert_grand_nombre(global_filtre_liste[liste][j]["prix"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 31, y = y, text = convert_grand_nombre(global_filtre_liste[liste][j]["nbr_dispo"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 39, y = y, text = bouche_trou(global_filtre_liste[liste][j]["nbr_commande"],4), back_color = 128, text_color = 1})
			
			table.insert(global_term_objet_select,{xmin = 39, xmax = 43, ymin = y, ymax = y, parametre={action="page",id=150,filtre={id_offre={valeur=global_filtre_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
			table.insert(global_term_objet_write,{x = 45, y = y, text = " edit ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 45, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=133,filtre={id={valeur=global_filtre_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end