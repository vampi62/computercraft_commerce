function page_info()
	table.insert(global_objet_write,{x = 20, y = 5, text = "info", back_color = 32768, text_color = 1})

	table.insert(global_objet_write,{x = 4, y = 7, text = "systeme : " .. global_systeme_nom, back_color = 32768, text_color = 1})
	table.insert(global_objet_write,{x = 4, y = 9, text = "version : " .. global_systeme_version, back_color = 32768, text_color = 1})
	
	table.insert(global_objet_write,{x = 4, y = 14, text = "creer par : vampi62", back_color = 32768, text_color = 1})
end