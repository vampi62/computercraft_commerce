function click()
	while true do
		local event, side, x, y = os.pullEvent("mouse_click")
		if global_edit_variable["nom"] ~= nil then
			global_click = {parametre={action="purge"}}
		end
		for j = #global_term_objet_select, 1, -1 do
			if y <= global_term_objet_select[j]["ymax"] and y >= global_term_objet_select[j]["ymin"] and x <= global_term_objet_select[j]["xmax"] and x >= global_term_objet_select[j]["xmin"] then
				global_click = global_term_objet_select[j]
				break
			end
		end
	end
end