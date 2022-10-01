function page_plus_info_offre_client()
	local liste = "offre"
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"]["valeur"] == global_liste[liste][j]["id"] then
			creation_variable({"id"},{global_liste[liste][j]["id"]})
			local page_tableau_panier = 43
			
			table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info offre", back_color = 32768, text_color = 1})
			-- section a droite de la barre de scroll (section fixe)

			if global_page_visible == page_tableau_panier then
				for j=1, #global_panier do
					if global_filtre["id"]["valeur"] == global_panier[j]["id"] then
						creation_variable({"quant"},{global_panier[j]["quant"]})
						break
					end
				end
			else
				creation_variable({"quant"},{"1"})
			end
			table.insert(global_term_objet_write,{x = 35, y = 5, text = "prixU:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 5, text = convert_grand_nombre(global_liste[liste][j]["prix"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 7, text = "stock:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 7, text = convert_grand_nombre(global_liste[liste][j]["nbr_dispo"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 9, text = "quant:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 9, text = global_variable["quant"], back_color = 128 + change_color_champ_select("quant"), text_color = 1})
			table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 9, ymax = 9, parametre={action="variable",nom="quant",type="int"}, back_color = 128 + change_color_champ_select("quant")})
			table.insert(global_term_objet_write,{x = 35, y = 11, text = "prixG:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 11, text = convert_grand_nombre(global_liste[liste][j]["prix"]*global_variable["quant"]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 13, text = "commander", back_color = 128, text_color = 1})
			if global_page_visible == page_tableau_panier then
				table.insert(global_term_objet_write,{x = 34, y = 15, text = "retirer du panier", back_color = 128, text_color = 1})
				if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
					table.insert(global_term_objet_select,{xmin = 34, xmax = 50, ymin = 15, ymax = 15, parametre={action="action",id="del_panier"}, back_color = 128})
					table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, parametre={action="action",id="http_commande_offre_panier"}, back_color = 128})
				else
					table.insert(global_term_objet_select,{xmin = 34, xmax = 50, ymin = 15, ymax = 15, parametre={action="page",id=20}, back_color = 128})
					table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, parametre={action="page",id=20}, back_color = 128})
				end
			else
				table.insert(global_term_objet_write,{x = 34, y = 15, text = "ajouter au panier", back_color = 128, text_color = 1})
				if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
					table.insert(global_term_objet_select,{xmin = 34, xmax = 50, ymin = 15, ymax = 15, parametre={action="action",id="ad_panier"}, back_color = 128})
					table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, parametre={action="action",id="http_commande_offre"}, back_color = 128})
				else
					table.insert(global_term_objet_select,{xmin = 34, xmax = 50, ymin = 15, ymax = 15, parametre={action="page",id=20}, back_color = 128})
					table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, parametre={action="page",id=20}, back_color = 128})
				end
			end
			
			-- variable pour la section a gauche de la barre de scroll (section mobile)
			local texte_info = {
				"nom        :",
				"type       :",
				"livraison  :",
				"adresse    :",
				"coordonnee :",
				"coo desc   :",
				"description:",
				"dateupdate :"
			}
			local texte_variable = {
				global_liste[liste][j]["nom"],
				global_http_error_message["type"][tonumber(global_liste[liste][j]["type"])],
				global_http_error_message["livraison"][tonumber(global_liste[liste][j]["livraison"])],
				global_liste[liste][j]["adresse"]["nom"],
				global_liste[liste][j]["adresse"]["coo"],
				global_liste[liste][j]["adresse"]["description"],
				global_liste[liste][j]["description"],
				global_liste[liste][j]["last_update"],
			}
			local variable_nom = {
				"nom",
				"type",
				"livraison",
				"adresse",
				"coordonnee",
				"coodesc",
				"description",
				"last_update"
			}
			local variable_type = {
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""
			}
			print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
			genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page,"scroll")
			break
		end
	end
end