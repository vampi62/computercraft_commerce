function page_login_pc_get_mdp()
	table.insert(global_term_objet_write,{x = 15, y = 5, text = "mot de passe poste local", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="mdp",type="code"}, back_color = 128 + change_color_champ_select("mdp")})

	table.insert(global_term_objet_select,{xmin = 22, xmax = 30, ymin = 15, ymax = 15, parametre={action="action",id="localmdp"}, back_color = 128})
end