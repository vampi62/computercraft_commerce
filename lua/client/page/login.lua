function page_login()
	table.insert(global_objet_write,{x = 24, y = 5, text = "login", back_color = 32768, text_color = 1})
	table.insert(global_objet_write,{x = 15, y = 1, text = "pseudo", back_color = 32768, text_color = 1})
	table.insert(global_objet_write,{x = 23, y = 1, text = "mot de", back_color = 32768, text_color = 1})
	table.insert(global_objet_write,{x = 38, y = 1, text = "passe", back_color = 32768, text_color = 1})
	
	table.insert(global_objet_write,{x = 23, y = 1, text = variable_pseudo, back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 38, y = 1, text = variable_mdp, back_color = 256, text_color = 1})
	
	table.insert(global_objet_write,{x = 3, y = 13, text = "pas de compte", back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 35, y = 13, text = "mdp oublier", back_color = 32768, text_color = 1})
	table.insert(global_objet_write,{x = 23, y = 13, text = "valider", back_color = 256, text_color = 1})

	table.insert(global_objet_select,{xmin = 35, xmax = 15, ymin = 13, ymax = 13, name = "page_oublie", back_color = 256})
	table.insert(global_objet_select,{xmin = 3, xmax = 45, ymin = 13, ymax = 13, name = "page_inscription", back_color = 256})
	table.insert(global_objet_select,{xmin = 23, xmax = 29, ymin = 13, ymax = 13, name = "valide_login", back_color = 256})

	table.insert(global_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, name = "variable_pseudo", back_color = 256})
	table.insert(global_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, name = "variable_mdp", back_color = 256})
end