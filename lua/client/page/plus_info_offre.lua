function page_plus_info_offre()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if #global_liste["offre"] < 1 then
		global_liste["offre"] = http_commande("http_offre")
	end
	for j=1, #global_liste["offre"] do
		if global_fitre["id"] == global_liste["offre"][j][1] then
			global_variable["id"] = global_liste["offre"][j][1]
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
				global_liste["offre"][j][8],
				global_http_error_message["type"][tonumber(global_liste["offre"][j][6])],
				global_http_error_message["livraison"][tonumber(global_liste["offre"][j][7])],
				global_liste["offre"][j][2]["nom"],
				global_liste["offre"][j][2]["coo"],
				global_liste["offre"][j][2]["description"],
				global_liste["offre"][j][9],
				global_liste["offre"][j][10],
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
			if global_page_visible == 133 then
				remplir_variable(variable_nom,texte_variable)
				remplir_variable({"prix","nbr_dispo"},{global_liste["offre"][j][5],global_liste["offre"][j][4]})
				table.insert(global_term_objet_write,{x = 35, y = 5, text = "prixU:", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 5, text = convert_grand_nombre(global_liste["offre"][j][4]), back_color = 128 + change_color_champ_select("prix"), text_color = 1})
				table.insert(global_term_objet_write,{x = 35, y = 7, text = "stock:", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 7, text = convert_grand_nombre(global_liste["offre"][j][5]), back_color = 128 + change_color_champ_select("nbr_dispo"), text_color = 1})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 5, ymax = 5, value={action="variable",id="prix",value="float"}, back_color = 128 + change_color_champ_select("prix")})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 7, ymax = 7, value={action="variable",id="nbr_dispo",value="int"}, back_color = 128 + change_color_champ_select("nbr_dispo")})

				table.insert(global_term_objet_write,{x = 42, y = 13, text = " update ", back_color = 128, text_color = 1})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, value={action="action",id="http_update_offre"}, back_color = 128})
			else
				remplir_variable({"quant"},{""})
				table.insert(global_term_objet_write,{x = 35, y = 5, text = "prixU:", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 5, text = convert_grand_nombre(global_liste["offre"][j][4]), back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 35, y = 7, text = "stock:", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 7, text = convert_grand_nombre(global_liste["offre"][j][5]), back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 35, y = 9, text = "quant:", back_color = 32768, text_color = 1})
				table.insert(global_term_objet_write,{x = 42, y = 9, text = global_variable["quant"], back_color = 128 + change_color_champ_select("quant"), text_color = 1})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 9, ymax = 9, value={action="variable",id="quant",value="int"}, back_color = 128 + change_color_champ_select("quant")})
				table.insert(global_term_objet_write,{x = 35, y = 11, text = "prixG:", back_color = 32768, text_color = 1})
				if global_variable["quant"] == "" then
					table.insert(global_term_objet_write,{x = 42, y = 11, text = "0", back_color = 32768, text_color = 1})
				else
					table.insert(global_term_objet_write,{x = 42, y = 11, text = convert_grand_nombre(global_liste["offre"][j][4]*global_variable["quant"]), back_color = 32768, text_color = 1})
				end
				table.insert(global_term_objet_write,{x = 42, y = 13, text = "commander", back_color = 128, text_color = 1})
				table.insert(global_term_objet_select,{xmin = 42, xmax = 50, ymin = 13, ymax = 13, value={action="action",id="http_commande_offre"}, back_color = 128})

			end

			table.insert(global_term_objet_write,{x = 21, y = global_min_y_page, text = "info offre", back_color = 32768, text_color = 1})
			if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
				if global_page_visible == 133 then
					
				else

				end
			else
				
			end
			print_tableau_plus_info_scroll(31,133,texte_variable,texte_info,variable_nom,variable_type)
			break
		end
	end
end