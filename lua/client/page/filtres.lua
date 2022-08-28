function page_filtres(type_page)
	if type_page == "offre" then
		local text1 = {
			"nom         :",
			"utilisateur :",
			"type        :",
			"livraison   :",
			"prix        :",
			"date        :",
			"stock min   :"
		}
		local text2 = {
			global_filtre["nom"],
			global_filtre["utilisateur"],
			global_filtre["type"],
			global_filtre["livraison"],
			global_filtre["prix"],
			global_filtre["date"],
			global_filtre["dispo"]
		}
		local text3 = {
			"X",
			"X",
			"X",
			"X",
			"X",
			"X",
			"X"
		}
		local text4 = {
			"filtre_nom",
			"filtre_utilisateur",
			"filtre_type",
			"filtre_livraison",
			"filtre_prix",
			"filtre_date",
			"filtre_dispo"
		}
		local text5 = {
			"suppr_filtre_nom",
			"suppr_filtre_utilisateur",
			"suppr_filtre_type",
			"suppr_filtre_livraison",
			"suppr_filtre_prix",
			"suppr_filtre_date",
			"suppr_filtre_dispo"
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
	elseif type_page == "adresse" then
		local text1 = {
			"nom         :",
			"type        :"
		}
		local text2 = {
			global_filtre["nom"],
			global_filtre["type"]
		}
		local text3 = {
			"X",
			"X"
		}
		local text4 = {
			"filtre_nom",
			"filtre_type"
		}
		local text5 = {
			"suppr_filtre_nom",
			"suppr_filtre_type"
		}
		local coo_y = {
			6,
			8
		}
	elseif type_page == "transaction" then
		local text1 = {
			"utilisateur :",
			"type        :",
			"somme       :",
			"statut      :",
			"date        :",
			"terminal    :"
		}
		local text2 = {
			global_filtre["utilisateur"],
			global_filtre["type"],
			global_filtre["prix"],
			global_filtre["statut"],
			global_filtre["date"],
			global_filtre["admin"]
		}
		local text3 = {
			"X",
			"X",
			"X",
			"X",
			"X",
			"X"
		}
		local text4 = {
			"filtre_utilisateur",
			"filtre_type",
			"filtre_prix",
			"filtre_statut",
			"filtre_date",
			"filtre_admin"
		}
		local text5 = {
			"suppr_filtre_utilisateur",
			"suppr_filtre_type",
			"suppr_filtre_prix",
			"suppr_filtre_statut",
			"suppr_filtre_date",
			"suppr_filtre_admin"
		}
		local coo_y = {
			6,
			8,
			10,
			12,
			14,
			16
		}
	elseif type_page == "commande" then
		local text1 = {
			"nom         :",
			"utilisateur :",
			"type        :",
			"livraison   :",
			"somme       :",
			"quantite    :",
			"statut      :",
			"date        :"
		}
		local text2 = {
			global_filtre["nom"],
			global_filtre["utilisateur"],
			global_filtre["type"],
			global_filtre["livraison"],
			global_filtre["prix"],
			global_filtre["dispo"],
			global_filtre["statut"],
			global_filtre["date"]
		}
		local text3 = {
			"X",
			"X",
			"X",
			"X",
			"X",
			"X",
			"X",
			"X"
		}
		local text4 = {
			"filtre_nom",
			"filtre_utilisateur",
			"filtre_type",
			"filtre_livraison",
			"filtre_prix",
			"filtre_dispo",
			"filtre_statut",
			"filtre_date"
		}
		local text5 = {
			"suppr_filtre_nom",
			"suppr_filtre_utilisateur",
			"suppr_filtre_type",
			"suppr_filtre_livraison",
			"suppr_filtre_prix",
			"suppr_filtre_dispo",
			"suppr_filtre_statut",
			"suppr_filtre_date"
		}
		local coo_y = {
			6,
			8,
			10,
			12,
			14,
			16,
			18,
			20
		}
	end

	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	for j=1, #text1 do
		local y = global_scroll + coo_y[j]
		if y <= global_max_y_page and y >= global_min_y_page then
			if j == 1 then
				global_limite_scroll_haut = true
			end
			if j == #text1 and y == global_max_y_page then
				global_limite_scroll_bas = true
			end
			table.insert(global_objet_write,{x = 2, y = y, text = text1[j], back_color = 256, text_color = 1}) -- text
			table.insert(global_objet_write,{x = 15, y = y, text = text2[j], back_color = 256, text_color = 1}) -- valeur de la filtre
			table.insert(global_objet_write,{x = 44, y = y, text = text3[j], back_color = 256, text_color = 1}) -- print(x)
			table.insert(global_objet_select,{xmin = 15, xmax = 35, ymin = y, ymax = y, name = text4[j], back_color = 256}) -- filtre edit
			table.insert(global_objet_select,{xmin = 41, xmax = 46, ymin = y, ymax = y, name = text5[j], back_color = 256}) -- filtre remove
		elseif y > global_max_y_page then
			break
		end
	end
	table.insert(global_objet_write,{x = 11, y = 4, text = "filtres " .. type_page, back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 38, y = 4, text = "retirer les filtres", back_color = 256, text_color = 1})
	table.insert(global_objet_select,{xmin = 38, xmax = 51, ymin = 17, ymax = 17, name = "retire_filtres", back_color = 256})
	table.insert(global_objet_write,{x = 15, y = 15, text = "valider les filtres", back_color = 256, text_color = 1})
	table.insert(global_objet_select,{xmin = 15, xmax = 33, ymin = 15, ymax = 15, name = "valide_filtres", back_color = 256})
end