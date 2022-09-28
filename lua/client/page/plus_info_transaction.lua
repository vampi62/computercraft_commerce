function page_plus_info_transaction()
	local liste = "transaction"
	resync_liste(liste)
	for j=1, #global_liste[liste] do
		if global_filtre["id"]["valeur"] == global_liste[liste][j][1] then
			creation_variable({"id"},{global_liste[liste][j][1]})

			table.insert(global_term_objet_write,{x = 16, y = global_min_y_page, text = "info transaction", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 7, text = "commande:", back_color = 32768, text_color = 1})
			if tonumber(global_liste[liste][j][2]) ~= 0 then
				if global_liste[liste][j][4] ~= global_session["pseudo"] then 
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 7, ymax = 7, parametre={action="page",id=53,filtre={id={valeur=global_liste[liste][j][2]}}}, back_color = 128})
				else
					table.insert(global_term_objet_select,{xmin = 45, xmax = 47, ymin = 7, ymax = 7, parametre={action="page",id=153,filtre={id={valeur=global_liste[liste][j][2]}}}, back_color = 128})
				end
				table.insert(global_term_objet_write,{x = 46, y = 7, text = "x", back_color = 128, text_color = 1})
			end
			table.insert(global_term_objet_write,{x = 35, y = 9, text = "borne:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 9, text = global_liste[liste][j][3], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 11, text = "user:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 11, text = global_liste[liste][j][0], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 13, text = "type:", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 42, y = 13, text =  global_http_error_message["statut_transaction"][tonumber(global_liste[liste][j][7])], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 35, y = 15, text = "somme:", back_color = 32768, text_color = 1})
			if global_liste[liste][j][4] == global_session["pseudo"] then
				table.insert(global_term_objet_write,{x = 42, y = 15, text = "+"..convert_grand_nombre(global_liste[liste][j][6]), back_color = 32768, text_color = 8192})
			else
				table.insert(global_term_objet_write,{x = 42, y = 15, text = "-"..convert_grand_nombre(global_liste[liste][j][6]), back_color = 32768, text_color = 16384})
			end

			-- variable pour la section a gauche de la barre de scroll (section mobile)
			local texte_info = {
				"crediteur  :",
				"debiteur   :",
				"somme      :",
				"description:",
				"date       :",
				"heure      :"
			}
			local texte_variable = {
				global_liste[liste][j][4],
				global_liste[liste][j][5],
				global_liste[liste][j][6],
				global_liste[liste][j][8],
				global_liste[liste][j][10],
				global_liste[liste][j][11]
			}
			local variable_nom = {
				"crediteur",
				"debiteur",
				"somme",
				"description",
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
			print_tableau_plus_info_scroll(31,texte_variable,texte_info,variable_nom,variable_type)
			genere_scroll_barre(texte_variable,31,global_scroll,global_min_y_page,global_max_y_page)
			break
		end
	end
end