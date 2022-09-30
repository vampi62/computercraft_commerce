function page_plus_info_offre_commerce()
	local liste = "offre"
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"]["valeur"] == global_liste[liste][j][1] then
			creation_variable({"id"},{global_liste[liste][j][1]})

			table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info offre", back_color = 32768, text_color = 1})
			-- section a droite de la barre de scroll (section fixe)
			creation_variable({"prix","nbr_dispo"},{global_liste[liste][j][4],global_liste[liste][j][5]})
			table.insert(global_term_objet_write,{x = 35, y = 5, text = "prixU:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 5, text = convert_grand_nombre(global_variable["prix"]), back_color = 128 + change_color_champ_select("prix"), text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 7, text = "stock:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 7, text = convert_grand_nombre(global_variable["nbr_dispo"]), back_color = 128 + change_color_champ_select("nbr_dispo"), text_color = 1})
			table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 5, ymax = 5, parametre={action="variable",nom="prix",type="float"}, back_color = 128 + change_color_champ_select("prix")})
			table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 7, ymax = 7, parametre={action="variable",nom="nbr_dispo",type="int"}, back_color = 128 + change_color_champ_select("nbr_dispo")})

			table.insert(global_term_objet_write,{x = 33, y = 11, text = "liste commandes", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 34, xmax = 46, ymin = 11, ymax = 11, parametre={action="page",id=150,filtre={id_offre={valeur=global_liste[liste][j][1],type="egal"}}}, back_color = 128})

			table.insert(global_term_objet_write,{x = 42, y = 13, text = " update ", back_color = 128, text_color = 1})
			
			table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, parametre={action="action",id="http_update_offre"}, back_color = 128})
			
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
				global_liste[liste][j][8],
				global_liste[liste][j][6],
				global_liste[liste][j][7],
				global_liste[liste][j][2]["nom"],
				global_liste[liste][j][2]["coo"],
				global_liste[liste][j][2]["description"],
				global_liste[liste][j][9],
				global_liste[liste][j][10],
			}
			local variable_nom = {
				"nom",
				"type",
				"livraison",
				"adresse",
				"coordonnee",
				"coodesc",
				"description",
				"dateupdate"
			}
			local variable_type = {
				"text",
				"select",
				"select",
				"select",
				"",
				"",
				"",
				""
			}
			creation_variable(variable_nom,texte_variable)
			print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
			texte_variable = import_variable(variable_nom,variable_type)
			genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page,"scroll")
			break
		end
	end
end