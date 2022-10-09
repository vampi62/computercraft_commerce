function page_edit_config()
	-- champs pres rempli
	creation_variable({"ip","port","uriapi","urilua"},{global_url,global_port,global_api_uri,global_lua_uri})

	table.insert(global_term_objet_write,{x = 15, y = 5, text = "changement config reseau", back_color = 32768, text_color = 1})

	table.insert(global_term_objet_write,{x = 6, y = 7, text = "ip/dns      :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 9, text = "port        :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 11, text = "uri api     :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 13, text = "uri lua     :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 22, y = 15, text = "envoyer", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["ip"], back_color = 128 + change_color_champ_select("ip"), text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["port"], back_color = 128 + change_color_champ_select("port"), text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["uriapi"], back_color = 128 + change_color_champ_select("uriapi"), text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 13, text = global_variable["urilua"], back_color = 128 + change_color_champ_select("urilua"), text_color = 1})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="ip",type="text"}, back_color = 128 + change_color_champ_select("ip")})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, parametre={action="variable",nom="port",type="int"}, back_color = 128 + change_color_champ_select("port")})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, parametre={action="variable",nom="uriapi",type="text"}, back_color = 128 + change_color_champ_select("uriapi")})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 13, ymax = 13, parametre={action="variable",nom="urilua",type="text"}, back_color = 128 + change_color_champ_select("urilua")})

	table.insert(global_term_objet_select,{xmin = 22, xmax = 28, ymin = 15, ymax = 15, parametre={action="action",id="edit_config"}, back_color = 128})
end