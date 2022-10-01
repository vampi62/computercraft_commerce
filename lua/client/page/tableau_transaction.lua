function page_tableau_transaction()
	local liste = "transaction"
	resync_liste(liste)
	chargement_filtre(liste,nil,global_session["pseudo"],'crediteur','debiteur')
	genere_scroll_barre(#global_filtre_liste[liste],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "                    |                |        |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="nom                ",champ="nom",type="string"},{text="statut         ",champ="statut",type="string"},{text="somme  ",champ="somme",type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j][0], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 22, y = y, text = global_http_error_message["statut_transaction"][tonumber(global_filtre_liste[liste][j]["type"])], back_color = 32768, text_color = 1})
			if global_filtre_liste[liste][j]["crediteur"] == global_session["pseudo"] then
				table.insert(global_term_objet_write,{x = 39, y = y, text = "+"..convert_grand_nombre(global_filtre_liste[liste][j]["somme"]), back_color = 32768, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 39, y = y, text = "-"..convert_grand_nombre(global_filtre_liste[liste][j]["somme"]), back_color = 32768, text_color = 16384})
			end
			table.insert(global_term_objet_write,{x = 49, y = y, text = "+", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=63,filtre={id={valeur=global_filtre_liste[liste][j]["id"],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end