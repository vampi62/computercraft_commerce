function page_edit_config()
	-- champs pres rempli
	local variable_a_remplir = {"ip","port","uriapi","urilua"}
	local variable_a_coller = {global_url,global_port,global_api_uri,global_lua_uri}
	remplir_variable(variable_a_remplir,variable_a_coller)


	table.insert(global_term_objet_write,{x = 15, y = 5, text = "changement config reseau", back_color = 32768, text_color = 1})

	table.insert(global_term_objet_write,{x = 6, y = 7, text = "ip/dns      :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 9, text = "port        :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 11, text = "uri api     :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 13, text = "uri lua     :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 22, y = 15, text = "envoyer", back_color = 256, text_color = 1})

	table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["ip"], back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["port"], back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["uriapi"], back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 13, text = global_variable["urilua"], back_color = 256, text_color = 1})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, value={action="variable",id="ip",value="text"}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, value={action="variable",id="port",value="int"}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, value={action="variable",id="uriapi",value="text"}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 13, ymax = 13, value={action="variable",id="urilua",value="text"}, back_color = 256})

	table.insert(global_term_objet_select,{xmin = 22, xmax = 28, ymin = 15, ymax = 15, value={action="action",id="edit_config",value=0}, back_color = 256})
end