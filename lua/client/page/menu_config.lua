function page_menu_config()
	table.insert(global_term_objet_write,{x = 22, y = 5, text = "config pc", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 12, y = 7, text = "mise a jour", back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 12, y = 9, text = "edit config", back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 12, y = 11, text = "reboot", back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 12, y = 13, text = "shutdown", back_color = 256, text_color = 1})
	table.insert(global_term_objet_write,{x = 12, y = 15, text = "infos", back_color = 256, text_color = 1})

	table.insert(global_term_objet_select,{xmin = 12, xmax = 22, ymin = 7, ymax = 7, value={action="page",id=203,value=0}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 12, xmax = 22, ymin = 9, ymax = 9, value={action="page",id=205,value=0}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 12, xmax = 22, ymin = 11, ymax = 11, value={action="action",id="reboot",value=0}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 12, xmax = 22, ymin = 13, ymax = 13, value={action="action",id="shutdown",value=0}, back_color = 256})
	table.insert(global_term_objet_select,{xmin = 12, xmax = 22, ymin = 15, ymax = 15, value={action="page",id=204,value=0}, back_color = 256})
end