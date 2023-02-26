function page_litige_commande()
	local page_client = 54
	local liste = ""
	if global_page_visible == page_client then
		liste = "commande_client"
	else
		liste = "commande_commerce"
	end
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"]["valeur"] == global_liste[liste][j]["id"] then
			creation_variable({"id"},{global_liste[liste][j]["id"]})
			table.insert(global_term_objet_write,{x = 19, y = global_min_y_page, text = "litige", back_color = 32768, text_color = 1})
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
			-- variable pour la section a gauche de la barre de scroll (section mobile)
			local texte_info = {
				"nom        :",
				"expediteur :",
				"suivie     :",
				"statut     :",
				"date       :",
				"heure      :"
			}
			local texte_variable = {
				global_liste[liste][j]["nom_commande"],
				global_liste[liste][j]["expediteur"],
				global_liste[liste][j]["suivie"],
				global_http_error_message["statut_echange"][tonumber(global_liste[liste][j]["statut"])],
				global_liste[liste][j]["date"],
				global_liste[liste][j]["heure"]
			}
			local variable_nom = {
				"nom_commande",
				"expediteur",
				"suivie",
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
				""
			}
			break
		end
	end
    if global_liste[liste][j]["statut"] == "1" then
        if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
            table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="action",id="http_update_statut",valeur="13"}, back_color = 128})
            table.insert(global_term_objet_write,{x = 38, y = 15, text = "annuler", back_color = 128, text_color = 1})
        else
            table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="action",id="http_update_statut",valeur="2"}, back_color = 128})
            table.insert(global_term_objet_write,{x = 38, y = 15, text = "valider", back_color = 128, text_color = 1})
            table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="action",id="http_update_statut",valeur="10"}, back_color = 128})
            table.insert(global_term_objet_write,{x = 38, y = 15, text = "refuser", back_color = 128, text_color = 1})
        end
    elseif global_liste[liste][j]["statut"] == "2" then
        if global_liste[liste][j]["expediteur"] ~= global_session["pseudo"] then
            table.insert(global_term_objet_select,{xmin = 37, xmax = 46, ymin = 15, ymax = 15, parametre={action="action",id="http_update_statut",valeur="13"}, back_color = 128})
            table.insert(global_term_objet_write,{x = 38, y = 15, text = "annuler", back_color = 128, text_color = 1})
        else
            table.insert(global_term_objet_write,{x = 37, y = 15, text = "en attente", back_color = 128, text_color = 1})
            table.insert(global_term_objet_write,{x = 38, y = 15, text = "de la banque", back_color = 128, text_color = 1})
        end
    end
end