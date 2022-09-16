function page_session()
	if global_page_visible == 20 then
		table.insert(global_term_objet_write,{x = 23, y = 5, text = "session", back_color = 32768, text_color = 1})
	elseif global_page_visible == 21 then
		table.insert(global_term_objet_write,{x = 21, y = 5, text = "inscription", back_color = 32768, text_color = 1})
	elseif global_page_visible == 22 then
		table.insert(global_term_objet_write,{x = 17, y = 5, text = "mot de passe oubliee", back_color = 32768, text_color = 1})
	elseif global_page_visible == 23 then
		table.insert(global_term_objet_write,{x = 15, y = 5, text = "code reinit mot de passe", back_color = 32768, text_color = 1})
	elseif global_page_visible == 25 then
		table.insert(global_term_objet_write,{x = 15, y = 5, text = "changement mot de passe", back_color = 32768, text_color = 1})
	elseif global_page_visible == 26 then
		table.insert(global_term_objet_write,{x = 19, y = 5, text = "changement email", back_color = 32768, text_color = 1})
	elseif global_page_visible == 27 then
		table.insert(global_term_objet_write,{x = 21, y = 5, text = "achat offre", back_color = 32768, text_color = 1})
	end
	if global_page_visible == 20 then
		if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
			table.insert(global_term_objet_write,{x = 36, y = 15, text = "deconnexion", back_color = 128, text_color = 1})
			table.insert(global_term_objet_write,{x = 2, y = 7, text = "changer mot de passe", back_color = 128, text_color = 1})
			table.insert(global_term_objet_write,{x = 2, y = 9, text = "changer email", back_color = 128, text_color = 1})
			table.insert(global_term_objet_write,{x = 2, y = 11, text = "achat slot offre", back_color = 128, text_color = 1})

			table.insert(global_term_objet_select,{xmin = 2, xmax = 22, ymin = 7, ymax = 7, value={action="page",id=25}, back_color = 128})
			table.insert(global_term_objet_select,{xmin = 2, xmax = 15, ymin = 9, ymax = 9, value={action="page",id=26}, back_color = 128})
			table.insert(global_term_objet_select,{xmin = 2, xmax = 18, ymin = 11, ymax = 11, value={action="page",id=27}, back_color = 128})
			table.insert(global_term_objet_select,{xmin = 36, xmax = 46, ymin = 15, ymax = 15, value={action="action",id="deconnexion"}, back_color = 128})
		else
			table.insert(global_term_objet_write,{x = 9, y = 7, text = "pseudo :", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 9, y = 9, text = "mot de", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 10, y = 10, text = "passe :", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 4, y = 15, text = "pas de compte", back_color = 128, text_color = 1})
			table.insert(global_term_objet_write,{x = 37, y = 15, text = "mdp oublier", back_color = 128, text_color = 1})
			table.insert(global_term_objet_write,{x = 22, y = 15, text = "connexion", back_color = 128, text_color = 1})

			table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
			table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
			table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="pseudo",value="text"}, back_color = 128 + change_color_champ_select("pseudo")})
			table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="mdp",value="code"}, back_color = 128 + change_color_champ_select("mdp")})

			table.insert(global_term_objet_select,{xmin = 4, xmax = 16, ymin = 15, ymax = 15, value={action="page",id=21}, back_color = 128})
			table.insert(global_term_objet_select,{xmin = 37, xmax = 48, ymin = 15, ymax = 15, value={action="page",id=22}, back_color = 128})
			table.insert(global_term_objet_select,{xmin = 22, xmax = 30, ymin = 15, ymax = 15, value={action="action",id="connexion"}, back_color = 128})
		end
	end
	if global_page_visible == 21 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "pseudo      :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 9, text = "mdp         :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 11, text = "confirm     :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 13, text = "email       :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["confirm_len"], back_color = 128 + change_color_champ_select("confirm"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 13, text = global_variable["email"], back_color = 128 + change_color_champ_select("email"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="pseudo",value="text"}, back_color = 128 + change_color_champ_select("pseudo")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="mdp",value="code"}, back_color = 128 + change_color_champ_select("mdp")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, value={action="variable",id="confirm",value="code"}, back_color = 128 + change_color_champ_select("confirm")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 13, ymax = 13, value={action="variable",id="email",value="text"}, back_color = 128 + change_color_champ_select("email")})

		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="inscription",value=0}, back_color = 128})
	end
	if global_page_visible == 22 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "pseudo      :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 9, text = "email       :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})
		table.insert(global_term_objet_write,{x = 3, y = 15, text = "entrer le code", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["email"], back_color = 128 + change_color_champ_select("email"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="pseudo",value="text"}, back_color = 128 + change_color_champ_select("pseudo")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="email",value="text"}, back_color = 128 + change_color_champ_select("email")})
		
		table.insert(global_term_objet_select,{xmin = 3, xmax = 16, ymin = 15, ymax = 15, value={action="page",id=23}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="mdpoublie"}, back_color = 128})
	end
	if global_page_visible == 23 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "pseudo      :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 9, text = "code mail   :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["codemail"], back_color = 128 + change_color_champ_select("codemail"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="pseudo",value="text"}, back_color = 128 + change_color_champ_select("pseudo")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="codemail",value="code"}, back_color = 128 + change_color_champ_select("codemail")})

		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="codemail"}, back_color = 128})
	end
	if global_page_visible == 25 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 9, text = "confirm     :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 11, text = "ancien mdp  :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["confirm_len"], back_color = 128 + change_color_champ_select("confirm"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["ancienmdp_len"], back_color = 128 + change_color_champ_select("ancienmdp"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="mdp",value="code"}, back_color = 128 + change_color_champ_select("mdp")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="confirm",value="code"}, back_color = 128 + change_color_champ_select("confirm")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, value={action="variable",id="ancienmdp",value="code"}, back_color = 128 + change_color_champ_select("ancienmdp")})
		
		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="changemdp"}, back_color = 128})
	end
	if global_page_visible == 26 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "email       :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["email"], back_color = 128 + change_color_champ_select("email"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="email",value="text"}, back_color = 128 + change_color_champ_select("email")})

		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="changemail"}, back_color = 128})
	end
	if global_page_visible == 27 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "nbr offre   :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 35, y = 7, text = global_session["nbr_offre"] .."/".. global_http_error_message["General"]["max_offre"], back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 35, y = 8, text = global_http_error_message["General"]["prix_offre"] * global_http_error_message["General"]["max_offre"] .. " - credit", back_color = 32768, text_color = 1})
		
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["nbroffre"], back_color = 128 + change_color_champ_select("nbroffre"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="nbroffre",value="int"}, back_color = 128 + change_color_champ_select("nbroffre")})

		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="achatoffre"}, back_color = 128})
	end
end