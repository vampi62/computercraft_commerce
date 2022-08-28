function page_menu_config()
	table.insert(global_objet_write,{x = 12, y = 5, text = "mise a jour", back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 12, y = 7, text = "edit config", back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 12, y = 9, text = "reboot", back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 12, y = 11, text = "shutdown", back_color = 256, text_color = 1})
	table.insert(global_objet_write,{x = 12, y = 13, text = "infos", back_color = 256, text_color = 1})

	table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 5, ymax = 5, name = "page_mise_a_jour", back_color = 256})
	table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 7, ymax = 7, name = "edit_config", back_color = 256})
	table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 9, ymax = 9, name = "reboot", back_color = 256})
	table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 11, ymax = 11, name = "shutdown", back_color = 256})
	table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 13, ymax = 13, name = "page_info", back_color = 256})
end