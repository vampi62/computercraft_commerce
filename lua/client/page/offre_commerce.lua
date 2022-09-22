function page_offre_commerce()
	local liste = "offre"
	resync_liste(liste)
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if global_filtre["proprio"] == nil then
		global_filtre["proprio"] = {}
		global_filtre["proprio"]["value"] = global_session["pseudo"]
		global_filtre["proprio"]["type"] = "compare"
	end
	if global_reapliquer_filtre then
		global_filtre_liste[liste] = chargement_filtre(liste)
		global_reapliquer_filtre = false
		global_scroll = 0
	end
	genere_scroll_barre(#global_filtre_liste[liste],51)
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "                    |        |       |     |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="nom                ",champ=8,type="string"},{text="prix   ",champ=4,type="int"},{text="stock ",champ=5,type="int"}}
	genere_menu_tableau(colonne_liste,liste)
	for j=1, #global_filtre_liste[liste] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste[liste][j][8], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 23, y = y, text = convert_grand_nombre(global_filtre_liste[liste][j][4]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 32, y = y, text = convert_grand_nombre(global_filtre_liste[liste][j][5]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 39, y = y, text = "histo", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 45, y = y, text = " edit ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 45, xmax = 50, ymin = y, ymax = y, value={action="page",id=133,value={id=global_filtre_liste[liste][j][1]}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end