function page_plus_info_commande()
	local page_client = 53
	local liste = ""
	if global_page_visible == page_client then
		liste = "commande_client"
	else
		liste = "commande_commerce"
	end
	if global_reapliquer_filtre then
		for j=1, #global_liste[liste] do
			if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
				global_liste[liste][j][0] = global_liste[liste][j]["expediteur"]
			else
				global_liste[liste][j][0] = global_liste[liste][j]["recepteur"]
			end
		end
	end
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"]["valeur"] == global_liste[liste][j]["id"] then
			creation_variable({"id"},{global_liste[liste][j]["id"]})
			table.insert(global_term_objet_write,{x = 16, y = global_min_y_page, text = "info commande", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 33, y = 7, text = "offre:", back_color = 32768, text_color = 1})
			if global_liste[liste][j]["id_offre"] ~= 0 then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 7, ymax = 7, parametre={action="page",id=33,filtre={id={valeur=global_liste[liste][j]["id_offre"]}}}, back_color = 128})
				else
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 7, ymax = 7, parametre={action="page",id=133,filtre={id={valeur=global_liste[liste][j]["id_offre"]}}}, back_color = 128})
				end
				table.insert(global_term_objet_write,{x = 46, y = 7, text = "x", back_color = 128, text_color = 1})
			end
			table.insert(global_term_objet_write,{x = 33, y = 9, text = "transaction:", back_color = 32768, text_color = 1})
			if global_liste[liste][j]["id_transaction"] ~= 0 then
				table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 9, ymax = 9, parametre={action="page",id=63,filtre={id={valeur=global_liste[liste][j]["id_transaction"]}}}, back_color = 128})
				table.insert(global_term_objet_write,{x = 46, y = 9, text = "x", back_color = 128, text_color = 1})
			end

			table.insert(global_term_objet_write,{x = 33, y = 11, text = "user:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 11, text = global_liste[liste][j][0], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 33, y = 13, text = "somme:", back_color = 32768, text_color = 1})
			if global_liste[liste][j]["expediteur"] == global_session["pseudo"] then
				table.insert(global_term_objet_write,{x = 42, y = 13, text = "+"..convert_grand_nombre(global_liste[liste][j]["somme"]), back_color = 32768, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 42, y = 13, text = "-"..convert_grand_nombre(global_liste[liste][j]["somme"]), back_color = 32768, text_color = 16384})
			end

			if global_liste[liste][j]["statut"] == "1" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "annuler", back_color = 128, text_color = 1})
				else
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=154,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "valider", back_color = 128, text_color = 1})
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=154,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "refuser", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "2" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "annuler", back_color = 128, text_color = 1})
				else
					table.insert(global_term_objet_write,{x = 37, y = 15, text = "en attente", back_color = 128, text_color = 1})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "de la banque", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "3" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 35, y = 15, text = "ouvrir un litige", back_color = 128, text_color = 1})
				else
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=154,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 33, y = 15, text = "valider preparation", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "4" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 35, y = 15, text = "ouvrir un litige", back_color = 128, text_color = 1})
				else
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=154,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commande", back_color = 128, text_color = 1})
					table.insert(global_term_objet_write,{x = 38, y = 16, text = "expedier", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "5" then
				-- litige
				-- valider livraison
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 35, y = 15, text = "ouvrir un litige", back_color = 128, text_color = 1})
				else
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 16, parametre={action="page",id=154,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commande", back_color = 128, text_color = 1})
					table.insert(global_term_objet_write,{x = 38, y = 16, text = "recu", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "6" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commande", back_color = 128, text_color = 1})
					table.insert(global_term_objet_write,{x = 38, y = 16, text = "recu", back_color = 128, text_color = 1})
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 35, y = 15, text = "ouvrir un litige", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "7" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commander", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "10" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commander", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "11" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commander", back_color = 128, text_color = 1})
				end
			elseif global_liste[liste][j]["statut"] == "13" then
				if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
					table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="page",id=54,filtre={id={valeur=global_liste[liste][j]["id"]}}}, back_color = 128})
					table.insert(global_term_objet_write,{x = 38, y = 15, text = "commander", back_color = 128, text_color = 1})
				end
			elseif tonumber(global_liste[liste][j]["statut"]) >= 20 then
				-- page litige
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
				global_liste[liste][j]["nom_commande"],
				global_liste[liste][j]["expediteur"],
				global_liste[liste][j]["recepteur"],
				global_liste[liste][j]["text_adresse_expediteur"],
				global_liste[liste][j]["text_adresse_recepteur"],
				global_liste[liste][j]["quantite"],
				global_liste[liste][j]["somme"],
				global_liste[liste][j]["prix_unitaire"],
				global_http_error_message["type"][tonumber(global_liste[liste][j]["type"])],
				global_http_error_message["livraison"][tonumber(global_liste[liste][j]["livraison"])],
				global_liste[liste][j]["suivie"],
				global_liste[liste][j]["description"],
				global_http_error_message["statut_echange"][tonumber(global_liste[liste][j]["statut"])],
				global_liste[liste][j]["date"],
				global_liste[liste][j]["heure"]
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
			print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
			genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page,"scroll")
			break
		end
	end
end