function affichage_term()
	while true do
		if global_refresh_term then
			global_refresh_term = false
			term.setBackgroundColor(32768)
			term.clear()
			for j = 1, #global_term_objet_select do
				term.setBackgroundColor(global_term_objet_select[j]["back_color"])
				for h = global_term_objet_select[j]["ymin"], global_term_objet_select[j]["ymax"] do
					term.setCursorPos(global_term_objet_select[j]["xmin"],h)
					for l = global_term_objet_select[j]["xmin"], global_term_objet_select[j]["xmax"] do
						term.write(" ")
					end
				end
			end
			for j = 1, #global_term_objet_write do
				term.setBackgroundColor(global_term_objet_write[j]["back_color"])
				term.setTextColor(global_term_objet_write[j]["text_color"])
				term.setCursorPos(global_term_objet_write[j]["x"],global_term_objet_write[j]["y"])
				if global_term_objet_write[j]["text"] ~= nil then
					term.write(global_term_objet_write[j]["text"])
				end
			end
		end
		sleep(0.5)
	end
end