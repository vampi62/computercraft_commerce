function page_session_menu()
	table.insert(global_term_objet_write,{x = 23, y = 5, text = "session", back_color = 32768, text_color = 1})
	if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
		table.insert(global_term_objet_write,{x = 36, y = 15, text = "deconnexion", back_color = 128, text_color = 1})
		table.insert(global_term_objet_write,{x = 2, y = 7, text = "changer mot de passe", back_color = 128, text_color = 1})
		table.insert(global_term_objet_write,{x = 2, y = 9, text = "changer email", back_color = 128, text_color = 1})

		table.insert(global_term_objet_select,{xmin = 2, xmax = 22, ymin = 7, ymax = 7, parametre={action="page",id=26}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 2, xmax = 15, ymin = 9, ymax = 9, parametre={action="page",id=25}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 36, xmax = 46, ymin = 15, ymax = 15, parametre={action="action",id="deconnexion"}, back_color = 128})
	else
		creation_variable({"pseudo","mdp","mdp_len"},{"","",""})

		table.insert(global_term_objet_write,{x = 9, y = 7, text = "pseudo :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 9, y = 9, text = "mot de", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 10, y = 10, text = "passe :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 4, y = 15, text = "pas de compte", back_color = 128, text_color = 1})
		table.insert(global_term_objet_write,{x = 37, y = 15, text = "mdp oublier", back_color = 128, text_color = 1})
		table.insert(global_term_objet_write,{x = 22, y = 15, text = "connexion", back_color = 128, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="pseudo",type="text"}, back_color = 128 + change_color_champ_select("pseudo")})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, parametre={action="variable",nom="mdp",type="code"}, back_color = 128 + change_color_champ_select("mdp")})

		table.insert(global_term_objet_select,{xmin = 4, xmax = 16, ymin = 15, ymax = 15, parametre={action="page",id=21}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 37, xmax = 48, ymin = 15, ymax = 15, parametre={action="page",id=22}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 22, xmax = 30, ymin = 15, ymax = 15, parametre={action="action",id="connexion"}, back_color = 128})
	end
end