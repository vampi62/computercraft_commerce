function page_plus_info_commande()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	local page_client = 53
	local liste = ""
	if global_page_visible == page_client then
		liste = "commande_client"
	else
		liste = "commande_commerce"
	end
	if global_reapliquer_filtre then
		for j=1, #global_liste[liste] do
			if global_liste[liste][j][5] ~= global_session["pseudo"] then
				global_liste[liste][j][0] = global_liste[liste][j][5]
			else
				global_liste[liste][j][0] = global_liste[liste][j][6]
			end
		end
	end
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"] == global_liste[liste][j][1] then
			remplir_variable({"id"},{global_liste[liste][j][1]})
			table.insert(global_term_objet_write,{x = 16, y = global_min_y_page, text = "info commande", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 33, y = 7, text = "offre:", back_color = 32768, text_color = 1})
			if global_liste[liste][j][2] ~= 0 then
				if global_liste[liste][j][5] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 7, ymax = 7, value={action="page",id=33,value={id=global_liste[liste][j][2]}}, back_color = 128})
				else
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 7, ymax = 7, value={action="page",id=133,value={id=global_liste[liste][j][2]}}, back_color = 128})
				end
				table.insert(global_term_objet_write,{x = 46, y = 7, text = "x", back_color = 128, text_color = 1})
			end
			table.insert(global_term_objet_write,{x = 33, y = 9, text = "transaction:", back_color = 32768, text_color = 1})
			if global_liste[liste][j][3] ~= 0 then
				if global_liste[liste][j][5] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 9, ymax = 9, value={action="page",id=63,value={id=global_liste[liste][j][3]}}, back_color = 128})
				else
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 9, ymax = 9, value={action="page",id=163,value={id=global_liste[liste][j][3]}}, back_color = 128})
				end
				table.insert(global_term_objet_write,{x = 46, y = 9, text = "x", back_color = 128, text_color = 1})
			end

			table.insert(global_term_objet_write,{x = 33, y = 11, text = "user:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 11, text = global_liste[liste][j][0], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 33, y = 13, text = "somme:", back_color = 32768, text_color = 1})
			if global_liste[liste][j][5] == global_session["pseudo"] then
				table.insert(global_term_objet_write,{x = 42, y = 13, text = "+"..convert_grand_nombre(global_liste[liste][j][10]), back_color = 32768, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 42, y = 13, text = "-"..convert_grand_nombre(global_liste[liste][j][10]), back_color = 32768, text_color = 16384})
			end

			-- variable pour la section a gauche de la barre de scroll (section mobile)
			local texte_info = {
				"nom        :",
				"expediteur :",
				"recepteur  :",
				"adr_exp    :",
				"adr_recep  :",
				"quantite   :",
				"somme      :",
				"prix_unit  :",
				"type       :",
				"livraison  :",
				"suivie     :",
				"description:",
				"statut     :",
				"date       :",
				"heure      :"
			}
			local texte_variable = {
				global_liste[liste][j][4],
				global_liste[liste][j][5],
				global_liste[liste][j][6],
				global_liste[liste][j][7],
				global_liste[liste][j][8],
				global_liste[liste][j][9],
				global_liste[liste][j][10],
				global_liste[liste][j][11],
				global_http_error_message["type"][tonumber(global_liste[liste][j][12])],
				global_http_error_message["livraison"][tonumber(global_liste[liste][j][13])],
				global_liste[liste][j][14],
				global_liste[liste][j][15],
				global_http_error_message["statut_echange"][tonumber(global_liste[liste][j][16])],
				global_liste[liste][j][17],
				global_liste[liste][j][18]
			}
			local variable_nom = {
				"nom_commande",
				"expediteur",
				"recepteur",
				"text_adresse_expediteur",
				"text_adresse_recepteur",
				"quantite",
				"somme",
				"prix_unitaire",
				"type",
				"livraison",
				"suivie",
				"description",
				"statut",
				"date",
				"heure"
			}
			local variable_type = {
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""
			}
			print_tableau_plus_info_scroll(31,-1,texte_variable,texte_info,variable_nom,variable_type)
			break
		end
	end
end