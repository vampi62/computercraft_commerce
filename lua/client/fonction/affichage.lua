function affichage()
	while true do
        term.clear()
        for j = 1, #global_objet_select do
			if global_objet_select[j]["back_color"] ~= "" then
                term.setBackgroundColor(global_objet_select[j]["back_color"])
                for h = global_objet_select[j]["ymin"], global_objet_select[j]["ymax"] do
                    term.setCursorPos(global_objet_select[j]["xmin"],h)
                    for l = global_objet_select[j]["xmin"], global_objet_select[j]["xmax"] do
                        term.write(" ")
                    end
                end
            end
		end
        for j = 1, #global_objet_write do
            term.setBackgroundColor(global_objet_write[j]["back_color"])
            term.setTextColor(global_objet_write[j]["text_color"])
            term.setCursorPos(global_objet_write[j]["x"],global_objet_write[j]["y"])
			term.write(global_objet_write["text"])
		end
        sleep(0.3)
    end
end