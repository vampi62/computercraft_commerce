function page_plus_para(type_page)
	if type_page == "offre" or type_page == "panier" then
		local text1 = {
			"vendeur     :",
			"nom         :",
			"prix        :",
			"stock       :",
			"type        :",
			"livraison   :",
			"adresse     :",
			"description :"
		}
		local text2 = {
			global_plus_para["nom"],
			global_plus_para["utilisateur"],
			global_plus_para["type"],
			global_plus_para["livraison"],
			global_plus_para["prix"],
			global_plus_para["quantite"]
		}
		local coo_y = {
			6,
			8,
			10,
			12,
			14,
			16,
			18
		}
	elseif type_page == "adresse" or type_page == "add_addr" then
		local text1 = {
			"nom         :",
			"type        :",
			"coo         :",
			"description :"
		}
		local text2 = {
			global_plus_para["nom"],
			global_plus_para["type"],
			global_plus_para["coo"],
			global_plus_para["description"]
		}
		local coo_y = {
			6,
			8,
			10,
			12
		}
	elseif type_page == "transaction" then
		local text1 = {
			"commande    :",
			"terminal    :",
			"crediteur   :",
			"debiteur    :",
			"somme       :",
			"type        :",
			"statut      :",
			"description :",
			"date        :"
		}
		local text2 = {
			global_plus_para["commande"],
			global_plus_para["admin"],
			global_plus_para["crediteur"],
			global_plus_para["debiteur"],
			global_plus_para["somme"],
			global_plus_para["type"],
			global_plus_para["statut"],
			global_plus_para["description"],
			global_plus_para["date"]
		}
		local coo_y = {
			6,
			8,
			10,
			12,
			14,
			16,
			18,
			20,
			22
		}
	elseif type_page == "commande" then
		local text1 = {
			"transaction :",
			"nom         :",
			"expediteur  :",
			"adresse exp :",
			"adresse des :",
			"prix        :",
			"quantite    :",
			"somme       :",
			"type        :",
			"livraison   :",
			"suivie      :",
			"statut      :",
			"date        :",
			"description :"
		}
		local text2 = {
			global_plus_para["transaction"],
			global_plus_para["nom"],
			global_plus_para["utilisateur"],
			global_plus_para["adresse_expediteur"],
			global_plus_para["adresse_destinataire"],
			global_plus_para["prix"],
			global_plus_para["quantite"],
			global_plus_para["somme"],
			global_plus_para["type"],
			global_plus_para["livraison"],
			global_plus_para["suivie"],
			global_plus_para["statut"],
			global_plus_para["date"],
			global_plus_para["description"]
		}
		local coo_y = {
			6,
			8,
			10,
			12,
			14,
			16,
			18,
			20,
			22,
			24,
			26,
			28,
			30,
			32,
			34,
			36
		}
	end
	local offset_text_long = 0

	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	for j=1, #text1 do
		local y = global_scroll + coo_y[j] + offset_text_long
		if y <= global_max_y_page and y >= global_min_y_page then
			if j == 1 then
				global_limite_scroll_haut = true
			end
			if j == #text1 and y == global_max_y_page then
				global_limite_scroll_bas = true
			end

			table.insert(global_objet_write,{x = 2, y = y, text = text1[j], back_color = 256, text_color = 1}) -- text
			if type(text2[j]) == "table" then
				for i=1, #text2[j] do
					offset_text_long = offset_text_long + 1
					if y + i <= global_max_y_page and y >= global_min_y_page then
						table.insert(global_objet_write,{x = 7, y = y + i, text = text2[j][i], back_color = 256, text_color = 1}) -- valeur de la variable
					elseif y + i > global_max_y_page then
						global_limite_scroll_bas = false
						break
					end
				end
			else
				table.insert(global_objet_write,{x = 15, y = y, text = text2[j], back_color = 256, text_color = 1}) -- valeur de la variable
			end
		elseif y > global_max_y_page then
			break
		end
	end
	if type_page == "offre" or type_page == "panier" then
		table.insert(global_objet_write,{x = 38, y = 1, text = "commande", back_color = 256, text_color = 1})
		table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "commande_item", back_color = 256})
		if type_page == "panier" then
			table.insert(global_objet_write,{x = 38, y = 1, text = "ajouter au panier", back_color = 256, text_color = 1})
			table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "add_panier_item", back_color = 256})
		else
			table.insert(global_objet_write,{x = 38, y = 1, text = "supprimer du panier", back_color = 256, text_color = 1})
			table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "del_panier_item", back_color = 256})
		end
	elseif type_page == "adresse" then
		table.insert(global_objet_write,{x = 38, y = 1, text = "modifier", back_color = 256, text_color = 1})
		table.insert(global_objet_write,{x = 38, y = 1, text = "supprimer", back_color = 256, text_color = 1})
		table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "modif_addr", back_color = 256})
		table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "suppr_addr", back_color = 256})

	elseif type_page == "add_addr" then
		table.insert(global_objet_write,{x = 38, y = 1, text = "ajouter", back_color = 256, text_color = 1})
		table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "edit_add_addr", back_color = 256})
		
	elseif type_page == "transaction" then
		table.insert(global_objet_write,{x = 38, y = 1, text = "litige", back_color = 256, text_color = 1})
		--table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "litige", back_color = 256})
		
	elseif type_page == "commande" then
		table.insert(global_objet_write,{x = 38, y = 1, text = "litige", back_color = 256, text_color = 1})
		--table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "litige", back_color = 256})

	end
	table.insert(global_objet_write,{x = 38, y = 1, text = "retour", back_color = 256, text_color = 1})
	table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = "quit_plus_para", back_color = 256})

end