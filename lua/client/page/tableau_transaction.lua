function page_tableau_transaction()
	local liste = "transaction"
	resync_liste(liste)
	chargement_filtre(liste,global_session["pseudo"],4,5)
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "                    |                |        |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="nom                ",champ=0,type="string"},{text="statut         ",champ=7,type="string"},{text="somme  ",champ=6,type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j][0], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 22, y = y, text = global_http_error_message["statut_transaction"][tonumber(global_filtre_liste[liste][j][7])], back_color = 32768, text_color = 1})
			if global_liste[liste][j][4] == global_session["pseudo"] then
				table.insert(global_term_objet_write,{x = 39, y = y, text = "+"..convert_grand_nombre(global_filtre_liste[liste][j][6]), back_color = 32768, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 39, y = y, text = "-"..convert_grand_nombre(global_filtre_liste[liste][j][6]), back_color = 32768, text_color = 16384})
			end
			table.insert(global_term_objet_write,{x = 49, y = y, text = "+", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=63,filtre={id={valeur=global_filtre_liste[liste][j][1],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end