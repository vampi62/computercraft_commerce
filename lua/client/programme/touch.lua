function touch()
	while true do
		local event, side, x, y = os.pullEvent("monitor_touch")
		for j = #global_monitor_objet_select[side], 1, -1 do
			if y < #global_monitor_objet_select[side][j]["ymax"] and y > #global_monitor_objet_select[side][j]["ymin"] and x < #global_monitor_objet_select[side][j]["xmax"] and x > #global_monitor_objet_select[side][j]["xmin"] then
				global_objet_touch = global_monitor_objet_select[side][j]
				global_objet_touch["side"] = side
				break
			end
		end
	end
end