function page_tableau_panier()
	local liste = "offre"
	resync_liste(liste)
	chargement_filtre(liste)
	creation_variable({"prix_panier"},{0})
	chargement_panier(liste)
	table.insert(global_term_objet_write,{x = 1, y = 3, text = "prix panier : "..convert_grand_nombre(global_variable["prix_panier"]), back_color = 32768, text_color = 1})
	if #global_panier > 0 then
		table.insert(global_term_objet_write,{x = 39, y = 3, text = "achat panier", back_color = 128, text_color = 1})
		if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
			table.insert(global_term_objet_select,{xmin = 39, xmax = 50, ymin = 3, ymax = 3, parametre={action="action",id="achat_panier"}, back_color = 128})
		else
			table.insert(global_term_objet_select,{xmin = 39, xmax = 50, ymin = 3, ymax = 3, parametre={action="page",id=20}, back_color = 128})
		end
	end
	genere_scroll_barre(#global_filtre_liste["panier"],51,global_scroll,global_min_y_page,global_max_y_page,"scroll")
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
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, parametre={action="page",id=43,filtre={id={valeur=global_filtre_liste["panier"][j][1],type="egal"}}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end
function chargement_panier(liste)
	global_filtre_liste["panier"] = {}
	global_variable["prix_panier"] = 0
	for g=1, #global_filtre_liste[liste] do
		for j=1, #global_panier do
			if global_panier[j]["id"] == global_filtre_liste[liste][g][1] then
				table.insert(global_filtre_liste["panier"],global_filtre_liste[liste][g])
				global_filtre_liste["panier"][#global_filtre_liste["panier"]]["quant"] = tonumber(global_panier[j]["quant"])
				global_filtre_liste["panier"][#global_filtre_liste["panier"]]["prixg"] = global_panier[j]["quant"]*global_filtre_liste[liste][g][4]
				global_variable["prix_panier"] = global_variable["prix_panier"] + global_filtre_liste["panier"][#global_filtre_liste["panier"]]["prixg"]
			end
		end
	end
end