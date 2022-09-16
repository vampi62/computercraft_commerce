function page_mise_a_jour()
	table.insert(global_term_objet_write,{x = 21, y = 5, text = "mise a jour", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 7, text = "systeme | installer | nouvelle | maj", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 14, y = 8, text = "|", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 26, y = 8, text = "|", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 37, y = 8, text = "|", back_color = 32768, text_color = 1})

	table.insert(global_term_objet_write,{x = 6, y = 8, text = global_systeme_nom, back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 16, y = 8, text = global_systeme_version, back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 28, y = 8, text = global_new_version[global_systeme_nom], back_color = 32768, text_color = 1})

	if global_systeme_version ~= global_new_version[global_systeme_nom] and global_new_version[global_systeme_nom] ~= "" and global_new_version[global_systeme_nom] ~= nil then
		table.insert(global_term_objet_select,{xmin = 39, xmax = 41, ymin = 8, ymax = 8, value={action="action",id="maj"}, back_color = 128})
		table.insert(global_term_objet_write,{x = 39, y = 8, text = " X ", back_color = 128, text_color = 1})
	else
		table.insert(global_term_objet_write,{x = 39, y = 8, text = " X ", back_color = 32768, text_color = 1})
	end
end