function page_login_pc()
	if global_page_visible == 0 then
		table.insert(global_term_objet_write,{x = 15, y = 5, text = "mot de passe poste local", back_color = 32768, text_color = 1})
	elseif global_page_visible == 200 then
		table.insert(global_term_objet_write,{x = 15, y = 5, text = "mot de passe poste local", back_color = 32768, text_color = 1})
	elseif global_page_visible == 201 then
		table.insert(global_term_objet_write,{x = 20, y = 4, text = "changement", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 15, y = 5, text = "mot de passe poste local", back_color = 32768, text_color = 1})
	end
	if global_page_visible == 0 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 9, text = "confirm     :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 256, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 256, text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["confirm_len"], back_color = 256, text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="mdp",value="code"}, back_color = 256})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="confirm",value="code"}, back_color = 256})

		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="setlocalmdp",value=0}, back_color = 256})
	elseif global_page_visible == 200 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 256, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 256, text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="mdp",value="code"}, back_color = 256})

		table.insert(global_term_objet_select,{xmin = 22, xmax = 30, ymin = 15, ymax = 15, value={action="action",id="localmdp",value=0}, back_color = 256})
	elseif global_page_visible == 201 then
		table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 9, text = "confirm     :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 6, y = 11, text = "ancien mdp  :", back_color = 32768, text_color = 1})
		table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 256, text_color = 1})

		table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 256, text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["confirm_len"], back_color = 256, text_color = 1})
		table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["ancienmdp_len"], back_color = 256, text_color = 1})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="mdp",value="code"}, back_color = 256})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="confirm",value="code"}, back_color = 256})
		table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, value={action="variable",id="ancienmdp",value="code"}, back_color = 256})

		table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, value={action="action",id="changelocalmdp",value=0}, back_color = 256})
	end

	-- pour afficher les message_http -- la section nav n'est pas charger pour cette page
	if global_page_visible == 0 then
		if global_message ~= "" then
			local messagetext = split(global_message, "-")
			if messagetext[1] == "succes " then
				messagecolor = 256
			elseif messagetext[1] == "erreur " then
				messagecolor = 16384
			else
				messagecolor = 32768
			end 
			table.insert(global_term_objet_write,{x = 3, y = 17, text = string.sub(messagetext[2],2), back_color = messagecolor, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, value={action="action",id="disable_message",value=0}, back_color = messagecolor})
		end
	end
end