function page_panier()
	resync_liste("offre")
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if global_filtre["proprio"] == nil then
		global_filtre["proprio"] = {}
		global_filtre["proprio"]["value"] = global_session["pseudo"]
		global_filtre["proprio"]["type"] = "diff"
	end
	if global_reapliquer_filtre then
		global_filtre_liste["offre"] = chargement_filtre("offre")
		global_reapliquer_filtre = false
		global_scroll = 0
		global_filtre_liste["panier"] = {}
		for g=1, #global_filtre_liste["offre"] do
			for j=1, #global_panier do
				if global_panier[j]["id"] == global_filtre_liste["offre"][g][1] then
					table.insert(global_filtre_liste["panier"],global_filtre_liste["offre"][g])
					global_filtre_liste["panier"][#global_filtre_liste["panier"]]["quant"] = tonumber(global_panier[j]["quant"])
					global_filtre_liste["panier"][#global_filtre_liste["panier"]]["prixg"] = global_panier[j]["quant"]*global_filtre_liste["offre"][g][4]
				end
			end
		end
	end
	genere_scroll_barre(#global_filtre_liste["panier"],51)
	for j=global_min_y_page, global_max_y_page do
		table.insert(global_term_objet_write,{x = 1, y = j, text = "              |               |       |       |", back_color = 32768, text_color = 1})
	end
	local colonne_liste = {{text="vendeur      ",champ=3,type="string"},{text="nom           ",champ=8,type="string"},{text="prixG ",champ="prixg",type="int"},{text="quant ",champ="quant",type="int"}}
	genere_menu_tableau(colonne_liste,"panier")
	for j=1, #global_filtre_liste["panier"] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_filtre_liste["panier"][j][3], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 16, y = y, text = global_filtre_liste["panier"][j][8], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 32, y = y, text = convert_grand_nombre(global_filtre_liste["panier"][j]["prixg"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 41, y = y, text = convert_grand_nombre(global_filtre_liste["panier"][j]["quant"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 49, y = y, text = "X", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, value={action="page",id=43,value={id=global_filtre_liste["panier"][j][1],quant=global_panier[j]["quant"]}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end