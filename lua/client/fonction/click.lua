function click()
	global_click = ""
	while true do
		local event, side, x, y = os.pullEvent("mouse_click")
		for j = #global_objet_select, 1, -1 do
			if y < #global_objet_select["ymax"] and y > #global_objet_select["ymin"] and x < #global_objet_select["xmax"] and x > #global_objet_select["xmin"] then
				global_click = global_objet_select["name"]
				global_value_click = global_objet_select["value"]
				break
			end
		end
	end
end