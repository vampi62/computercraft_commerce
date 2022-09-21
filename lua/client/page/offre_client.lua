function page_offre_client()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if #global_liste["offre"] < 1 then
		global_liste["offre"] = http_commande("http_offre")
		global_reapliquer_filtre = true
	end
	if global_filtre["proprio"] == nil then
		global_filtre["proprio"] = {}
		global_filtre["proprio"]["value"] = global_session["pseudo"]
		global_filtre["proprio"]["type"] = "diff"
	end
	if global_reapliquer_filtre then
		global_filtre_liste["offre"] = chargement_filtre("offre")
		global_reapliquer_filtre = false
		global_scroll = 0
	end
	genere_scroll_barre(#global_filtre_liste["offre"],51)
	table.insert(global_term_objet_write,{x = 1, y = global_min_y_page, text = "              |               |       |       |", back_color = 32768, text_color = 1})
	local colonne_liste = {{text="vendeur      ",champ=3,type="string"},{text="nom           ",champ=8,type="string"},{text="prix  ",champ=4,type="int"},{text="stock ",champ=5,type="int"}}
	genere_menu_tableau(colonne_liste,"offre")
	for j=1, #global_filtre_liste["offre"] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = "              |               |       |       |", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste["offre"][j][3], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 16, y = y, text = global_filtre_liste["offre"][j][8], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 32, y = y, text = convert_grand_nombre(global_filtre_liste["offre"][j][4]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 41, y = y, text = convert_grand_nombre(global_filtre_liste["offre"][j][5]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 49, y = y, text = "X", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, value={action="page",id=33,value={id=global_filtre_liste["offre"][j][1]}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end